<?php

$_style_block = '';

if ( $color_css ) {
	$_style_block .= '#' . $social_bar_uniqid . '.socialbar a{';
	$_style_block .= $color_css;
	$_style_block .= '}';
}
if ( $icon_color_css ) {
	$_style_block .= '#' . $social_bar_uniqid . '.socialbar a .icon{';
	$_style_block .= $icon_color_css;
	$_style_block .= '}';
}
if ( $color_css_before ) {
	$_style_block .= '#' . $social_bar_uniqid . '.socialbar a:before{';
	$_style_block .= $color_css_before;
	$_style_block .= '}';
}
if ( $color_css_hover ) {
	$_style_block .= '#' . $social_bar_uniqid . '.socialbar a:hover{';
	$_style_block .= $color_css_hover;
	$_style_block .= '}';
}
if ( $icon_hover_color_css ) {
	$_style_block .= '#' . $social_bar_uniqid . '.socialbar a:hover .icon{';
	$_style_block .= $icon_hover_color_css;
	$_style_block .= '}';
}

if ( vc_mode() == 'page_editable' ) {
	echo '<style>' . $_style_block . '</style>';
} else {
	NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );
}