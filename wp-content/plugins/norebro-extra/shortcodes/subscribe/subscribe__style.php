<?php

/**
* Visual Composer Norebro Subscribe shortcode custom style
*/

$_style_block = '';

if ( $table_css ) {
	$_style_block .= '#' . $subscribe_uniqid . ' table{';
	$_style_block .= $table_css;
	$_style_block .= '}';
}
if ( $button_css['css'] ) {
	$_style_block .= '#' . $subscribe_uniqid . ' .btn{';
	$_style_block .= $button_css['css'];
	$_style_block .= '}';
}
if ( $button_css['hover-css'] ) {
	$_style_block .= '#' . $subscribe_uniqid . ' .btn:hover{';
	$_style_block .= $button_css['hover-css'];
	$_style_block .= '}';
}
if ( $input_color_css ) {
	$_style_block .= '#' . $subscribe_uniqid . '.subscribe input[type="text"]{';
	$_style_block .= $input_color_css;
	$_style_block .= ' } ';
	$_style_block .= '#' . $subscribe_uniqid . '.subscribe input[type="text"]::-webkit-input-placeholder{';
	$_style_block .= $input_color_css;
	$_style_block .= '}';
	$_style_block .= '#' . $subscribe_uniqid . '.subscribe input[type="text"]:-ms-input-placeholder{';
	$_style_block .= $input_color_css;
	$_style_block .= '}';
	$_style_block .= '#' . $subscribe_uniqid . '.subscribe input[type="text"]::-moz-placeholder{';
	$_style_block .= $input_color_css;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );