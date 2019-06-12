<?php

/**
* Visual Composer Norebro Call To Action shortcode params
*/

vc_map( array(
	'name' => __( 'Call To Action', 'norebro-extra' ),
	'description' => __( 'Call to action block', 'norebro-extra' ),
	'base' => 'norebro_call_to_action',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(
		// General
		array(
			'type' => 'textarea_raw_html',
			'holder' => 'div class="norebro_heading_VC_gap"',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Title', 'norebro-extra' ),
			'param_name' => 'title',
			'description' => __( 'HTML allowed.', 'norebro-extra' ),
		),
		array(
			'type' => 'textarea_raw_html',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Subtitle', 'norebro-extra' ),
			'param_name' => 'subtitle',
			'description' => __( 'HTML allowed.', 'norebro-extra' ),
		),

		// Link
		array(
			'type' => 'vc_link',
			'group' => __( 'Link', 'norebro-extra' ),
			'heading' => __( 'Link', 'norebro-extra' ),
			'param_name' => 'link',
			'description' => __( 'Fill title field to change the \'Get started\' label.', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Link', 'norebro-extra' ),
			'heading' => __( 'Add icon?', 'norebro-extra' ),
			'param_name' => 'icon_use',
			'value' => array(
				__( 'Yes, sure', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Link', 'norebro-extra' ),
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
			'group' => __( 'Link', 'norebro-extra' ),
			'heading' => __( 'Icon type', 'norebro-extra' ),
			'param_name' => 'icon_type',
			'value' => array(
				__( 'Font icon', 'norebro-extra' ) => 'font_icon',
				__( 'Custom image', 'norebro-extra' ) => 'user_image'
			),
			'dependency' => array(
				'element' => 'icon_use',
				'value' => '1'
			)
		),
		array(
			'type' => 'norebro_icon_picker',
			'group' => __( 'Link', 'norebro-extra' ),
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
			'group' => __( 'Link', 'norebro-extra' ),
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
			'value' => __( 'Subtitle', 'norebro-extra' )
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'subtitle_typo'
		),

		// Style
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Show without side paddings', 'norebro-extra' ),
			'param_name' => 'without_side_paddings',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Background color', 'norebro-extra' ),
			'param_name' => 'bg_color',
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
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_readmore',
			'value' => __( 'Readmore button', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_button',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'readmore_button',
			'button_full_disabled' => 'true'
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_other',
			'value' => __( 'Other', 'norebro-extra' ),
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
	),
));