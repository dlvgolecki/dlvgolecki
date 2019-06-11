<?php
/**
 * The Template for displaying all single posts.
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
	
		<div id="primary" class="vc_column_container">
			<div class="vc_column-inner">
				<div id="content" role="main">
				
					<div class="entry-content clearfix">

						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', get_post_format() ); ?>

						<?php endwhile; // end of the loop. ?>
					
					</div><!-- .entry-content -->

				</div><!-- #content -->
			</div><!-- .vc_column-inner -->
		</div><!-- #primary -->
		
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div id="secondary" class="vc_column_container">
				<div class="vc_column-inner">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div><!-- .vc_column-inner -->
			</div><!-- #secondary -->
		<?php } ?>
		
		</div><!-- #main-content -->
		
		<?php comments_template( '', true ); ?>
		
		
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