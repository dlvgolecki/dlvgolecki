<?php

/**
* Visual Composer Norebro Contact Form shortcode params
*/

$norebro_extra_cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

$norebro_extra_contact_forms = array();
if ( $norebro_extra_cf7 ) {
	foreach ( $norebro_extra_cf7 as $cform ) {
		$norebro_extra_contact_forms[ $cform->post_title ] = $cform->ID;
	}
} else {
	$norebro_extra_contact_forms[ __( 'No contact forms found', 'norebro-extra' ) ] = 0;
}

vc_map( array(
	'name' => __( 'Contact Form', 'norebro-extra' ),
	'description' => __( 'Norebro Contact 7 form module', 'norebro-extra' ),
	'base' => 'norebro_contact_form',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Form', 'norebro-extra' ),
			'param_name' => 'form_id',
			'value' => $norebro_extra_contact_forms,
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Form style', 'norebro-extra' ),
			'param_name' => 'form_style',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_029.svg',
					'key' => 'classic',
					'title' => __( 'Default', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_030.svg',
					'key' => 'border',
					'title' => __( 'Outline', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_031.svg',
					'key' => 'flat',
					'title' => __( 'Flat', 'norebro-extra' ),
				),
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Fields offset', 'norebro-extra' ),
			'param_name' => 'fields_offset',
			'description' => __( 'CSS value.', 'norebro-extra' ),
			'value' => '10px'
		),

		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_fields',
			'value' => __( 'Fields', 'norebro-extra' ),
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Fields background color', 'norebro-extra' ),
			'param_name' => 'fields_color',
			'dependency' => array(
				'element' => 'form_style',
				'value' => array(
					'flat',
				)
			)
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Fields border color', 'norebro-extra' ),
			'param_name' => 'fields_border_color',
			'dependency' => array(
				'element' => 'form_style',
				'value' => array(
					'border',
					'classic'
				)
			)
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Fields text color', 'norebro-extra' ),
			'param_name' => 'fields_text_color',
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Fields focus border color', 'norebro-extra' ),
			'param_name' => 'fields_focus_border_color',
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
			'value' => 'color=brand',
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Button position', 'norebro-extra' ),
			'param_name' => 'button_position',
			'value' => array(
				__( 'Left', 'norebro-extra' ) => 'left',
				__( 'Center', 'norebro-extra' ) => 'center',
				__( 'Right', 'norebro-extra' ) => 'right'
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