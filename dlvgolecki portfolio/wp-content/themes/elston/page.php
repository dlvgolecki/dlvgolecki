<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

// Metabox
$elston_id    = ( isset( $post ) ) ? $post->ID : 0;
$elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
$elston_id    = ( elston_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elston_id;
$elston_meta  = get_post_meta( $elston_id, 'page_type_metabox', true );
$elston_layout_meta = get_post_meta( $elston_id, 'page_layout_options', true );

if ($elston_meta) {
	$content_padding = $elston_meta['content_spacings'];
	$banner_type = $elston_meta['banner_type'];
	$page_custom_title = $elston_meta['page_custom_title'];
	$page_custom_subtitle = $elston_meta['page_custom_subtitle'];
} else {
	$content_padding = '';
	$banner_type = '';
	$page_custom_title = '';
	$page_custom_subtitle = '';
}
if ($elston_layout_meta) {
	$elston_layout_meta = $elston_layout_meta['page_layout'];
} else {
	$elston_layout_meta = '';
}
$elston_layout = ($elston_layout_meta == 'extra-width') ? '' : 'container content-inner' ;

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

get_header(); ?>

<div class="<?php echo esc_attr($content_padding); ?> <?php echo esc_attr($elston_layout); ?> elston-content-area" style="<?php echo esc_attr($custom_padding); ?>">
	<?php
	while ( have_posts() ) : the_post();?>
	    <?php if($banner_type != 'hide-title-area'){ ?>
	    <div class="elstn-top-title">
	      <?php if($page_custom_title){ ?>
	      <h1><?php echo esc_attr( $page_custom_title ); ?></h1>
	      <?php } else { ?>
	      <h1><?php echo esc_attr(the_title()); ?></h1>
	      <?php } ?>
	      <?php if($page_custom_subtitle){ ?>
	      <p><?php echo esc_attr( $page_custom_subtitle ); ?></p>
	      <?php } ?>
	    </div>
	    <?php } ?>

		<?php the_content(); ?>
</div>
	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		$theme_page_comments = cs_get_option('theme_page_comments');
		if ( isset($theme_page_comments) && (comments_open() || get_comments_number()) ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

<?php
get_footer();