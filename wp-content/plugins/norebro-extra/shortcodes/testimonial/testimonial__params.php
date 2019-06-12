<?php


vc_map( array(
	'name' => __( 'Testimonials', 'norebro-extra' ),
	'description' => __( 'Testimonial module', 'norebro-extra' ),
	'base' => 'norebro_testimonial',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'js_view' => 'VcNorebroTestimonialView',
	'custom_markup' => '{{title}}<div class="vc_norebro_testimonial-container">
			<div class="lines"><div class="line"></div><div class="line"></div><div class="line"></div></div>
			<div class="photo"></div>
			<div class="name">%%author%%</div>
			<div class="position"></div>
		</div>',
	'params' => array(
		// General
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Testimonial layout', 'norebro-extra' ),
			'param_name' => 'block_type_layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_071.svg',
					'key' => 'default',
					'title' => __( 'Default', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_065.svg',
					'key' => 'photo_top',
					'title' => __( 'Image Top', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_068.svg',
					'key' => 'photo_middle',
					'title' => __( 'Image Middle', 'norebro-extra' ),
				)
			)
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Content alignment', 'norebro-extra' ),
			'param_name' => 'block_type_alignment_default',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_071.svg',
					'key' => 'center',
					'title' => __( 'Center', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_070.svg',
					'key' => 'left',
					'title' => __( 'Left', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_072.svg',
					'key' => 'right',
					'title' => __( 'Right', 'norebro-extra' ),
				)
			),
			'dependency' => array(
				'element' => 'block_type_layout',
				'value' => array(
					'default'
				)
			)
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Box alignment', 'norebro-extra' ),
			'param_name' => 'block_type_alignment_top',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_065.svg',
					'key' => 'center',
					'title' => __( 'Center', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_064.svg',
					'key' => 'left',
					'title' => __( 'Left', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_066.svg',
					'key' => 'right',
					'title' => __( 'Right', 'norebro-extra' ),
				)
			),
			'dependency' => array(
				'element' => 'block_type_layout',
				'value' => array(
					'photo_top'
				)
			)
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Box alignment', 'norebro-extra' ),
			'param_name' => 'block_type_alignment_middle',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_068.svg',
					'key' => 'center',
					'title' => __( 'Center', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_067.svg',
					'key' => 'left',
					'title' => __( 'Left', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_069.svg',
					'key' => 'right',
					'title' => __( 'Right', 'norebro-extra' ),
				)
			),
			'dependency' => array(
				'element' => 'block_type_layout',
				'value' => array(
					'photo_middle'
				)
			)
		),
		array(
			'type' => 'textarea',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Testimonial text', 'norebro-extra' ),
			'param_name' => 'quote'
		),
		array(
			'type' => 'attach_image',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Image', 'norebro-extra' ),
			'param_name' => 'photo',
			'description' => __( 'Choose author photo.', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'block_type_layout',
				'value' => array(
					'photo_top',
					'photo_middle',
					'photo_and_mark'
				)
			)
		),
		array(
			'type' => 'textfield',
			'holder' => 'em',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Author', 'norebro-extra' ),
			'param_name' => 'author',
			'description' => __( 'Testimonial author name.', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Position', 'norebro-extra' ),
			'param_name' => 'position',
			'description' => __( 'For example, <strong>Product manager at Colabr.io</strong>.', 'norebro-extra' )
		),

		// Typography
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_quote',
			'value' => __( 'Testimonial text', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'quote_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_author',
			'value' => __( 'Author', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'author_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_position',
			'value' => __( 'Position', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'position_typo',
		),

		// Style
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Image border color', 'norebro-extra' ),
			'param_name' => 'image_border_color',
			'dependency' => array(
				'element' => 'block_type_layout',
				'value' => array(
					'photo_top',
					'photo_middle',
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Testimonial color', 'norebro-extra' ),
			'param_name' => 'quote_color'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Author color', 'norebro-extra' ),
			'param_name' => 'author_color'
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Position color', 'norebro-extra' ),
			'param_name' => 'position_color'
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