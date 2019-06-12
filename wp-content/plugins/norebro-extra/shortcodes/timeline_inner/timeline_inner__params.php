<?php

/**
* Visual Composer Norebro Timeline Inner shortcode settings
*/

vc_map( array(
	'name' => __( 'Timeline', 'norebro-extra' ),
	'description' => __( 'Timeline group module', 'norebro-extra' ),
	'base' => 'norebro_timeline_inner',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'content_element' => true,
	'as_child' => array(
		'only' => 'norebro_timeline_group'
	),
	'params' => array(

		// General
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Boxed', 'norebro-extra' ),
			'param_name' => 'boxed',
			'value' => array(
				'Yes' => '0'
			),
		),
		array(
			'type' => 'textfield',
			'holder' => 'em',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Title', 'norebro-extra' ),
			'param_name' => 'title',
			'description' => __( 'Timeline title.', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Subtitle', 'norebro-extra' ),
			'param_name' => 'subtitle',
			'description' => __( 'For example, <strong>2009 - 2012 Years</strong>.', 'norebro-extra' ),
		),
		array(
			'type' => 'textarea',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Description', 'norebro-extra' ),
			'param_name' => 'description',
		),

		/* Typography */
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
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_subtitle',
			'value' => __( 'Subtitle', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'subtitle_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_description',
			'value' => __( 'Description', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'desription_typo',
		),

		/* Styles */
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Background color', 'norebro-extra' ),
			'param_name' => 'background_color',
			'value' => 'brand',
			'dependency' => array(
				'element' => 'boxed',
				'value' => array(
					'1'
				)
			),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Title color', 'norebro-extra' ),
			'param_name' => 'title_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Subtitle color', 'norebro-extra' ),
			'param_name' => 'subtitle_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Description color', 'norebro-extra' ),
			'param_name' => 'description_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Dot background color', 'norebro-extra' ),
			'param_name' => 'dot_bg_color',
			'value' => ''
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Dot border color', 'norebro-extra' ),
			'param_name' => 'dot_border_color',
			'value' => 'brand'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Line color', 'norebro-extra' ),
			'param_name' => 'line_color',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_other',
			'value' => __( 'Other', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Custom CSS class', 'norebro-extra' ),
			'param_name' => 'css_class',
			'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'norebro-extra' )
		),
	)
) );