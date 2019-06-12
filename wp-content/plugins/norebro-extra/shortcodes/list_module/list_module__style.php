<?php

/**
* Visual Composer Norebro List Module shortcode custom style
*/

$_style_block = '';

if ( $title_settings ) {
	$_style_block .= '#' . $list_box_uniqid . ' li h4{';
	$_style_block .= $title_settings;
	$_style_block .= '}';
}
if ( $icon_settings ) {
	$_style_block .= '#' . $list_box_uniqid . ' li .icon{';
	$_style_block .= $icon_settings;
	$_style_block .= '}';
}
if ( $border_settings ) {
	$_style_block .= '#' . $list_box_uniqid . ' li, #' . $list_box_uniqid . ' li .wrap .col{';
	$_style_block .= $border_settings;
	$_style_block .= '}';
}
if ( $icon_shape_settings ) {
	$_style_block .= '#' . $list_box_uniqid . ' li .icon{';
	$_style_block .= $icon_shape_settings;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );