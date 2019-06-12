<?php

$output = $el_class = '';
extract(shortcode_atts(array(
	'images' => '',
	'lazyload' => '',
    'el_class' => '',
), $atts));

global $mega_atts;
$mega_atts = $atts;

if ($lazyload!='' && $lazyload!='0') {
	$lazyload_class = 'lazyload-enabled';
} else {
	$lazyload_class = 'lazyload-disabled';
}

if ( '' === $images ) {
	$images = '-1,-2,-3';
}

$images = explode( ',', $images );

$i = - 1;

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class, $this->settings['base']);

wp_enqueue_script('slick');

$output .= '<div class="team-slider-wrapper">';
$output .= '<div class="team-slider '. esc_attr( $css_class ) .' '. esc_attr( $lazyload_class ) .'">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= '</div>';
$output .= '</div>';

unset($mega_atts);

echo $output;