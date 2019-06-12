<?php

	/**
	* Visual Composer Norebro colorpicker type
	*/

	if ( function_exists ( 'vc_add_shortcode_param' ) ) {
		vc_add_shortcode_param( 'norebro_colorpicker', 'norebro_extra_colorpicker_settings_field', plugins_url( 'colorpicker.js' , __FILE__ ) );
	}

	function norebro_extra_colorpicker_settings_field( $settings, $value ) {
		ob_start();
		if( $value == '' && $settings['value'] ) {
			$value = $settings['value'];
		}

		if ( function_exists( 'get_field' ) ) {
			$brand_color = NorebroSettings::get( 'page_brand_color', 'global' );
		} else {
			$brand_color = $GLOBALS['wpdb']->get_results( "SELECT * FROM `wp_options` WHERE `option_name` = 'options_global_page_brand_color'", OBJECT );
			if ( $brand_color && is_array( $brand_color ) ) {
				$brand_color = $brand_color[0]->option_value;
			} else {
				$brand_color = false;
			}
		}
		if ( ! $brand_color ) $brand_color = 'empty';

?>
		<div class="norebro_extra_colorpicker_block">
			<input type="hidden" name="<?php echo NorExtraFilter::string( $settings['param_name'], 'attr', '' ); ?>" class="wpb_vc_param_value" value="<?php echo NorExtraFilter::string( $value, 'attr', '' ); ?>">
			<div class="color left">
				<div class="color-group">
					<input name="colorpicker" class="vc_color-control" type="text" value="<?php echo NorExtraFilter::string( $value, 'attr', '' ); ?>">
				</div>
			</div>
			<div class="brand-color left">
				<label>
					<input type="checkbox" name="brand-color"<?php if ( $value == 'brand' ) { echo 'checked="checked"'; } ?>>
					<?php esc_html_e( 'Brand color', 'norebro-extra' ); ?>
					<div style="display:inline-block;color:#8f8f8f;font-size:12px;">
						<div style="width:12px;height:12px;background:<?php echo ( $brand_color != 'empty' ) ? $brand_color : '#ffffff';?>;border-radius:50%;border:1px solid rgba(0,0,0,.18);display:inline-block;vertical-align:-2px;margin-left:2px;"></div>
						<?php echo $brand_color; ?>
					</div>
				</label>
			</div>
			<div class="clear"></div>
		</div>
<?php

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}