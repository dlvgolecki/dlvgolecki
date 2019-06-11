<?php
/**
 * Portfolio - Shortcode Options
 */
add_action( 'init', 'elstn_portfolio_vc_map' );
if ( ! function_exists( 'elstn_portfolio_vc_map' ) ) {
  function elstn_portfolio_vc_map() {
    vc_map( array(
      "name" => __( "Portfolio", 'elston-core'),
      "base" => "elstn_portfolio",
      "description" => __( "Portfolio Area/Block", 'elston-core'),
      "icon" => "fa fa-dribbble color-red",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(

        array(
          'type' => 'dropdown',
          'heading' => __( 'Portfolio Style', 'elston-core' ),
          'value' => array(
            __( 'Grid (Default)', 'elston-core' ) => 'grid',
            __( 'Grid With Masonry', 'elston-core' ) => 'masonry',
            __( 'Wide Full Screen', 'elston-core' ) => 'wide',
          ),
          'admin_label' => true,
          'param_name' => 'style',
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'description' => __( 'Select Portfolio Style.', 'elston-core' ),
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Grid Column', 'elston-core' ),
          'value' => array(
            __( 'Select Column', 'elston-core' ) => '',
            __('Two Column', 'elston-core') => 'col-item-2',
            __('Three Column', 'elston-core') => 'col-item-3',
            __('Four Column', 'elston-core') => 'col-item-4',
            __('Five Column', 'elston-core') => 'col-item-5',
          ),
          'admin_label' => true,
          'param_name' => 'blog_col',
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'dependency' => array(
            'element' => 'style',
            'value' => array('grid', 'masonry'),
          ),
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Top Banner Title', 'elston-core'),
          "param_name"  => "banner_title",
          "value"       => "",
          'dependency' => array(
            'element' => 'style',
            'value' => array('wide'),
          ),
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Top Banner Sub Title', 'elston-core'),
          "param_name"  => "banner_subtitle",
          "value"       => "",
          'dependency' => array(
            'element' => 'style',
            'value' => array('wide'),
          ),
        ),

        array(
          "type"        =>'href',
          "heading"     =>__('Banner Link', 'elston-core'),
          "param_name"  => "banner_link",
          "value"       => "",
          'dependency' => array(
            'element' => 'style',
            'value' => array('wide'),
          ),
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Banner Link Text', 'elston-core'),
          "param_name"  => "banner_link_text",
          "value"       => "",
          'dependency' => array(
            'element' => 'style',
            'value' => array('wide'),
          ),
        ),

        array(
          "type"        =>'attach_image',
          "heading"     =>__('Banner Background Image', 'elston-core'),
          "param_name"  => "banner_image",
          "value"       => "",
          'dependency' => array(
            'element' => 'style',
            'value' => array('wide'),
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Order', 'elston-core' ),
          'value' => array(
            __( 'Select Order', 'elston-core' ) => '',
            __('Asending', 'elston-core') => 'ASC',
            __('Desending', 'elston-core') => 'DESC',
          ),
          'param_name' => 'blog_order',
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'dependency' => array(
            'element' => 'style',
            'value' => array('grid', 'masonry'),
          ),
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Order By', 'elston-core' ),
          'value' => array(
            __('None', 'elston-core') => 'none',
            __('ID', 'elston-core') => 'ID',
            __('Author', 'elston-core') => 'author',
            __('Title', 'elston-core') => 'title',
            __('Date', 'elston-core') => 'date',
          ),
          'param_name' => 'blog_orderby',
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'dependency' => array(
            'element' => 'style',
            'value' => array('grid', 'masonry'),
          ),
        ),
        array(
          "type"        => 'textfield',
          "heading"     => __('Show only certain categories?', 'elston-core'),
          "param_name"  => "blog_show_category",
          "value"       => "",
          "description" => __( "Enter category SLUGS (comma separated) you want to display.", 'elston-core'),
          'dependency' => array(
            'element' => 'style',
            'value' => array('grid', 'masonry'),
          ),
        ),

        array(
          "type"        => "elstn_taxonomy",
          "heading"     => __('Select Category To Show Posts In Slider', 'elston-core' ),
          "param_name"  => 'category',
          'value'       => '',
          'description' => __( 'Selected category posts will be shown in full page slider', 'elston-core' ),
          'dependency' => array(
            'element' => 'style',
            'value' => array('wide'),
          ),
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Hover Style', 'elston-core' ),
          'value' => array(
            __( 'Regular', 'elston-core' ) => 'hover',
            __( 'Direction', 'elston-core' ) => 'direction-hover',
            __( 'Direction Inverse', 'elston-core' ) => 'direction-hover-inverse',
            __( 'Expand', 'elston-core' ) => 'expand-hover',
            __( 'Replace', 'elston-core' ) => 'replace-hover',
            __( 'Shifting', 'elston-core' ) => 'shifting-hover',
            __( 'Sweep', 'elston-core' ) => 'sweep-hover',
          ),
          'admin_label' => true,
          'param_name' => 'hover_style',
          'description' => __( 'Select Portfolio Hover Style.', 'elston-core' ),
          'dependency' => array(
            'element' => 'style',
            'value' => array('grid', 'masonry'),
          ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          "type" => "dropdown",
          "heading" => __( "Show Pagination?", 'elston-core' ),
          "param_name" => "pagination",
          'description' => __( 'Enable/Disable Pagination for Portfolio Items.', 'elston-core' ),
          'value' => array(
            __( 'No', 'elston-core' ) => 'no',
            __( 'Yes', 'elston-core' ) => 'yes',
          ),
          'dependency' => array(
            'element' => 'style',
            'value' => array('grid', 'masonry'),
          ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Pagination Style', 'elston-core' ),
          'value' => array(
            __( 'Default', 'elston-core' ) => 'default',
            __( 'Ajax', 'elston-core' ) => 'ajax',
          ),
          'param_name' => 'pagination_type',
          'description' => __( 'Select Portfolio Pagination Style.', 'elston-core' ),
          'dependency' => array(
            'element' => 'pagination',
            'value' => array('yes'),
          ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Show Post', 'elston-core'),
          "param_name"  => "posts_per_page",
          'description' => __( 'Show Max No of Portfolio Items in a Page.', 'elston-core' ),
          "value"       => 12,
          'dependency' => array(
            'element' => 'pagination',
            'value' => array('yes'),
          ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        VictorLib::elston_class(),

      )
    ) );
  }
}
