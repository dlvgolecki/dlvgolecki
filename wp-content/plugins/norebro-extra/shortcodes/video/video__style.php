<?php

/**
* Visual Composer Norebro Video shortcode custom style
*/

$_style_block = '';

if ( $video_module_settings ) {
	$_style_block .= '#' . $video_module_uniqid . '.video-module .content{';
	$_style_block .= $video_module_settings;
	$_style_block .= '}';
}
if ( $title_settings ) {
	$_style_block .= '#' . $video_module_uniqid . '.video-module .content h4{';
	$_style_block .= $title_settings;
	$_style_block .= '}';
}
if ( $button_settings ) {
	$_style_block .= '#' . $video_module_uniqid . '.video-module .btn-play{';
	$_style_block .= $button_settings;
	$_style_block .= '}';
}
if ( $button_after_before_css ) {
	$_style_block .= '#' . $video_module_uniqid . '.video-module.with-anim .btn-play:after,';
	$_style_block .= '#' . $video_module_uniqid . '.video-module.with-anim .btn-play:before{';
	$_style_block .= $button_after_before_css;
	$_style_block .= '}';
}
if ( $icon_settings ) {
	$_style_block .= '#' . $video_module_uniqid . '.video-module .btn-play{';
	$_style_block .= $icon_settings;
	$_style_block .= '}';
}
if ( $button_hover_settings ) {
	$_style_block .= '#' . $video_module_uniqid . '.video-module:hover .btn-play{';
	$_style_block .= $button_hover_settings;
	$_style_block .= '}';
}
if ( $icon_hover_settings ) {
	$_style_block .= '#' . $video_module_uniqid . '.video-module:hover .btn-play{';
	$_style_block .= $icon_hover_settings;
	$_style_block .= '}';
}

if ( vc_mode() == 'page_editable' ) {
	echo '<style>' . $_style_block . '</style>';
	echo '<script> window.norebroRefreshFrontEnd(); </script>';
} else {
	NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );
}