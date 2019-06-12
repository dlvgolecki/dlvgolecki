<?php

/**
* Visual Composer Norebro Gallery shortcode params
*/



vc_map( array(
	'name' => __( 'Gallery', 'norebro-extra' ),
	'description' => __( 'Simple lightbox gallery module', 'norebro-extra' ),
	'base' => 'norebro_gallery',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'params' => array(
		// General
		array(
			'type' => 'attach_images',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Gallery images', 'norebro-extra' ),
			'param_name' => 'content_images',
			'description' => __( 'First image will be main. Set title and caption in WordPress media.', 'norebro-extra' ),
		),
		array(
		  'type' => 'dropdown',
		  'group' => __( 'General', 'norebro-extra' ),
		  'heading' => __( 'Images size', 'norebro-extra' ),
		  'param_name' => 'images_size',
		  'value' => array( 'Thumbnail', 'Medium', 'Large', 'Original' ),
		  "description" => __( "Choose gallery images size" )
	  	),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Hide overlay?', 'norebro-extra' ),
			'param_name' => 'hide_overlay',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Show title on preview', 'norebro-extra' ),
			'param_name' => 'show_title',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
			'dependency' => array(
				'element' => 'hide_overlay',
				'value' => array(
					'0'
				)
			)
		),

		// Grid
		array(
			'type' => 'norebro_check',
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Masonry grid', 'norebro-extra' ),
			'param_name' => 'masonry_grid',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Metro style', 'norebro-extra' ),
			'param_name' => 'metro_style',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			)
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Gap between images', 'norebro-extra' ),
			'param_name' => 'gap',
			'std' => '15px',
			'description' => __( 'CSS value.', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_columns',
			'group' => __( 'Grid', 'norebro-extra' ),
			'heading' => __( 'Columns', 'norebro-extra' ),
			'param_name' => 'columns',
			'std' => '4-3-2-1'
		),

		// Pagination
		array(
			'type' => 'norebro_check',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Use pagination', 'norebro-extra' ),
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
			'heading' => __( 'Number of items per page', 'norebro-extra' ),
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
			'param_name' => 'style_tab_divider_grid',
			'value' => __( 'Grid', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Overlay color', 'norebro-extra' ),
			'param_name' => 'overlay_color',
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
			'heading' => __( 'Icon color', 'norebro-extra' ),
			'param_name' => 'icon_color',
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
			'param_name' => 'style_tab_divider_gallery',
			'value' => __( 'Gallery', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Background color', 'norebro-extra' ),
			'param_name' => 'gallery_bg_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Image title color', 'norebro-extra' ),
			'param_name' => 'gallery_title_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Image subtitle color', 'norebro-extra' ),
			'param_name' => 'gallery_subtitle_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Buttons color', 'norebro-extra' ),
			'param_name' => 'gallery_buttons_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Slider navigation buttons background color', 'norebro-extra' ),
			'param_name' => 'slider_nav_bg_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Slider navigation buttons color', 'norebro-extra' ),
			'param_name' => 'slider_nav_color',
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
