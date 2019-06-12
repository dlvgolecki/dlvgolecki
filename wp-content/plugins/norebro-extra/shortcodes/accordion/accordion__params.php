<?php

/**
* Visual Composer Norebro Accordion shortcode params
*/

vc_map( array(
	'name' => __( 'Accordion', 'norebro-extra' ),
	'description' => __( 'Collapsible accordion', 'norebro-extra' ),
	'base' => 'norebro_accordion',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'is_container' => true,
	'show_settings_on_create' => false,
	'as_parent' => array(
		'only' => 'norebro_accordion_inner',
	),
	'js_view' => 'VcNorebroBackendTtaAccordionView',
	'custom_markup' => '
		<div class="vc_tta-container" data-vc-action="collapseAll">
			<div class="vc_general vc_tta vc_tta-accordion vc_tta-color-backend-accordion-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-o-shape-group vc_tta-controls-align-left vc_tta-gap-2">
			   <div class="vc_tta-panels vc_clearfix {{container-class}}">
			      <div class="vc_tta-panel vc_tta-section-append">
			         <div class="vc_tta-panel-heading">
			            <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left">
			               <a href="javascript:;" aria-expanded="false" class="vc_tta-backend-add-control">
			                   <span class="vc_tta-title-text">' . esc_html__( 'Add Section', 'norebro-extra' ) . '</span>
			                    <i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
							</a>
			            </h4>
			         </div>
			      </div>
			   </div>
			</div>
		</div>
	',
	'default_content' => '[norebro_accordion_inner title="' . sprintf( '%s %d', esc_html__( 'Section', 'norebro-extra' ), 1 ) . '"][/norebro_accordion_inner][norebro_accordion_inner title="' . sprintf( '%s %d', esc_html__( 'Section', 'norebro-extra' ), 2 ) . '"][/norebro_accordion_inner]',
	'params' => array(
		// Styles
		array(
			'type' => 'norebro_choose_box',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Accordion layout', 'norebro-extra' ),
			'param_name' => 'accordion_tabs_type',
			'value' => array(
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_021.svg',
					'key' => 'default',
					'title' => __( 'Flat', 'norebro-extra' )
				),
				array(
					'icon' => plugin_dir_url( __FILE__ ) . 'images/wpb_params_022.svg',
					'key' => 'outline',
					'title' => __( 'Outline', 'norebro-extra' )
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Tabs background color', 'norebro-extra' ),
			'param_name' => 'tab_bg_color',
			'dependency' => array(
				'element' => 'accordion_tabs_type',
				'value' => array(
					'default'
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Tabs border color', 'norebro-extra' ),
			'param_name' => 'tab_border_color',
			'dependency' => array(
				'element' => 'accordion_tabs_type',
				'value' => array(
					'outline'
				)
			)
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Tabs title color', 'norebro-extra' ),
			'param_name' => 'tab_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Tabs color on active', 'norebro-extra' ),
			'param_name' => 'active_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Tabs content color', 'norebro-extra' ),
			'param_name' => 'tab_content_color',
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
	class WPBakeryShortCode_Norebro_Accordion extends WPBakeryShortCode {
		protected $controls_css_settings = 'out-tc vc_controls-content-widget';

		public function __construct( $settings ) {
			parent::__construct( $settings );
		}

		public function contentAdmin( $atts, $content = null ) {
			$width = $custom_markup = '';
			$shortcode_attributes = array( 'width' => '1/1' );
			foreach ( $this->settings['params'] as $param ) {
				if ( 'content' !== $param['param_name'] ) {
					$shortcode_attributes[ $param['param_name'] ] = isset( $param['value'] ) ? $param['value'] : null;
				} elseif ( 'content' === $param['param_name'] && null === $content ) {
					$content = $param['value'];
				}
			}
			extract( shortcode_atts( $shortcode_attributes, $atts ) );

			$elem = $this->getElementHolder( $width );

			$inner = '';
			foreach ( $this->settings['params'] as $param ) {
				$param_value = isset( ${$param['param_name']} ) ? ${$param['param_name']} : '';
				if ( is_array( $param_value ) ) {
					// Get first element from the array
					reset( $param_value );
					$first_key = key( $param_value );
					$param_value = $param_value[ $first_key ];
				}
				$inner .= $this->singleParamHtmlHolder( $param, $param_value );
			}

			$tmp = '';

			if ( isset( $this->settings['custom_markup'] ) && '' !== $this->settings['custom_markup'] ) {
				if ( '' !== $content ) {
					$custom_markup = str_ireplace( '%content%', $tmp . $content, $this->settings['custom_markup'] );
				} elseif ( '' === $content && isset( $this->settings['default_content_in_template'] ) && '' !== $this->settings['default_content_in_template'] ) {
					$custom_markup = str_ireplace( '%content%', $this->settings['default_content_in_template'], $this->settings['custom_markup'] );
				} else {
					$custom_markup = str_ireplace( '%content%', '', $this->settings['custom_markup'] );
				}
				$inner .= do_shortcode( $custom_markup );
			}
			$output = str_ireplace( '%wpb_element_content%', $inner, $elem );

			return $output;
		}
	}
}