<?php

/**
* Visual Composer Norebro Vertical Fullscreen Slider shortcode params
*/

vc_map( array(
	'name' => __( 'Vertical Slider', 'norebro-extra' ),
	'description' => __( 'Paged split view', 'norebro-extra' ),
	'base' => 'norebro_vertical_slider',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'holder' => '',
	'js_view' => 'VcNorebroVerticalSliderView',
	'show_settings_on_create' => true,
	'content_element' => true,
	'is_container' => true,
	'as_parent' => array(
		'only' => 'norebro_vertical_slider_inner'
	),
	'default_content' => '[norebro_vertical_slider_inner][/norebro_vertical_slider_inner]',
	'params' => array(
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Show navigation buttons?', 'norebro-extra' ),
			'param_name' => 'navigation_show',
			'description' => __( 'Show navigation buttons on page' ),
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Show slides pagination?', 'norebro-extra' ),
			'param_name' => 'pagination_show',
			'description' => __( 'Show pagination dots/numbers on page' ),
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Pagination color', 'norebro-extra' ),
			'param_name' => 'elements_color'
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Pagination buttons type', 'norebro-extra' ),
			'param_name' => 'pagination_type',
			'value' => array(
				__( 'Bullets', 'norebro-extra' ) => 'bullets',
				__( 'Numbers', 'norebro-extra' ) => 'numbers'
			)
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Scroll animation duration', 'norebro-extra' ),
			'param_name' => 'animation_duration',
			'value' => array(
				__( 'Default', 'norebro-extra' ) => 'default',
				__( 'Fast', 'norebro-extra' ) => 'fast',
				__( 'Slow', 'norebro-extra' ) => 'slow'
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Custom CSS class', 'norebro-extra' ),
			'param_name' => 'css_class',
			'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'norebro-extra' ),
		),
	)
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Norebro_Vertical_Slider extends WPBakeryShortCodesContainer { }
}