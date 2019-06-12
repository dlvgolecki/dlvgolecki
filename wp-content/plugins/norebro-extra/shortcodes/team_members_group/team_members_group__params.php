<?php

/**
* Visual Composer Norebro Team Members Group shortcode params
*/

vc_map( array(
	'name' => __( 'Team Group', 'norebro-extra' ), 
	'description' => __( 'Team members group module', 'norebro-extra' ), 
	'base' => 'norebro_team_members_group',
	'category' => __( 'Norebro', 'norebro-extra' ), 
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'js_view' => 'VcNorebroGroupColumnView',
	'show_settings_on_create' => false,
	'as_parent' => array(
		'only' => 'norebro_team_member_inner',
	),
	'default_content' => '[norebro_team_member_inner][/norebro_team_member_inner][norebro_team_member_inner][/norebro_team_member_inner][norebro_team_member_inner][/norebro_team_member_inner]',
	'params' => array(
		// Style
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'argenta_extra' ),
			'heading' => __( 'Content block background', 'argenta_extra' ),
			'param_name' => 'content_bg',
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Styles and Colors', 'argenta_extra' ),
			'heading' => __( 'Appearance effect', 'argenta_extra' ),
			'param_name' => 'appearance_effect',
			'value' => array(
				__( 'None', 'argenta_extra' ) => 'none',
				__( 'Fade up', 'argenta_extra' ) => 'fade-up',
				__( 'Fade down', 'argenta_extra' ) => 'fade-down',
				__( 'Fade right', 'argenta_extra' ) => 'fade-right',
				__( 'Fade left', 'argenta_extra' ) => 'fade-left',
				__( 'Flip up', 'argenta_extra' ) => 'flip-up',
				__( 'Flip down', 'argenta_extra' ) => 'flip-down',
				__( 'Zoom in', 'argenta_extra' ) => 'zoom-in',
				__( 'Zoom out', 'argenta_extra' ) => 'zoom-out'
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Styles and Colors', 'argenta_extra' ),
			'heading' => __( 'Appearance effect duration', 'argenta_extra' ),
			'param_name' => 'appearance_duration',
			'description' => __( 'Duration accept values from 50 to 3000(ms), with step 50.', 'argenta_extra' ),
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

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Norebro_Team_Members_Group extends WPBakeryShortCodesContainer { }
}