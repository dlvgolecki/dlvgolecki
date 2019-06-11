<?php
/**
 * Portfolio Image - Shortcode Options
 */
add_action( 'init', 'elstn_portfolio_image_vc_map' );
if ( ! function_exists( 'elstn_portfolio_image_vc_map' ) ) {
  function elstn_portfolio_image_vc_map() {
    vc_map( array(
      "name" => __( "Portfolio Image", 'elston-core'),
      "base" => "elstn_portfolio_image",
      "description" => __( "Portfolio Image Selection", 'elston-core'),
      "icon" => "fa fa-instagram color-red",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(
        array(
          'type' => 'dropdown',
          'heading' => __( 'Portfolio Image', 'elston-core' ),
          'value' => array(
            __( 'Portfolio Image', 'elston-core' ) => 'p_img',
            __( 'Portfolio Gallery Image', 'elston-core' ) => 'p_gal',
            __( 'Portfolio Image No Wrap', 'elston-core' ) => 'p_img_w',
          ),
          'admin_label' => true,
          'param_name' => 'type',
          'description' => __( 'Select Portfolio Details Block Type.', 'elston-core' ),
        ),
        array(
          "type"        =>'textfield',
          "heading"     =>__('Title', 'elston-core'),
          "param_name"  => 'title',
          "value"       => '',
          "admin_label"       => true,
          "description" => __( "Image Title.", "elston-core" ),
          'dependency' => array(
            'element' => 'type',
            'value' => array('p_gal'),
          ),
        ),
        array(
          "type"        =>'attach_image',
          "heading"     =>__('Select Image', 'elston-core'),
          "param_name"  => 'image',
          "value"       => '',
          "description" => __( "Upload HD Image.", "elston-core" ),
        ),

        VictorLib::elston_class(),

      )
    ) );
  }
}
