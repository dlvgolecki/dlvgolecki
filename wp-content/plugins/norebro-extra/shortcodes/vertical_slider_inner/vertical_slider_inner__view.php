<?php

/**
* Visual Composer Norebro Vertical Slider Page shortcode view
*/

?>
<section class="onepage-section<?php echo esc_attr($css_class) ?>" id="<?php echo $split_page_uniqid; ?>"
	<?php if( $pagination_color ) { echo ' data-pagination-color="' . esc_attr( $pagination_color ) . '"'; } ?>
	<?php if( $header_nav_color ) { echo ' data-header-nav-color="' . esc_attr( $header_nav_color ) . '"'; } ?>
	<?php if( $header_logo_type != 'none' ) { echo ' data-header-logo-type="' . esc_attr( $header_logo_type ) . '"'; } ?>>

	<?php echo do_shortcode( $content ); ?>

</section>