<?php

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

// check if class already exists
if ( ! class_exists( 'acf_plugin_norebro' ) ) :


class acf_plugin_norebro {
	
	function __construct() {
		$this->settings = array(
			'version' => '1.0.0',
			'url' => plugin_dir_url( __FILE__ ),
			'path' => plugin_dir_path( __FILE__ )
		);

		add_action( 'acf/include_field_types', 	array( $this, 'include_field_types' ) );
	}

	function include_field_types( $version = false ) {
		include_once( 'fields/acf-norebro-typo-field.php' );
		include_once( 'fields/acf-norebro-sizes-field.php' );
		include_once( 'fields/acf-norebro-color-field.php' );
		include_once( 'fields/acf-norebro-columns-field.php' );
		include_once( 'fields/acf-norebro-ecommerce-columns-field.php' );
		include_once( 'fields/acf-norebro-responsive-height-field.php' );
		include_once( 'fields/acf-norebro-code-field.php' );
		include_once( 'fields/acf-norebro-image-option-field.php' );
		include_once( 'fields/acf-norebro-menu-field.php' );
		include_once( 'fields/acf-norebro-page-menu-field.php' );
	}

}

// initialize
new acf_plugin_norebro();

endif;
	
?>