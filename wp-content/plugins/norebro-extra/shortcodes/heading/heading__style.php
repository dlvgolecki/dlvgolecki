<?php

/**
* Visual Composer Norebro Heading shortcode custom style
*/

$_style_block = '';

if ( $title_settings ) {
	$_style_block .= '#' . $headings_uniqid . ' ' . $heading_type . '{';
	$_style_block .= $title_settings;
	$_style_block .= '}';
}
if ( $subtitle_settings ) {
	$_style_block .= '#' . $headings_uniqid . ' p.subtitle{';
	$_style_block .= $subtitle_settings;
	$_style_block .= '}';
}
if ( $divider_settings ) {
	$_style_block .= '#' . $headings_uniqid . ' .divider{';
	$_style_block .= $divider_settings;
	$_style_block .= '}';
}

if ( $mobile_title_settings ) {
	$_style_block .= '@media screen and (max-width: 768px){';
	$_style_block .= '#' . $headings_uniqid . ' ' . $heading_type . '{';
	$_style_block .= $mobile_title_settings;
	$_style_block .= '}}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );