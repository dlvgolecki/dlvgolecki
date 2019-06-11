<?php
/*
 * The template for displaying all single portfolios.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
get_header();

// Metabox
$elston_id    = ( isset( $post ) ) ? $post->ID : 0;
$elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
$elston_id    = ( elston_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elston_id;
$elston_meta  = get_post_meta( $elston_id, 'portfolio_type_metabox', true );

if ($elston_meta) {
	$content_padding = $elston_meta['content_spacings'];
	$hide_featured_image = $elston_meta['hide_featured_image'];
	$portfolio_layout_options = $elston_meta['portfolio_layout_options'];
	$portfolio_carousel = $elston_meta['portfolio_carousel'];
	$hide_navigation = $elston_meta['hide_navigation'];
	$portfolio_sidebar_full = $elston_meta['portfolio_sidebar_full'];
} else {
	$content_padding = '';
	$hide_featured_image = '';
	$portfolio_layout_options = '';
	$portfolio_carousel = '';
	$hide_navigation = '';
	$portfolio_sidebar_full = '';
}

// Padding - Metabox
if ($content_padding == 'padding-standard') {
	$content_padding = 'version2';
} elseif ($content_padding == 'padding-modern'){
	$content_padding = 'version2 version3';
} elseif ($content_padding == 'padding-narrow'){
	$content_padding = 'spacer2';
} else {
	$content_padding = '';
}

// Banner Featured Image
if ($elston_meta) {
	$banner_image = $elston_meta['choose_banner_image'] ? $elston_meta['choose_banner_image'] : '';
	if ($banner_image === 'masonry_image') {
		$large_image = wp_get_attachment_url($elston_meta['portfolio_masonry_image']);
	} elseif ($banner_image === 'wide_image') {
		$large_image = wp_get_attachment_url($elston_meta['portfolio_wide_image']);
	} else {
		$large_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
		$large_image = $large_image[0];
	}
} else {
	$large_image = '';
}

// Translation
$single_pagination = cs_get_option('portfolio_page_link');
$portfolio_link = cs_get_option('portfolio_link');
$prev_port = cs_get_option('prev_port');
$next_port = cs_get_option('next_port');
$prev_port = ($prev_port) ? $prev_port : esc_html__('Prev Project', 'elston');
$next_port = ($next_port) ? $next_port : esc_html__('Next Project', 'elston');

if($portfolio_layout_options == 'slider') {
	get_template_part('layouts/portfolio/portfolio', 'slider' );
} else { ?>

	<?php if($hide_featured_image == false) { ?>
		<?php if($large_image) { ?>
			<?php if($portfolio_layout_options == 'default' || $portfolio_layout_options == 'carousel') { ?>
				<div class="elstn-portfolio-banner" style="background-image: url(<?php echo esc_url($large_image) ?>)"></div>
			<?php } ?>
		<?php } ?>
	<?php } ?>
	<div class="elstn-portfolio-detail <?php echo esc_attr($content_padding); ?>">
		<?php $post_class = (!empty($portfolio_sidebar_full)) ? '' : 'container';?>
		<div id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>

			<?php
			if (have_posts()) : while (have_posts()) : the_post();

				the_content();

			endwhile;
			endif;
			?>
		</div><!-- Post ID -->

		<!-- For displaying bottom carousel for single portfolios. -->
		<?php if($portfolio_layout_options == 'carousel') { ?>
	      <div class="elstn-projects-slider">
	        <div class="container">
	          <div class="elstn-default-slider" data-items="3" data-margin="0" data-loop="true" data-nav="true">
		        <?php
		        if( !empty( $portfolio_carousel ) ) {
		          $images = explode( ',', $portfolio_carousel );
		          foreach($images as $image){
		            $large_image =  wp_get_attachment_image_src( $image, 'full' );
		            $large_image =  $large_image[0];
		          ?>
		          <div class="item"><img src="<?php echo esc_url($large_image);?>" alt=""/></div>
		          <?php } ?>
		        <?php } ?>
	          </div>
	        </div>
	      </div>
		<?php } ?>
		<!-- .elstn-projects-slider -->

		<!-- Next and Prev Navigation -->
		<?php if( $single_pagination ) { ?>
			<?php if ( $hide_navigation == false ) { ?>
			<div class="container">

				<div class="elstn-more-project">
					<?php
					$prev_post = get_previous_post();
					$next_post = get_next_post();
					if ($prev_post) {
					?>
					<div class="pull-left">
						<a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="elstn-portfolio-prev">
							<?php echo esc_attr($prev_port); ?>
						</a>
					</div>
					<?php } ?>
					<div class="project-grid">
						<a href="<?php echo esc_url(get_permalink($portfolio_link)); ?>"><span></span> <span></span> <span></span> <span></span></a>
	        </div>
					<?php
					if ($next_post) { ?>
					<div class="pull-right">
					<a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="elstn-portfolio-next">
						<?php echo esc_attr($next_port); ?>
					</a>
					</div>
					<?php } ?>
				</div>

			</div><!-- container -->
			<?php } ?>
		<?php } ?>
	</div>

<?php get_footer();
}