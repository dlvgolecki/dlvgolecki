<?php

/**
* Visual Composer Norebro Banner shortcode custom style
*/

$_style_block = '';

if ( $title_css ) {
	$_style_block .= '#' . $banner_box_uniqid . ' h4{';
	$_style_block .= $title_css;
	$_style_block .= '}';
}
if ( $subtitle_css ) {
	$_style_block .= '#' . $banner_box_uniqid . ' p.subtitle{';
	$_style_block .= $subtitle_css;
	$_style_block .= '}';
}
if ( $description_css ) {
	$_style_block .= '#' . $banner_box_uniqid . ' p.description{';
	$_style_block .= $description_css;
	$_style_block .= '}';
}
if ( $overlay_css ) {
	$_style_block .= '#' . $banner_box_uniqid . ' .box-title,';
	$_style_block .= '#' . $banner_box_uniqid . ' .wrap-content{';
	$_style_block .= $overlay_css;
	$_style_block .= '}';
}
if ( $content_css ) {
	$_style_block .= '#' . $banner_box_uniqid . ' .content{';
	$_style_block .= $content_css;
	$_style_block .= '}';
}
if ( $title_wrap_css ) {
	$_style_block .= '#' . $banner_box_uniqid . ' .title-wrap{';
	$_style_block .= $title_wrap_css;
	$_style_block .= '}';
}
if ( isset( $button_css['css'] ) && $button_css['css'] ) {
	$_style_block .= '#' . $banner_box_uniqid . ' .btn-link,';
	$_style_block .= '#' . $banner_box_uniqid . ' .btn{';
	$_style_block .= $button_css['css'];
	$_style_block .= '}';
}
if ( isset( $button_css['hover-css'] ) && $button_css['hover-css'] ) {
	$_style_block .= '#' . $banner_box_uniqid . ' .btn:hover{';
	$_style_block .= $button_css['hover-css'];
	$_style_block .= '}';
}
if ( isset( $inner_padding_css ) && $inner_padding_css ) {
	$_style_block .= '#' . $banner_box_uniqid . ' .overlay{';
	$_style_block .= $inner_padding_css;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );