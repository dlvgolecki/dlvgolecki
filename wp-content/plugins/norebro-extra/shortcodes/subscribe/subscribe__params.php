<?php

/**
* Visual Composer Norebro Subscribe shortcode params
*/

vc_map( array(
	'name' => __( 'Subscribe Module', 'norebro-extra' ),
	'description' => __( 'Feed subscribe module', 'norebro-extra' ),
	'base' => 'norebro_subscribe',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'js_view' => 'VcNorebroSubscribeView',
	'custom_markup' => '{{title}}<div class="vc_norebro_subscribe-container">
		<em>%%title%%</em>
	</div>',
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Form type', 'norebro-extra' ),
			'param_name' => 'input_type',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/param_type_default.png',
					'key' => 'default',
					'title' => __( 'Default', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/param_type_outline.png',
					'key' => 'outline',
					'title' => __( 'Outline', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/param_type_flat.png',
					'key' => 'flat',
					'title' => __( 'Flat', 'norebro-extra' ),
				),
			)
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Alignment', 'norebro-extra' ),
			'param_name' => 'alignment',
			'std' => 'center',
			'value' => array(
				__( 'Left', 'norebro-extra' ) => 'left',
				__( 'Center', 'norebro-extra' ) => 'center',
				__( 'Right', 'norebro-extra' )   => 'right',
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Squared shapes', 'norebro-extra' ),
			'param_name' => 'squared_shapes',
			'value' => array(
				'Yes' => '0'
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Input placeholder', 'norebro-extra' ),
			'value' => __( 'Enter your email', 'norebro-extra' ),
			'param_name' => 'input_placeholder',
			'description' => __( 'Don\'t leave empty', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Button text', 'norebro-extra' ),
			'value' => __( 'Subscribe', 'norebro-extra' ),
			'param_name' => 'button_text',
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Feedburner feed name', 'norebro-extra' ),
			'param_name' => 'feedburner_name',
			'description' => __( 'See <a href="https://feedburner.google.com/" target="_blank">Feedburner.com</a> service', 'norebro-extra' ),
		),
		 
		// Style
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Full width', 'norebro-extra' ),
			'param_name' => 'fullwidth',
			'value' => array(
				__( 'Yes, sure', 'norebro-extra' ) => '1'
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Input color', 'norebro-extra' ),
			'param_name' => 'input_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Input background color', 'norebro-extra' ),
			'param_name' => 'input_bg_color',
			'dependency' => array(
				'element' => 'input_type',
				'value' => array(
					'flat'
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Input border color', 'norebro-extra' ),
			'param_name' => 'input_border_color',
			'dependency' => array(
				'element' => 'input_type',
				'value' => array(
					'default',
					'outline'
				)
			)
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_button',
			'value' => __( 'Button', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_button',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'button',
			'color_brand' => true,
			'button_link_disabled' => '1',
			'button_size_disabled' => '1',
			'button_squared_disabled' => '1',
			'button_full_disabled' => '1',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_other',
			'value' => __( 'Other', 'norebro-extra' ),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Appearance effect', 'norebro-extra' ),
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
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Appearance effect duration', 'norebro-extra' ),
			'param_name' => 'appearance_duration',
			'description' => __( 'Duration accept values from 50 to 3000(ms), with step 50.', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Custom CSS class', 'norebro-extra' ),
			'param_name' => 'css_class',
			'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'norebro-extra' ),
		),
	)
) );