<?php $social_links = ot_get_option( 'social_links' ); ?>
<?php if ( ! empty( $social_links ) ) { ?>
<div class="social-links">
<?php } ?>

	<?php
	// Twitter
	if ( ! empty( $social_links[0] ) ) {
	$twitter_url = ot_get_option( 'twitter_url' );
	?>
		<a class="social twitter" href="<?php echo esc_url( $twitter_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">Twitter</span>
		</a>
	<?php } // end if ( ! empty( $social_links[0] ) ) ?>

	<?php
	// Facebook
	if ( ! empty( $social_links[1] ) ) {
	$facebook_url = ot_get_option( 'facebook_url' );
	?>
		<a class="social facebook" href="<?php echo esc_url( $facebook_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">Facebook</span>
		</a>
	<?php } // end if ( ! empty( $social_links[1] ) ) ?>
	
	<?php // LinkedIn
	if ( ! empty( $social_links[2] ) ) {
	$linkedin_url = ot_get_option( 'linkedin_url' );
	?>
		<a class="social linkedin" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">LinkedIn</span>
		</a>
	<?php } // end if ( ! empty( $social_links[2] ) ) ?>
	
	<?php // Instagram
	if ( ! empty( $social_links[3] ) ) {
	$instagram_url = ot_get_option( 'instagram_url' );
	?>
		<a class="social instagram" href="<?php echo esc_url( $instagram_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">Instagram</span>
		</a>
	<?php } // end if ( ! empty( $social_links[3] ) ) ?>
	
	<?php // Tumblr
	if ( ! empty( $social_links[4] ) ) {
	$tumblr_url = ot_get_option( 'tumblr_url' );
	?>
		<a class="social tumblr" href="<?php echo esc_url( $tumblr_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">Tumblr</span>
		</a>
	<?php } // end if ( ! empty( $social_links[4] ) ) ?>

	<?php // Google+
	if ( ! empty( $social_links[5] ) ) {
	$gplus_url = ot_get_option( 'gplus_url' );
	?>
		<a class="social google" href="<?php echo esc_url( $gplus_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">Google+</span>
		</a>
	<?php } // end if ( ! empty( $social_links[5] ) ) ?>

	<?php // Vimeo
	if ( ! empty( $social_links[6] ) ) {
	$vimeo_url = ot_get_option( 'vimeo_url' );
	?>
		<a class="social vimeo" href="<?php echo esc_url( $vimeo_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">Vimeo</span>
		</a>
	<?php } // end if ( ! empty( $social_links[6] ) ) ?>

	<?php // Flickr
	if ( ! empty( $social_links[7] ) ) {
	$flickr_url = ot_get_option( 'flickr_url' );
	?>
		<a class="social flickr" href="<?php echo esc_url( $flickr_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">Flickr</span>
		</a>
	<?php } // end if ( ! empty( $social_links[7] ) ) ?>
	
	<?php // Pinterest
	if ( ! empty( $social_links[8] ) ) {
	$pinterest_url = ot_get_option( 'pinterest_url' );
	?>
		<a class="social pinterest" href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">Pinterest</span>
		</a>
	<?php } // end if ( ! empty( $social_links[8] ) ) ?>

	<?php // YouTube
	if ( ! empty( $social_links[9] ) ) {
	$youtube_url = ot_get_option( 'youtube_url' );
	?>
		<a class="social youtube" href="<?php echo esc_url( $youtube_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">YouTube</span>
		</a>
	<?php } // end if ( ! empty( $social_links[9] ) ) ?>
	
	<?php // Dribbble
	if ( ! empty( $social_links[10] ) ) {
	$dribbble_url = ot_get_option( 'dribbble_url' );
	?>
		<a class="social dribbble" href="<?php echo esc_url( $dribbble_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">Dribbble</span>
		</a>
	<?php } // end if ( ! empty( $social_links[10] ) ) ?>

	<?php // Behance
	if ( ! empty( $social_links[11] ) ) {
	$behance_url = ot_get_option( 'behance_url' );
	?>
		<a class="social behance" href="<?php echo esc_url( $behance_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">Behance</span>
		</a>
	<?php } // end if ( ! empty( $social_links[11] ) ) ?>
	
	<?php // 500px
	if ( ! empty( $social_links[12] ) ) {
	$px_url = ot_get_option( 'px_url' );
	?>
		<a class="social px" href="<?php echo esc_url( $px_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">500px</span>
		</a>
	<?php } // end if ( ! empty( $social_links[12] ) ) ?>
	
	<?php // VK
	if ( ! empty( $social_links[13] ) ) {
	$vk_url = ot_get_option( 'vk_url' );
	?>
		<a class="social vk" href="<?php echo esc_url( $vk_url ); ?>" target="_blank">
			<span class="social-icon"></span> <span class="social-text">VK</span>
		</a>
	<?php } // end if ( ! empty( $social_links[13] ) ) ?>
	
	<?php // Email
	if ( ! empty( $social_links[14] ) ) {
	$email_address = ot_get_option( 'email_address' );
	?>
		<a class="social email" href="mailto:<?php echo sanitize_email( $email_address ); ?>">
			<span class="social-icon"></span> <span class="social-text">Email</span>
		</a>
	<?php } // end if ( ! empty( $social_links[14] ) ) ?>
	
<?php if ( ! empty( $social_links ) ) { ?>
</div>
<?php } ?>

				