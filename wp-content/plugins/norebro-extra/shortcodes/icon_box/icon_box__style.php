<?php

/**
* Visual Composer Norebro Icon Box shortcode custom style
*/

$_style_block = '';

if ( $title_settings ) {
	$_style_block .= '#' . $icon_box_uniqid . ' h3{';
	$_style_block .= $title_settings;
	$_style_block .= '}';
}
if ( $subtitle_settings ) {
	$_style_block .= '#' . $icon_box_uniqid . ' p.subtitle{';
	$_style_block .= $subtitle_settings;
	$_style_block .= '}';
}
if ( $description_settings ) {
	$_style_block .= '#' . $icon_box_uniqid . ' .description{';
	$_style_block .= $description_settings;
	$_style_block .= '}';
}
if ( $icon_css ) {
	$_style_block .= '#' . $icon_box_uniqid . ' .icon-wrap{';
	$_style_block .= $icon_css;
	$_style_block .= '}';
}
if ( isset( $button_css['css'] ) && $button_css['css'] ) {
	$_style_block .= '#' . $icon_box_uniqid . ' .icon-box-link,';
	$_style_block .= '#' . $icon_box_uniqid . ' .icon-box-link .icon-arrow,';
	$_style_block .= '#' . $icon_box_uniqid . ' .btn{';
	$_style_block .= $button_css['css'];
	$_style_block .= '}';
}
if ( isset( $button_css['hover-css'] ) && $button_css['hover-css'] ) {
	$_style_block .= '#' . $icon_box_uniqid . ' .btn:hover{';
	$_style_block .= $button_css['hover-css'];
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );