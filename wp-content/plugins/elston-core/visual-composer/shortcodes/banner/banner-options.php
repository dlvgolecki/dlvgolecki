<?php
/**
 * Banner - Shortcode Options
 */
add_action( 'init', 'elstn_banner_vc_map' );
if ( ! function_exists( 'elstn_banner_vc_map' ) ) {
  function elstn_banner_vc_map() {
    vc_map( array(
      "name" => __( "Banner", 'elston-core'),
      "base" => "elstn_banner",
      "description" => __( "Banner Area/Block", 'elston-core'),
      "icon" => "fa fa-file-o color-blue",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(

        array(
          'type' => 'dropdown',
          'heading' => __( 'Banner Block Type', 'elston-core' ),
          'value' => array(
            __( 'Select Style', 'elston-core' ) => '',
            __( 'Fixed', 'elston-core' ) => 'fixed',
            __( 'Parallax', 'elston-core' ) => 'parallax',
          ),
          'admin_label' => true,
          'param_name' => 'type',
          'description' => __( 'Select banner block style type .', 'elston-core' ),
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Parallax Style', 'elston-core' ),
          'value' => array(
            __( 'Select Parallax Style', 'elston-core' ) => '',
            __( 'Text', 'elston-core' ) => 'text',
            __( 'Section', 'elston-core' ) => 'section',
          ),
          'param_name' => 'parallax_type',
          'description' => __( 'Select parallax style type .', 'elston-core' ),
          'dependency' => array(
            'element' => 'type',
            'value' => array('parallax'),
          ),
        ),

        array(
          "type"        => "textarea_html",
          "param_name"  => 'content',
          "value"       => '',
          "description" => __( "Description.", "elston-core" )
        ),

        VictorLib::elston_class(),

        // Styling
        array(
          "type" => "colorpicker",
          "heading" => __( "Text Color", 'elston-core' ),
          "param_name" => "text_color",
          'value' => '',
          "group" => __( "Styling", 'elston-core'),
        ),
      )
    ) );
  }
}
