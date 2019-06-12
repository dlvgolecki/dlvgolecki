<?php

/**
* Visual Composer Norebro Message module shortcode params
*/

vc_map( array(
	'name' => __( 'Message Module', 'norebro-extra' ),
	'description' => __( 'Messages and notifications module', 'norebro-extra' ),
	'base' => 'norebro_message_module',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Box type', 'norebro-extra' ),
			'param_name' => 'layout',
			'value' => array(
				__( 'Default', 'norebro-extra' ) => 'default',
				__( 'Warning', 'norebro-extra' ) => 'warning',
				__( 'Primary', 'norebro-extra' ) => 'primary',
				__( 'Success', 'norebro-extra' ) => 'success',
				__( 'Danger', 'norebro-extra' ) => 'danger'
			),
			'description' => __( 'Choose message module appearance type.', 'norebro-extra' ),
		),
		array(
			'type' => 'textarea_raw_html',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Text', 'norebro-extra' ),
			'param_name' => 'text',
			'description' => __( 'Enter message text (HTML allowed).', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Full width', 'norebro-extra' ),
			'param_name' => 'full_width',
			'description' => __( 'If checked message box will be 100% width.', 'norebro-extra' ),
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'std' => '1'
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Hide close button?', 'norebro-extra' ),
			'param_name' => 'without_close_button',
			'description' => __( 'If checked close button will be hidden.', 'norebro-extra' ),
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Use block as link?', 'norebro-extra' ),
			'description' => __( 'If checked wrap message box in link tag.', 'norebro-extra' ),
			'param_name' => 'use_link',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'vc_link',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Link', 'norebro-extra' ),
			'param_name' => 'link',
			'dependency' => array(
				'element' => 'use_link',
				'value' => '1'
			)
		),

		// Typography
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_text',
			'value' => __( 'Text typography', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'text_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_link',
			'value' => __( 'Link', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'use_link',
				'value' => '1'
			)
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'link_typo',
			'dependency' => array(
				'element' => 'use_link',
				'value' => '1'
			)
		),

		// Style
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Background color', 'norebro-extra' ),
			'param_name' => 'bg_color',
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
			'heading' => __( 'Link color', 'norebro-extra' ),
			'param_name' => 'link_color',
			'dependency' => array(
				'element' => 'use_link',
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