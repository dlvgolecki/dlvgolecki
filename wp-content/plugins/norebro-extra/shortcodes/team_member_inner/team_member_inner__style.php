<?php

/**
* Visual Composer Norebro Team Members Group Inner shortcode custom style
*/

$_style_block = '';

if ( $overlay_settings ) {
	$_style_block .= '#' . $team_member_uniqid . '.cover-content{';
	$_style_block .= $overlay_settings;
	$_style_block .= '}';
}
if ( $name_settings ) {
	$_style_block .= '#' . $team_member_uniqid . ' h3{';
	$_style_block .= $name_settings;
	$_style_block .= '}';
}
if ( $position_settings ) {
	$_style_block .= '#' . $team_member_uniqid . ' p.subtitle{';
	$_style_block .= $position_settings;
	$_style_block .= '}';
}
if ( $description_settings ) {
	$_style_block .= '#' . $team_member_uniqid . ' .description{';
	$_style_block .= $description_settings;
	$_style_block .= '}';
}
if ( $social_settings ) {
	$_style_block .= '#' . $team_member_uniqid . ' .socialbar a{';
	$_style_block .= $social_settings;
	$_style_block .= '}';
}
if ( $social_hover_settings ) {
	$_style_block .= '#' . $team_member_uniqid . ' .socialbar a:hover{';
	$_style_block .= $social_hover_settings;
	$_style_block .= '}';
}

if ( vc_mode() == 'page_editable' ) {
	echo '<style>' . $_style_block . '</style>';
} else {
	NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );
}