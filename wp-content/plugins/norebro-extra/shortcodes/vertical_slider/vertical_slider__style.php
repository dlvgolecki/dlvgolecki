<?php

/**
* Visual Composer Norebro Vertical Fullscreen Slider shortcode custom style
*/

$_style_block = '';

if ( $navigation_css ) {
	$_style_block .= '#' . $split_pages_uniqid  . ' .slider-vertical-dots li,';
	$_style_block .= '#' . $split_pages_uniqid  . ' .slider-vertical-numbers li{';
	$_style_block .= $navigation_css;
	$_style_block .= '}';
	$_style_block .= '#' . $split_pages_uniqid  . ' .slider-vertical-dots li.active,';
	$_style_block .= '#' . $split_pages_uniqid  . ' .slider-vertical-numbers li.active{';
	$_style_block .= $navigation_active_css;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );