<?php

/**
* Visual Composer Norebro Google Maps shortcode view
*/

?>
<div class="norebro-google-maps-sc google-maps" id="<?php echo esc_attr( $google_maps_uniqid ); ?>" 
data-google-map="true" data-google-map-zoom="<?php echo esc_attr( $map_zoom ); ?>"
<?php if($map_zoom_enable) { ?> data-google-map-zoom-enable="true"<?php } ?>
<?php if($map_street_enable) { ?> data-google-map-steet-enable="true"<?php } ?>
<?php if($map_type_enable) { ?> data-google-map-type-enable="true"<?php } ?>
<?php if($map_fullscreen_enable) { ?> data-google-map-fullscreen-enable="true"<?php } ?>
data-google-map-marker="<?php echo esc_attr( $map_marker ); ?>"
<?php if ( $map_style == 'custom' ) : ?>
data-google-map-custom-style="<?php echo esc_attr( json_encode( json_decode( $custom_map_style ) ) ); ?>"
<?php else: ?>
data-google-map-style="<?php echo esc_attr( $map_style ); ?>"
<?php endif; ?>>
	
	<div class="google-maps-wrap"></div>
	<div class="hidden" data-google-map-markers="true"><?php echo esc_attr( $marker_locations ); ?></div>

</div>