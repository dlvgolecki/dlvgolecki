<?php
/**
 * Title Block - Shortcode Options
 */
add_action( 'init', 'elstn_title_block_vc_map' );
if ( ! function_exists( 'elstn_title_block_vc_map' ) ) {
  function elstn_title_block_vc_map() {
    vc_map( array(
      "name" => __( "Title Block", 'elston-core'),
      "base" => "elstn_title_block",
      "description" => __( "Title Block Area", 'elston-core'),
      "icon" => "fa fa-align-center color-blue",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(
        array(
          "type"        =>'textfield',
          "heading"     =>__('Title', 'elston-core'),
          "param_name"  => 'title',
          "value"       => '',
          "admin_label"       => true,
          "description" => __( "Text Block Title.", "elston-core" )
        ),
        array(
          "type"        =>'textarea_html',
          "heading"     =>__('Short Description', 'elston-core'),
          "param_name"  => 'content',
          "value"       => '',
          "admin_label"       => true,
          "description" => __( "Text Block Short Description.", "elston-core" )
        ),

        VictorLib::elston_class(),

      )
    ) );
  }
}
