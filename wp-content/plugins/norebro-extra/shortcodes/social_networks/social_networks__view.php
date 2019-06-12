<?php

/**
* Visual Composer Norebro Social Networks shortcode view
*/

?>
<div class="norebro-socialbar-sc socialbar <?php echo $socialbar_class . $css_class; ?>" 
	id="<?php echo esc_attr( $social_bar_uniqid ); ?>" 
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . $appearance_duration . '"'; } ?>>

	<?php if ( $twitter_link ) : ?>
		<a href="<?php echo $twitter_link; ?>" target="_blank" class="twitter<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-twitter"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Twitter', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $facebook_link ) : ?>
		<a href="<?php echo $facebook_link; ?>" target="_blank" class="facebook<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-facebook"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Facebook', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $instagram_link ) : ?>
		<a href="<?php echo $instagram_link; ?>" target="_blank" class="instagram<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-instagram"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Instagram', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $googleplus_link ) : ?>
		<a href="<?php echo $googleplus_link; ?>" target="_blank" class="googleplus<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-google"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Google+', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $dribbble_link ) : ?>
		<a href="<?php echo $dribbble_link; ?>" class="dribbble<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-dribbble"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Dribbble', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $linkedin_link ) : ?>
		<a href="<?php echo $linkedin_link; ?>" target="_blank" class="linkedin<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-linkedin"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'LinkedIn', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $pinterest_link ) : ?>
		<a href="<?php echo $pinterest_link; ?>" class="pinterest<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-pinterest-p"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Pinterest', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $github_link ) : ?>
		<a href="<?php echo $github_link; ?>" class="github<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-github"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'GitHub', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $dropbox_link ) : ?>
		<a href="<?php echo $dropbox_link; ?>" class="dropbox<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-dropbox"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Dropbox', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $vk_link ) : ?>
		<a href="<?php echo $vk_link; ?>" class="vk<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-vk"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Vkontakte', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $youtube_link ) : ?>
		<a href="<?php echo $youtube_link; ?>" class="youtube<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-youtube"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Youtube', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $vimeo_link ) : ?>
		<a href="<?php echo $vimeo_link; ?>" class="vimeo<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-vimeo"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Vimeo', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $behance_link ) : ?>
		<a href="<?php echo $behance_link; ?>" class="behance<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-behance"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Behance', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $tumblr_link ) : ?>
		<a href="<?php echo $tumblr_link; ?>" class="tumblr<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-tumblr"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Tumblr', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $flickr_link ) : ?>
		<a href="<?php echo $flickr_link; ?>" class="flickr<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-flickr"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Flickr', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $reddit_link ) : ?>
		<a href="<?php echo $reddit_link; ?>" class="reddit<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-reddit-alien"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Reddit', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $snapchat_link ) : ?>
		<a href="<?php echo $snapchat_link; ?>" class="snapchat<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-snapchat-ghost"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Snapchat', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $whatsapp_link ) : ?>
		<a href="<?php echo $whatsapp_link; ?>" class="whatsapp<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-whatsapp"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'WhatsApp', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $quora_link ) : ?>
		<a href="<?php echo $quora_link; ?>" class="quora<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-quora"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Quora', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $vine_link ) : ?>
		<a href="<?php echo $vine_link; ?>" class="vine<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-vine"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Vine', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $digg_link ) : ?>
		<a href="<?php echo $digg_link; ?>" class="digg<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-digg"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Digg', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $foursquare_link ) : ?>
		<a href="<?php echo $foursquare_link; ?>" class="foursquare<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-foursquare"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'Foursquare', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

	<?php if ( $tripadvisor_link ) : ?>
		<a href="<?php echo $tripadvisor_link; ?>" class="foursquare<?php echo $link_class; ?>">
			<?php if ( $show_icon ) : ?>
			<span class="icon fa fa-tripadvisor"></span>
			<?php endif; ?>
			<?php if ( $show_text ) : ?>
			<span class="social-text"><?php esc_html_e( 'TripAdvisor', 'norebro-extra' ); ?></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>

</div>