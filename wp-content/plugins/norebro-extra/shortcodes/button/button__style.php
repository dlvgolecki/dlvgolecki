<?php

/**
* Visual Composer Norebro Banner shortcode custom style
*/
		
$_style_block = '';

if ( $button_settings ) {
	$_style_block .= '#' . $button_uniqid . ' .btn{';
	$_style_block .= $button_settings;
	$_style_block .= '}';
}
if ( $button_hover_settings ) {
	$_style_block .= '#' . $button_uniqid . ' .btn:hover{';
	$_style_block .= $button_hover_settings;
	$_style_block .= '}';
}

if ( vc_mode() == 'page_editable' ) {
	echo '<style>' . $_style_block . '</style>';
} else {
	NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );
}