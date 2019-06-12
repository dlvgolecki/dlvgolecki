<?php

/**
* Visual Composer Norebro Progress Bar shortcode custom style
*/

$_style_block = '';

if ( $label_settings ) {
	$_style_block .=  '#' . $progress_bar_uniqid . '.progress-bar h4 .left{';
	$_style_block .= $label_settings;
	$_style_block .= '}';
}
if ( $percent_settings ) {
	$_style_block .= '#' . $progress_bar_uniqid . '.progress-bar .line-percent,';
	$_style_block .= '#' . $progress_bar_uniqid . '.progress-bar h4 .right{';
	$_style_block .= $percent_settings;
	$_style_block .= '}';
}
if ( $bar_bg_settings ) {
	if ( $layout == 'split' ) {
		$_style_block .= '#' . $progress_bar_uniqid . '.progress-bar .line-split{';
		$_style_block .= $bar_bg_settings;
		$_style_block .= '}';
	} else {
		$_style_block .= '#' . $progress_bar_uniqid . '.progress-bar .line-wrap{';
		$_style_block .= $bar_bg_settings;
		$_style_block .= '}';
	}
}
if ( $bar_line_settings ) {
	$_style_block .= '#' . $progress_bar_uniqid . '.progress-bar .line{';
	$_style_block .= $bar_line_settings;
	$_style_block .= '}';
}
if ( $tooltip_settings ) {
	$_style_block .= '#' . $progress_bar_uniqid . '.progress-bar .line-percent{';
	$_style_block .= $tooltip_settings;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );