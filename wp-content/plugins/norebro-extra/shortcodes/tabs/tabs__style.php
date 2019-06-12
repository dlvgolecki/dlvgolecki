<?php

/**
* Visual Composer Norebro Tabs shortcode custom style
*/

$_style_block = '';

if ( $tabs_settings ) {
	$_style_block .= '#' . $tabs_uniqid . '{';
	$_style_block .= $tabs_settings;
	$_style_block .= '}';
}
if ( $content_settings ) {
	$_style_block .= '#' . $tabs_uniqid . ' .item p,';
	$_style_block .= '#' . $tabs_uniqid . ' .item{';
	$_style_block .= $content_settings;
	$_style_block .= '}';
}
if ( $tab_settings ) {
	$_style_block .= '#' . $tabs_uniqid . ' .button{';
	$_style_block .= $tab_settings;
	$_style_block .= '}';
}
if ( $tab_active_settings ) {
	$_style_block .= '#' . $tabs_uniqid . ' .button:hover,';
	$_style_block .= '#' . $tabs_uniqid . ' .button.active{';
	$_style_block .= $tab_active_settings;
	$_style_block .= '}';
}
if ( $tabs_line_settings ) {
	$_style_block .= '#' . $tabs_uniqid . ' .buttons .line{';
	$_style_block .= $tabs_line_settings;
	$_style_block .= '}';
}
if ( $tabs_border_settings ) {
	$_style_block .= '#' . $tabs_uniqid . ' .buttons-wrap{';
	$_style_block .= $tabs_border_settings;
	$_style_block .= '}';
}

if ( vc_mode() == 'page_editable' ) {
	echo '<style>' . $_style_block . '</style>';
} else {
	NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );
}