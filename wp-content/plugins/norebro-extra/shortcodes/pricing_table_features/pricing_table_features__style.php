<?php

/**
* Visual Composer Norebro Pricing Table Features shortcode custom style
*/

$_style_block = '';

if ( $pricing_table_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . '{';
	$_style_block .= $pricing_table_settings;
	$_style_block .= '}';
}
if ( $borders_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . '.list-box li,';
	$_style_block .= '#' . $pricing_table_uniqid . '.list-box li:first-child{';
	$_style_block .= $borders_settings;
	$_style_block .= '}';
}
if ( $title_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' h3{';
	$_style_block .= $title_settings;
	$_style_block .= '}';
}
if ( $features_titles_settings ) {
	$_style_block .= '#' . $pricing_table_uniqid . ' .list-box li .title{';
	$_style_block .= $features_titles_settings;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );