<?php

/**
* Visual Composer Norebro Parallax shortcode params
*/

vc_map( array(
	'name' => __( 'Parallax', 'norebro-extra' ),
	'description' => __( 'Parallax block', 'norebro-extra' ),
	'base' => 'norebro_parallax',
	'category' => __( 'Norebro', 'norebro-extra' ),
	"content_element" => true,
	"is_container" => true,
	"js_view" => 'VcColumnView',
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'attach_image',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Image', 'norebro-extra' ),
			'param_name' => 'image',
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Size', 'norebro-extra' ),
			'param_name' => 'size',
			'value' => array(
				__( 'Auto', 'norebro-extra' ) => '',
				__( 'Contain', 'norebro-extra' ) => 'contain',
				__( 'Cover', 'norebro-extra' )   => 'cover',
				__( 'auto 100%', 'norebro-extra' )  => 'auto 100%',
				__( '100% auto', 'norebro-extra' )  => '100% auto',
				__( '100% 100%', 'norebro-extra' )  => '100% 100%',
			),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Parallax type', 'norebro-extra' ),
			'param_name' => 'parallax',
			'value' => array(
				__( 'Vertical', 'norebro-extra' ) => 'vertical',
				__( 'Horizontal', 'norebro-extra' ) => 'horizontal'
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Parallax speed', 'norebro-extra' ),
			'param_name' => 'parallax_speed',
			'description' => __( 'Parallax speed (default 1.0).', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Use overlay?', 'norebro-extra' ),
			'param_name' => 'use_overlay',
			'value' => array(
				__( 'Yes, sure', 'norebro-extra' ) => '0'
			)
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Overlay color', 'norebro-extra' ),
			'param_name' => 'overlay_color',
			'dependency' => array(
				'element' => 'use_overlay',
				'value' => '1'
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Custom CSS class', 'norebro-extra' ),
			'param_name' => 'css_class',
			'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'norebro-extra' )
		),
	)
) );


if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Norebro_Parallax extends WPBakeryShortCodesContainer {
		
	}
}