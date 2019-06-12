<?php

/**
* Visual Composer Norebro Split Screens shortcode params
*/

vc_map( array(
	'name' => __( 'Split Slider', 'norebro-extra' ),
	'description' => __( 'Split view in slides', 'norebro-extra' ),
	'base' => 'norebro_split_screens',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'holder' => '',
	'js_view' => 'VcNorebroSplitScreensView',
	'show_settings_on_create' => false,
	'content_element' => true,
	'is_container' => true,
	'as_parent' => array(
		'only' => 'norebro_split_screen'
	),
	'default_content' => '[norebro_split_screen][/norebro_split_screen]',
	'params' => array(
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
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Show navigation buttons?', 'norebro-extra' ),
			'param_name' => 'navigation_buttons',
			'description' => __( 'Show navigation dots on page' ),
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Navigation buttons type', 'norebro-extra' ),
			'param_name' => 'navigation_type',
			'value' => array(
				__( 'Bullets', 'norebro-extra' ) => 'bullets',
				__( 'Numbers', 'norebro-extra' ) => 'numbers'
			),
			'dependency' => array(
				'element' => 'navigation_buttons',
				'value' => array(
					'1',
					true
				)
			)
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Navigation buttons color', 'norebro-extra' ),
			'param_name' => 'navigation_color',
			'dependency' => array(
				'element' => 'navigation_buttons',
				'value' => array(
					'1',
					true
				)
			)
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
	class WPBakeryShortCode_Norebro_Split_Screens extends WPBakeryShortCodesContainer { }
}