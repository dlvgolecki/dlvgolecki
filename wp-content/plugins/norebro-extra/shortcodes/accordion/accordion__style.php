<?php

/**
* Visual Composer Norebro Accordion shortcode custom style
*/

$_style_block = '';

if ( $tab_css ) {
	$_style_block .= '#' . $accordion_uniqid . ' .title{';
	$_style_block .= $tab_css;
	$_style_block .= '}';
}
if ( $tab_content_settings ) {
	$_style_block .= '#' . $accordion_uniqid . ' .content p{';
	$_style_block .= $tab_content_settings;
	$_style_block .= '}';
}
if ( $active_settings ) {
	$_style_block .= '#' . $accordion_uniqid . ' .item.active .control,'; 
	$_style_block .= '#' . $accordion_uniqid . ' .title:hover .control{ ';
	$_style_block .= $active_settings;
	$_style_block .= ' } '; 
}


if ( vc_mode() == 'page_editable' ) {
	echo '<style>' . $_style_block . '</style>';
	echo '<script> window.norebroRefreshFrontEnd(); </script>';
} else {
	NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );
}