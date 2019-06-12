<?php

/**
* Visual Composer Norebro Social Networks shortcode params
*/

vc_map( array(
	'name' => __( 'Social Networks', 'norebro-extra' ),
	'description' => __( 'Social sharing buttons block', 'norebro-extra' ),
	'base' => 'norebro_social_networks',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(

		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Icons layout', 'norebro-extra' ),
			'param_name' => 'icon_layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_052.svg',
					'key' => 'outline',
					'title' => __( 'Outline', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_053.svg',
					'key' => 'fill',
					'title' => __( 'Fill', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_054.svg',
					'key' => 'flat',
					'title' => __( 'Flat', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_055.svg',
					'key' => 'inline',
					'title' => __( 'Inline', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_056.svg',
					'key' => 'text',
					'title' => __( 'Text', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_057.svg',
					'key' => 'boxed',
					'title' => __( 'Boxed', 'norebro-extra' ),
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
				__( 'Right', 'norebro-extra' ) => 'right',
			),
			'dependency' => array(
				'element' => 'icon_layout',
				'value' => array(
					'outline',
					'fill',
					'flat',
					'inline',
					'text'
				),
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Use small shapes', 'norebro-extra' ),
			'param_name' => 'small_shapes',
			'std' => '0',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'icon_layout',
				'value' => array(
					'outline',
					'fill',
					'flat',
					'inline',
					'text'
				),
			),
		),

		// Links
		array(
			'type' => 'dropdown',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => __( 'Type links', 'norebro-extra' ),
			'param_name' => 'type_links',
			'value' => array(
				__( 'Share', 'norebro-extra' ) => 'share',
				__( 'Custom', 'norebro-extra' ) => 'custom',
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-facebook"></em>' . __( 'Facebook share', 'norebro-extra' ),
			'param_name' => 'facebook',
			'value' => array(
				__( 'Add', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'share',
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-twitter"></em>' . __( 'Twitter share', 'norebro-extra' ),
			'param_name' => 'twitter',
			'value' => array(
				__( 'Add', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'share',
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-googleplus-outline"></em>' . __( 'Google+ share', 'norebro-extra' ),
			'param_name' => 'googleplus',
			'value' => array(
				__( 'Add', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'share',
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-linkedin-outline"></em>' . __( 'LinkedIn share', 'norebro-extra' ),
			'param_name' => 'linkedin',
			'value' => array(
				__( 'Add', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'share',
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-pinterest-outline"></em>' . __( 'Pinterest share', 'norebro-extra' ),
			'param_name' => 'pinterest',
			'value' => array(
				__( 'Add', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'share',
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-vk"></em>' . __( 'Vkontakte share', 'norebro-extra' ),
			'param_name' => 'vk',
			'value' => array(
				__( 'Add', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'share',
			),
		),
		/* Custom */
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-facebook"></em>' . __( 'Facebook link', 'norebro-extra' ),
			'param_name' => 'facebook_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-twitter"></em>' . __( 'Twitter link', 'norebro-extra' ),
			'param_name' => 'twitter_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-googleplus-outline"></em>' . __( 'Google+ link', 'norebro-extra' ),
			'param_name' => 'googleplus_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-instagram-outline"></em>' . __( 'Instagram link', 'norebro-extra' ),
			'param_name' => 'instagram_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-dribbble"></em>' . __( 'Dribbble link', 'norebro-extra' ),
			'param_name' => 'dribbble_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-linkedin-outline"></em>' . __( 'LinkedIn link', 'norebro-extra' ),
			'param_name' => 'linkedin_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-pinterest-outline"></em>' . __( 'Pinterest link', 'norebro-extra' ),
			'param_name' => 'pinterest_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is ion-social-github"></em>' . __( 'GitHub link', 'norebro-extra' ),
			'param_name' => 'github_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-dropbox"></em>' . __( 'Dropbox link', 'norebro-extra' ),
			'param_name' => 'dropbox_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-vk"></em>' . __( 'Vkontakte link', 'norebro-extra' ),
			'param_name' => 'vk_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-youtube"></em>' . __( 'Youtube link', 'norebro-extra' ),
			'param_name' => 'youtube_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-vimeo"></em>' . __( 'Vimeo link', 'norebro-extra' ),
			'param_name' => 'vimeo_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-behance"></em>' . __( 'Behance link', 'norebro-extra' ),
			'param_name' => 'behance_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-tumblr"></em>' . __( 'Tumblr link', 'norebro-extra' ),
			'param_name' => 'tumblr_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-flickr"></em>' . __( 'flickr link', 'norebro-extra' ),
			'param_name' => 'flickr_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-reddit-alien"></em>' . __( 'reddit link', 'norebro-extra' ),
			'param_name' => 'reddit_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-snapchat-ghost"></em>' . __( 'Snapchat link', 'norebro-extra' ),
			'param_name' => 'snapchat_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-whatsapp"></em>' . __( 'Whatsapp link', 'norebro-extra' ),
			'param_name' => 'whatsapp_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-quora"></em>' . __( 'Quora link', 'norebro-extra' ),
			'param_name' => 'quora_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-vine"></em>' . __( 'Vine link', 'norebro-extra' ),
			'param_name' => 'vine_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-digg"></em>' . __( 'Digg link', 'norebro-extra' ),
			'param_name' => 'digg_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-foursquare"></em>' . __( 'Foursquare link', 'norebro-extra' ),
			'param_name' => 'foursquare_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-tripadvisor"></em>' . __( 'TripAdvisor link', 'norebro-extra' ),
			'param_name' => 'tripadvisor_link_custom',
			'dependency' => array(
				'element' => 'type_links',
				'value' => 'custom',
			),
		),
		
		// Style
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Squared shape', 'norebro-extra' ),
			'param_name' => 'shape_squared',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
			'std' => '0',
			'dependency' => array(
				'element' => 'icon_layout',
				'value' => array(
					'fill',
					'outline',
					'flat'
				),
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Outline hover', 'norebro-extra' ),
			'param_name' => 'outline_hover',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'icon_layout',
				'value' => 'flat',
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Default colors', 'norebro-extra' ),
			'param_name' => 'default_colors',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Hover default colors', 'norebro-extra' ),
			'param_name' => 'hover_default_colors',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'default_colors',
				'value' => '0',
			),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Shape color', 'norebro-extra' ),
			'param_name' => 'color',
			'dependency' => array(
				'element' => 'default_colors',
				'value' => '0',
			),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Icon color', 'norebro-extra' ),
			'param_name' => 'icon_color',
			'dependency' => array(
				'element' => 'default_colors',
				'value' => '0',
			),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Icon hover color', 'norebro-extra' ),
			'param_name' => 'icon_hover_color',
			'dependency' => array(
				'element' => 'default_colors',
				'value' => '0',
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
) );