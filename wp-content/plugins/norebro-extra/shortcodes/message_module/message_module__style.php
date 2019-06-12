<?php

/**
* Visual Composer Norebro Message module shortcode custom style
*/

$_style_block = '';

if ( $message_settings ) {
	$_style_block .= '#' . $message_box_uniqid . '.message-box{';
	$_style_block .= $message_settings;
	$_style_block .= '}';
}
if ( $link_settings ) {
	$_style_block .= '#' . $message_box_uniqid . '.message-box a{';
	$_style_block .= $link_settings;
	$_style_block .= '}';
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );