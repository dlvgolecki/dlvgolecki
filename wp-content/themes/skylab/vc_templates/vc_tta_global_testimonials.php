<?php

$output = $el_class = '';
extract(shortcode_atts(array(
	'style' => '',
	'navigation' => '',
	'navigation_style' => '1',
	'dots' => '',
	'animation' => '',
	'lazyload' => '',
    'el_class' => '',
), $atts));

global $mega_atts;
$mega_atts = $atts;

if ( $style == '2' ) {
	$style_class = 'mt-testimonials-style-2';
} else if ( $style == '3' ) {
	$style_class = 'mt-testimonials-style-3';
} else if ( $style == '4' ) {
	$style_class = 'mt-testimonials-style-4';
} else if ( $style == '5' ) {
	$style_class = 'mt-testimonials-style-5';
} else if ( $style == '6' ) {
	$style_class = 'mt-testimonials-style-6';
} else if ( $style == '7' ) {
	$style_class = 'mt-testimonials-style-7';
} else if ( $style == '8' ) {
	$style_class = 'mt-testimonials-style-8';
} else if ( $style == '9' ) {
	$style_class = 'mt-testimonials-style-9';
} else {
	$style_class = 'mt-testimonials-style-1';
}

if ($navigation!='' && $navigation!='0'){
	$navigation = 'true';
} else {
	$navigation = 'false';
}
	
if ($dots!='' && $dots!='0'){
	$dots = 'true';
} else {
	$dots = 'false';
}

if ($animation!='' && $animation!='0') {
	wp_enqueue_script( 'waypoints' );
	$Animation = 'mt-animate_when_almost_visible-enabled';
} else {
	$Animation = 'mt-animate_when_almost_visible-disabled';
}

if ($lazyload!='' && $lazyload!='0') {
	$lazyload_class = 'lazyload-enabled';
} else {
	$lazyload_class = 'lazyload-disabled';
}

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class, $this->settings['base']);

wp_enqueue_script('slick');


$output .= '<div class="slick-slider-wrapper mt-testimonials '. esc_attr( $style_class ) .'">';
$output .= '<div class="slick-slider mt-carousel nav-'. esc_attr( $navigation ) .' nav-style-'. esc_attr( $navigation_style ) .' slide-by-by_page margin-0 fade-true mt-fadeIn '. esc_attr( $Animation ) .' '. esc_attr( $lazyload_class ) .'" data-items="1" data-items-on-small-screens="1" data-nav="'. esc_attr( $navigation ) .'" data-dots="false" data-margin="0">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= '</div>';
$output .= '</div>';

unset($mega_atts);

echo $output;