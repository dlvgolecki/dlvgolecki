<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to mega_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?>
	<div id="comments-wrapper" class="clearfix">
	<div id="comments" class="clearfix">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'skylab' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 id="comments-title">
			<?php
				printf( _n( 'Comments <span>(%1$s)</span>', 'Comments <span>(%1$s)</span>', get_comments_number(), 'skylab' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use mega_comment() to format the comments.
				 * See mega_comment() in mega/functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'mega_comment' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
			<nav class="nav-pagination-single comments-nav clearfix">
				<?php
				$args = array(
					'prev_text' => '<span>'. esc_html__( 'Older comments', 'skylab' ) .'</span>',
					'next_text' => '<span>'. esc_html__( 'Newer comments', 'skylab' ) .'</span>'
				);
				?>
				<?php $result = get_the_comments_navigation($args); ?>
				<?php echo $result; ?>
			</nav>
		<?php } // check for comment navigation ?>

	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'skylab' ); ?></p>
	<?php endif; ?>

	<?php global $required_text; ?>
	<?php global $aria_req; ?>
	<?php global $post_id; ?>
	<?php $comments_args = array(
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html_x( 'Comment', 'noun', 'skylab' ) . '</label> <textarea id="comment" name="comment" placeholder="' . esc_html_x( 'Comment', 'noun', 'skylab' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>',
		'title_reply' => '<span>'. esc_html__( 'Leave a Comment', 'skylab' ) .'</span>',
		'title_reply_to' => esc_html__( 'Reply', 'skylab' ),
		'cancel_reply_link' => esc_html__( 'Cancel', 'skylab' ),
		'logged_in_as'         => '<p class="logged-in-as"><a href="'. get_edit_user_link() .'"><span>'. esc_html__( 'Logged in as', 'skylab' ) .' '. $user_identity .'</span></a>. <a href="'. wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) .'"><span>'. esc_html__( 'Log out?', 'skylab' ) .'</span></a></p>',
		'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.', 'skylab' ) . ( $req ? $required_text : '' ) . '</p>',
		'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' =>
			  '<p class="comment-form-author">' .
			  '<label for="author">' . esc_html__( 'Name', 'skylab' ) . '</label> ' .
			  ( $req ? '<span class="required">' . esc_html__( '(required)', 'skylab' ) . '</span>' : '' ) .
			  '<input id="author" name="author" type="text" placeholder="' . esc_html__( 'Name', 'skylab' ) . ( $req ? esc_html__( ' (required)', 'skylab' ) : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
			  '" size="30"' . $aria_req . ' /></p>',

			'email' =>
			  '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'skylab' ) . '</label> ' .
			  ( $req ? '<span class="required">' . esc_html__( '(required)', 'skylab' ) . '</span>' : '' ) .
			  '<input id="email" name="email" type="text" type="text" placeholder="' . esc_html__( 'Email', 'skylab' ) . ( $req ? esc_html__( ' (required)', 'skylab' ) : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			  '" size="30"' . $aria_req . ' /></p>',
			'url' =>
			  '<p class="comment-form-url"><label for="url">' .
			  esc_html__( 'Website', 'skylab' ) . '</label>' .
			  '<input id="url" name="url" type="text" placeholder="' . esc_html__( 'Website', 'skylab' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) .
			  '" size="30" /></p>'
			)
		),
	); ?>
	
	<?php comment_form( $comments_args ); ?>

</div><!-- #comments -->
</div><!-- #comments-wrapper -->
