<?php

/**
* Visual Composer Norebro Tabs shortcode params
*/

vc_map( array(
	'name' => __( 'Tabs', 'norebro-extra' ),
	'description' => __( 'Tabs module', 'norebro-extra' ),
	'base' => 'norebro_tabs',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'is_container' => true,
	'show_settings_on_create' => true,
	'as_parent' => array(
		'only' => 'norebro_tabs_inner',
	),
	'js_view' => 'VcNorebroBackendTtaTabsView',
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
		[norebro_tabs_inner title="' . sprintf( '%s %d', __( 'Tab', 'norebro-extra' ), 1 ) . '"][/norebro_tabs_inner]
		[norebro_tabs_inner title="' . sprintf( '%s %d', __( 'Tab', 'norebro-extra' ), 2 ) . '"][/norebro_tabs_inner]
	',
	'admin_enqueue_js' => array(
		vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ),
	),
	'params' => array(
		// Styles
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Tabs layout', 'norebro-extra' ),
			'param_name' => 'tabs_type',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_059.svg',
					'key' => 'default',
					'title' => __( 'Default', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_058.svg',
					'key' => 'filled',
					'title' => __( 'Flat', 'norebro-extra' ),
				)
			),
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Tabs type', 'norebro-extra' ),
			'param_name' => 'tabs_layout',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_058.svg',
					'key' => 'ontop',
					'title' => __( 'Horizontal', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_060.svg',
					'key' => 'onleft',
					'title' => __( 'Vertical', 'norebro-extra' ),
				)
			),
			'dependency' => array(
				'element' => 'tabs_type',
				'value' => 'filled'
			)
		),
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Tabs layout', 'norebro-extra' ),
			'param_name' => 'tabs_layout_2',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_059.svg',
					'key' => 'ontop',
					'title' => __( 'Horizontal', 'norebro-extra' ),
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_061.svg',
					'key' => 'onleft',
					'title' => __( 'Vertical', 'norebro-extra' ),
				)
			),
			'dependency' => array(
				'element' => 'tabs_type',
				'value' => 'default'
			)
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Tabs alignment', 'norebro-extra' ),
			'param_name' => 'tabs_alignment',
			'value' => array(
				__( 'Left', 'norebro-extra' ) => 'left',
				__( 'Center', 'norebro-extra' ) => 'center',
				__( 'Right', 'norebro-extra' ) => 'right'
			),
			'dependency' => array(
				'element' => 'tabs_layout_2',
				'value' => 'ontop'
			)
		),

		// Typography
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_tabs_title',
			'value' => __( 'Tabs title', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'tabs_title_typo'
		),

		// Style
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Background color', 'norebro-extra' ),
			'param_name' => 'bg_color',
			'dependency' => array(
				'element' => 'tabs_type',
				'value' => 'filled'
			),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Content color', 'norebro-extra' ),
			'param_name' => 'content_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Tab color', 'norebro-extra' ),
			'param_name' => 'tab_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Active tab color', 'norebro-extra' ),
			'param_name' => 'tab_active_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Tabs border color', 'norebro-extra' ),
			'param_name' => 'tabs_border_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Tabs line color', 'norebro-extra' ),
			'param_name' => 'tabs_line_color',
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
	class WPBakeryShortCode_Norebro_Tabs extends WPBakeryShortCode {
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
