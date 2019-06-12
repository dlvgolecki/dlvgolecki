<?php

/**
* Visual Composer Norebro Video shortcode view
*/

if ( $layout == 'with_preview' ) : ?>

	<div class="norebro-video-module-sc video-module preview<?php echo $css_class . ' ' . $video_module_class; ?>"
		id="<?php echo esc_attr( $video_module_uniqid ); ?>"
		data-video-module="<?php if( $link ) { echo esc_attr( $link ); } ?>"
		data-video-start="<?php if( $start_time ) { echo esc_attr($start_time); } else { echo '0'; } ?>"
		<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?>
		<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>

		<div class="image-wrap">
			<?php if ( $preview_image ): ?>
				<img src="<?php echo esc_attr( $preview_image ); ?>" alt="">
			<?php endif; ?>
		</div>

		<div class="overlay">
			<div class="content-center">
				<div class="wrap text-center">
					<div class="btn-play<?php echo $button_settings_class; ?>">
						<span class="icon ion-ios-play"></span>
					</div>
					<?php if ( $title ): ?>
						<h4 class="title"><?php echo $title; ?></h4>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php else: ?>

	<div class="text-<?php echo $alignment; ?>">
		<div class="norebro-video-module-sc video-module<?php echo $css_class . ' ' . $video_module_class; ?>"
		id="<?php echo $video_module_uniqid; ?>"
		data-video-module="<?php if ( $link ) { echo esc_url( $link ); } ?>"
		data-video-start="<?php if( $start_time ) { echo esc_attr($start_time); } else { echo '0'; } ?>"
		<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?>
		<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

			<div class="btn-play<?php echo $button_settings_class; ?>">
				<span class="icon ion-ios-play"></span>
			</div>

			<?php if ( $title ) : ?>
				<div class="content-center">
					<div class="wrap">

						<div class="content">
							<h4 class="title text-left">
								<?php echo $title; ?>
							</h4>
						</div>

					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>

<?php endif; ?>
