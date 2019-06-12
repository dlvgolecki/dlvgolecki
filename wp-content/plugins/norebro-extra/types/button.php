<?php

	/**
	* Visual Composer Norebro button custom type
	*/

	if ( function_exists ( 'vc_add_shortcode_param' ) ) {
		vc_add_shortcode_param( 'norebro_button', 'norebro_extra_button_settings_field', plugins_url( 'button.js' , __FILE__ ) );
	}

	function norebro_extra_button_settings_field( $settings, $value ) {
		parse_str( $value, $value_array );
		if ( $value == '' && $settings['value'] ) {
			parse_str( $settings['value'], $value_array );
		}

		$color = ( $value_array['color'] ) ? NorExtraFilter::string( $value_array['color'], 'attr', '' ) : '';
		$hover_color = ( $value_array['hover-color'] ) ? NorExtraFilter::string( $value_array['hover-color'], 'attr', '' ) : '';
		$text_color = ( isset( $value_array['text-color'] ) ) ? NorExtraFilter::string( $value_array['text-color'], 'attr', '' ) : '';
		$text_hover_color = ( isset( $value_array['text-hover-color'] ) ) ? NorExtraFilter::string( $value_array['text-hover-color'], 'attr', '' ) : '';

		ob_start();

?>
		<div class="norebro_extra_button_block">
			<input type="hidden" name="<?php echo NorExtraFilter::string( $settings['param_name'], 'attr', '' ); ?>" class="wpb_vc_param_value" value="<?php echo NorExtraFilter::string( $value, 'attr', '' ); ?>">
			<div class="col-3 type<?php if ( $settings['button_type_disabled'] ) { echo ' disabled" data-disabled="true'; } ?>">
				<label>
					<div class="wpb_element_label"><?php _e( 'Type', 'norebro-extra' ); ?></div>
					<select class="type">
						<option value="default"<?php if ( $value_array['type'] == 'default' ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Default', 'norebro-extra' ); ?></option>
						<option value="outline"<?php if ( $value_array['type'] == 'outline' ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Outline', 'norebro-extra' ); ?></option>
						<option value="flat"<?php if ( $value_array['type'] == 'flat' ) { echo 'selected'; } ?>><?php esc_html_e( 'Flat', 'norebro-extra' ); ?></option>
						<?php if ( ! $settings['button_link_disabled'] ) : ?>
							<option value="arrow_link"<?php if ( $value_array['type'] == 'arrow_link' ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Link', 'norebro-extra' ); ?></option>
						<?php endif; ?>
					</select>
				</label>
			</div>
			<div class="col-3 size<?php if ( $settings['button_size_disabled'] ) { echo ' disabled" data-disabled="true'; } ?>">
				<label>
					<div class="wpb_element_label"><?php esc_html_e( 'Size', 'norebro-extra' ); ?></div>
					<select class="size">
						<option value="default"<?php if ( $value_array['size'] == 'default' ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Default', 'norebro-extra' ); ?></option>
						<option value="small"<?php if ( $value_array['size'] == 'small' ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Small', 'norebro-extra' ); ?></option>
						<option value="large"<?php if ( $value_array['size'] == 'large' ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Large', 'norebro-extra' ); ?></option>
						<option value="huge"<?php if ( $value_array['size'] == 'huge' ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Huge', 'norebro-extra' ); ?></option>
					</select>
				</label>
			</div>
			<div class="col-6">
				<div class="left squared button-checkbox<?php if ( $settings['button_squared_disabled'] ) { echo ' disabled" data-disabled="true'; } ?>">
					<label>
						<input type="checkbox" name="squared"<?php if ( $value_array['squared'] ) { echo 'checked="checked"'; } ?>>
						<?php esc_html_e( 'Squared shape', 'norebro-extra' ); ?>
					</label>
				</div>
				<div class="left fullwidth button-checkbox<?php if ( $settings['button_full_disabled'] ) { echo ' disabled" data-disabled="true'; } ?>">
					<label>
						<input type="checkbox" name="fullwidth"<?php if ( $value_array['fullwidth'] ) { echo 'checked="checked"'; } ?>>
						<?php esc_html_e( 'Full width', 'norebro-extra' ); ?>
					</label>
				</div>
			</div>
			<div class="col-6 button-color">
				<div class="wpb_element_label"><?php esc_html_e( 'Color', 'norebro-extra' ); ?></div>
				<div class="color-group left<?php if ( $color == 'brand' ) { echo ' disabled'; } ?>">
					<input name="color" class="vc_color-control" type="text" value="<?php echo $color; ?>">
				</div>
				<div class="brand-color left">
					<label>
						<input type="checkbox" name="brand-color"<?php if ( $color == 'brand' ) { echo 'checked="checked"'; } ?>>
						<?php esc_html_e( 'Brand color', 'norebro-extra' ); ?>
					</label>
				</div>
			</div>
			<div class="col-6 button-hover-color">
				<div class="wpb_element_label"><?php esc_html_e( 'Hover color', 'norebro-extra' ); ?></div>
				<div class="color-group left<?php if ( $hover_color == 'brand' ) { echo ' disabled'; } ?>">
					<input name="hover-color" class="vc_color-control" type="text" value="<?php echo esc_attr( $hover_color ); ?>">
				</div>
				<div class="brand-color left">
					<label>
						<input type="checkbox" name="brand-hover-color"<?php if ( $hover_color == 'brand' ) { echo 'checked="checked"'; } ?>>
						<?php esc_html_e( 'Brand color', 'norebro-extra' ); ?>
					</label>
				</div>
			</div>
			<div class="col-6 text-color">
				<div class="wpb_element_label"><?php esc_html_e( 'Text color', 'norebro-extra' ); ?></div>
				<div class="color-group left<?php if ( $text_color == 'brand' ) { echo ' disabled'; } ?>">
					<input name="text-color" class="vc_color-control" type="text" value="<?php echo $text_color; ?>">
				</div>
				<div class="brand-color left">
					<label>
						<input type="checkbox" name="brand-text-color"<?php if ( $text_color == 'brand' ) { echo 'checked="checked"'; } ?>>
						<?php esc_html_e( 'Brand color', 'norebro-extra' ); ?>
					</label>
				</div>
			</div>
			<div class="col-6 text-hover-color">
				<div class="wpb_element_label"><?php esc_html_e( 'Text hover color', 'norebro-extra' ); ?></div>
				<div class="color-group left<?php if ( $text_hover_color == 'brand' ) { echo ' disabled'; } ?>">
					<input name="text-hover-color" class="vc_color-control" type="text" value="<?php echo esc_attr( $text_hover_color ); ?>">
				</div>
				<div class="brand-color left">
					<label>
						<input type="checkbox" name="brand-text-hover-color"<?php if ( $text_hover_color == 'brand' ) { echo 'checked="checked"'; } ?>>
						<?php esc_html_e( 'Brand color', 'norebro-extra' ); ?>
					</label>
				</div>
			</div>
		</div>
<?php

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}