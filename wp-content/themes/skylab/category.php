<?php
get_header(); ?>

	<div id="main-wrapper" class="clearfix">
	<div class="vc_column-inner">
	<div id="main" class="clearfix">
	<div id="main-content" class="clearfix">
	
	<div id="primary">
	<div id="content" role="main">		
					
	<div class="entry-content clearfix">
		<div class="vc_row wpb_row vc_row-fluid vc_row-has-fill no-margin"><div class="wrapper clearfix"><div class="inner-wrapper clearfix"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
			<div class="wpb_text_column wpb_content_element heading-wrapper">
				<div class="wpb_wrapper">
					<h1><?php printf( esc_html( 'All in: %s', 'skylab' ), '<span>“' . single_cat_title( '', false ) . '”</span>' ); ?></h1>
				</div>
			</div>
		
			<?php if ( have_posts() ) { ?>
			<?php if ( get_option('permalink_structure') ) { ?>
				<?php $permalink_class = 'permalinks-enabled'; ?>
			<?php } else { ?>
				<?php $permalink_class = 'permalinks-disabled'; ?>
			<?php } ?>
			
			<div class="wpb_teaser_grid wpb_content_element wpb_grid-alternative wpb_teaser_grid_post posts-style-9 columns_count_1 vc_span12 clearfix">
				<div class="wpb_wrapper">
				<div class="teaser_grid_container mt-animate_when_almost_visible-enabled infinite-scroll-disabled <?php echo sanitize_html_class( $permalink_class ); ?> lazyload-disabled clearfix">
					<div class="mt-loader spinner3"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>
					<div class="wpb_thumbnails-alternative wpb_thumbnails-fluid clearfix" data-layout-mode="masonry">
						<div class="grid-sizer"></div>
						<div class="gutter-sizer"></div>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
								
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'isotope-item clearfix' ); ?>>
							<div class="hentry-text-wrapper">
								<div class="entry-meta">
									<?php mega_posted_on(); ?>
								</div>
								
								<?php if ( has_post_thumbnail() ) { ?>
									<?php $post_thumbnail_id = get_post_thumbnail_id( $post->ID ); ?>
									<?php $post_featured_img = wp_get_attachment_image_src( $post_thumbnail_id, 'medium' ); ?>
									<div class="featured-image-wrapper-helper">
										<div class="featured-image-wrapper">
											<div class="featured-image lazy" style="padding-bottom: <?php echo esc_attr( ($post_featured_img[2] / $post_featured_img[1]) * 100 ) ?>%;">
												<?php echo '<img data-src="'. $post_featured_img[0] .'" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" />'; ?>
												<div class="loader">
													<svg class="circular" viewBox="25 25 50 50">
														<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="10"/>
													</svg>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
								
								<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							</div>
						</article><!-- #post-<?php the_ID(); ?> -->
						
						<?php endwhile; ?>
																									
					</div>
				</div><!-- .teaser_grid_container -->
									
				<?php mega_pagination_content_nav( 'nav-pagination' ); ?>
					
			</div><!-- .wpb_wrapper -->
			</div><!-- .wpb_teaser_grid -->
			<?php } ?>
		
		</div></div></div></div></div></div>
	</div><!-- .entry-content -->
	
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