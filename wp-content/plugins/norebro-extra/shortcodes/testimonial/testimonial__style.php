<?php

/**
* Visual Composer Norebro Testimonial shortcode custom style
*/

$_style_block = '';

if ( $quote_settings ) {
	$_style_block .= '#' . $testimonial_uniqid . ' blockquote{';
	$_style_block .= $quote_settings;
	$_style_block .= '}';
}
if ( $image_settings ) {
	$_style_block .= '#' . $testimonial_uniqid . ' .avatar{';
	$_style_block .= $image_settings;
	$_style_block .= '}';
}
if ( $author_settings ) {
	$_style_block .= '#' . $testimonial_uniqid . ' h4.title{';
	$_style_block .= $author_settings;
	$_style_block .= '}';
}
if ( $position_settings ) {
	$_style_block .= '#' . $testimonial_uniqid . ' p.subtitle{';
	$_style_block .= $position_settings;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );