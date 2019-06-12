<?php

/**
* Visual Composer Norebro Google Maps shortcode params
*/

vc_map( array(
	'name' => __( 'Google Maps', 'norebro-extra' ),
	'description' => __( 'Google Maps block', 'norebro-extra' ),
	'base' => 'norebro_google_maps',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'textarea',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Map marker locations', 'norebro-extra' ),
			'param_name' => 'marker_locations',
			'description' => __( 'Use several locations by placing coordinates in separate rows. (e.g. 55.6925218, 12.5199567).', 'norebro-extra' ),	
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Map height', 'norebro-extra' ),
			'param_name' => 'map_height',
			'description' => __( 'Enter map height (in pixels or leave empty for responsive map).', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Enable map zoom buttons', 'norebro-extra' ),
			'param_name' => 'map_zoom_enable',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Enable fullsreen button', 'norebro-extra' ),
			'param_name' => 'map_fullscreen_enable',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Enable map type buttons', 'norebro-extra' ),
			'param_name' => 'map_type_enable',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Enable map street view button', 'norebro-extra' ),
			'param_name' => 'map_street_view_enable',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Map zoom', 'norebro-extra' ),
			'param_name' => 'map_zoom',
			'description' => __( 'Map zoom level (min - 1, max - 20, default - 14)', 'norebro-extra' ),
		),
		array(
			'type' => 'attach_image',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Map marker image', 'norebro-extra' ),
			'param_name' => 'map_marker',
			'description' => __( 'Choose marker image.', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Map style', 'norebro-extra' ),
			'param_name' => 'map_style',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/default.png',
					'key' => 'default',
					'title' => __( 'Default', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/light_dream.png',
					'key' => 'light_dream',
					'title' => __( 'Light Dream', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/shades_of_grey.png',
					'key' => 'shades_of_grey',
					'title' => __( 'Shades of Grey', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/paper.png',
					'key' => 'paper',
					'title' => __( 'Paper', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/light_monochrome.png',
					'key' => 'light_monochrome',
					'title' => __( 'Monochrome', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/lunar_landscape.png',
					'key' => 'lunar_landscape',
					'title' => __( 'Lunar', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/routexl.png',
					'key' => 'routexl',
					'title' => __( 'Routexl', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/flat_pale.png',
					'key' => 'flat_pale',
					'title' => __( 'Flat Pale', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/flat_design.png',
					'key' => 'flat_design',
					'title' => __( 'Flat Design', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/',
					'key' => 'custom',
					'title' => __( 'Custom', 'norebro-extra' ),
				)
			)
		),
		array(
			'type' => 'textarea_raw_html',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Custom map style', 'norebro-extra' ),
			'description' => __( 'Paste JSON code. Customize style on <a target="_blank" href="https://mapstyle.withgoogle.com/">Styling Wizard</a>', 'norebro-extra' ),
			'param_name' => 'custom_map_style',
			'dependency' => array(
				'element' => 'map_style',
				'value' => array(
					'custom'
				)
			)
		)
	)
) );