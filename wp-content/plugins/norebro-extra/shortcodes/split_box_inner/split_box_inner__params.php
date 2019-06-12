<?php

/**
* Visual Composer Norebro Split Box shortcode params
*/

vc_map( array(
	'name' => __( 'Split Box', 'norebro-extra' ),
	'description' => __( 'Split view box', 'norebro-extra' ),
	'base' => 'norebro_split_box_inner',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'js_view' => 'VcNorebroSplitBoxColumnView',
	'show_settings_on_create' => false,
	'as_parent' => array( 
		'only' => 'norebro_split_box_column_inner'
	),
	'as_child' => array( 
		'only' => 'norebro_split_box_column'
	),
	'default_content' => '[norebro_split_box_column_inner][/norebro_split_box_column_inner][norebro_split_box_column_inner][/norebro_split_box_column_inner]',
	'params' => array(
		array(
			'type' => 'textfield',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Custom CSS class', 'norebro-extra' ),
			'param_name' => 'css_class',
			'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'norebro-extra' ),
		),

		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles for Left Block', 'norebro-extra' ),
			'heading' => __( 'Background color', 'norebro-extra' ),
			'param_name' => 'bg_first_color',
		),
		array(
			'type' => 'attach_image',
			'group' => __( 'Styles for Left Block', 'norebro-extra' ),
			'heading' => __( 'Background image', 'norebro-extra' ),
			'param_name' => 'bg_first_image',
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles for Left Block', 'norebro-extra' ),
			'heading' => __( 'Overlay color', 'norebro-extra' ),
			'param_name' => 'bg_first_overlay_color',
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Styles for Left Block', 'norebro-extra' ),
			'heading' => __( 'Background size', 'norebro-extra' ),
			'param_name' => 'bg_first_size',
			'value' => array(
				__( 'Auto', 'norebro-extra' ) => '',
				__( 'Contain', 'norebro-extra' ) => 'contain',
				__( 'Cover', 'norebro-extra' )   => 'cover',
				__( 'auto 100%', 'norebro-extra' )  => 'auto 100%',
				__( '100% auto', 'norebro-extra' )  => '100% auto',
				__( '100% 100%', 'norebro-extra' )  => '100% 100%',
			),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Styles for Left Block', 'norebro-extra' ),
			'heading' => __( 'Background parallax type', 'norebro-extra' ),
			'param_name' => 'bg_first_parallax',
			'value' => array(
				__( 'None', 'norebro-extra' ) => '',
				__( 'Vertical', 'norebro-extra' ) => 'vertical',
				__( 'Horizontal', 'norebro-extra' ) => 'horizontal'
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Styles for Left Block', 'norebro-extra' ),
			'heading' => __( 'Parallax speed', 'norebro-extra' ),
			'param_name' => 'bg_first_parallax_speed',
			'description' => __( 'Parallax speed (default 1.0).', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'bg_first_parallax',
				'value' => array(
					'vertical',
					'horizontal'
				)
			),
		),

		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles for Right Block', 'norebro-extra' ),
			'heading' => __( 'Background color', 'norebro-extra' ),
			'param_name' => 'bg_second_color',
		),
		array(
			'type' => 'attach_image',
			'group' => __( 'Styles for Right Block', 'norebro-extra' ),
			'heading' => __( 'Background image', 'norebro-extra' ),
			'param_name' => 'bg_second_image',
		),
		array(
			'type' => 'colorpicker',
			'group' => __( 'Styles for Right Block', 'norebro-extra' ),
			'heading' => __( 'Overlay color', 'norebro-extra' ),
			'param_name' => 'bg_second_overlay_color',
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Styles for Right Block', 'norebro-extra' ),
			'heading' => __( 'Background size', 'norebro-extra' ),
			'param_name' => 'bg_second_size',
			'value' => array(
				__( 'Auto', 'norebro-extra' ) => '',
				__( 'Contain', 'norebro-extra' ) => 'contain',
				__( 'Cover', 'norebro-extra' )   => 'cover',
				__( 'auto 100%', 'norebro-extra' )  => 'auto 100%',
				__( '100% auto', 'norebro-extra' )  => '100% auto',
				__( '100% 100%', 'norebro-extra' )  => '100% 100%',
			),
		),
		array(
			'type' => 'dropdown',
			'group' => __( 'Styles for Right Block', 'norebro-extra' ),
			'heading' => __( 'Background parallax type', 'norebro-extra' ),
			'param_name' => 'bg_second_parallax',
			'value' => array(
				__( 'None', 'norebro-extra' ) => '',
				__( 'Vertical', 'norebro-extra' ) => 'vertical',
				__( 'Horizontal', 'norebro-extra' )   => 'horizontal'
			),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Styles for Right Block', 'norebro-extra' ),
			'heading' => __( 'Parallax speed', 'norebro-extra' ),
			'param_name' => 'bg_second_parallax_speed',
			'description' => __( 'Parallax speed (default 1.0).', 'norebro-extra' ),
			'dependency' => array(
				'element' => 'bg_second_parallax',
				'value' => array(
					'vertical',
					'horizontal'
				)
			),
		),
	)
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Norebro_Split_Box_Inner extends WPBakeryShortCodesContainer {
		
		public function getColumnControls( $controls = 'full', $extended_css = '' ) {
			$controls_start = '<div class="vc_controls vc_controls-visible controls_column' . ( ! empty( $extended_css ) ? " {$extended_css}" : '' ) . '">';
			$controls_end = '</div>';

			if ( 'bottom-controls' === $extended_css ) {
				$control_title = sprintf( __( 'Append to this %s', 'norebro-extra' ), strtolower( $this->settings( 'name' ) ) );
			} else {
				$control_title = sprintf( __( 'Prepend to this %s', 'norebro-extra' ), strtolower( $this->settings( 'name' ) ) );
			}

			$controls_move = '<a class="vc_control column_move" data-vc-control="move" href="#" title="' . sprintf( __( 'Move this %s', 'norebro-extra' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
			$controls_add = ''; //'<a class="vc_control column_add" data-vc-control="add" href="#" title="' . $control_title . '"><span class="vc_icon"></span></a>';
			$controls_edit = '<a class="vc_control column_edit" data-vc-control="edit" href="#" title="' . sprintf( __( 'Edit this %s', 'norebro-extra' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
			$controls_clone = '<a class="vc_control column_clone" data-vc-control="clone" href="#" title="' . sprintf( __( 'Clone this %s', 'norebro-extra' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
			$controls_delete = '<a class="vc_control column_delete" data-vc-control="delete" href="#" title="' . sprintf( __( 'Delete this %s', 'norebro-extra' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
			$controls_full = $controls_move . $controls_add . $controls_edit . $controls_clone . $controls_delete;

			$editAccess = vc_user_access_check_shortcode_edit( $this->shortcode );
			$allAccess = vc_user_access_check_shortcode_all( $this->shortcode );

			if ( ! empty( $controls ) ) {
				if ( is_string( $controls ) ) {
					$controls = array( $controls );
				}
				$controls_string = $controls_start;
				foreach ( $controls as $control ) {
					$control_var = 'controls_' . $control;
					if ( ( $editAccess && 'edit' == $control ) || $allAccess ) {
						if ( isset( ${$control_var} ) ) {
							$controls_string .= ${$control_var};
						}
					}
				}

				return $controls_string . $controls_end;
			}

			if ( $allAccess ) {
				return $controls_start . $controls_full . $controls_end;
			} elseif ( $editAccess ) {
				return $controls_start . $controls_edit . $controls_end;
			}

			return $controls_start . $controls_end;
		}


	}
}