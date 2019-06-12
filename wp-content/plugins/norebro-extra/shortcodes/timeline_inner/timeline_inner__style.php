<?php

/**
* Visual Composer Norebro Timeline Inner shortcode custom style
*/

$_style_block = '';

if ( $background_settings ) {
	$_style_block .= '#' . $timeline_uniqid . ' .wrap{';
	$_style_block .= $background_settings;
	$_style_block .= '}';
}
if ( $title_settings ) {
	$_style_block .= '#' . $timeline_uniqid . ' h3{';
	$_style_block .= $title_settings;
	$_style_block .= '}';
}
if ( $subtitle_settings ) {
	$_style_block .= '#' . $timeline_uniqid . ' .subtitle{';
	$_style_block .= $subtitle_settings;
	$_style_block .= '}';
}
if ( $description_settings ) {
	$_style_block .= '#' . $timeline_uniqid . ' .description{';
	$_style_block .= $description_settings;
	$_style_block .= '}';
}
if ( $dot_bg_settings ) {
	$_style_block .= '#' . $timeline_uniqid . ':after{';
	$_style_block .= $dot_bg_settings;
	$_style_block .= '}';
}
if ( $line_settings ) {
	$_style_block .= '#' . $timeline_uniqid . ':before{';
	$_style_block .= $line_settings;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );