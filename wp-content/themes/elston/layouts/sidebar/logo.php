<?php
// Logo Image
$brand_logo_default = cs_get_option('brand_logo_default');
$brand_logo_default_small = cs_get_option('brand_logo_default_small');
$brand_logo_retina = cs_get_option('brand_logo_retina');

// Metabox - Header Transparent
$elston_id    = ( isset( $post ) ) ? $post->ID : 0;
$elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
$elston_id    = ( elston_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elston_id;
$elston_meta  = get_post_meta( $elston_id, 'page_type_metabox', true );

// Retina Size
$retina_width = cs_get_option('retina_width');
$retina_height = cs_get_option('retina_height');

// Logo Spacings
$brand_logo_top = cs_get_option('brand_logo_top');
$brand_logo_bottom = cs_get_option('brand_logo_bottom');
if ($brand_logo_top) {
	$brand_logo_top = 'padding-top:'. elston_check_px($brand_logo_top) .';';
} else { $brand_logo_top = ''; }
if ($brand_logo_bottom) {
	$brand_logo_bottom = 'padding-bottom:'. elston_check_px($brand_logo_bottom) .';';
} else { $brand_logo_bottom = ''; }
?>
<div class="logo elston-logo" style="<?php echo esc_attr($brand_logo_top); echo esc_attr($brand_logo_bottom); ?>">
	<a href="<?php echo esc_url(home_url('/')); ?>">
	<?php
	if ($brand_logo_default != ''){
		if ($brand_logo_retina){
			echo '<img src="'. wp_get_attachment_url($brand_logo_default) .'" alt="', esc_attr(bloginfo('name')) .'" class="default-logo" />
					<img src="'. wp_get_attachment_url($brand_logo_retina) .'" width="'. esc_attr($retina_width) .'" height="'. esc_attr($retina_height) .'" alt="', esc_attr(bloginfo('name')) .'" class="retina-logo" />
				';
		} else {
			echo '<img src="'. esc_attr(wp_get_attachment_url($brand_logo_default)) .'" alt="', esc_attr(bloginfo('name')) .'" class="default-logo" />';
		}
	} else {
		echo '<span class="text-logo">'. esc_attr(get_bloginfo( 'name' )) . '</span>';
	}
	echo '</a>';
	?>
</div><?php
