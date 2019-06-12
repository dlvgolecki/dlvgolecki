<?php

/**
* Visual Composer Norebro Parallax shortcode custom style
*/

$_style_block = '';

if ( $parallax_css ) {
	$_style_block .= '#' . $parallax_uniqid . ' .parallax-bg{';
	$_style_block .= $parallax_css;
	$_style_block .= '}';
}
if ( $overlay_css ) {
	$_style_block .= '#' . $parallax_uniqid . ':after{';
	$_style_block .= $overlay_css;
	$_style_block .= '}';
}

if ( vc_mode() == 'page_editable' ) {
	echo '<style>' . $_style_block . '</style>';
	echo '<script> window.norebroRefreshFrontEnd(); </script>';
} else {
	NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );
}