<?php

/**
* Visual Composer Norebro WooCommerce categories shortcode custom style
*/

$_style_block = '';

if ( $title_css ) {
	$_style_block .= '#' . $woo_categories_uniqid . ' .info-wrap .second-title a{';
	$_style_block .= $title_css;
	$_style_block .= '}';
}

if ( $description_css ) {
	$_style_block .= '#' . $woo_categories_uniqid . ' .info-wrap .description{';
	$_style_block .= $description_css;
	$_style_block .= '}';
}

if ( $button_css ) {
	$_style_block .= '#' . $woo_categories_uniqid . ' .info-wrap a.shop-now{';
	$_style_block .= $button_css;
	$_style_block .= '}';
}

if ( $button_css_hover ) {
	$_style_block .= '#' . $woo_categories_uniqid . ' .info-wrap a.shop-now:hover{';
	$_style_block .= $button_css_hover;
	$_style_block .= '}';
}

if ( $overlay_css ) {
	$_style_block .= '#' . $woo_categories_uniqid . ' .info-wrap .content-center{';
	$_style_block .= $overlay_css;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );