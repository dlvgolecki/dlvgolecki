<?php

/**
* Visual Composer Norebro Dynamic Text shortcode params
*/

vc_map( array(
	'name' => __( 'Dynamic Text', 'norebro-extra' ),
	'description' => __( 'Effective dynamic text block', 'norebro-extra' ),
	'base' => 'norebro_dynamic_text',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Alignment', 'norebro-extra' ),
			'param_name' => 'alignment',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_035.svg',
					'key' => 'left',
					'title' => __( 'Left', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_036.svg',
					'key' => 'center',
					'title' => __( 'Center', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_037.svg',
					'key' => 'right',
					'title' => __( 'Right', 'norebro-extra' ),
				)
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Static text before', 'norebro-extra' ),
			'param_name' => 'pre_title',
			'description' => '',
		),
		array(
			'type' => 'param_group',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Dynamic text', 'norebro-extra' ),
			'param_name' => 'dynamic_title',
			'description' => '',
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Variant string', 'norebro-extra' ),
					'param_name' => 'dynamic_part',
				),
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Static text after', 'norebro-extra' ),
			'param_name' => 'post_title',
			'description' => '',
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Type speed', 'norebro-extra' ),
			'param_name' => 'type_speed',
			'value' => array(
				__( 'Slow', 'norebro-extra' ) => 'slow',
				__( 'Normal', 'norebro-extra' ) => 'normal',
				__( 'Fast', 'norebro-extra' ) => 'fast',
				__( 'Very fast', 'norebro-extra' ) => 'very_fast',
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Loop', 'norebro-extra' ),
			'param_name' => 'loop',
			'value' => array(
				'Yes' => '1'
			),
		),

		// Typography
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_static',
			'value' => __( 'Static text', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'static_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_dynamic',
			'value' => __( 'Dynamic text', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'dynamic_typo',
		),
		
		// Style and colors
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'argenta_extra' ),
			'heading' => __( 'Static text color', 'argenta_extra' ),
			'param_name' => 'static_color',
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'argenta_extra' ),
			'heading' => __( 'Dynamic text color', 'argenta_extra' ),
			'param_name' => 'dynamic_color',
		),

		// Custom Class
		array(
			'type' => 'textfield',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Custom CSS class', 'norebro-extra' ),
			'param_name' => 'css_class',
			'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'norebro-extra' ),
		),


		// Appear Effect
		array(
			'type' => 'dropdown',
			'group' => __( 'Appear Effect', 'norebro-extra' ),
			'heading' => __( 'Appear effect', 'norebro-extra' ),
			'param_name' => 'appearance_effect',
			'value' => array(
				__( 'None', 'norebro-extra' ) => 'none',
				__( 'Fade up', 'norebro-extra' ) => 'fade-up',
				__( 'Fade down', 'norebro-extra' ) => 'fade-down',
				__( 'Fade right', 'norebro-extra' ) => 'fade-right',
				__( 'Fade left', 'norebro-extra' ) => 'fade-left',
				__( 'Flip up', 'norebro-extra' ) => 'flip-up',
				__( 'Flip down', 'norebro-extra' ) => 'flip-down',
				__( 'Zoom in', 'norebro-extra' ) => 'zoom-in',
				__( 'Zoom out', 'norebro-extra' ) => 'zoom-out'
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Appear Effect', 'norebro-extra' ),
			'heading' => __( 'Animation duration', 'norebro-extra' ),
			'param_name' => 'appearance_duration',
			'description' => __( 'Duration accept values from 50 to 3000 (ms), with step 50.', 'norebro-extra' ),
		),
	)
) );