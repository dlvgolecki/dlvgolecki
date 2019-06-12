<?php
/**
 * Template Name: Blank Template
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

get_header(); ?>

	<div id="main-wrapper" class="clearfix vc_column_container">
	<div class="vc_column-inner">
	<div id="main" class="clearfix">

		<div id="primary">
			<div id="content" role="main">
			
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
		
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