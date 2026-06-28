#!/usr/bin/env python3
"""Downloads Instagram posts (images + captions) using instaloader."""
import os
import sys
import argparse
from dotenv import load_dotenv
import instaloader

load_dotenv()


def download_posts(username, password, target, output_dir, limit=None):
    L = instaloader.Instaloader(
        download_pictures=True,
        download_videos=False,
        download_video_thumbnails=True,
        download_geotags=False,
        download_comments=False,
        save_metadata=True,
        compress_json=False,
        post_metadata_txt_pattern="{caption}",
        dirname_pattern=os.path.join(output_dir, "{target}"),
        filename_pattern="{date_utc}_UTC",
    )

    if username and password:
        print(f"Logging in as @{username}...")
        L.login(username, password)
    else:
        print("No credentials provided — downloading as anonymous (public profiles only).")

    print(f"Fetching posts from @{target}...")
    profile = instaloader.Profile.from_username(L.context, target)

    count = 0
    for post in profile.get_posts():
        if limit and count >= limit:
            break
        preview = (post.caption or "")[:60].strip().replace("\n", " ")
        print(f"  [{count + 1}] {post.date_local.strftime('%Y-%m-%d')} — {preview}...")
        L.download_post(post, target=profile.username)
        count += 1

    print(f"\nDone. {count} posts saved to {output_dir}/{target}/")


def main():
    parser = argparse.ArgumentParser(description="Download Instagram posts with captions")
    parser.add_argument("--username", default=os.getenv("INSTAGRAM_USERNAME"), help="Your Instagram username")
    parser.add_argument("--password", default=os.getenv("INSTAGRAM_PASSWORD"), help="Your Instagram password")
    parser.add_argument("--target", default=os.getenv("TARGET_USERNAME"), help="Profile to download")
    parser.add_argument("--output-dir", default=os.getenv("DOWNLOAD_DIR", "./instagram_posts"))
    parser.add_argument("--limit", type=int, default=None, help="Max number of posts to download")
    args = parser.parse_args()

    if not args.target:
        print("Error: no target username. Use --target or set TARGET_USERNAME in .env")
        sys.exit(1)

    download_posts(args.username, args.password, args.target, args.output_dir, args.limit)


if __name__ == "__main__":
    main()
