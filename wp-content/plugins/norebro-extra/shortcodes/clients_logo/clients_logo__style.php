<?php

/**
* Visual Composer Norebro Clients logo shortcode custom style
*/

$_style_block = '';

if ( $overlay_settings ) {
	$_style_block .= '#' . $clients_logo_uniqid . ' .overlay{';
	$_style_block .= $overlay_settings;
	$_style_block .= '}';
}
if ( $title_settings ) {
	$_style_block .= '#' . $clients_logo_uniqid . ' .title{';
	$_style_block .= $title_settings;
	$_style_block .= '}';
}
if ( $description_settings ) {
	$_style_block .= '#' . $clients_logo_uniqid . ' .description{';
	$_style_block .= $description_settings;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );