<?php

/**
* Visual Composer Norebro Carousel shortcode params
*/

vc_map( array(
	'name' => __( 'Carousel', 'norebro-extra' ),
	'description' => __( 'Carousel module', 'norebro-extra' ),
	'base' => 'norebro_carousel',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'is_container' => true,
	'show_settings_on_create' => true,
	'as_parent' => array(
		'only' => 'norebro_carousel_inner',
	),
	'js_view' => 'VcNorebroBackendTtaSliderView',
	'custom_markup' => '
		<div class="vc_tta-container" data-vc-action="collapse">
			<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
				<div class="vc_tta-tabs-container">'
					. '<ul class="vc_tta-tabs-list">'
					. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
					. '</ul>
				</div>
				<div class="vc_tta-panels vc_clearfix {{container-class}}">
				  {{ content }}
				</div>
			</div>
		</div>
	',
	'default_content' => '
		[norebro_carousel_inner title="' . sprintf( '%s %d', __( 'Section', 'norebro-extra' ), 1 ) . '"][/norebro_carousel_inner]
		[norebro_carousel_inner title="' . sprintf( '%s %d', __( 'Section', 'norebro-extra' ), 2 ) . '"][/norebro_carousel_inner]
		[norebro_carousel_inner title="' . sprintf( '%s %d', __( 'Section', 'norebro-extra' ), 3 ) . '"][/norebro_carousel_inner]
	',
	'admin_enqueue_js' => array(
		vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ),
	),
	'params' => array(

		// General
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Offset items', 'norebro-extra' ),
			'param_name' => 'offset_items',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '0'
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Offset size', 'norebro-extra' ),
			'param_name' => 'offset_size',
			'value' => '70%',
			'dependency' => array(
				'element' => 'offset_items',
				'value' => array(
					'1'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Loop', 'norebro-extra' ),
			'param_name' => 'loop',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
			'description' => __( 'Infinity loop. Duplicate last and first items to get loop illusion.', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Number of visible items on desktop', 'norebro-extra' ),
			'param_name' => 'item_desktop',
			'description' => __( 'Default, 5 items.', 'norebro-extra' ),
			'value' => '5'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Number of visible items on tablet', 'norebro-extra' ),
			'param_name' => 'item_tablet',
			'description' => __( 'Default, 3 items.', 'norebro-extra' ),
			'value' => '3'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Number of visible items on mobile', 'norebro-extra' ),
			'param_name' => 'item_mobile',
			'description' => __( 'Default, 1 items.', 'norebro-extra' ),
			'value' => '1'
		),

		// Pagination
		array(
			'type' => 'norebro_check',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Bullets', 'norebro-extra' ),
			'param_name' => 'pagination_show',
			'description' => __( 'Show bullets navigation.', 'norebro-extra' ),
			'std' => 'true',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Dots each', 'norebro-extra' ),
			'param_name' => 'dots_each',
			'description' => __( 'Show bullet each <strong>x</strong> item.', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'pagination_show',
				'value' => array(
					'1'
				)
			)
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Buttons', 'norebro-extra' ),
			'param_name' => 'navigation_buttons',
			'std' => 'true',
			'description' => __( 'Show navigation buttons.', 'norebro-extra' ),
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Pagination', 'norebro-extra' ),
			'heading' => __( 'Buttons position', 'norebro-extra' ),
			'param_name' => 'position_nav_buttons',
			'value' => array(
				__( 'Default', 'norebro-extra' ) => 'default',
				__( 'Offset', 'norebro-extra' ) => 'offset',
				__( 'Inset', 'norebro-extra' ) => 'inset',
			),
			'dependency' => array(
				'element' => 'navigation_buttons',
				'value' => array(
					'1'
				)
			)
		),

		// Scroll
		array(
			'type' => 'textfield',
			'group' => __( 'Slide', 'norebro-extra' ),
			'heading' => __( 'Slide by', 'norebro-extra' ),
			'param_name' => 'slide_by',
			'description' => __( 'Navigation slide by x. `page` string can be set to slide by page.', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Slide', 'norebro-extra' ),
			'heading' => __( 'Scroll per page', 'norebro-extra' ),
			'param_name' => 'scroll_per_page',
			'description' => __( 'Scroll per page not per item. This affect next/prev buttons and mouse/touch dragging.', 'norebro-extra' ),
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
		),
		array(
			'type' => 'norebro_check',
			'group' => __( 'Slide', 'norebro-extra' ),
			'heading' => __( 'Autoplay', 'norebro-extra' ),
			'param_name' => 'autoplay',
			'value' => array(
				__( 'Yes', 'norebro-extra' ) => '1'
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Slide', 'norebro-extra' ),
			'heading' => __( 'Autoplay time', 'norebro-extra' ),
			'param_name' => 'autoplay_time',
			'description' => __( 'Autoplay interval timeout in seconds.', 'norebro-extra' ),
			'value' => '5',
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

		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Navigation buttons background color', 'norebro-extra' ),
			'param_name' => 'nav_bg_color',
			'dependency' => array(
				'element' => 'navigation_buttons',
				'value' => '1',
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Navigation buttons color', 'norebro-extra' ),
			'param_name' => 'nav_color',
			'dependency' => array(
				'element' => 'navigation_buttons',
				'value' => '1',
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

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Norebro_Carousel extends WPBakeryShortCode {
		static $filter_added = false;
		protected $controls_css_settings = 'out-tc vc_controls-content-widget';
		protected $controls_list = array( 'edit', 'clone', 'delete' );

		public function __construct( $settings ) {
			parent::__construct( $settings );
			if ( ! self::$filter_added ) {
				$this->addFilter( 'vc_inline_template_content', 'setCustomTabId' );
				self::$filter_added = true;
			}
		}

		public function getTabTemplate() {
			return '<div class="wpb_template">' . do_shortcode( '[vc_tab title="Tab" tab_id=""][/vc_tab]' ) . '</div>';
		}

		public function setCustomTabId( $content ) {
			return preg_replace( '/tab\_id\=\"([^\"]+)\"/', 'tab_id="$1-' . time() . '"', $content );
		}
	}
}
