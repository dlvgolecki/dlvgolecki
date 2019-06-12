<?php
get_header(); ?>

	<div id="main-wrapper" class="clearfix">
	<div class="vc_column-inner">
	<div id="main" class="clearfix">
	<div id="main-content" class="clearfix">
	
	<div id="primary" class="vc_column_container">
		<div class="vc_column-inner">
			<div id="content" role="main">		
							
			<div class="entry-content clearfix">
				<div class="vc_row wpb_row vc_row-fluid vc_row-has-fill no-margin"><div class="wrapper clearfix"><div class="inner-wrapper clearfix"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element heading-wrapper">
						<div class="wpb_wrapper">
							<?php if ( is_front_page() ) { ?>
								<h2><?php esc_html_e( 'Blog', 'skylab' ); ?></h2>
							<?php } else { ?>
								<h2><?php echo apply_filters( 'the_title', get_the_title( get_option( 'page_for_posts' ) ) ); ?></h2>
							<?php } ?>
						</div>
					</div>
					
					<?php if ( have_posts() ) { ?>
					<?php if ( get_option('permalink_structure') ) { ?>
						<?php $permalink_class = 'permalinks-enabled'; ?>
					<?php } else { ?>
						<?php $permalink_class = 'permalinks-disabled'; ?>
					<?php } ?>
					
					<div class="wpb_teaser_grid wpb_content_element wpb_grid-alternative wpb_teaser_grid_post posts-style-1 columns_count_1 vc_span12 clearfix">
						<div class="wpb_wrapper">
						<div class="teaser_grid_container mt-animate_when_almost_visible-disabled infinite-scroll-disabled <?php echo sanitize_html_class( $permalink_class ); ?> lazyload-enabled clearfix">
							<div class="mt-loader spinner3"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>
							<div class="wpb_thumbnails-alternative wpb_thumbnails-fluid clearfix" data-layout-mode="masonry">
								<div class="grid-sizer"></div>
								<div class="gutter-sizer"></div>

								<?php /* Start the Loop */ ?>
								<?php while ( have_posts() ) : the_post(); ?>
										
									<?php get_template_part( 'content', get_post_format() ); ?>
									
								<?php endwhile; ?>
																											
							</div>
						</div><!-- .teaser_grid_container -->
											
						<?php mega_pagination_content_nav( 'nav-pagination' ); ?>
						
						<?php wp_reset_postdata(); ?>
							
					</div><!-- .wpb_wrapper -->
					</div><!-- .wpb_teaser_grid -->
					<?php } ?>
				
				</div></div></div></div></div></div>
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