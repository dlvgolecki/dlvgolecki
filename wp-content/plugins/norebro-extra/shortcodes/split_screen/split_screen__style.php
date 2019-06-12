<?php

/**
* Visual Composer Norebro Split Screen shortcode custom style
*/

$_style_block = '';

if ( $bg_css || $side_paddings_css) {
	$_style_block .= '#' . $split_screen_uniqid . '{';
	$_style_block .= $bg_css;
	$_style_block .= $side_paddings_css;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );