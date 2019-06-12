<?php

/**
* Visual Composer Norebro Video shortcode params
*/

vc_map( array(
	'name' => __( 'Video', 'norebro-extra' ),
	'description' => __( 'Popup video module', 'norebro-extra' ),
	'base' => 'norebro_video',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Block layout', 'norebro-extra' ),
			'param_name' => 'layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_076.svg',
					'key' => 'boxed_shape',
					'title' => __( 'Boxed', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_077.svg',
					'key' => 'outline',
					'title' => __( 'Outline', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_075.svg',
					'key' => 'with_preview',
					'title' => __( 'With preview', 'norebro-extra' ),
				)
			)
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Button layout', 'norebro-extra' ),
			'param_name' => 'button_layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_073.svg',
					'key' => 'filled',
					'title' => __( 'Filled', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_074.svg',
					'key' => 'outline',
					'title' => __( 'Outline', 'norebro-extra' ),
				),
			),
		),
		array(
			'type' => 'attach_image',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Preview image', 'norebro-extra' ),
			'param_name' => 'preview_image',
			'dependency' => array(
				'element' => 'layout',
				'value' => array(
					'with_preview'
				)
			)
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Alignment', 'norebro-extra' ),
			'param_name' => 'alignment',
			'value' => array(
				__( 'Left', 'norebro-extra' ) => 'left',
				__( 'Center', 'norebro-extra' ) => 'center',
				__( 'Right', 'norebro-extra' ) => 'right'
			),
			'std' => 'center',
			'dependency' => array(
				'element' => 'layout',
				'value' => array(
					'boxed_shape',
					'outline'
				)
			),
		),
		array(
			'type' => 'textarea_raw_html',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Video title', 'norebro-extra' ),
			'param_name' => 'title',
			'value' => '',
			'description' => __( 'HTML allowed.', 'norebro-extra' )
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Video URL', 'norebro-extra' ),
			'param_name' => 'link',
			'value' => '',
			'description' => 'For example, https://www.youtube.com/watch?v=dQw4w9WgXcQ'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Start video from ... second', 'norebro-extra' ),
			'param_name' => 'start_time',
			'value' => '',
			'description' => 'Supported by youtube player only'
		),

		// Typography
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_title',
			'value' => __( 'Title', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'layout',
				'value' => array(
					'boxed_shape',
					'outline'
				)
			)
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'title_typo',
			'dependency' => array(
				'element' => 'layout',
				'value' => array(
					'boxed_shape',
					'outline'
				)
			)
		),

		// Style
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_button',
			'value' => __( 'Button', 'norebro-extra' )
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Add shadow?', 'norebro-extra' ),
			'param_name' => 'button_shadow',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Use "Call to action" animation?', 'norebro-extra' ),
			'param_name' => 'button_anim',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Button color', 'norebro-extra' ),
			'param_name' => 'button_color'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Button color on hover', 'norebro-extra' ),
			'param_name' => 'button_hover_color'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Icon color', 'norebro-extra' ),
			'param_name' => 'icon_color'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Icon color on hover', 'norebro-extra' ),
			'param_name' => 'icon_hover_color'
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_typo',
			'value' => __( 'Typography', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Title color', 'norebro-extra' ),
			'param_name' => 'title_color',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_other',
			'value' => __( 'Other', 'norebro-extra' )
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Background color', 'norebro-extra' ),
			'param_name' => 'background_color',
			'dependency' => array(
				'element' => 'layout',
				'value' => array(
					'boxed_shape'
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Border color', 'norebro-extra' ),
			'param_name' => 'border_color',
			'dependency' => array(
				'element' => 'layout',
				'value' => array(
					'outline'
				)
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
