<?php

/**
* Visual Composer Norebro Gallery shortcode custom style
*/

$_style_block = '';

if ( $images_css ) {
	$_style_block .= '#' . $images_uniqid . ' .gallery-image{';
	$_style_block .= $images_css;
	$_style_block .= '}';
}
if ( $overlay_settings ) {
	$_style_block .= '#' . $images_uniqid . ' .overlay{';
	$_style_block .= $overlay_settings;
	$_style_block .= '}';
}
if ( $title_settings ) {
	$_style_block .= '#' . $images_uniqid . ' h4{';
	$_style_block .= $title_settings;
	$_style_block .= '}';
}
if ( $icon_settings ) {
	$_style_block .= '#' . $images_uniqid . ' .icon{';
	$_style_block .= $icon_settings;
	$_style_block .= '}';
}
if ( $gallery_bg_settings ) {
	$_style_block .= '#' . $gallery_uniqid . '{';
	$_style_block .= $gallery_bg_settings;
	$_style_block .= '}';
}
if ( $gallery_buttons_settings ) {
	$_style_block .= '#' . $gallery_uniqid . ' .expand,';
	$_style_block .= '#' . $gallery_uniqid . ' .close{';
	$_style_block .= $gallery_buttons_settings;
	$_style_block .= '}';
}
if ( $gallery_title_settings ) {
	$_style_block .= '#' . $gallery_uniqid . ' h3{';
	$_style_block .= $gallery_title_settings;
	$_style_block .= '}';
}
if ( $gallery_subtitle_settings ) {
	$_style_block .= '#' . $gallery_uniqid . ' .subtitle{';
	$_style_block .= $gallery_subtitle_settings;
	$_style_block .= '}';
}
if ( $slider_nav_bg_settings ) {
	$_style_block .= '#' . $gallery_uniqid . ' .slider .slider-nav > .div{';
	$_style_block .= $slider_nav_bg_settings;
	$_style_block .= '}';
}
if ( $slider_nav_settings ) {
	$_style_block .= '#' . $gallery_uniqid . ' .slider .slider-nav > .div{';
	$_style_block .= $slider_nav_settings;
	$_style_block .= '}';
}

if ( $use_pagination ) {
	if ( $pagination_css ) {
		switch ( $pagination_type ) {
			case 'simple':
				$_style_block .= '#' . $gallery_uniqid . ' .pagination a {';
				$_style_block .= $pagination_css;
				$_style_block .= '}';
				break;
			case 'lazy_scroll':
			case 'lazy_button':
				$_style_block .= '#' . $gallery_uniqid . ' .lazy-load {';
				$_style_block .= $pagination_css;
				$_style_block .= '}';
				break;
		}
	}
	if ( $pagination_hover_css ) {
		switch ( $pagination_type ) {
			case 'simple':
				$_style_block .= '#' . $gallery_uniqid . ' .pagination a:hover,';
				$_style_block .= '#' . $gallery_uniqid . ' .pagination a.active {';
				$_style_block .= $pagination_hover_css;
				$_style_block .= '}';
				break;
			case 'lazy_scroll':
			case 'lazy_button':
				$_style_block .= '#' . $gallery_uniqid . ' .lazy-load:hover {';
				$_style_block .= $pagination_hover_css;
				$_style_block .= '}';
				break;
		}
	}
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );