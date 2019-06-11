<?php
/**
 * Visual Composer Related Functions
 */

// Init Visual Composer
function elstn_init_vc_shortcodes() {
  if ( defined( 'WPB_VC_VERSION' ) ) {

    /* Visual Composer - Setup */
    require_once( ELSTN_SHORTCODE_BASE_PATH . '/lib/lib.php' );
    require_once( ELSTN_SHORTCODE_BASE_PATH . '/lib/add-params.php' );
    require_once( ELSTN_SHORTCODE_BASE_PATH . '/pre_pages/pre-pages.php' );

    /* All Shortcodes */
    if (class_exists('WPBakeryVisualComposerAbstract')) {

      // Templates
      $dir = ELSTN_SHORTCODE_BASE_PATH . '/vc_templates';
      vc_set_shortcodes_templates_dir( $dir );

      /* Set VC editor as default in following post types */
      $list = array(
        'post',
        'page',
        'portfolio',
      );
      vc_set_default_editor_post_types( $list );

    } // class_exists

    // Add New Param - VC_Column
    $vc_column_attr = array(
      array(
        'type' => 'dropdown',
        'value' => array(
          __( 'Default', 'elston-core' ) => 'text-default',
          __( 'Text Left', 'elston-core' ) => 'text-left',
          __( 'Text Right', 'elston-core' ) => 'text-right',
          __( 'Text Center', 'elston-core' ) => 'text-center',
        ),
        'heading' => __( 'Text Alignment', 'elston-core' ),
        'param_name' => 'text_alignment',
      ),
    );
    vc_add_params( 'vc_column', $vc_column_attr );

  }
}

add_action( 'vc_before_init', 'elstn_init_vc_shortcodes' );

/* Remove VC Teaser metabox */
if ( is_admin() ) {
  if ( ! function_exists('elston_framework_remove_vc_boxes') ) {
    function elston_framework_remove_vc_boxes(){
      $post_types = get_post_types( '', 'names' );
      foreach ( $post_types as $post_type ) {
        remove_meta_box('vc_teaser',  $post_type, 'side');
      }
    } // End function
  } // End if
add_action('do_meta_boxes', 'elston_framework_remove_vc_boxes');
}
