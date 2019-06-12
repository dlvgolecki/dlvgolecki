<?php

/**
* Visual Composer Norebro Pricing Table shortcode custom style
*/

$_style_block = '';

if ( $pricing_table_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . '{';
	$_style_block .= $pricing_table_settings;
	$_style_block .= '}';
}
if ( $borders_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' .price,';
	$_style_block .= '#' . $pricing_table_uniqid . ' .list-box li,';
	$_style_block .= '#' . $pricing_table_uniqid . ' .list-box li:first-child{';
	$_style_block .= $borders_settings;
	$_style_block .= '}';
}
if ( $title_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' h3{';
	$_style_block .= $title_settings;
	$_style_block .= '}';
}
if ( $subtitle_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' p.pricing-subtitle{';
	$_style_block .= $subtitle_settings;
	$_style_block .= '}';
}
if ( $description_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' .price .subtitle{';
	$_style_block .= $description_settings;
	$_style_block .= '}';
}
if( $price_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' .price h2.title{';
	$_style_block .= $price_settings;
	$_style_block .= '}';
}
if( $price_caption_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' .price .time-interval{';
	$_style_block .= $price_caption_settings;
	$_style_block .= '}';
}

if ( $button_css['css'] ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' .btn{';
	$_style_block .= $button_css['css'];
	$_style_block .= '}';
}
if ( $button_css['hover-css'] ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' .btn:hover{';
	$_style_block .= $button_css['hover-css'];
	$_style_block .= '}';
}

if( $features_titles_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' .list-box li .title{';
	$_style_block .= $features_titles_settings;
	$_style_block .= '}';
}
if( $features_icons_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' .list-box li .icon{';
	$_style_block .= $features_icons_settings;
	$_style_block .= '}';
}
if( $features_disabled_titles_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' .list-box li.disabled .title{';
	$_style_block .= $features_disabled_titles_settings;
	$_style_block .= '}';
}
if( $features_disabled_icons_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' .list-box li.disabled .icon{';
	$_style_block .= $features_disabled_icons_settings;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );