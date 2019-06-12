<?php

/**
* Visual Composer Norebro Pie Chart shortcode params
*/

vc_map( array(
	'name' => __( 'Pie Chart', 'norebro-extra' ),
	'description' => __( 'Chart box module', 'norebro-extra' ),
	'base' => 'norebro_pie_chart',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Pie chart layout', 'norebro-extra' ),
			'param_name' => 'layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_046.svg',
					'key' => 'percent',
					'title' => __( 'Percent', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_047.svg',
					'key' => 'icon',
					'title' => __( 'Icon', 'norebro-extra' ),
				)
			)
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Description position', 'norebro-extra' ),
			'param_name' => 'description_position',
			'value' => array(
				__( 'Bottom', 'norebro-extra' ) => 'bottom',
				__( 'Right', 'norebro-extra' ) => 'right',
				__( 'Left', 'norebro-extra' ) => 'left'
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Percent', 'norebro-extra' ),
			'param_name' => 'percent',
			'value' => '100',
			'description' => __( 'Percent of pie chart', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Title', 'norebro-extra' ),
			'param_name' => 'title',
			'value' => '',
			'description' => ''
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Subtitle', 'norebro-extra' ),
			'param_name' => 'subtitle',
			'value' => '',
			'description' => ''
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Subtitle position', 'norebro-extra' ),
			'param_name' => 'subtitle_position',
			'value' => array(
				__( 'Bottom', 'norebro-extra' ) => 'bottom',
				__( 'Top', 'norebro-extra' ) => 'top'
			)
		),

		// Icon
		array(
			'type' => 'dropdown',
			'group' => __( 'Icon', 'norebro-extra' ),
			'heading' => __( 'Icon type', 'norebro-extra' ),
			'param_name' => 'icon_type',
			'value' => array(
				__( 'Font icon', 'norebro-extra' ) => 'font_icon',
				__( 'Custom image', 'norebro-extra' ) => 'user_image'
			),
			'dependency' => array(
				'element' => 'layout',
				'value' => array(
					'icon'
				)
			)
		),
		array(
			'type' => 'norebro_icon_picker',
			'group' => __( 'Icon', 'norebro-extra' ),
			'heading' => __( 'Icon', 'norebro-extra' ),
			'param_name' => 'icon_as_icon',
			'description' => __( 'Choose icon.', 'norebro-extra' ),
			'settings' => array(),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array(
					'font_icon'
				)
			)
		),
		array(
			'type' => 'attach_image',
			'group' => __( 'Icon', 'norebro-extra' ),
			'heading' => __( 'Icon image', 'norebro-extra' ),
			'param_name' => 'icon_as_image',
			'description' => __( 'Choose icon image.', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array(
					'user_image'
				)
			)
		),

		// Typography
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_percent',
			'value' => __( 'Percent', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'percent_typo',
		),
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
		
		// Style
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Chart color', 'norebro-extra' ),
			'param_name' => 'chart_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Title color', 'norebro-extra' ),
			'param_name' => 'title_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Subtitle color', 'norebro-extra' ),
			'param_name' => 'subtitle_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Chart content color', 'norebro-extra' ),
			'param_name' => 'chart_content_color',
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