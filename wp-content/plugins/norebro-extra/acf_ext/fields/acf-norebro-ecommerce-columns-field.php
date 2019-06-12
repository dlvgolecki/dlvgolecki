<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

// check if class already exists
if( ! class_exists( 'acf_field_norebro_ecommerce_columns' ) ) :


class acf_field_norebro_ecommerce_columns extends acf_field {

	function __construct( $settings ) {

		$this->name = 'norebro_ecommerce_columns';
		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/
		$this->label = esc_html__( 'Norebro ecommerce columns', 'norebro-extra' );
		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/
		$this->category = 'basic';
		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/
		$this->defaults = array(
			'add_theme_inherited' => true
		);
		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('FIELD_NAME', 'error');
		*/
		
		$this->l10n = array(
			'error'	=> esc_html__( 'Error! Please enter a higher value', 'norebro-extra' ),
		);
		/*
		*  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
		*/
		$this->settings = $settings;

		// ----------------------------------------------------------------------------------------------------

		// do not delete!
    	parent::__construct();
    	
	}



	/*function render_field_settings( $field ) {
		acf_render_field_setting( $field, array(
			'label'			=> __( 'Add "Theme inherited" option?','acf' ),
			'instructions'	=> '',
			'name'			=> 'add_theme_inherited',
			'type'			=> 'true_false',
			'ui'			=> 1,
		));
	}*/
	
	
	function render_field( $field ) {

		/*
		echo '<pre>';
		print_r( $field );
		echo '</pre>';
		*/

		$text = acf_get_sub_array( $field, array('id', 'class', 'name', 'value') );
		$hidden = acf_get_sub_array( $field, array('name', 'value') );
		$uniqid = uniqid( 'norebro-ecommerce-columns' );

		$value = null;

		if ( is_string( $field['value'] ) ) {
			$value = json_decode( $field['value'] );
		}
		elseif ( isset( $field['default_value'] ) ) {
			$value = ( object ) $field['default_value'];
		}
?>

		<div class="norebro-acf-ecommerce-columns-field-content" data-uniqid="<?php echo $uniqid; ?>">

			<!-- Hidden field -->
			<?php acf_hidden_input( $hidden ); ?>

			<div class="col-4 col-large">
				<label for="large"><?php esc_html_e( 'Large devices', 'norebro-extra' ); ?></label>
				<select class="nor-col-large" name="large">
					<?php if ( isset( $field['use_inherit'] ) ) : ?>
					<option value="i"<?php if ( $value->large == 'i' ) { echo ' selected="true"'; } ?>>Theme settings inherited</option>
					<?php endif; ?>
					<option value="1"<?php if ( $value->large == '1' ) { echo ' selected="true"'; } ?>>1 column</option>
					<option value="2"<?php if ( $value->large == '2' ) { echo ' selected="true"'; } ?>>2 columns</option>
					<option value="3"<?php if ( $value->large == '3' ) { echo ' selected="true"'; } ?>>3 columns</option>
					<option value="4"<?php if ( $value->large == '4' ) { echo ' selected="true"'; } ?>>4 columns</option>
					<option value="5"<?php if ( $value->large == '5' ) { echo ' selected="true"'; } ?>>5 columns</option>
					<option value="6"<?php if ( $value->large == '6' ) { echo ' selected="true"'; } ?>>6 columns</option>
					<option value="12"<?php if ( $value->large == '12' ) { echo ' selected="true"'; } ?>>12 columns</option>
				</select>
			</div>
			<div class="col-4 col-medium">
				<label for=""><?php esc_html_e( 'Medium devices', 'norebro-extra' ); ?></label>
				<select class="nor-col-medium" name="medium">
					<?php if ( isset( $field['use_inherit'] ) ) : ?>
					<option value="i"<?php if ( $value->medium == 'i' ) { echo ' selected="true"'; } ?>>Theme settings inherited</option>
					<?php endif; ?>
					<option value="1"<?php if ( $value->medium == '1' ) { echo ' selected="true"'; } ?>>1 column</option>
					<option value="2"<?php if ( $value->medium == '2' ) { echo ' selected="true"'; } ?>>2 columns</option>
					<option value="3"<?php if ( $value->medium == '3' ) { echo ' selected="true"'; } ?>>3 columns</option>
					<option value="4"<?php if ( $value->medium == '4' ) { echo ' selected="true"'; } ?>>4 columns</option>
					<option value="5"<?php if ( $value->medium == '5' ) { echo ' selected="true"'; } ?>>5 columns</option>
					<option value="6"<?php if ( $value->medium == '6' ) { echo ' selected="true"'; } ?>>6 columns</option>
					<option value="12"<?php if ( $value->medium == '12' ) { echo ' selected="true"'; } ?>>12 columns</option>
				</select>
			</div>
			<div class="col-4 col-small">
				<label for=""><?php esc_html_e( 'Small devices', 'norebro-extra' ); ?></label>
				<select class="nor-col-small" name="small">
					<?php if ( isset( $field['use_inherit'] ) ) : ?>
					<option value="i"<?php if ( $value->small == 'i' ) { echo ' selected="true"'; } ?>>Theme settings inherited</option>
					<?php endif; ?>
					<option value="1"<?php if ( $value->small == '1' ) { echo ' selected="true"'; } ?>>1 column</option>
					<option value="2"<?php if ( $value->small == '2' ) { echo ' selected="true"'; } ?>>2 columns</option>
					<option value="3"<?php if ( $value->small == '3' ) { echo ' selected="true"'; } ?>>3 columns</option>
					<option value="4"<?php if ( $value->small == '4' ) { echo ' selected="true"'; } ?>>4 columns</option>
					<option value="5"<?php if ( $value->small == '5' ) { echo ' selected="true"'; } ?>>5 columns</option>
					<option value="6"<?php if ( $value->small == '6' ) { echo ' selected="true"'; } ?>>6 columns</option>
					<option value="12"<?php if ( $value->small == '12' ) { echo ' selected="true"'; } ?>>12 columns</option>
				</select>
			</div>

		</div>

<?php
	}
	

	
	function input_admin_enqueue_scripts() {
		global $wp_scripts, $wp_styles;

		$url = $this->settings['url'];
		$version = $this->settings['version'];

		// wp_register_style( 'acf-input-norebro', "{$url}assets/css/input.css", array( 'acf-input' ), $version );
		wp_enqueue_style( 'acf-input-norebro' );
		
		wp_register_script( 'acf-input-norebro-columns', "{$url}assets/js/input.js", array( 'acf-input' ), $version );
		wp_enqueue_script('acf-input-norebro-columns');

		wp_enqueue_style( 'wp-columns-picker' );
	}
	
	
	
	function load_value( $value, $post_id, $field ) {
		return $value;
	}
}

// initialize
new acf_field_norebro_ecommerce_columns( $this->settings );

// class_exists check
endif;

?>