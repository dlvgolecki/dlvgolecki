<?php

/**
* WPBakery Page Builder Stockie Instagram Feed shortcode params
*/

vc_map( array(
	'name' => __( 'Instagram Feed', 'norebro-extra' ),
	'description' => __( 'Instagram feed module', 'norebro-extra' ),
	'base' => 'norebro_instagram_feed',
	'category' => __( 'Stockie', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'text',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Usage note:', 'norebro-extra' ),
			'param_name' => 'photo_count',
			'description' => __( 'To use the shortcode please firstly install <a target="_blank" href="/wp-admin/plugins.php">Instagram Feed</a> from the recommended plugins. Then connect your Instagram account in the plugin\'s <a target="_blank" href="/wp-admin/admin.php?page=sb-instagram-feed">settings</a>.', 'norebro-extra' ),
		),
        array(
            'type' => 'norebro_check',
            'group' => __( 'General', 'norebro-extra' ),
            'heading' => __( 'Show username?', 'norebro-extra' ),
            'param_name' => 'header',
            'value' => array(
                'Yes' => true
            ),
            'default' => '0',
        ),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Number of photos', 'norebro-extra' ),
			'param_name' => 'photo_count',
			'description' => __( 'Default 6. We recommend using a number that is suitable for the number of columns.', 'norebro-extra' ),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Columns', 'norebro-extra' ),
			'param_name' => 'columns',
			'value' => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'6' => '6',
				'12' => '12',
			),
			'default' => '6',
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Remove columns gap?', 'norebro-extra' ),
			'param_name' => 'columns_gap',
			'value' => array(
				'Yes' => '0'
			),
			'default' => '6',
		),

		// Custom CSS Class
		array(
			'type' => 'textfield',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Custom CSS class', 'norebro-extra' ),
			'param_name' => 'css_class',
			'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'norebro-extra' )
		),
	)
) );