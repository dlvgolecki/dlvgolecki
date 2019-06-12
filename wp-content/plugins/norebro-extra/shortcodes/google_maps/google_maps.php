<?php 

/**
* Visual Composer Norebro Google Maps shortcode
*/

add_shortcode( 'norebro_google_maps', 'norebro_google_maps_func' );

function norebro_google_maps_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	$default_map_marker = plugin_dir_url( __FILE__ ) . 'images/google-maps-marker.png';

	// Default values, parsing and filtering
	$marker_locations = isset( $marker_locations ) ? NorExtraFilter::string( $marker_locations, 'string', '') : '';
	$map_height = isset( $map_height ) ? NorExtraFilter::string( $map_height, 'string', '') : '';
	$map_zoom = isset( $map_zoom ) ? NorExtraFilter::string( $map_zoom, 'string', '14') : '14';

    $map_zoom_enable = isset( $map_zoom_enable ) ? NorExtraFilter::boolean( $map_zoom_enable ) : false;
    $map_street_enable = isset( $map_street_view_enable ) ? NorExtraFilter::boolean( $map_street_view_enable ) : false;
    $map_type_enable = isset( $map_type_enable ) ? NorExtraFilter::boolean( $map_type_enable ) : false;
    $map_fullscreen_enable = isset( $map_fullscreen_enable ) ? NorExtraFilter::boolean( $map_fullscreen_enable ) : false;


	$map_style = isset( $map_style ) ? NorExtraFilter::string( $map_style, 'string', 'default') : 'default';
	$custom_map_style = isset( $custom_map_style ) ? rawurldecode( base64_decode( $custom_map_style ) ) : '';

	if ( isset( $map_marker ) ) {
		$map_marker = NorExtraFilter::string( $map_marker, 'string', $default_map_marker );
		$map_marker = wp_get_attachment_image_src( $map_marker );
		$map_marker = $map_marker[0];
	} else {
		$map_marker = $default_map_marker;
	}

	// Styling
	$google_maps_uniqid = uniqid( 'norebro-custom-' );

    NorebroHelper::add_required_script( 'google-maps' );

    $GLOBALS['stockie_use_map'] = true;

	$map_uniqid = uniqid();

	// Assembling
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'google_maps__style.php' );
	include( plugin_dir_path( __FILE__ ) . 'google_maps__view.php' );
	return ob_get_clean();
}