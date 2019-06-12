<?php

/**
* Visual Composer Norebro Carousel shortcode custom style
*/

$_style_block = '';

if ( $slider_css ) {
	$_style_block .= '#' . $slider_uniqid . ' {';
	$_style_block .= $slider_css;
	$_style_block .= '}';
}
if ( $items_css ) {
	$_style_block .= '#' . $slider_uniqid . ' > .owl-stage-outer > .owl-stage > .owl-item{';
	$_style_block .= $items_css;
	$_style_block .= '}';
}
if ( $dots_settings ) {
	$_style_block .= '#' . $slider_uniqid . ' > .owl-dots > .owl-dot.active,';
	$_style_block .= '#' . $slider_uniqid . ' > .owl-dots > .owl-dot:hover{';
	$_style_block .= $dots_settings;
	$_style_block .= '}';
	$_style_block .= '#' . $slider_uniqid . ' .owl-dot:after{';
	$_style_block .= $dots_after_settings;
	$_style_block .= '}';
}
if ( $nav_settings ) {
	$_style_block .= '#' . $slider_uniqid . ' > .owl-nav div{';
	$_style_block .= $nav_settings;
	$_style_block .= '}';
}
if ( $nav_bg_settings ) {
	$_style_block .= '#' . $slider_uniqid . ' > .owl-nav div{';
	$_style_block .= $nav_bg_settings;
	$_style_block .= '}';
}

if ( vc_mode() == 'page_editable' ) {
	echo '<style>' . $_style_block . '</style>';
	echo '<script> window.norebroRefreshFrontEnd(); </script>';
} else {
	NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );
}