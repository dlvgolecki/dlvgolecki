<?php
/**
 * The template for displaying image attachments.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

get_header(); ?>
	
	<div id="main-wrapper" class="clearfix">
	<div class="vc_column-inner">
	<div id="main" class="clearfix">
	<div id="main-content" class="clearfix">
		
		<div id="primary" class="image-attachment">
			<div id="content" role="main">
			
			<div class="entry-header-wrapper">
				<header class="entry-header clearfix">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->
			</div>

			<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
						<div class="entry-wrapper">

						<div class="entry-content">

							<div class="entry-attachment">
								<div class="attachment">
<?php
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
	 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
	 */
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
									<a href="<?php echo esc_url( $next_attachment_url ); ?>"><?php
									$attachment_size = apply_filters( 'mega_attachment_size', 848 );
									echo wp_get_attachment_image( $post->ID, array( $attachment_size, 1024 ) ); // filterable image width with 1024px limit for image height.
									?></a>

									<?php if ( ! empty( $post->post_excerpt ) ) : ?>
									<div class="entry-caption">
										<?php the_excerpt(); ?>
									</div>
									<?php endif; ?>
								</div><!-- .attachment -->

							</div><!-- .entry-attachment -->

							<div class="entry-description">
								<?php the_content(); ?>
								<?php wp_link_pages( array(
									'before' => '<div class="nav-pagination">',
									'after' => '</div>',
									'link_before' => '<span>',
									'link_after' => '</span>',
									) ); ?>
							</div><!-- .entry-description -->
						</div><!-- .entry-content -->
						</div><!-- .entry-wrapper -->
					</article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
		
	</div><!-- #main-content -->
	
	<?php
	$header_position = ot_get_option( 'header_position' );
	if ( empty( $header_position ) ) {
		$header_position = 'top';
	}
	if ( $header_position == 'left' || $header_position == 'right' ) {
	?>
	<?php get_footer(); ?>
	<?php } ?>
	
	</div><!-- #main -->
	</div><!-- .vc_column-inner -->
	</div><!-- #main-wrapper -->
		
<?php if ( $header_position == 'top' || $header_position == 'bottom' ) { ?>
<?php get_footer(); ?>
<?php } ?>