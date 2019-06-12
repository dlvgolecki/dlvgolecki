<?php

/**
* Visual Composer Norebro Counter shortcode params
*/

vc_map( array(
	'name' => __( 'Counter', 'norebro-extra' ),
	'description' => __( 'Facts and numbers counter block', 'norebro-extra' ),
	'base' => 'norebro_counter',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(
		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Counter layout', 'norebro-extra' ),
			'param_name' => 'layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_034.svg',
					'key' => 'number',
					'title' => __( 'Default', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_033.svg',
					'key' => 'number_with_icon',
					'title' => __( 'With icon', 'norebro-extra' ),
				)
			)
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
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Number', 'norebro-extra' ),
			'param_name' => 'count_number',
			'value' => '',
			'description' => __( 'The number of count', 'norebro-extra' ),
		),
		array(
			'type' => 'textarea',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Title', 'norebro-extra' ),
			'param_name' => 'title',
			'value' => '',
			'description' => __( 'Enter title text (HTML allowed).', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Subtitle', 'norebro-extra' ),
			'param_name' => 'subtitle',
			'value' => '',
			'description' => __( 'Enter subtitle text.', 'norebro-extra' ),
		),

		// Icon
		array(
			'type' => 'dropdown',
			'group' => __( 'Icon', 'norebro-extra' ),
			'heading' => __( 'Icon position', 'norebro-extra' ),
			'param_name' => 'icon_position',
			'value' => array(
				__( 'Left', 'norebro-extra' ) => 'left',
				__( 'Right', 'norebro-extra' ) => 'right',
				__( 'Top', 'norebro-extra' ) => 'top'
			),
			'dependency' => array(
				'element' => 'layout',
				'value' => 'number_with_icon'
			)
		),
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
					'number_with_icon',
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
			'param_name' => 'typo_tab_divider_count',
			'value' => __( 'Number of count', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'count_typo',
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
			'heading' => __( 'Number color', 'norebro-extra' ),
			'param_name' => 'count_color'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Icon color', 'norebro-extra' ),
			'param_name' => 'icon_color',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'number_with_icon'
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Title color', 'norebro-extra' ),
			'param_name' => 'title_color'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Subtitle color', 'norebro-extra' ),
			'param_name' => 'subtitle_color'
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