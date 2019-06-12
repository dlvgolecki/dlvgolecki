<?php

/**
* Visual Composer Norebro Icon Box shortcode params
*/

vc_map( array(
	'name' => __( 'Icon Box', 'norebro-extra' ),
	'description' => __( 'Norebro eye catching icons', 'norebro-extra' ),
	'base' => 'norebro_icon_box',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'js_view' => 'VcNorebroIconBoxView',
	'custom_markup' => '{{title}}<div class="vc_norebro_icon_box-container">
			<div class="icon">%%icon%%</div>
			<div class="title">%%title%%</div>
			<div class="subtitle"></div>
			<div class="divider"></div>
			<div class="lines"><div class="line"></div><div class="line"></div><div class="line"></div></div>
			<div class="read_more"></div>
		</div>',
	'params' => array(
		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Icon box layout', 'norebro-extra' ),
			'param_name' => 'box_type_layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_012.svg',
					'key' => 'top_icon',
					'title' => __( 'Top icon', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_015.svg',
					'key' => 'left_icon',
					'title' => __( 'Side icon', 'norebro-extra' ),
				),
				/*array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/param_box_layout_right_icon.png',
					'key' => 'right_icon',
					'title' => __( 'Right Icon', 'norebro-extra' ),
				)*/
			)
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Content alignment', 'norebro-extra' ),
			'param_name' => 'box_alignment',
			'dependency' => array(
				'element' => 'box_type_layout',
				'value' => array(
					'top_icon'
				)
			),
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_012.svg',
					'key' => 'center',
					'title' => __( 'Center', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_013.svg',
					'key' => 'left',
					'title' => __( 'Left', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_014.svg',
					'key' => 'right',
					'title' => __( 'Right', 'norebro-extra' ),
				)
			)
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Box layout', 'norebro-extra' ),
			'param_name' => 'content_full',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_015.svg',
					'key' => 'none',
					'title' => __( 'Float content', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_016.svg',
					'key' => 'full',
					'title' => __( 'Inline title', 'norebro-extra' ),
				)
			),
			'dependency' => array(
				'element' => 'box_type_layout',
				'value' => array(
					'left_icon',
					'right_icon'
				)
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Title', 'norebro-extra' ),
			'param_name' => 'title',
			'description' => __( 'Main title for block.', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Subtitle', 'norebro-extra' ),
			'param_name' => 'subtitle',
			'description' => __( 'Subtitle.', 'norebro-extra' ),
		),
		array(
			'type' => 'textarea',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Description', 'norebro-extra' ),
			'param_name' => 'description',
			'description' => __( 'Description content.', 'norebro-extra' ),
		),
		/*array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Full width content', 'norebro-extra' ),
			'param_name' => 'content_full',
			'value' => array(
				'Yes' => '0'
			),
			'dependency' => array(
				'element' => 'box_type_layout',
				'value' => array(
					'left_icon',
					'right_icon'
				)
			),
		),*/

		// Icon
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'Icon', 'norebro-extra' ),
			'heading' => __( 'Icon layout', 'norebro-extra' ),
			'param_name' => 'icon_type_layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_017.svg',
					'key' => 'default',
					'title' => __( 'Default', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_018.svg',
					'key' => 'border',
					'title' => __( 'Border', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_019.svg',
					'key' => 'fill_and_border',
					'title' => __( 'Fill & border', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_020.svg',
					'key' => 'only_fill',
					'title' => __( 'Fill only', 'norebro-extra' ),
				),
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Icon', 'norebro-extra' ),
			'heading' => __( 'Rounded icon shape', 'norebro-extra' ),
			'param_name' => 'rounded_icon_shape',
			'value' => array(
				'Yes' => '0'
			),
			'dependency' => array(
				'element' => 'icon_type_layout',
				'value' => array(
					'border',
					'double',
					'fill_and_border',
					'only_fill'
				)
			),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Icon', 'norebro-extra' ),
			'heading' => __( 'Icon type', 'norebro-extra' ),
			'param_name' => 'icon_type',
			'value' => array(
				__( 'Font icon', 'norebro-extra' ) => 'font_icon',
				__( 'Custom image', 'norebro-extra' ) => 'user_image'
			),
		),
		array(
			'type' => 'norebro_icon_picker',
			'group' => __( 'Icon', 'norebro-extra' ),
			'heading' => __( 'Icon', 'norebro-extra' ),
			'param_name' => 'icon_as_icon',
			'description' => __( 'Choose icon.', 'norebro-extra' ),
			'settings' => array(),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array(
					'font_icon'
				)
			)
		),
		array(
			'type' => 'attach_image',
			'group' => __( 'Icon', 'norebro-extra' ),
			'heading' => __( 'Icon image', 'norebro-extra' ),
			'param_name' => 'icon_as_image',
			'description' => __( 'Choose icon image.', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array(
					'user_image'
				)
			)
		),

		// Link
		array(
			'type' => 'norebro_check',
			'group' => __( 'Link', 'norebro-extra' ),
			'heading' => __( 'Use link?', 'norebro-extra' ),
			'param_name' => 'use_link',
			'description' => __( 'Select if you want to block links to some page.', 'norebro-extra' ),
			'value' => array(
				__( 'Yes, sure', 'norebro-extra' ) => '0'
			)
		),
		array(
			'type' => 'vc_link',
			'group' => __( 'Link', 'norebro-extra' ),
			'heading' => __( 'Link URL', 'norebro-extra' ),
			'param_name' => 'link_url',
			'dependency' => array(
				'element' => 'use_link',
				'value' => array(
					'1'
				)
			),
			'description' => __( 'Fill title field to change the <strong>Read more</strong> label.', 'norebro-extra' ),
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
			'heading' => __( 'Title color', 'norebro-extra' ),
			'param_name' => 'title_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Subtitle color', 'norebro-extra' ),
			'param_name' => 'subtitle_color',
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
			'param_name' => 'style_tab_divider_icon',
			'value' => __( 'Icon', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Fill color', 'norebro-extra' ),
			'param_name' => 'fill_color',
			'dependency' => array(
				'element' => 'icon_type_layout',
				'value' => array(
					'fill_and_border',
					'only_fill'
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Border color', 'norebro-extra' ),
			'param_name' => 'border_color',
			'value' => 'brand',
			'dependency' => array(
				'element' => 'icon_type_layout',
				'value' => array(
					'fill_and_border',
					'border',
					'double'
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Icon color', 'norebro-extra' ),
			'param_name' => 'icon_color',
			'value' => 'brand',
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array(
					'font_icon'
				)
			)
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_readmore',
			'value' => __( 'Readmore button', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'use_link',
				'value' => array(
					'1'
				)
			),
		),
		array(
			'type' => 'norebro_button',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'readmore_button',
			'color_brand' => true,
			'dependency' => array(
				'element' => 'use_link',
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