<?php

/**
* Visual Composer Norebro Clients logo shortcode params
*/

vc_map( array(
	'name' => __( 'Clients Logo', 'norebro-extra' ),
	'description' => __( 'Clients logo box', 'norebro-extra' ),
	'base' => 'norebro_clients_logo',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'js_view' => 'VcNorebroClientsLogoView',
	'params' => array(
		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Clients logo layout', 'norebro-extra' ),
			'param_name' => 'layout_type',
			'std' => 'default',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_027.svg',
					'key' => 'default',
					'title' => __( 'Default', 'norebro-extra' )
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_028.svg',
					'key' => 'overlay',
					'title' => __( 'Info overlay', 'norebro-extra' )
				),
			)
		),
		array(
			'type' => 'attach_image',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Clients logo', 'norebro-extra' ),
			'param_name' => 'image_logo',
		),
		array(
			'type' => 'textfield',
			'holder' => 'em',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Link', 'norebro-extra' ),
			'param_name' => 'link',
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Open in new window?', 'norebro-extra' ),
			'description' => __( '', 'norebro-extra' ),
			'param_name' => 'in_new_tab',
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
			'dependency' => array(
				'element' => 'layout_type',
				'value' => array(
					'overlay'
				)
			),
		),
		array(
			'type' => 'textarea_raw_html',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Description', 'norebro-extra' ),
			'param_name' => 'description',
			'description' => __( 'Enter description text (HTML allowed).', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'layout_type',
				'value' => array(
					'overlay'
				)
			),
		),

		// Typography
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_title',
			'value' => __( 'Title', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'layout_type',
				'value' => array(
					'overlay'
				)
			),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'title_typo',
			'dependency' => array(
				'element' => 'layout_type',
				'value' => array(
					'overlay'
				)
			),
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_description',
			'value' => __( 'Description', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'layout_type',
				'value' => array(
					'overlay'
				)
			),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'description_typo',
			'dependency' => array(
				'element' => 'layout_type',
				'value' => array(
					'overlay'
				)
			),
		),


		// Style
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_content',
			'value' => __( 'Content', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'layout_type',
				'value' => array(
					'overlay'
				)
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Overlay shadow', 'norebro-extra' ),
			'param_name' => 'overlay_shadow',
			'value' => array(
				__( 'Yes, sure', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'layout_type',
				'value' => array(
					'overlay'
				)
			),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Overlay color', 'norebro-extra' ),
			'param_name' => 'overlay_color',
			'dependency' => array(
				'element' => 'layout_type',
				'value' => array(
					'overlay'
				)
			),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Title color', 'norebro-extra' ),
			'param_name' => 'title_color',
			'dependency' => array(
				'element' => 'layout_type',
				'value' => array(
					'overlay'
				)
			),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Description color', 'norebro-extra' ),
			'param_name' => 'description_color',
			'dependency' => array(
				'element' => 'layout_type',
				'value' => array(
					'overlay'
				)
			),
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
	)
) );
