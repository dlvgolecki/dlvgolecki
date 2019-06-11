<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?>

	<?php $header_position = ot_get_option( 'header_position' ); ?>
	<?php if ( $header_position == 'left' || $header_position == 'right' ) { ?>
	</div><!-- #header-main-wrapper -->
	<?php } ?>
	
	<?php // Single Nav ?>
	<?php if ( is_single() ) { ?>
		<?php $single_post_navigation = ot_get_option( 'single_post_navigation' ); ?>
		<?php if ( empty( $single_post_navigation ) ) { ?>
			<?php $single_post_navigation = 'enable'; ?>
		<?php } ?>
		
		<?php $single_portfolio_navigation = ot_get_option( 'single_portfolio_navigation' ); ?>
		<?php if ( empty( $single_portfolio_navigation ) ) { ?>
			<?php $single_portfolio_navigation = 'enable'; ?>
		<?php } ?>
		
		<?php if ( $single_post_navigation == 'enable' && 'post' == get_post_type() || $single_portfolio_navigation == 'enable' && 'portfolio' == get_post_type() ) { ?>
			<div class="nav-pagination-single-wrapper clearfix">
				<nav id="nav-pagination-single" class="clearfix">
				<?php $next_post = get_next_post(); ?>
				<?php if ( ! empty( $next_post ) ) { ?>
					<div class="nav-previous">
						<a class="previous" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
						<span class="text-wrapper"><?php echo esc_html__( 'Prev', 'skylab' ); ?></span>
							<span class="content-wrapper">
								<span class="title-wrapper"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
								
								<?php if ( has_post_thumbnail() ) { ?>
									<?php $next_post_thumbnail_id = get_post_thumbnail_id( $next_post->ID ); ?>
									<?php $next_post_featured_img = wp_get_attachment_image_src( $next_post_thumbnail_id, 'medium' ); ?>
									<div class="featured-image-wrapper">
										<div class="featured-image lazy" style="padding-bottom: <?php echo esc_attr( ($next_post_featured_img[2] / $next_post_featured_img[1]) * 100 ) ?>%;">
											<?php echo '<img width="'. $next_post_featured_img[1] .'" height="'. $next_post_featured_img[2] .'" data-src="'. $next_post_featured_img[0] .'" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" />'; ?>
											<div class="loader">
												<svg class="circular" viewBox="25 25 50 50">
													<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="10"/>
												</svg>
											</div>
										</div>
									</div>
								<?php } ?>
							</span>
						</a>
					</div>
				<?php } else { ?>
					<div class="nav-previous">
						<span class="previous not-active">
							<span class="text-wrapper"><?php echo esc_html__( 'Prev', 'skylab' ); ?></span>
						</span>
					</div>
				<?php } ?>
				
				<?php $prev_post = get_previous_post(); ?>
				<?php if ( ! empty( $prev_post ) ) { ?>
					<div class="nav-next compensate-for-scrollbar">
						<a class="next" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
						<span class="text-wrapper"><?php echo esc_html__( 'Prev', 'skylab' ); ?></span>
							<span class="content-wrapper">
								<span class="title-wrapper"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
							
								<?php if ( has_post_thumbnail() ) { ?>
									<?php $prev_post_thumbnail_id = get_post_thumbnail_id( $prev_post->ID ); ?>
									<?php $prev_post_featured_img = wp_get_attachment_image_src( $prev_post_thumbnail_id, 'medium' ); ?>
									<div class="featured-image-wrapper">
										<div class="featured-image lazy" style="padding-bottom: <?php echo esc_attr( ($prev_post_featured_img[2] / $prev_post_featured_img[1]) * 100 ) ?>%;">
											<?php echo '<img width="'. $prev_post_featured_img[1] .'" height="'. $prev_post_featured_img[2] .'" data-src="'. $prev_post_featured_img[0] .'" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" />'; ?>
											<div class="loader">
												<svg class="circular" viewBox="25 25 50 50">
													<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="10"/>
												</svg>
											</div>
										</div>
									</div>
								<?php } ?>
							</span>
						</a>
					</div>
				<?php } else { ?>
					<div class="nav-next">
						<span class="next not-active">
							<span class="text-wrapper"><?php echo esc_html__( 'Next', 'skylab' ); ?></span>
						</span>
					</div>
				<?php } ?>
				</nav>
			</div>
		<?php } ?>
	<?php } ?>

	<?php $back_to_top_button = ot_get_option( 'back_to_top_button' ); ?>
	<?php if ( empty( $back_to_top_button ) ) { ?>
		<?php $back_to_top_button = 'enable'; ?>
	<?php } ?>
	<?php if ( $back_to_top_button == 'enable' ) { ?>
		<?php $back_to_top_button_align = ot_get_option( 'back_to_top_button_align' ); ?>
		<?php if ( empty( $back_to_top_button_align ) ) { ?>
			<?php $back_to_top_button_align = 'fixed'; ?>
		<?php } ?>
	<?php if ( $back_to_top_button_align == 'fixed' ) { ?>
	<div id="to-top" class="<?php echo sanitize_html_class( $back_to_top_button_align ); ?> compensate-for-scrollbar"><i></i></div>
	<?php } ?>
	<?php } ?>
	
	<!-- Footer
================================================== -->
<footer id="colophon">
	<?php $footer_parallax = ot_get_option( 'footer_parallax' ); ?>
	<?php if ( $footer_parallax == 'enable' ) { ?>
	<div class="footer-parallax-opacity" style="opacity: 0;">
	<?php } ?>
	
	<?php get_sidebar( 'footer' ); ?>
	<?php if ( has_nav_menu( 'subfooter' ) || $back_to_top_button == 'enable' && $back_to_top_button_align != 'fixed' || is_active_sidebar( 'sidebar-8'  ) || is_active_sidebar( 'sidebar-9' ) ) { ?>
	<div id="site-generator-wrapper">
		<div id="site-generator" class="clearfix">
					
			<div class="clearfix">
			
			<?php get_sidebar( 'subfooter' ); ?>
			
			<?php if ( has_nav_menu( 'subfooter' ) ) { ?>
				<nav id="footer-access" class="clearfix">
					<?php wp_nav_menu( array( 'theme_location' => 'subfooter', 'menu_class' => '', 'container_class' => 'nav-menu', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</nav><!-- #access -->
			<?php } ?>
			
			<?php if ( $back_to_top_button == 'enable' ) { ?>
				<?php if ( $back_to_top_button_align != 'fixed' ) { ?>
				<div id="to-top" class="<?php echo sanitize_html_class( $back_to_top_button_align ); ?>"><i></i></div>
				<?php } ?>
			<?php } ?>
			</div>
		</div>
	</div><!-- #site-generator-wrapper -->
	<?php } ?>
	<?php if ( $footer_parallax == 'enable' ) { ?>
	</div>
	<?php } ?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>