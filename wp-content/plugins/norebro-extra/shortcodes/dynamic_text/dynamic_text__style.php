<?php

/**
* Visual Composer Norebro Dynamic Text shortcode custom style
*/

$_style_block = '';

if ( $alignment_css || $static_color_css || $static_typo_css ) {
	$_style_block .= '#' . $dynamic_text_uniqid . '{';
	$_style_block .= $alignment_css;
	$_style_block .= $static_color_css;
	$_style_block .= $static_typo_css;
	$_style_block .= '}';
}

if ( $dynamic_color_css || $dynamic_typo_css ) {
	$_style_block .= '#' . $dynamic_text_uniqid . ' .dynamic,#' . $dynamic_text_uniqid . ' .typed-cursor{';
	$_style_block .= $dynamic_color_css;
	$_style_block .= $dynamic_typo_css;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );