<?php

/**
* Visual Composer Norebro Pricing List shortcode custom style
*/

$_style_block = '';

if ( $name_css ) {
	$_style_block .= '#' . $menu_list_uniqid . '.menu-list table td.title h4.name{';
	$_style_block .= $name_css;
	$_style_block .= '}';
}
if ( ! $regular_price && $sale_price ) {
	if ( $regular_price_css ) {
		$_style_block .= '#' . $menu_list_uniqid . '.menu-list table td.title h4.price ins{';
		$_style_block .= $regular_price_css;
		$_style_block .= '}';
	}
} else {
	if ( $sale_price_css ) {
		$_style_block .= '#' . $menu_list_uniqid . '.menu-list table td.title h4.price ins{';
		$_style_block .= $sale_price_css;
		$_style_block .= '}';
	}
}
if ( $regular_price_css ) {
	$_style_block .= '#' . $menu_list_uniqid . '.menu-list table td.title h4.price del{';
	$_style_block .= $regular_price_css;
	$_style_block .= '}';
}
if ( $border_css ) {
	$_style_block .= '#' . $menu_list_uniqid . '.menu-list table td.line:after{';
	$_style_block .= $border_css;
	$_style_block .= '}';
}
if ( $mark_css ) {
	$_style_block .= '#' . $menu_list_uniqid . '.menu-list .content .new{';
	$_style_block .= $mark_css;
	$_style_block .= '}';
}
if ( $indigriends_css ) {
	$_style_block .= '#' . $menu_list_uniqid . '.menu-list .content p{';
	$_style_block .= $indigriends_css;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );