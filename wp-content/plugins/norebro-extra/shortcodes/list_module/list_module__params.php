<?php

/**
* Visual Composer Norebro List Module shortcode params
*/

vc_map( array(
	'name' => __( 'List Module', 'norebro-extra' ),
	'description' => __( 'Elements list block', 'norebro-extra' ),
	'base' => 'norebro_list_module',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'List layout', 'norebro-extra' ),
			'param_name' => 'list_layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_040.svg',
					'key' => 'default',
					'title' => __( 'Default', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_041.svg',
					'key' => 'border_items',
					'title' => __( 'Border Items', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_042.svg',
					'key' => 'offset_border_items',
					'title' => __( 'Offset Border', 'norebro-extra' ),
				)
			)
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'List style', 'norebro-extra' ),
			'param_name' => 'list_style',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_040.svg',
					'key' => 'default',
					'title' => __( 'Default', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_043.svg',
					'key' => 'line',
					'title' => __( 'Line', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_044.svg',
					'key' => 'icon',
					'title' => __( 'Icon', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_045.svg',
					'key' => 'shape_icon',
					'title' => __( 'Shape Icon', 'norebro-extra' ),
				)
			)
		),
		array(
			'type' => 'param_group',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'List items', 'norebro-extra' ),
			'param_name' => 'list_value_type1',
			'value' => array(
				false
			),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'norebro-extra' ),
					'param_name' => 'list_title',
				),
			),
			'dependency' => array(
				'element' => 'list_style',
				'value' => array(
					'default',
					'line'
				)
			)
		),
		array(
			'type' => 'param_group',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'List items', 'norebro-extra' ),
			'param_name' => 'list_value_type2',
			'value' => array(
				false
			),
			'params' => array(
				array(
					'type' => 'norebro_icon_picker',
					'heading' => __( 'Icon', 'norebro-extra' ),
					'param_name' => 'list_icon',
					'description' => __( 'Choose icon.', 'norebro-extra' ),
					'settings' => array(),
				),
				array(
					'type' => 'attach_image',
					'heading' => __( 'or Icon image', 'norebro-extra' ),
					'param_name' => 'list_image',
					'description' => __( 'If you select an image, then choosed an icon will be ignored.', 'norebro-extra' ),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'norebro-extra' ),
					'param_name' => 'list_title',
				),
			),
			'dependency' => array(
				'element' => 'list_style',
				'value' => array(
					'icon',
					'shape_icon'
				)
			)						
		),

		// Typography
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_title',
			'value' => __( 'Title', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'title_typo',
		),
		
		// Style
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Title color', 'norebro-extra' ),
			'param_name' => 'title_color'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Border color', 'norebro-extra' ),
			'param_name' => 'border_color',
			'dependency' => array(
				'element' => 'list_layout',
				'value' => array(
					'border_items',
					'offset_border_items'
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Icon color', 'norebro-extra' ),
			'param_name' => 'icon_color',
			'dependency' => array(
				'element' => 'list_style',
				'value' => array(
					'shape_icon',
					'icon'
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Icon shape color', 'norebro-extra' ),
			'param_name' => 'icon_shape_color',
			'dependency' => array(
				'element' => 'list_style',
				'value' => 'shape_icon'
			),
			'value' => 'brand'
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