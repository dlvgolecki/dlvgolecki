<?php

/**
* Visual Composer Norebro Heading shortcode params
*/

vc_map( array(
	'name' => __( 'Heading', 'norebro-extra' ),
	'description' => __( 'Headnig block', 'norebro-extra' ),
	'base' => 'norebro_heading',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(
		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Heading layout', 'norebro-extra' ),
			'param_name' => 'subtitle_type_layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_035.svg',
					'key' => 'bottom_subtitle',
					'title' => __( 'Bottom subtitle', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_038.svg',
					'key' => 'top_subtitle',
					'title' => __( 'Top subtitle', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_039.svg',
					'key' => 'without_subtitle',
					'title' => __( 'Without subtitle', 'norebro-extra' ),
				)
			)
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Content alignment', 'norebro-extra' ),
			'param_name' => 'module_type_layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_035.svg',
					'key' => 'on_middle',
					'title' => __( 'Centred', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_036.svg',
					'key' => 'on_left',
					'title' => __( 'Left', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_037.svg',
					'key' => 'on_right',
					'title' => __( 'Right', 'norebro-extra' ),
				)
			)
		),
		array(
			'type' => 'textarea_raw_html',
			'holder' => 'div class="norebro_heading_VC_gap"',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Title', 'norebro-extra' ),
			'param_name' => 'title',
			'description' => __( 'Enter block title (HTML allowed).', 'norebro-extra' ),
		),
		array(
			'type' => 'textarea_raw_html',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Subtitle', 'norebro-extra' ),
			'param_name' => 'subtitle',
			'description' => __( 'Enter block subtitle (HTML allowed).', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'subtitle_type_layout',
				'value' => array(
					'bottom_subtitle',
					'top_subtitle'
				)
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Subtitle offset', 'norebro-extra' ),
			'param_name' => 'subtitle_offset',
			'description' => __( 'CSS value.', 'norebro-extra' ),
			'std' => '12px',
			'dependency' => array(
				'element' => 'subtitle_type_layout',
				'value' => array(
					'bottom_subtitle',
					'top_subtitle'
				)
			),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Heading tag', 'norebro-extra' ),
			'param_name' => 'heading_type',
			'description' => __( 'Select the tag in which the title will be displayed.', 'norebro-extra' ),
			'value' => array(
				__( '<h1>', 'norebro-extra' ) => 'h1',
				__( '<h2>', 'norebro-extra' ) => 'h2',
				__( '<h3>', 'norebro-extra' ) => 'h3',
				__( '<h4>', 'norebro-extra' ) => 'h4',
				__( '<h5>', 'norebro-extra' ) => 'h5'
			),
			'std' => 'h3',
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Show divider?', 'norebro-extra' ),
			'description' => __( 'If checked then divider will be hidden.', 'norebro-extra' ),
			'param_name' => 'divider_visible',
			'value' => array(
				'Yes' => '0'
			),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Divider position', 'norebro-extra' ),
			'param_name' => 'divider_alignment',
			'value' => array(
				__( 'Before title', 'norebro-extra' ) => 'before_title',
				__( 'After title', 'norebro-extra' ) => 'after_title'
			),
			'std' => 'before_title',
			'dependency' => array(
				'element' => 'divider_visible',
				'value' => array(
					'1'
				)
			),
		),

		// Typography
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_title',
			'value' => __( 'Title typography', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'title_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_mobile_title',
			'value' => __( 'Title typography (Mobile)', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'mobile_title_typo'
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_subtitle',
			'value' => __( 'Subtitle typography', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'subtitle_type_layout',
				'value' => array(
					'bottom_subtitle',
					'top_subtitle'
				)
			),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'subtitle_typo',
			'dependency' => array(
				'element' => 'subtitle_type_layout',
				'value' => array(
					'bottom_subtitle',
					'top_subtitle'
				)
			),
		),

		// Style
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
			'dependency' => array(
				'element' => 'subtitle_type_layout',
				'value' => array(
					'bottom_subtitle',
					'top_subtitle'
				)
			),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Divider color', 'norebro-extra' ),
			'param_name' => 'divider_color',
			'dependency' => array(
				'element' => 'divider_visible',
				'value' => '1',
			),
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