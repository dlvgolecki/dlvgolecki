<?php

/**
* Visual Composer Norebro Counter shortcode custom style
*/

$_style_block = '';

if ( $title_css ) {
	$_style_block .= '#' . $counter_box_uniqid . '.counter-box h3.title{';
	$_style_block .= $title_css;
	$_style_block .= '}';
}
if ( $subtitle_css ) {
	$_style_block .= '#' . $counter_box_uniqid . '.counter-box p.subtitle{';
	$_style_block .= $subtitle_css;
	$_style_block .= '}';
}
if ( $count_css ) {
	$_style_block .= '#' . $counter_box_uniqid . '.counter-box .counter-box-count span.count{';
	$_style_block .= $count_css;
	$_style_block .= '}';
}
if ( $icon_css ) {
	$_style_block .= '#' . $counter_box_uniqid . '.counter-box .counter-box-icon{';
	$_style_block .= $icon_css;
	$_style_block .= '}';
}

if ( vc_mode() == 'page_editable' ) {
	echo '<style>' . $_style_block . '</style>';
	echo '<script> window.norebroRefreshFrontEnd(); </script>';
} else {
	NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );
}