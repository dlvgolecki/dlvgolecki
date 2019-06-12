<?php

/**
* Visual Composer Norebro Pie Chart shortcode custom style
*/

$_style_block = '';

if ( $title_settings ) {
	$_style_block .= '#' . $chart_box_uniqid . '.chart-box h3.title{';
	$_style_block .= $title_settings;
	$_style_block .= '}';
}
if ( $subtitle_settings ) {
	$_style_block .= '#' . $chart_box_uniqid . '.chart-box p.subtitle{';
	$_style_block .= $subtitle_settings;
	$_style_block .= '}';
}
if ( $chart_content_settings ) {
	$_style_block .= '#' . $chart_box_uniqid . '.chart-box .pie-content{';
	$_style_block .= $chart_content_settings;
	$_style_block .= '}';
}
if ( $percent_css ) {
	$_style_block .= '#' . $chart_box_uniqid . '.chart-box span.percent-wrap{';
	$_style_block .= $percent_css;
	$_style_block .= '}';
}

if ( vc_mode() == 'page_editable' ) {
	echo '<style>' . $_style_block . '</style>';
	echo '<script> window.norebroRefreshFrontEnd(); </script>';
} else {
	NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );
}