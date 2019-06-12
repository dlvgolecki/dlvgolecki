<div class="norebro-recent-projects-sc norebro-onepage <?php echo $onepage_class . $css_class; ?>" 
	data-norebro-onepage="<?php echo $recent_projects_uniqid; ?>" 
	data-options='<?php echo $onepage_json; ?>' 
	id="<?php echo $recent_projects_uniqid; ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

	<div class="onepage-stage">
		<?php foreach ( $projects_data as $project_index => $_project_object ) : ?>
		<?php
            $_project_object->image_size = $portfolio_images_size;
			$norebro_project = NorExtraParser::project_object( $_project_object );
			$norebro_project['in_popup'] = $open_in_popup;
			$norebro_project['popup_navigation'] = $popup_show_nav_buttons;
			$norebro_project['popup_mouse_scrolling'] = $popup_mouse_scrolling;
			$norebro_project['popup_autoplay'] = $popup_autoplay;
			$norebro_project['popup_autoplay_time'] = $popup_autoplay_time;
			$norebro_project['hide_view_link_in_popup'] = $hide_view_link_in_popup; 
			NorebroHelper::set_storage_item_data( $norebro_project );
			echo '<section class="onepage-section portfolio-item-wrap">';
			
			switch ( $card_layout ) {
				case 'grid_7':
					include( locate_template( 'parts/portfolio-cards/grid_7.php' ) );
					break;
				case 'grid_8':
					include( locate_template( 'parts/portfolio-cards/grid_8.php' ) );
					break;
			}

			echo '</section>';

			if ( $open_in_popup ) {
				ob_start();
				NorebroHelper::set_storage_item_data( $norebro_project );
				include( locate_template( 'parts/portfolio-cards/_popup.php' ) );
				NorebroLayout::append_to_footer_buffer_content( ob_get_clean() );
			}
		?>
		<?php endforeach; ?>
	</div>
	<div class="scroll font-titles<?php echo $scroll_desc_class; ?>">
		<?php esc_html_e( 'Scroll', 'norebro-extra' ) ?>
	</div>
	
</div>