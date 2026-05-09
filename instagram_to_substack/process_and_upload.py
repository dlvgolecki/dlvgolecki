#!/usr/bin/env python3
"""
Reads downloaded Instagram posts, extracts titles via Claude, and creates
Substack drafts via Playwright browser automation.
"""
import os
import json
import glob
import argparse
import sys
from pathlib import Path
from dotenv import load_dotenv
import anthropic
from playwright.sync_api import sync_playwright, TimeoutError as PlaywrightTimeout

load_dotenv()

ANTHROPIC_API_KEY = os.getenv("ANTHROPIC_API_KEY")
SUBSTACK_EMAIL = os.getenv("SUBSTACK_EMAIL")
SUBSTACK_PASSWORD = os.getenv("SUBSTACK_PASSWORD")
SUBSTACK_URL = os.getenv("SUBSTACK_URL", "").rstrip("/")
POSTS_DIR = os.getenv("DOWNLOAD_DIR", "./instagram_posts")
PROCESSED_LOG = os.getenv("PROCESSED_LOG", "./processed_posts.json")


# ── Persistence ──────────────────────────────────────────────────────────────

def load_processed():
    if os.path.exists(PROCESSED_LOG):
        with open(PROCESSED_LOG) as f:
            return set(json.load(f))
    return set()


def save_processed(processed):
    with open(PROCESSED_LOG, "w") as f:
        json.dump(sorted(processed), f, indent=2)


# ── Post discovery ────────────────────────────────────────────────────────────

def get_posts(posts_dir):
    posts = []
    for txt_file in sorted(glob.glob(f"{posts_dir}/**/*.txt", recursive=True)):
        path = Path(txt_file)
        # instaloader caption files always have a date-like stem (contains digits)
        if not any(c.isdigit() for c in path.stem):
            continue

        with open(txt_file, encoding="utf-8") as f:
            caption = f.read().strip()

        if not caption:
            continue

        image = None
        for ext in [".jpg", ".jpeg", ".png", ".webp"]:
            candidate = path.with_suffix(ext)
            if candidate.exists():
                image = str(candidate)
                break

        posts.append({
            "id": str(path),
            "caption": caption,
            "image": image,
            "date": path.stem,
        })

    return posts


# ── Claude title extraction ───────────────────────────────────────────────────

def extract_title_and_body(caption):
    client = anthropic.Anthropic(api_key=ANTHROPIC_API_KEY)

    response = client.messages.create(
        model="claude-sonnet-4-6",
        max_tokens=1024,
        messages=[{
            "role": "user",
            "content": f"""You are formatting an Instagram caption as a Substack newsletter post.

Rules:
- If the caption's first line is clearly a title (short, punchy, self-contained), use it as-is
- Otherwise write a compelling title from the content (5–10 words max)
- Body: preserve the original voice, remove hashtags, clean up line breaks for readability
- Do not add any text that wasn't in the original caption

Caption:
{caption}

Respond with JSON only — no markdown fences:
{{"title": "...", "body": "..."}}""",
        }],
    )

    text = response.content[0].text.strip()
    # Strip markdown code fences if the model wraps anyway
    if text.startswith("```"):
        text = text.split("\n", 1)[1].rsplit("```", 1)[0].strip()

    try:
        return json.loads(text)
    except json.JSONDecodeError:
        lines = caption.strip().split("\n")
        return {"title": lines[0][:100], "body": "\n".join(lines[1:]).strip() or caption}


# ── Substack automation ───────────────────────────────────────────────────────

def login_substack(page):
    print("Logging into Substack...")
    page.goto("https://substack.com/sign-in")
    page.wait_for_load_state("networkidle")

    page.get_by_placeholder("Type your email...").fill(SUBSTACK_EMAIL)
    page.get_by_role("button", name="Continue").click()

    try:
        pwd = page.get_by_placeholder("Type your password...")
        pwd.wait_for(timeout=6000)
        pwd.fill(SUBSTACK_PASSWORD)
        page.get_by_role("button", name="Sign in").click()
        page.wait_for_load_state("networkidle")
        print("Logged in.")
    except PlaywrightTimeout:
        print(
            "\nSubstack sent a magic link instead of showing a password prompt.\n"
            "Click the link in your email, then press Enter here to continue..."
        )
        input()


def create_draft(page, title, body):
    page.goto(f"{SUBSTACK_URL}/publish/post")
    page.wait_for_load_state("networkidle")

    # Title — try placeholder first, fall back to contenteditable h1
    try:
        title_el = page.get_by_placeholder("Title").first
        title_el.wait_for(timeout=8000)
        title_el.click()
        title_el.fill(title)
    except PlaywrightTimeout:
        page.locator("h1[contenteditable], [data-testid='post-title']").first.click()
        page.keyboard.type(title)

    # Move to body editor
    page.keyboard.press("Tab")
    page.wait_for_timeout(400)

    # Type body paragraph by paragraph
    for para in body.split("\n\n"):
        para = para.strip()
        if para:
            page.keyboard.type(para)
            page.keyboard.press("Enter")
            page.keyboard.press("Enter")

    # Allow Substack's autosave to fire
    page.wait_for_timeout(3000)
    print(f"  Draft saved: {title}")


# ── Main ──────────────────────────────────────────────────────────────────────

def main():
    parser = argparse.ArgumentParser(description="Process Instagram posts → Substack drafts")
    parser.add_argument("--posts-dir", default=POSTS_DIR, help="Folder containing downloaded posts")
    parser.add_argument("--limit", type=int, default=None, help="Max posts to process this run")
    parser.add_argument("--dry-run", action="store_true", help="Extract titles but skip Substack upload")
    parser.add_argument("--headless", action="store_true", help="Run browser headlessly (no window)")
    parser.add_argument("--reprocess", action="store_true", help="Re-process already-uploaded posts")
    args = parser.parse_args()

    if not ANTHROPIC_API_KEY:
        print("Error: ANTHROPIC_API_KEY not set in .env")
        sys.exit(1)

    if not args.dry_run and not all([SUBSTACK_EMAIL, SUBSTACK_PASSWORD, SUBSTACK_URL]):
        print("Error: SUBSTACK_EMAIL, SUBSTACK_PASSWORD, and SUBSTACK_URL must all be set in .env")
        sys.exit(1)

    posts = get_posts(args.posts_dir)
    processed = load_processed()

    if not args.reprocess:
        posts = [p for p in posts if p["id"] not in processed]

    if args.limit:
        posts = posts[: args.limit]

    print(f"Found {len(posts)} post(s) to process\n")

    if not posts:
        print("Nothing to do. Run download_instagram.py first, or use --reprocess.")
        return

    with sync_playwright() as p:
        browser = p.chromium.launch(headless=args.headless)
        page = browser.new_page()

        if not args.dry_run:
            login_substack(page)

        for i, post in enumerate(posts, 1):
            print(f"\n[{i}/{len(posts)}] {post['date']}")
            print(f"  Caption: {post['caption'][:80].replace(chr(10), ' ')}...")

            result = extract_title_and_body(post["caption"])
            title = result.get("title", "Untitled")
            body = result.get("body", post["caption"])

            print(f"  Title:   {title}")

            if args.dry_run:
                print("  [DRY RUN] Skipping Substack upload.")
            else:
                create_draft(page, title, body)

            processed.add(post["id"])
            save_processed(processed)

        browser.close()

    print(f"\nDone. {len(posts)} post(s) processed.")


if __name__ == "__main__":
    main()
