<?php

/**
* Visual Composer Norebro Pricing List shortcode params
*/

vc_map( array(
	'name' => __( 'Pricing List', 'norebro-extra' ),
	'description' => __( 'Pricing list module', 'norebro-extra' ),
	'base' => 'norebro_pricing_list',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Name', 'norebro-extra' ),
			'param_name' => 'name'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Details', 'norebro-extra' ),
			'param_name' => 'indigriends'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Sale price', 'norebro-extra' ),
			'param_name' => 'sale_price'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Regular price', 'norebro-extra' ),
			'param_name' => 'regular_price'
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'New', 'norebro-extra' ),
			'param_name' => 'new',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			)
		),

		// Typography
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_name',
			'value' => __( 'Name', 'norebro-extra' )
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'name_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_indigriends',
			'value' => __( 'Indigriends', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'indigriends_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_sale_price',
			'value' => __( 'Sale price', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'sale_price_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_regular_price',
			'value' => __( 'Regular price', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'regular_price_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_mark',
			'value' => __( 'Mark', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'new',
				'value' => '1'
			)
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'mark_typo',
			'dependency' => array(
				'element' => 'new',
				'value' => '1'
			)
		),

		// Style
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Name color', 'norebro-extra' ),
			'param_name' => 'name_color',
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Indigriends color', 'norebro-extra' ),
			'param_name' => 'indigriends_color',
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Sale price color', 'norebro-extra' ),
			'param_name' => 'sale_price_color',
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Regular price color', 'norebro-extra' ),
			'param_name' => 'regular_price_color',
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Border color', 'norebro-extra' ),
			'param_name' => 'border_color',
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Mark color', 'norebro-extra' ),
			'param_name' => 'mark_color',
			'dependency' => array(
				'element' => 'new',
				'value' => '1'
			)
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Mark background color', 'norebro-extra' ),
			'param_name' => 'mark_background_color',
			'dependency' => array(
				'element' => 'new',
				'value' => '1'
			)
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