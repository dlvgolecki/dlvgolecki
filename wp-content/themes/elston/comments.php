<?php
/*
 * The template for displaying comments.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="elstn-comments-area comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
	<div class="comments-section">
		<div class="wrapper">

			<h3 class="comments-title">
				<?php
					printf( // WPCS: XSS OK.
						esc_html__( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments title', 'elston' ) ),
						number_format_i18n( get_comments_number() ),
						'<span>' . get_the_title() . '</span>'
					);
				?>
			</h3>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-above" class="navigation vt-comment-navigation" role="navigation">
				<h2 class="vt-screen-reader-text"><?php esc_html_e( 'Comment navigation', 'elston' ); ?></h2>
				<div class="vt-nav-links">

					<div class="vt-nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'elston' ) ); ?></div>
					<div class="vt-nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'elston' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
			<?php endif; // Check for comment navigation. ?>

			<ol class="comments">
				<?php wp_list_comments('type=all&callback=elston_comment_modification'); ?>
			</ol><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="vt-comment-nav-below" class="navigation vt-comment-navigation" role="navigation">
				<h2 class="vt-screen-reader-text"><?php esc_html_e( 'Comment navigation', 'elston' ); ?></h2>
				<div class="vt-nav-links">

					<div class="vt-nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'elston' ) ); ?></div>
					<div class="vt-nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'elston' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
			<?php
			endif; // Check for comment navigation.
		?>

		</div><!-- .comments-section-wrapper -->
	</div><!-- .comments-section -->

	<?php else: ?>
	<div class="comments-section no-comments">
		<div class="wrapper">
          <h3 class="comments-title"><?php esc_html_e( 'No Comments', 'elston' ); ?></h3>
          <p><?php esc_html_e( 'There are not comments on this post yet. Be the first one!', 'elston' ); ?></p>
		</div><!-- .comments-section-wrapper -->
	</div><!-- .comments-section -->
	<?php

	endif; // Check for have_comments()

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<p class="vt-no-comments"><?php esc_html_e( 'Comments are closed.', 'elston' ); ?></p>
		<?php
		endif;
		?>

	<?php
	/* ==============================================
	  Comment Forms
	=============================================== */
	if ( comments_open() ) { ?>
	<div id="respond" class="elstn-comment-form comment-respond">
		<div id="" class="wrapper">
			<?php
			$post_comment_text = cs_get_option('post_comment_text');
			$post_comment_text = $post_comment_text ? $post_comment_text : esc_html__( 'Post Comment', 'elston' );
			$fields = array(
				'author' => '<div class="elstn-form-inputs no-padding-left"><input type="text" id="author" name="author" value="' . esc_attr( $commenter['comment_author'] ) . '" tabindex="1" placeholder="' . esc_html__( 'Name', 'elston' ) . '"/>',
				'email' => '<input type="text" id="email" name="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" tabindex="2" placeholder="' . esc_html__( 'Email', 'elston' ) . '"/>',
				'URL' => '<input type="text" id="url" name="url" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" tabindex="3" placeholder="' . esc_html__( 'Phone', 'elston' ) . '"/></div>',
			);
			$defaults = array(
	      'comment_notes_before' => '',
	      'comment_notes_after'  => '',
	      'fields' => apply_filters( 'comment_form_default_fields', $fields),
	      'id_form'              => 'commentform',
	      'id_submit'            => 'submit',
	      'class_submit' 		 => 'elstn-btn elstn-btn-one elstn-btn-medium submit',
	      'title_reply'          => esc_html__( 'Post your Comment', 'elston' ),
	      'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'elston' ),
	      'cancel_reply_link'    => '<i class="icon-close"></i>'. '',
	      'label_submit'         => $post_comment_text,
	      'comment_field' 			 => '<div class="elstn-form-textarea no-padding-right"><textarea id="comment" name="comment" tabindex="4" rows="3" cols="30" placeholder="' . esc_html__( 'Write your comment...', 'elston' ) . '" ></textarea></div>'
	    );

			comment_form($defaults);
			?>
		</div>
	</div>
	<?php } ?>
</div><!-- #comments --><?php
