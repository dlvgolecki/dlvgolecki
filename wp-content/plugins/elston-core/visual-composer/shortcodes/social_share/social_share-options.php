<?php
/**
 * List - Shortcode Options
 */
add_action( 'init', 'elstn_social_share_vc_map' );
if ( ! function_exists( 'elstn_social_share_vc_map' ) ) {
  function elstn_social_share_vc_map() {
    vc_map( array(
      "name" => __( "Social Share", 'elston-core'),
      "base" => "elstn_social_share",
      "description" => __( "Social Share Icons Area/Block", 'elston-core'),
      "icon" => "fa fa-dribbble color-red",
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
          'type' => 'dropdown',
          'heading' => __( 'Share Alignment', 'elston-core' ),
          'value' => array(
            __( 'Default', 'elston-core' ) => 'share-default',
            __( 'Center', 'elston-core' ) => 'share-center',
            __( 'Left', 'elston-core' ) => 'share-left',
            __( 'Right', 'elston-core' ) => 'share-right',
          ),
          'param_name' => 'share_alignment',
          'default' => 'share-default',
          'description' => __( 'Select Share Alignment.', 'elston-core' ),
        ),
        VictorLib::elston_class(),

      )
    ) );
  }
}
