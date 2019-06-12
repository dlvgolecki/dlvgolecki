<?php

/**
* Visual Composer Norebro Recent Projects shortcode params
*/

vc_map( array(
	'name' => __( 'Recent Projects', 'norebro-extra' ),
	'description' => __( 'Recent Norebro portfolio projects', 'norebro-extra' ),
	'base' => 'norebro_recent_projects',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(


		// General
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Portfolio layout', 'norebro-extra' ),
			'param_name' => 'card_layout',
			'value' => array(
				__( 'Image Grid. Hover: centered details', 'norebro-extra' ) => 'grid_1_hover_1',
				__( 'Image Grid. Hover: side details', 'norebro-extra' ) => 'grid_1_hover_2',
				__( 'Image Grid. Hover: bottom details', 'norebro-extra' ) => 'grid_1_hover_3',
				__( 'Classic Grid. Hover: simple opacity', 'norebro-extra' ) => 'grid_2_hover_1',
				__( 'Classic Grid. Hover: overlay button', 'norebro-extra' ) => 'grid_2_hover_2',
				__( 'Classic Grid. Hover: overlay link', 'norebro-extra' ) => 'grid_2_hover_3',
				__( 'Fullscreen Carousel', 'norebro-extra' ) => 'grid_4',
				__( 'Split Screen', 'norebro-extra' ) => 'grid_5',
				__( 'Classic Carousel', 'norebro-extra' ) => 'grid_6',
				__( 'Slider with Vertical Scroll', 'norebro-extra' ) => 'grid_7',
				__( 'Slider with Horizontal Scroll', 'norebro-extra' ) => 'grid_8',
			),
		),
        array(
            'type' => 'dropdown',
            'group' => __( 'General', 'norebro-extra' ),
            'heading' => __( 'Portfolio item image size', 'norebro-extra' ),
            'param_name' => 'portfolio_images_size',
            'value' => array(
                __( 'Theme settings inherited', 'norebro-extra' ) => 'inherit',
                __( 'Thumbnail', 'norebro-extra' ) => 'thumbnail',
                __( 'Small', 'norebro-extra' ) => 'medium',
                __( 'Medium', 'norebro-extra' ) => 'medium_large',
                __( 'Large', 'norebro-extra' ) => 'large',
                __( 'Original', 'norebro-extra' ) => 'full',
            ),
        ),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Metro style', 'norebro-extra' ),
			'param_name' => 'metro_style',
			'description' => '',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_1_hover_1',
					'grid_1_hover_2',
					'grid_1_hover_3'
				)
			)
		),
		array(
			'type' => 'norebro_portfolio_types',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Project categories', 'norebro-extra' ),
			'param_name' => 'projects_category',
			'value' => ''
		),

		// Lightbox
		array(
			'type' => 'norebro_check',
			'group' => __( 'Lightbox', 'norebro-extra' ),
			'heading' => __( 'Enable lightbox preview for portfolio project', 'norebro-extra' ),
			'param_name' => 'open_in_popup',
			'description' => '',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Lightbox', 'norebro-extra' ),
			'heading' => __( 'Hide "View project" link from lightbox?', 'norebro-extra' ),
			'param_name' => 'hide_view_link_in_popup',
			'description' => '',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'open_in_popup',
				'value' => array(
					'1'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Lightbox', 'norebro-extra' ),
			'heading' => __( 'Show navigation buttons', 'norebro-extra' ),
			'param_name' => 'popup_show_nav_buttons',
			'description' => '',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'open_in_popup',
				'value' => array(
					'1'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Lightbox', 'norebro-extra' ),
			'heading' => __( 'Enable mouse wheel scrolling', 'norebro-extra' ),
			'param_name' => 'popup_mouse_scrolling',
			'description' => '',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'open_in_popup',
				'value' => array(
					'1'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Lightbox', 'norebro-extra' ),
			'heading' => __( 'Enable auto scrolling', 'norebro-extra' ),
			'param_name' => 'popup_autoplay',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'open_in_popup',
				'value' => array(
					'1'
				)
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Lightbox', 'norebro-extra' ),
			'heading' => __( 'Gallery autoplay time', 'norebro-extra' ),
			'param_name' => 'popup_autoplay_time',
			'description' => __( 'Autoplay interval timeout in seconds. Default 5 second.', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'popup_autoplay',
				'value' => '1',
			),
			'std' => '5'
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Grid animation', 'norebro-extra' ),
			'param_name' => 'animation_type',
			'value' => array(
				__( 'Without animation', 'norebro-extra' ) => 'default',
				__( 'Sync animation', 'norebro-extra' ) => 'sync',
				__( 'Async animation', 'norebro-extra' ) => 'async'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_1_hover_1',
					'grid_1_hover_2',
					'grid_1_hover_3',
					'grid_2_hover_1',
					'grid_2_hover_2',
					'grid_2_hover_3',
					'grid_3',
				)
			)
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Grid animation effect', 'norebro-extra' ),
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
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_1_hover_1',
					'grid_1_hover_2',
					'grid_1_hover_3',
					'grid_2_hover_1',
					'grid_2_hover_2',
					'grid_2_hover_3',
					'grid_3',
				)
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Grid height', 'norebro-extra' ),
			'param_name' => 'grid_height',
			'description' => __( 'CSS value. `100vh` for full viewport height', 'norebro-extra' ),
			'value' => '500px',
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_5',
					'grid_7',
					'grid_8'
				)
			)
		),
		array(
			'type' => 'norebro_columns',
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Portfolio items per row', 'norebro-extra' ),
			'param_name' => 'columns_in_row',
			'std' => '4-3-2-1',
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_1_hover_1',
					'grid_1_hover_2',
					'grid_1_hover_3',
					'grid_2_hover_1',
					'grid_2_hover_2',
					'grid_2_hover_3',
				)
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Items gap', 'norebro-extra' ),
			'param_name' => 'grid_items_gap',
			'description' => __( 'CSS value.', 'norebro-extra' ),
			'value' => '15px',
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_1_hover_1',
					'grid_1_hover_2',
					'grid_1_hover_3',
					'grid_2_hover_1',
					'grid_2_hover_2',
					'grid_2_hover_3',
					'grid_3',
					'grid_4',
					'grid_6'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Show category filter', 'norebro-extra' ),
			'param_name' => 'show_projects_filter',
			'description' => '',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_1_hover_1',
					'grid_1_hover_2',
					'grid_1_hover_3',
					'grid_2_hover_1',
					'grid_2_hover_2',
					'grid_2_hover_3',
				)
			)
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Category filter position', 'norebro-extra' ),
			'param_name' => 'filter_align',
			'value' => array(
				__( 'Left', 'norebro-extra' ) => 'left',
				__( 'Center', 'norebro-extra' ) => 'center',
				__( 'Right', 'norebro-extra' ) => 'right',
			),
			'std' => 'center',
			'dependency' => array(
				'element' => 'show_projects_filter',
				'value' => array(
					'1'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Enable pagination', 'norebro-extra' ),
			'param_name' => 'use_pagination',
			'description' => '',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_1_hover_1',
					'grid_1_hover_2',
					'grid_1_hover_3',
					'grid_2_hover_1',
					'grid_2_hover_2',
					'grid_2_hover_3',
				)
			)
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Grid', 'norebro-extra' ),
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
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Project items per page', 'norebro-extra' ),
			'param_name' => 'projects_in_block',
			'description' => __( 'Choose a number of projects to be displayed', 'norebro-extra' ),
			'value' => '4',
		),


		// Items
		array(
			'type' => 'norebro_check',
			'group' => __( 'Items', 'norebro-extra' ),
			'heading' => __( 'Offset slider items', 'norebro-extra' ),
			'param_name' => 'offset_items',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_6'
				)
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Items', 'norebro-extra' ),
			'heading' => __( 'How many items to display on desktop', 'norebro-extra' ),
			'param_name' => 'item_desktop',
			'description' => __( 'Default value &mdash; 5 items.', 'norebro-extra' ),
			'value' => '5',
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_6'
				)
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Items', 'norebro-extra' ),
			'heading' => __( 'How many items to display on tablet', 'norebro-extra' ),
			'param_name' => 'item_tablet',
			'value' => '3',
			'description' => __( 'Default value &mdash; 3 items.', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_6'
				)
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Items', 'norebro-extra' ),
			'heading' => __( 'How many items to display on mobile', 'norebro-extra' ),
			'param_name' => 'item_mobile',
			'value' => '1',
			'description' => __( 'Default value &mdash; 1 items.', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_6'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Items', 'norebro-extra' ),
			'heading' => __( 'Loop slider', 'norebro-extra' ),
			'param_name' => 'loop',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_6'
				)
			)
		),

		// Pagination
		array(
			'type' => 'norebro_check',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Enable mouse wheel srolling', 'norebro-extra' ),
			'param_name' => 'mouse_wheel_srolling',
			'value' => array(
				__( 'Enable', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_5',
					'grid_6',
					'grid_7',
                    'grid_8'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Navigation dots', 'norebro-extra' ),
			'param_name' => 'pagination_show',
			'value' => array(
				__( 'Show', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_5',
					'grid_6',
					'grid_7',
					'grid_8'
				)
			)
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Dots type', 'norebro-extra' ),
			'param_name' => 'pagination_slider_type',
			'value' => array(
				__( 'Numbers', 'norebro-extra' ) => 'numbers',
				__( 'Dots', 'norebro-extra' ) => 'dots'
			),
			'std' => 'numbers',
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_5',
					'grid_7',
					'grid_8'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Navigation buttons', 'norebro-extra' ),
			'param_name' => 'navigation_buttons',
			'value' => array(
				__( 'Show', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_5',
					'grid_6',
					'grid_7',
					'grid_8'
				)
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Dots each', 'norebro-extra' ),
			'param_name' => 'dots_each',
			'description' => __( 'Show dots each x item.', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_6'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Hide scroll label?', 'norebro-extra' ),
			'param_name' => 'hide_slider_scroll_label',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_7',
					'grid_8'
				)
			)
		),

		// Slide
		array(
			'type' => 'textfield',
			'group' => __( 'Slide', 'norebro-extra' ),
			'heading' => __( 'Slide by', 'norebro-extra' ),
			'param_name' => 'slide_by',
			'description' => __( 'Navigation slide by x. `page` string can be set to slide by page.', 'norebro-extra' ),
			'value' => '1',
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_6'
				)
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Slide', 'norebro-extra' ),
			'heading' => __( 'Slide speed', 'norebro-extra' ),
			'param_name' => 'slide_speed',
			'description' => __( 'In milliseconds.', 'norebro-extra' ),
			'value' => '500',
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_6'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Slide', 'norebro-extra' ),
			'heading' => __( 'Autoplay', 'norebro-extra' ),
			'param_name' => 'autoplay',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_6'
				)
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Slide', 'norebro-extra' ),
			'heading' => __( 'Autoplay time', 'norebro-extra' ),
			'param_name' => 'autoplay_time',
			'description' => __( 'Autoplay interval timeout in seconds. Default 5 second.', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => '1',
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Slide', 'norebro-extra' ),
			'heading' => __( 'Stop on hover', 'norebro-extra' ),
			'param_name' => 'stop_on_hover',
			'description' => __( 'Stop autoplay on mouse hover.', 'norebro-extra' ),
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => '1',
			)
		),

		// Style
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_card_title',
			'value' => __( 'Card content', 'norebro-extra' ),
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Overlay color', 'norebro-extra' ),
			'param_name' => 'overlay_color',
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_1_hover_1',
					'grid_1_hover_2',
					'grid_1_hover_3',
					'grid_2_hover_2',
					'grid_4',
					'grid_7',
					'grid_8'
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Background color', 'norebro-extra' ),
			'param_name' => 'bg_color',
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_5'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Category outline', 'norebro-extra' ),
			'param_name' => 'category_outline',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Category background color', 'norebro-extra' ),
			'param_name' => 'category_bg_color',
			'dependency' => array(
				'element' => 'category_outline',
				'value' => array(
					'0',
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Category color', 'norebro-extra' ),
			'param_name' => 'category_color',
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
			'heading' => __( 'More color', 'norebro-extra' ),
			'param_name' => 'more_color',
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_1_hover_1',
					'grid_1_hover_2',
					'grid_1_hover_3',
					'grid_2_hover_2',
					'grid_4',
					'grid_5',
					'grid_7',
					'grid_8'
				)
			)
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_slider_title',
			'value' => __( 'Slider', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_5',
					'grid_6',
					'grid_7',
					'grid_8'
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Dots color', 'norebro-extra' ),
			'param_name' => 'dots_color',
			'dependency' => array(
				'element' => 'pagination_show',
				'value' => '1',
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Nav button background color', 'norebro-extra' ),
			'param_name' => 'nav_bg_color',
			'dependency' => array(
				'element' => 'navigation_buttons',
				'value' => '1',
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Nav button color', 'norebro-extra' ),
			'param_name' => 'nav_color',
			'dependency' => array(
				'element' => 'navigation_buttons',
				'value' => '1',
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Scroll description color', 'norebro-extra' ),
			'param_name' => 'scroll_desc_color',
			'dependency' => array(
				'element' => 'card_layout',
				'value' => array(
					'grid_4',
					'grid_5',
					'grid_7',
					'grid_8'
				)
			)
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_grid_title',
			'value' => __( 'Grid', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'use_pagination',
				'value' => '1',
			)
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
			'param_name' => 'style_other_title',
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
