<?php

/**
* Visual Composer Norebro Recent Posts shortcode params
*/

vc_map( array(
	'name' => __( 'Recent Posts', 'norebro-extra' ),
	'description' => __( 'Block with recent posts', 'norebro-extra' ),
	'base' => 'norebro_recent_posts',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(
		// General
		array(
			'type' => 'norebro_post_types',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Post categories', 'norebro-extra' ),
			'param_name' => 'post_category',
			'value' => ''
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Blog layout', 'norebro-extra' ),
			'param_name' => 'card_layout',
			'value' => array(
				__( 'Classic', 'norebro-extra' ) => 'classic',
				__( 'Side image', 'norebro-extra' ) => 'side_image',
				__( 'Overlay', 'norebro-extra' ) => 'overlay',
				__( 'Simple', 'norebro-extra' ) => 'simple',
				__( 'Striped', 'norebro-extra' ) => 'striped'
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Use boxed style for items?', 'norebro-extra' ),
			'param_name' => 'card_boxed',
			'description' => __( 'Append box wrapper for post cards', 'norebro-extra' ),
			'value' => array(
				__( 'Wrap in box', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'classic',
					'side_image',
					'striped'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Show cards in striped view?', 'norebro-extra' ),
			'param_name' => 'card_striped',
			'description' => __( '', 'norebro-extra' ),
			'value' => array(
				__( 'Striped view', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'striped'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Add indented to cards view?', 'norebro-extra' ),
			'param_name' => 'card_indented',
			'description' => __( '', 'norebro-extra' ),
			'value' => array(
				__( 'Indented view', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'striped'
				)
			)
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Grid animation', 'norebro-extra' ),
			'param_name' => 'animation_type',
			'value' => array(
				__( 'Without animation', 'norebro-extra' ) => 'default',
				__( 'Sync animation', 'norebro-extra' ) => 'sync',
				__( 'Async animation', 'norebro-extra' ) => 'async'
			)
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Animation effect', 'norebro-extra' ),
			'param_name' => 'animation_effect',
			'value' => array(
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
			'type' => 'norebro_columns',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Blog items per row', 'norebro-extra' ),
			'param_name' => 'columns_in_row',
			'std' => '4-3-2-1'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Blog items per page', 'norebro-extra' ),
			'param_name' => 'posts_in_block',
			'description' => __( 'Chose number of last projects in the block.', 'norebro-extra' ),
			'value' => 12
		),
		
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Items gap', 'norebro-extra' ),
			'param_name' => 'card_gap',
			'description' => __( 'Use CSS value.', 'norebro-extra' ),
			'value' => '30px'
		),

		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_card_content_typo',
			'value' => __( 'Card content', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'text_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_card_heading_typo',
			'value' => __( 'Card heading', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'heading_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_card_info_typo',
			'value' => __( 'Card info subtitles', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'subtitle_typo',
		),

		// Pagination
		array(
			'type' => 'norebro_check',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Enable pagination', 'norebro-extra' ),
			'param_name' => 'use_pagination',
			'description' => '',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			)
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Pagination type', 'norebro-extra' ),
			'param_name' => 'pagination_type',
			'value' => array(
				__( 'Simple', 'norebro-extra' ) => 'simple',
				__( 'Lazy load', 'norebro-extra' ) => 'lazy_scroll',
				__( 'Load more button', 'norebro-extra' ) => 'lazy_button',
			),
			'std' => 'simple',
			'dependency' => array(
				'element' => 'use_pagination',
				'value' => array(
					'1'
				)
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Blog items per page', 'norebro-extra' ),
			'param_name' => 'pagination_items_per_page',
			'value' => '6',
			'dependency' => array(
				'element' => 'use_pagination',
				'value' => array(
					'1'
				)
			)
		),

		// Style
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_colors',
			'value' => __( 'Card colors', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Card background color', 'norebro-extra' ),
			'param_name' => 'card_background_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Card text color', 'norebro-extra' ),
			'param_name' => 'card_text_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Card heading color', 'norebro-extra' ),
			'param_name' => 'card_heading_color',
			'description' => __( 'Color for post title link.', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Card info subtitle color', 'norebro-extra' ),
			'param_name' => 'card_subtitle_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Pagination color', 'norebro-extra' ),
			'param_name' => 'pagination_color',
			'dependency' => array(
				'element' => 'use_pagination',
				'value' => '1',
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Pagination hover and active color', 'norebro-extra' ),
			'param_name' => 'pagination_active_color',
			'dependency' => array(
				'element' => 'use_pagination',
				'value' => '1',
			)
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_other',
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