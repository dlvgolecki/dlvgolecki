<?php
get_header(); ?>
	
	<div id="main-wrapper" class="clearfix">
	<div class="vc_column-inner">
	<div id="main" class="clearfix">
	<div id="main-content" class="clearfix">
	
	<div id="primary">
	<div id="content" role="main">		
					
	<div class="entry-content clearfix">
		<div class="vc_row wpb_row vc_row-fluid vc_row-has-fill"><div class="wrapper clearfix"><div class="inner-wrapper clearfix"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
			<div class="wpb_text_column wpb_content_element ">
				<div class="wpb_wrapper">
					<h2><?php single_post_title(); ?></h2>
				</div>
			</div>
		
			<?php if ( have_posts() ) { ?>
			<?php if ( get_option('permalink_structure') ) { ?>
				<?php $permalink_class = 'permalinks-enabled'; ?>
			<?php } else { ?>
				<?php $permalink_class = 'permalinks-disabled'; ?>
			<?php } ?>
			
			<div class="wpb_teaser_grid wpb_content_element wpb_grid-alternative wpb_teaser_grid_post posts-style-9 columns_count_1 pagination-right  vc_span12 infinite-scroll-button-style-2 clearfix">
				<div class="wpb_wrapper">
				<div class="teaser_grid_container mt-animate_when_almost_visible-enabled infinite-scroll-enabled-with-button <?php echo sanitize_html_class( $permalink_class ); ?> lazyload-disabled clearfix">
					<div class="mt-loader spinner3"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>
					<div class="wpb_thumbnails-alternative wpb_thumbnails-fluid clearfix" data-layout-mode="masonry">
						<div class="grid-sizer"></div>
						<div class="gutter-sizer"></div>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
								
						<article id="post-<?php the_ID(); ?>" class="isotope-item vc_span12 clearfix">
							<div class="hentry-text-wrapper">
								<div class="entry-meta">
									<?php if ( is_sticky() ) { ?>
										<span class="entry-category"><?php esc_html_e( 'Sticky', 'skylab' ); ?></span>
									<?php } else { ?>
										<?php $categories = get_the_category(); ?>
										<?php $category_names = array(); ?>
										<?php foreach ($categories as $category) { ?>
											<?php $category_names[] = $category->cat_name; ?>
										<?php } ?>
										<span class="entry-category"><?php echo implode(', ', $category_names); ?></span>
									<?php } ?>
								</div>
								<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							</div>
						</article><!-- #post-<?php the_ID(); ?> -->
						
						<?php endwhile; ?>
																									
					</div>
				</div><!-- .teaser_grid_container -->
				
				<?php if ( $wp_query->max_num_pages > 1 ) { ?>
					<div class="load-more-wrapper vc_btn3-container vc_btn3-center">
						<a class="load-more vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-round vc_btn3-style-modern vc_btn3-color-blue"><b class="load-more-button-text"><span><?php esc_html_e( 'Load More', 'skylab' ); ?></span></b></a>
					</div>
				<?php } ?>
									
				<?php mega_pagination_content_nav( 'nav-pagination' ); ?>
					
			</div><!-- .wpb_wrapper -->
			</div><!-- .wpb_teaser_grid -->
			<?php } else { ?>
			
				<article id="post-0" class="post no-results not-found">
					<p><?php esc_html_e( 'Apologies, but no results were found for the requested archive.', 'skylab' ); ?></p>
				</article>
			
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