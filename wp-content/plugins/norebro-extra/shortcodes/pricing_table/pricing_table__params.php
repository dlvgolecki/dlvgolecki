<?php

/**
* Visual Composer Norebro Pricing Table shortcode params
*/

vc_map( array(
	'name' => __( 'Pricing Table', 'norebro-extra' ),
	'description' => __( 'Simple pricing table block', 'norebro-extra' ),
	'base' => 'norebro_pricing_table',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'js_view' => 'VcNorebroPricingTableView',
	'custom_markup' => '{{title}}<div class="vc_norebro_pricing_table-container">
			<div class="title">%%title%%</div>
			<div class="subtitle"></div>
			<div class="divider"></div>
			<div class="price"><span></span>%%price%%</div>
			<div class="divider"></div>
			<div class="item"></div>
			<div class="divider"></div>
			<div class="item"></div>
			<div class="divider"></div>
			<div class="item"></div>
			<div class="divider"></div>
			<div class="item"></div>
			<div class="divider"></div>
			<div class="read_more"></div>
		</div>',
	'params' => array(
		// General
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Title', 'norebro-extra' ),
			'param_name' => 'title',
			'value' => '',
			'description' => __( 'You can specify the name of the tariff plan like <b>Basic</b> and <b>Business</b> or your product name.', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Subtitle', 'norebro-extra' ),
			'param_name' => 'subtitle',
			'value' => '',
			'description' => ''
		),
		array(
			'type' => 'textarea',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Description', 'norebro-extra' ),
			'param_name' => 'description',
			'value' => '',
			'description' => __( 'Short description.', 'norebro-extra' ),
		),

		// Price
		array(
			'type' => 'textfield',
			'group' => __( 'Price', 'norebro-extra' ),
			'heading' => __( 'Price', 'norebro-extra' ),
			'param_name' => 'price',
			'value' => '',
			'description' => __( 'Number or specific phrases like <b>Free</b>, <b>Personal price</b> and <b>Beta testers only</b>.', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Price', 'norebro-extra' ),
			'heading' => __( 'Currency', 'norebro-extra' ),
			'param_name' => 'price_currency',
			'value' => '',
			'description' => __( '<b>&#36;</b>, <b>&euro;</b>, <b>&pound;</b>, <b>&yen;</b>, USD, EUR, anything.', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Price', 'norebro-extra' ),
			'heading' => __( 'Caption', 'norebro-extra' ),
			'param_name' => 'price_caption',
			'value' => '',
			'description' => __( 'You can write that this amount per year or month. For ex. <b>per month</b> or <b>per year</b>', 'norebro-extra' ),
		),

		// Features
		array(
			'type' => 'param_group',
			'group' => __( 'Features', 'norebro-extra' ),
			'heading' => __( 'Features', 'norebro-extra' ),
			'param_name' => 'features_value',
			'value' => array(
				false
			),
			'params' => array(
				array(
					'type' => 'dropdown',
					'group' => __( 'Icon', 'norebro-extra' ),
					'heading' => __( 'Icon', 'norebro-extra' ),
					'param_name' => 'feature_icon',
					'value' => array(
						__( 'Without icon', 'norebro-extra' ) => 'without_icon',
						__( 'Enable icon', 'norebro-extra' ) => 'icon_plus',
						__( 'Disable icon', 'norebro-extra' ) => 'icon_minus'
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'norebro-extra' ),
					'param_name' => 'feature_title',
				),
			),					
		),
		
		// Button
		array(
			'type' => 'norebro_check',
			'group' => __( 'Button', 'norebro-extra' ),
			'heading' => __( 'Add button', 'norebro-extra' ),
			'param_name' => 'add_button',
			'value' => array(
				__( 'Yes, please', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'vc_link',
			'group' => __( 'Button', 'norebro-extra' ),
			'heading' => __( 'Button link', 'norebro-extra' ),
			'param_name' => 'button_link',
			'dependency' => array(
				'element' => 'add_button',
				'value' => array(
					'1'
				)
			),
			'description' => __( 'Fill title field to change the <strong>Get started</strong> inscription.', 'norebro-extra' ),
		),

		// Typography
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_title',
			'value' => __( 'Title', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'title_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_subtitle',
			'value' => __( 'Subtitle', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'subtitle_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_description',
			'value' => __( 'Description', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'description_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_price',
			'value' => __( 'Price', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'price_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_features_title',
			'value' => __( 'Features title', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'features_title_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_features_subtitle',
			'value' => __( 'Features subtitle', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'features_subtitle_typo',
		),

		// Style
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_content',
			'value' => __( 'Content', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Background color', 'norebro-extra' ),
			'param_name' => 'bg_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Borders color', 'norebro-extra' ),
			'param_name' => 'borders_color',
		),
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
			'value' => 'brand'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Description color', 'norebro-extra' ),
			'param_name' => 'description_color',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_price',
			'value' => __( 'Price', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Price color', 'norebro-extra' ),
			'param_name' => 'price_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Price caption color', 'norebro-extra' ),
			'param_name' => 'price_caption_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Price caption background color', 'norebro-extra' ),
			'param_name' => 'price_caption_bg_color',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_features',
			'value' => __( 'Features', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Titles color', 'norebro-extra' ),
			'param_name' => 'features_titles_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Icons color', 'norebro-extra' ),
			'param_name' => 'features_icons_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Disabled titles color', 'norebro-extra' ),
			'param_name' => 'features_disabled_titles_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Disabled icons color', 'norebro-extra' ),
			'param_name' => 'features_disabled_icons_color',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_button',
			'value' => __( 'Button', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'add_button',
				'value' => array(
					'1'
				)
			),
		),
		array(
			'type' => 'norebro_button',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'readmore_button',
			'value' => 'type=outline',
			'dependency' => array(
				'element' => 'add_button',
				'value' => array(
					'1'
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