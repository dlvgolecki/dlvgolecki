<?php
/**
 * Target Info - Shortcode Options
 */
add_action( 'init', 'elstn_target_info_vc_map' );
if ( ! function_exists( 'elstn_target_info_vc_map' ) ) {
  function elstn_target_info_vc_map() {
    vc_map( array(
      "name" => __( "Target Info", 'elston-core'),
      "base" => "elstn_target_info",
      "description" => __( "Target Info for Portfolio", 'elston-core'),
      "icon" => "fa fa-envelope color-blue",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(
        array(
          "type"        =>'textfield',
          "heading"     =>__('Title', 'elston-core'),
          "param_name"  => 'title',
          "value"       => '',
          "admin_label"       => true,
          "description" => __( "Social Share Title.", "elston-core" )
        ),
        array(
          "type"        =>'textarea_html',
          "heading"     =>__('Description', 'elston-core'),
          "param_name"  => 'content',
          "value"       => '',
          "admin_label"       => true,
          "description" => __( "Details About the Item.", "elston-core" )
        ),
        VictorLib::elston_class(),

      )
    ) );
  }
}
