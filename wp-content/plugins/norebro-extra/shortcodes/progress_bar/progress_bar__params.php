<?php

/**
* Visual Composer Norebro Progress Bar shortcode params
*/

vc_map( array(
	'name' => __( 'Progress Bar', 'norebro-extra' ),
	'description' => __( 'Progress bar section', 'norebro-extra' ),
	'base' => 'norebro_progress_bar',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'js_view' => 'VcNorebroProgressBarView',
	'custom_markup' => '{{title}}<div class="vc_norebro_progress_bar-container"><em>%%title%%</em></div>',
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Progress bar layout', 'norebro-extra' ),
			'param_name' => 'layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_048.svg',
					'key' => 'default',
					'title' => __( 'Flat', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_049.svg',
					'key' => 'inner',
					'title' => __( 'Inner', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_050.svg',
					'key' => 'split',
					'title' => __( 'Split', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_051.svg',
					'key' => 'pattern',
					'title' => __( 'Pattern', 'norebro-extra' ),
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Percent in tooltip', 'norebro-extra' ),
			'param_name' => 'percent_in_tooltip',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Label', 'norebro-extra' ),
			'param_name' => 'name',
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Progress value', 'norebro-extra' ),
			'param_name' => 'percent',
			'value' => '100',
		),

		// Typography
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_name',
			'value' => __( 'Label', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'name_typo',
		),
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
		
		// Style
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Label color', 'norebro-extra' ),
			'param_name' => 'label_color'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Percent color', 'norebro-extra' ),
			'param_name' => 'percent_color'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Bar background color', 'norebro-extra' ),
			'param_name' => 'bar_bg_color'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Bar line color', 'norebro-extra' ),
			'param_name' => 'bar_line_color'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and colors', 'norebro-extra' ),
			'heading' => __( 'Tooltip color', 'norebro-extra' ),
			'param_name' => 'tooltip_color',
			'dependency' => array(
				'element' => 'percent_in_tooltip',
				'value' => '1'
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
	)
)
);