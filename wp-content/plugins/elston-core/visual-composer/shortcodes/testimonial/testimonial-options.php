<?php
/**
 * Testimonial - Shortcode Options
 */
add_action( 'init', 'elstn_testimonial_vc_map' );
if ( ! function_exists( 'elstn_testimonial_vc_map' ) ) {
  function elstn_testimonial_vc_map() {
    vc_map( array(
      "name" => __( "Testimonial", 'elston-core'),
      "base" => "elstn_testimonial",
      "description" => __( "Testimonial Slider", 'elston-core'),
      "icon" => "fa fa-mouse-pointer color-orange",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(
        array(
          "type" => "textfield",
          "heading" => __( "How Much Testimonial will show?", 'elston-core' ),
          "param_name" => "item",
          'value' => '',
          'admin_label' => true,
          "description" => __( "Enter number only.", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Order', 'elston-core' ),
          'value' => array(
            __( 'Select Order', 'elston-core' ) => '',
            __('Asending', 'elston-core') => 'ASC',
            __('Desending', 'elston-core') => 'DESC',
          ),
          'param_name' => 'testi_order',
          'admin_label' => true,

          "description" => __( "Select Order", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Order By', 'elston-core' ),
          'value' => array(
            __('None', 'elston-core') => 'none',
            __('ID', 'elston-core') => 'ID',
            __('Title', 'elston-core') => 'title',
            __('Date', 'elston-core') => 'date',
          ),
          'param_name' => 'testi_orderby',
          'admin_label' => true,
          "description" => __( "Select Order By", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Show Member by ID?', 'elston-core'),
          "param_name"  => "testi_ids",
          "value"       => '',
          'admin_label' => true,
          "description" => __( "Enter comma seperated team member ID to show in a page. Ex: 1,3,5,6", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        VictorLib::elston_class(),

      )
    ) );
  }
}
