<?php
/**
 * Gmap - Shortcode Options
 */
add_action( 'init', 'elstn_gmap_vc_map' );
if ( ! function_exists( 'elstn_gmap_vc_map' ) ) {
  function elstn_gmap_vc_map() {
    vc_map( array(
      "name" => __( "Google Map", 'elston-core'),
      "base" => "elstn_gmap",
      "description" => __( "Google Map Styles", 'elston-core'),
      "icon" => "fa fa-map color-cadetblue",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(

        array(
          "type"        => "notice",
          "heading"     => __( "API KEY", 'elston-core' ),
          "param_name"  => 'api_key',
          'class'       => 'cs-info',
          'value'       => '',
        ),
        array(
          "type"        =>'textfield',
          "heading"     =>__('Enter Map ID', 'elston-core'),
          "param_name"  => "gmap_id",
          "value"       => "",
          "description" => __( 'Enter google map ID. If you\'re using this in <strong>Map Tab</strong> shortcode, enter unique ID for each map tabs. Else leave it as blank. <strong>Note : This should same as Tab ID in Map Tabs shortcode.</strong>', 'elston-core'),
          'admin_label' => true,
        ),
        array(
          "type"        =>'textfield',
          "heading"     =>__('Enter your Google Map API Key', 'elston-core'),
          "param_name"  => "gmap_api",
          "value"       => "",
          "description" => __( 'New Google Maps usage policy dictates that everyone using the maps should register for a free API key. <br />Please create a key for "Google Static Maps API" and "Google Maps Embed API" using the <a href="https://console.developers.google.com/project" target="_blank">Google Developers Console</a>.<br /> Or follow this step links : <br /><a href="https://console.developers.google.com/flows/enableapi?apiid=maps_embed_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">1. Step One</a> <br /><a href="https://console.developers.google.com/flows/enableapi?apiid=static_maps_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">2. Step Two</a><br /> If you still receive errors, please check following link : <a href="https://churchthemes.com/2016/07/15/page-didnt-load-google-maps-correctly/" target="_blank">How to Fix?</a>', 'elston-core'),
        ),

        array(
          "type"        => "notice",
          "heading"     => __( "Map Settings", 'elston-core' ),
          "param_name"  => 'map_settings',
          'class'       => 'cs-info',
          'value'       => '',
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Google Map Type', 'elston-core' ),
          'value' => array(
            __( 'Select Type', 'elston-core' ) => '',
            __( 'ROADMAP', 'elston-core' ) => 'ROADMAP',
            __( 'SATELLITE', 'elston-core' ) => 'SATELLITE',
            __( 'HYBRID', 'elston-core' ) => 'HYBRID',
            __( 'TERRAIN', 'elston-core' ) => 'TERRAIN',
          ),
          'admin_label' => true,
          'param_name' => 'gmap_type',
          'description' => __( 'Select your google map type.', 'elston-core' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Google Map Style', 'elston-core' ),
          'value' => array(
            __( 'Select Style', 'elston-core' ) => '',
            __( 'Gray Scale', 'elston-core' ) => "gray-scale",
            __( 'Mid Night', 'elston-core' ) => "mid-night",
            __( 'Blue Water', 'elston-core' ) => 'blue-water',
            __( 'Light Dream', 'elston-core' ) => 'light-dream',
            __( 'Pale Dawn', 'elston-core' ) => 'pale-dawn',
            __( 'Apple Maps-esque', 'elston-core' ) => 'apple-maps',
            __( 'Blue Essence', 'elston-core' ) => 'blue-essence',
            __( 'Unsaturated Browns', 'elston-core' ) => 'unsaturated-browns',
            __( 'Paper', 'elston-core' ) => 'paper',
            __( 'Midnight Commander', 'elston-core' ) => 'midnight-commander',
            __( 'Light Monochrome', 'elston-core' ) => 'light-monochrome',
            __( 'Flat Map', 'elston-core' ) => 'flat-map',
            __( 'Retro', 'elston-core' ) => 'retro',
            __( 'becomeadinosaur', 'elston-core' ) => 'becomeadinosaur',
            __( 'Neutral Blue', 'elston-core' ) => 'neutral-blue',
            __( 'Subtle Grayscale', 'elston-core' ) => 'subtle-grayscale',
            __( 'Ultra Light with Labels', 'elston-core' ) => 'ultra-light-labels',
            __( 'Shades of Grey', 'elston-core' ) => 'shades-grey',
          ),
          'admin_label' => true,
          'param_name' => 'gmap_style',
          'description' => __( 'Select your google map style.', 'elston-core' ),
          'dependency' => array(
            'element' => 'gmap_type',
            'value' => 'ROADMAP',
          ),
        ),
        array(
          "type"        =>'textfield',
          "heading"     =>__('Height', 'elston-core'),
          "param_name"  => "gmap_height",
          "value"       => "",
          "description" => __( "Enter the px value for map height. This will not work if you add this shortcode into the Map Tab shortcode.", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type"        =>'attach_image',
          "heading"     =>__('Common Marker', 'elston-core'),
          "param_name"  => "gmap_common_marker",
          "value"       => "",
          "description" => __( "Upload your custom marker.", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type"        =>'textfield',
          "heading"     =>__('Zoom', 'redel-core'),
          "param_name"  => "gmap_zoom",
          "value"       => "",
          "description" => __( "Enter zoom as numeric value. [Eg : 18]", 'redel-core'),
        ),

        array(
          "type"        => "notice",
          "heading"     => __( "Enable & Disable", 'elston-core' ),
          "param_name"  => 'enb_disb',
          'class'       => 'cs-info',
          'value'       => '',
        ),
        array(
          "type"        =>'switcher',
          "heading"     =>__('Scroll Wheel', 'elston-core'),
          "param_name"  => "gmap_scroll_wheel",
          "value"       => "",
          "std"         => false,
          'edit_field_class'   => 'vc_col-md-4 vc_column vt_field_space',
        ),
        array(
          "type"        =>'switcher',
          "heading"     =>__('Street View Control', 'elston-core'),
          "param_name"  => "gmap_street_view",
          "value"       => "",
          "std"         => false,
          'edit_field_class'   => 'vc_col-md-4 vc_column vt_field_space',
        ),
        array(
          "type"        =>'switcher',
          "heading"     =>__('Map Type Control', 'elston-core'),
          "param_name"  => "gmap_maptype_control",
          "value"       => "",
          "std"         => false,
          'edit_field_class'   => 'vc_col-md-4 vc_column vt_field_space',
        ),

        // Map Markers
        array(
          "type"        => "notice",
          "heading"     => __( "Map Pins", 'elston-core' ),
          "param_name"  => 'map_pins',
          'class'       => 'cs-info',
          'value'       => '',
        ),
        array(
          'type' => 'param_group',
          'value' => '',
          'heading' => __( 'Map Locations', 'elston-core' ),
          'param_name' => 'locations',
          'params' => array(

            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Latitude', 'elston-core' ),
              'param_name' => 'latitude',
              'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
              'admin_label' => true,
              'description' => __( 'Find Latitude : <a href="http://www.latlong.net/" target="_blank">latlong.net</a>', 'elston-core' ),
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Longitude', 'elston-core' ),
              'param_name' => 'longitude',
              'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
              'admin_label' => true,
              'description' => __( 'Find Longitude : <a href="http://www.latlong.net/" target="_blank">latlong.net</a>', 'elston-core' ),
            ),
            array(
              'type' => 'attach_image',
              'value' => '',
              'heading' => __( 'Custom Marker', 'elston-core' ),
              'param_name' => 'custom_marker',
              "description" => __( "Upload your unique map marker if your want to differentiate from others.", 'elston-core'),
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Heading', 'elston-core' ),
              'param_name' => 'location_heading',
              'admin_label' => true,
            ),
            array(
              'type' => 'textarea',
              'value' => '',
              'heading' => __( 'Content', 'elston-core' ),
              'param_name' => 'location_text',
            ),

          )
        ),

        VictorLib::elston_class(),

        // Design Tab
        array(
          "type" => "css_editor",
          "heading" => __( "Text Size", 'elston-core' ),
          "param_name" => "css",
          "group" => __( "Design", 'elston-core'),
        ),

      )
    ) );
  }
}
