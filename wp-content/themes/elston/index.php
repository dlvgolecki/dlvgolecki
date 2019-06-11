<?php
/*
 * The main template file.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
get_header();

// Metabox
$elston_id    = ( isset( $post ) ) ? $post->ID : 0;
$elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
$elston_id    = ( elston_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elston_id;
$elston_meta  = get_post_meta( $elston_id, 'post_type_metabox', true );
$page_meta  = get_post_meta( $elston_id, 'page_type_metabox', true );

if ($elston_meta) {
	$content_padding = $elston_meta['content_spacings'];
} else { $content_padding = ''; }
// Padding - Metabox
if ($content_padding && $content_padding !== 'padding-none') {
	$content_top_spacings = $elston_meta['content_top_spacings'];
	$content_bottom_spacings = $elston_meta['content_bottom_spacings'];
	if ($content_padding === 'padding-custom') {
		$content_top_spacings = $content_top_spacings ? 'padding-top:'. elston_check_px($content_top_spacings) .';' : '';
		$content_bottom_spacings = $content_bottom_spacings ? 'padding-bottom:'. elston_check_px($content_bottom_spacings) .';' : '';
		$custom_padding = $content_top_spacings . $content_bottom_spacings;
	} else {
		$custom_padding = '';
	}
} else {
	$custom_padding = '';
}

// Page Sub Title
if ($page_meta) {
	if ($page_meta['page_custom_subtitle']) {
		$page_sub_title = $page_meta['page_custom_subtitle'];
	} else {
		$page_sub_title = get_bloginfo( 'description', 'display' );
	}
} else {
	$page_sub_title = get_bloginfo( 'description', 'display' );
}

// Theme Options
$blog_style = cs_get_option('blog_listing_style');
if($blog_style == 'modern'){
	$blog_version = 'version2';
	$blog_container = 'clearfix';
	$blog_col = 'content_ajax';
	$load_more_class = '';
} else {
	$blog_version = 'version1';
	$blog_container = 'container';
	$blog_col = 'content_ajax elstn-masonry col-item-3';
	$load_more_class = 'space2';
}

$pagination_type = cs_get_option('pagination_type');
$more_text = cs_get_option('more_text');
?>

<div class="elstn-blogs <?php echo esc_attr($blog_version); ?> <?php echo esc_attr($content_padding); ?>" style="<?php echo esc_attr($custom_padding); ?>">
	<div class="container">

	    <div class="elstn-top-title">
	      <h1><?php elston_title_area();?></h1>
	      <p><?php echo esc_attr($page_sub_title); ?></p>
	    </div>
	</div>

	<div id="container" class="<?php echo esc_attr($blog_container); ?>">

		<div class="<?php echo esc_attr($blog_col); ?>">
		<?php
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				get_template_part( 'layouts/post/content' );
			endwhile;
		else :
			get_template_part( 'layouts/post/content', 'none' );
		endif; ?>

		</div>

		<?php
			if ($pagination_type == 'ajax') { ?>
				<div id="elston-load-posts" class="elstn-load-more <?php echo esc_attr($load_more_class); ?>"><a href="#0"><?php echo esc_attr($more_text); ?></a></div>
				<?php
			} else { ?>
				<div class="elstn-load-more <?php echo esc_attr($load_more_class); ?>">
					<?php elston_paging_nav();?>
				</div>
				<?php

			}
			wp_reset_postdata();  // avoid errors further down the page
		?>
	</div>

</div>

<?php
get_footer();