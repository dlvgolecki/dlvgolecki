<?php

/**
* Visual Composer Norebro Button shortcode params
*/

vc_map( array(
	'name' => __( 'Button', 'norebro-extra' ),
	'description' => __( 'Simple eye catching button', 'norebro-extra' ),
	'base' => 'norebro_button',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Button layout', 'norebro-extra' ),
			'param_name' => 'layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_023.svg',
					'key' => 'fill',
					'title' => __( 'Fill', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_024.svg',
					'key' => 'outline',
					'title' => __( 'Outline', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_025.svg',
					'key' => 'flat',
					'title' => __( 'Flat', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_026.svg',
					'key' => 'link',
					'title' => __( 'Link', 'norebro-extra' ),
				)
			)
		),
		array(
			'type' => 'vc_link',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Link', 'norebro-extra' ),
			'param_name' => 'link',
			'description' => __( 'Fill link text field to change the \'Get started\' label.', 'norebro-extra' ),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Button size', 'norebro-extra' ),
			'param_name' => 'shape_size',
			'std' => 'default',
			'value' => array(
				__( 'Small', 'norebro-extra' ) => 'small',
				__( 'Default', 'norebro-extra' ) => 'default',
				__( 'Large', 'norebro-extra' ) => 'large',
				__( 'Huge', 'norebro-extra' ) => 'huge',
			),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Button position', 'norebro-extra' ),
			'param_name' => 'shape_position',
			'std' => 'center',
			'value' => array(
				__( 'Left', 'norebro-extra' ) => 'left',
				__( 'Center', 'norebro-extra' ) => 'center',
				__( 'Right', 'norebro-extra' ) => 'right',
			),
			'description' => __( 'You can choose button alignment position.', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Full width', 'norebro-extra' ),
			'param_name' => 'full_width',
			'value' => array(
				__( 'Yes, set 100% width', 'norebro-extra' ) => '0'
			),
		),

		// Icon
		array(
			'type' => 'norebro_check',
			'group' => __( 'Icon', 'norebro-extra' ),
			'heading' => __( 'Add icon', 'norebro-extra' ),
			'param_name' => 'icon_use',
			'value' => array(
				__( 'Yes, add icon', 'norebro-extra' ) => '0'
			),
			'description' => __( 'You can add icon instead or with text.', 'norebro-extra' )
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Icon', 'norebro-extra' ),
			'heading' => __( 'Swap icon to text on hover', 'norebro-extra' ),
			'param_name' => 'text_on_hover',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'icon_use',
				'value' => '1'
			),
			'description' => __( 'This add "rolling" effect on hover.', 'norebro-extra' ),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Icon', 'norebro-extra' ),
			'heading' => __( 'Icon position', 'norebro-extra' ),
			'param_name' => 'icon_position',
			'std' => 'left',
			'value' => array(
				__( 'Left', 'norebro-extra' ) => 'left',
				__( 'Right', 'norebro-extra' ) => 'right',
			),
			'dependency' => array(
				'element' => 'icon_use',
				'value' => '1'
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
				'element' => 'icon_use',
				'value' => '1'
			),
			'description' => __( 'Choose icon from font icons packs or your custom image.', 'norebro-extra' ),
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
			'param_name' => 'typo_tab_divider_heading',
			'value' => __( 'Heading', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'title_typo',
		),
		
		// Style
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Squared shape', 'norebro-extra' ),
			'param_name' => 'shape_squared',
			'value' => array(
				__( 'Yes, set squared shape', 'norebro-extra' ) => '0'
			),
			'description' => __( 'By default, button have rounded corners shape.', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Button background', 'norebro-extra' ),
			'param_name' => 'color',
			'description' => __( 'This color is also used for button border.', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Button background on hover', 'norebro-extra' ),
			'param_name' => 'hover_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Text color', 'norebro-extra' ),
			'param_name' => 'text_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Text color on hover', 'norebro-extra' ),
			'param_name' => 'hover_text_color',
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