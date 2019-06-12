<?php

/**
* Visual Composer Norebro Split Screen shortcode params
*/

vc_map( array(
	'name' => __( 'Split Screen', 'norebro-extra' ),
	'description' => __( 'Split view in screens', 'norebro-extra' ),
	'base' => 'norebro_split_screen',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'js_view' => 'VcNorebroSplitScreenView',
	'show_settings_on_create' => false,
	'as_parent' => array( 
		'only' => array( 
			'norebro_split_screen_column_left',
			'norebro_split_screen_column_right'
		)
	),
	'as_child' => array( 
		'only' => 'norebro_split_screens'
	),
	'default_content' => '[norebro_split_screen_column_left][/norebro_split_screen_column_left][norebro_split_screen_column_right][/norebro_split_screen_column_right]'
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

	class WPBakeryShortCode_Norebro_Split_Screen extends WPBakeryShortCodesContainer {
		
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
			$controls_edit = ''; //'<a class="vc_control column_edit" data-vc-control="edit" href="#" title="' . sprintf( __( 'Edit this %s', 'norebro-extra' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
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