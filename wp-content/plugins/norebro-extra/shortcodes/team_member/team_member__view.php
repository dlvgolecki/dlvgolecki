<?php

/**
* Visual Composer Norebro Team Member shortcode view
*/

?>
<div class="norebro-team-member-sc team-member<?php echo $css_class; ?>"
	id="<?php echo esc_attr( $team_member_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?>
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>

	<div class="image-wrap">
		<?php if ( $photo ) : ?>
			<img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $name ); ?>">
		<?php endif; ?>
		<div class="overlay">
			<div class="content-center">
				<div class="wrap">
					<?php if ( $block_type_layout == 'inner' ) : ?>
						<p class="description"><?php echo $description; ?></p>
					<?php endif; ?>
					<div class="socialbar small<?php echo $social_settings_class; ?>">
						<?php if ( $facebook_link ) : ?>
							<a href="<?php echo $facebook_link; ?>" class="facebook"><span class="icon fa fa-facebook"></span></a>
						<?php endif; ?>
						<?php if ( $twitter_link ) : ?>
							<a href="<?php echo $twitter_link; ?>" class="twitter"><span class="icon fa fa-twitter"></span></a>
						<?php endif; ?>
						<?php if ( $dribbble_link ) : ?>
							<a href="<?php echo $dribbble_link; ?>" class="dribbble"><span class="icon fa fa-dribbble"></span></a>
						<?php endif; ?>
						<?php if ( $pinterest_link ) : ?>
							<a href="<?php echo $pinterest_link; ?>" class="pinterest"><span class="icon fa fa-pinterest-p"></span></a>
						<?php endif; ?>
						<?php if ( $github_link ) : ?>
							<a href="<?php echo $github_link; ?>" class="github"><span class="icon fa fa-github"></span></a>
						<?php endif; ?>
						<?php if ( $instagram_link ) : ?>
							<a href="<?php echo $instagram_link; ?>" class="instagram"><span class="icon fa fa-instagram"></span></a>
						<?php endif; ?>
						<?php if ( $linkedin_link ) : ?>
							<a href="<?php echo $linkedin_link; ?>" class="linkedin"><span class="icon fa fa-linkedin"></span></a>
						<?php endif; ?>
						<?php if ( $vk_link ) : ?>
							<a href="<?php echo $vk_link; ?>" class="vk"><span class="icon fa fa-vk"></span></a>
						<?php endif; ?>
						<?php if ( $wechat_link ) : ?>
							<a href="<?php echo $wechat_link; ?>" class="wechat"><span class="icon fa fa-weixin"></span></a>
						<?php endif; ?>
					</div>

					<?php if ($member_link): ?>
						<a href="<?php echo $member_link ?>" class="team-member-link">
							<i class="ion-ios-arrow-thin-right"></i>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<h3 class="title"><?php echo $name; ?></h3>
	<p class="subtitle small uppercase"><?php echo $position; ?></p>
	<?php if ( $block_type_layout != 'inner' ) : ?>
		<p class="description"><?php echo $description; ?></p>
	<?php endif; ?>

</div>
