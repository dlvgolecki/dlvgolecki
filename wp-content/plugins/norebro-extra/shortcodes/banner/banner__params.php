<?php

/**
* Visual Composer Norebro Banner shortcode params
*/

vc_map( array(
	'name' => __( 'Banner', 'norebro-extra' ),
	'description' => __( 'Banner / Announcement box', 'norebro-extra' ),
	'base' => 'norebro_banner',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'js_view' => 'VcNorebroBannerBoxView',
	'custom_markup' => '{{title}}<div class="vc_norebro_banner_box-container">
			<div class="image" style="background-image: url(\'' . plugin_dir_url( __FILE__ ) . 'images/vc_gap_image.svg\');">
				<div class="title">%%title%%</div>
				<div class="lines">%%subtitle%%</div>
			</div>
		</div>',
	'params' => array(
		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Banner layout', 'norebro-extra' ),
			'param_name' => 'block_type_layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_001.svg',
					'key' => 'full',
					'title' => __( 'Full content', 'norebro-extra' )
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_004.svg',
					'key' => 'boxed',
					'title' => __( 'Boxed content', 'norebro-extra' )
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_005.svg',
					'key' => 'inner',
					'title' => __( 'Inner content', 'norebro-extra' )
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_006.svg',
					'key' => 'inner_hover',
					'title' => __( 'Hover content', 'norebro-extra' )
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_007.svg',
					'key' => 'overlay_title',
					'title' => __( 'Overlay title', 'norebro-extra' )
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_008.svg',
					'key' => 'hover_title',
					'title' => __( 'Hover title', 'norebro-extra' )
				)
			)
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Content alignment', 'norebro-extra' ),
			'param_name' => 'block_type_full_align',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_001.svg',
					'key' => 'left',
					'title' => __( 'Left', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_002.svg',
					'key' => 'center',
					'title' => __( 'Center', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_003.svg',
					'key' => 'right',
					'title' => __( 'Right', 'norebro-extra' ),
				)
			),
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Subtitle position', 'norebro-extra' ),
			'param_name' => 'block_type_subtitle',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_009.svg',
					'key' => 'after',
					'title' => __( 'After title', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_010.svg',
					'key' => 'before',
					'title' => __( 'Before title', 'norebro-extra' ),
				)
			),
		),
		array(
			'type' => 'textfield',
			'holder' => 'em',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Inner padding', 'norebro-extra' ),
			'description' => __( 'Use CSS value.', 'norebro-extra'),
			'param_name' => 'inner_padding',
			'std' => '30px'
		),

		array(
			'type' => 'textfield',
			'holder' => 'em',
			'group' => __( 'Content', 'norebro-extra' ),
			'heading' => __( 'Title', 'norebro-extra' ),
			'param_name' => 'title'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Content', 'norebro-extra' ),
			'heading' => __( 'Subtitle', 'norebro-extra' ),
			'param_name' => 'subtitle',
		),
		array(
			'type' => 'textarea_raw_html',
			'group' => __( 'Content', 'norebro-extra' ),
			'heading' => __( 'Description', 'norebro-extra' ),
			'param_name' => 'description',
			'description' => __( 'Banner can be used as announcement block. Therefore, you can write text of the announcement for page / post / category / external link (HTML allowed).', 'norebro-extra' )
		),
		array(
			'type' => 'attach_image',
			'group' => __( 'Content', 'norebro-extra' ),
			'heading' => __( 'Background image', 'norebro-extra' ),
			'param_name' => 'background_image',
			'description' => __( 'Choose block background image.', 'norebro-extra' ),
		),

		// Link
		array(
			'type' => 'norebro_check',
			'group' => __( 'Link', 'norebro-extra' ),
			'heading' => __( 'Use link?', 'norebro-extra' ),
			'param_name' => 'use_link',
			'value' => array(
				__( 'Yes, sure', 'norebro-extra' ) => '1'
			),
			'description' => __( 'You can use banner as link to another page.', 'norebro-extra' ),
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
			'description' => __( 'Fill Link Text field to change the <strong>Read more</strong> label.', 'norebro-extra' ),
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
			'param_name' => 'subtitle_typo'
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
			'type' => 'argenta_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_heading',
			'value' => __( 'Button text', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'use_link',
				'value' => array(
					'1'
				)
			),
		),
		array(
			'type' => 'argenta_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'button_typo',
			'dependency' => array(
				'element' => 'use_link',
				'value' => array(
					'1'
				)
			),
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
			'param_name' => 'style_tab_divider_readmore',
			'value' => __( 'Read more button', 'norebro-extra' ),
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
			'value' => 'type=outline&size=small',
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
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Background overlay color', 'norebro-extra' ),
			'param_name' => 'overlay_color',
			'value' => 'rgba(52, 52, 54, 0.9)',
			'dependency' => array(
				'element' => 'block_type_layout',
				'value' => array(
					'inner'
				)
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