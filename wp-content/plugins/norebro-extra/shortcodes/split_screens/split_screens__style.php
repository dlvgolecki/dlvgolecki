<?php

/**
* Visual Composer Norebro Split Screens shortcode custom style
*/

$_style_block = '';

if ( $animation_duration_css ) {
	$_style_block .= '#' . $split_screens_uniqid . ' .ms-easing{';
	$_style_block .= $animation_duration_css;
	$_style_block .= '}'; 
}
if ( $navigation_css ) {
	$_style_block .= '#multiscroll-nav li a{';
	$_style_block .= $navigation_css;
	$_style_block .= '}';
	$_style_block .= '#multiscroll-nav li a.active{';
	$_style_block .= $navigation_active_css;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );