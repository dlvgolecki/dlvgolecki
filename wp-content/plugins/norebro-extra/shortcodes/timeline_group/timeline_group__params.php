<?php


vc_map( array(
	'name' => __( 'Timeline', 'norebro-extra' ), 
	'description' => __( 'Timeline group module', 'norebro-extra' ), 
	'base' => 'norebro_timeline_group',
	'category' => __( 'Norebro', 'norebro-extra' ), 
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'js_view' => 'VcNorebroTimelineInnerView',
	'show_settings_on_create' => false,
	'as_parent' => array(
		'only' => 'norebro_timeline_inner',
	),
	'default_content' => '[norebro_timeline_inner][/norebro_timeline_inner]',
	'params' => array(
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Alignment', 'norebro-extra' ),
			'param_name' => 'alignment',
			'value' => array(
				__( 'Left', 'norebro-extra' ) => 'left',
				__( 'Right', 'norebro-extra' ) => 'right',
			),
		),
	
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Custom CSS class', 'norebro-extra' ),
			'param_name' => 'css_class',
			'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'norebro-extra' ),
		),
	)
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Norebro_Timeline_Group extends WPBakeryShortCodesContainer {	}
}