<?php
/**
 * Service Info - Shortcode Options
 */
add_action( 'init', 'elstn_service_info_vc_map' );
if ( ! function_exists( 'elstn_service_info_vc_map' ) ) {
  function elstn_service_info_vc_map() {
    vc_map( array(
      "name" => __( "Service Info", 'elston-core'),
      "base" => "elstn_service_info",
      "description" => __( "Service Info for service grid area", 'elston-core'),
      "icon" => "fa fa-check-circle color-orange",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(
        array(
          "type"        =>'textfield',
          "heading"     =>__('Title', 'elston-core'),
          "param_name"  => 'title',
          "value"       => '',
          "admin_label"       => true,
          "description" => __( "Service Title.", "elston-core" )
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Select Style', 'elston-core' ),
          'value' => array(
            __( 'Select Style', 'elston-core' ) => '',
            __( 'Single', 'elston-core' ) => 'single',
            __( 'Group', 'elston-core' ) => 'group',
          ),
          'admin_label' => true,
          'param_name' => 'type',
          'description' => __( 'Select banner block style type .', 'elston-core' ),
        ),
        array(
          "type" => "vt_icon",
          "heading" => __( "Select Icon", 'elston-core' ),
          "param_name" => "icon",
          'value' => '',
          "description" => __( "Select icon if you want.", 'elston-core'),
        ),
        array(
          "type"        =>'textarea_html',
          "heading"     =>__('Description', 'elston-core'),
          "param_name"  => 'content',
          "value"       => '',
          "description" => __( "Details About the Service.", "elston-core" )
        ),
        VictorLib::elston_class(),

      )
    ) );
  }
}
