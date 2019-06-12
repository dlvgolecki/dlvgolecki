<?php

if ( ! class_exists( 'norebro_widget_socialbar_subscribe' ) ) {

	class norebro_widget_socialbar_subscribe extends WP_Widget {

		function __construct() {
			parent::__construct(
				'norebro_widget_socialbar_subscribe',
				'Norebro: ' . esc_html__( 'Socialbar subscribe', 'norebro-extra' ),
				array( 'description' =>  esc_html__( 'Subscribe social buttons', 'norebro-extra' ) )
			);
		}

		function widget( $args, $instance ) {
			extract( $args );
			$title = $instance['title'];

			$facebook = false;
			$twitter = false;
			$googleplus = false;
			$instagram = false;
			$pinterest = false;
			$linkedin = false;
			$vk = false;
			$dribbble = false;
			$youtube = false;
			$vimeo = false;
			$tumblr = false;
			$flickr = false;
			$reddit = false;
			$snapchat = false;
			$whatsapp = false;
			$quora = false;
			$vine = false;
			$digg = false;
			$foursquare = false;
			$tripadvisor = false;
			
			if ( isset( $instance['facebook'] ) ) {
				$facebook = $instance['facebook'];
			}
			if ( isset( $instance['twitter'] ) ) {
				$twitter = $instance['twitter'];
			}
			if ( isset( $instance['googleplus'] ) ) {
				$googleplus = $instance['googleplus'];
			}
			if ( isset( $instance['instagram'] ) ) {
				$instagram = $instance['instagram'];
			}
			if ( isset( $instance['pinterest'] ) ) {
				$pinterest = $instance['pinterest'];
			}
			if ( isset( $instance['linkedin'] ) ) {
				$linkedin = $instance['linkedin'];
			}
			if ( isset( $instance['vk'] ) ) {
				$vk = $instance['vk'];
			}
			if ( isset( $instance['dribbble'] ) ) {
				$dribbble = $instance['dribbble'];
			}
			if ( isset( $instance['youtube'] ) ) {
				$youtube = $instance['youtube'];
			}
			if ( isset( $instance['vimeo'] ) ) {
				$vimeo = $instance['vimeo'];
			}
			if ( isset( $instance['tumblr'] ) ) {
				$tumblr = $instance['tumblr'];
			}
			if ( isset( $instance['flickr'] ) ) {
				$flickr = $instance['flickr'];
			}
			if ( isset( $instance['reddit'] ) ) {
				$reddit = $instance['reddit'];
			}
			if ( isset( $instance['snapchat'] ) ) {
				$snapchat = $instance['snapchat'];
			}
			if ( isset( $instance['whatsapp'] ) ) {
				$whatsapp = $instance['whatsapp'];
			}
			if ( isset( $instance['quora'] ) ) {
				$quora = $instance['quora'];
			}
			if ( isset( $instance['vine'] ) ) {
				$vine = $instance['vine'];
			}
			if ( isset( $instance['digg'] ) ) {
				$digg = $instance['digg'];
			}
			if ( isset( $instance['foursquare'] ) ) {
				$foursquare = $instance['foursquare'];
			}
			if ( isset( $instance['tripadvisor'] ) ) {
				$tripadvisor = $instance['tripadvisor'];
			}

			$allowed_tags = array(
				'section' => array(
					'id' => array(),
					'class' => array()
				),
				'li' => array(
					'id' => array(),
					'class' => array()
				),
				'div' => array(
					'id' => array(),
					'class' => array()
				),
				'h3' => array(
					'class' => array()
				)
			);
			
			echo wp_kses( $before_widget, $allowed_tags );

			if ( ! empty( $title ) ) {
				echo wp_kses( $before_title . esc_html( $title ) . $after_title, $allowed_tags );
			}
			?>
			<div class="socialbar small new-tab-links">
				<?php if ( $facebook ) : ?>
					<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-facebook"></span>
					</a>
				<?php endif; ?>

				<?php if ( $twitter ) : ?>
					<a href="<?php echo esc_url( $twitter ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-twitter"></span>
					</a>
				<?php endif; ?>

				<?php if ( $googleplus ) : ?>
					<a href="<?php echo esc_url( $googleplus ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-google"></span>
					</a>
				<?php endif; ?>

				<?php if ( $instagram ) : ?>
					<a href="<?php echo esc_url( $instagram ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-instagram"></span>
					</a>
				<?php endif; ?>

				<?php if ( $linkedin ) : ?>
					<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-linkedin"></span>
					</a>
				<?php endif; ?>

				<?php if ( $pinterest ) : ?>
					<a href="<?php echo esc_url( $pinterest ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-pinterest-p"></span>
					</a>
				<?php endif; ?>

				<?php if ( $vk ) : ?>
					<a href="<?php echo esc_url( $vk ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-vk"></span>
					</a>
				<?php endif; ?>

				<?php if ( $dribbble ) : ?>
					<a href="<?php echo esc_url( $dribbble ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-dribbble"></span>
					</a>
				<?php endif; ?>

				<?php if ( $youtube ) : ?>
					<a href="<?php echo esc_url( $youtube ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-youtube"></span>
					</a>
				<?php endif; ?>

				<?php if ( $vimeo ) : ?>
					<a href="<?php echo esc_url( $vimeo ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-vimeo"></span>
					</a>
				<?php endif; ?>

				<?php if ( $tumblr ) : ?>
					<a href="<?php echo esc_url( $tumblr ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-tumblr"></span>
					</a>
				<?php endif; ?>

				<?php if ( $flickr ) : ?>
					<a href="<?php echo esc_url( $flickr ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-flickr"></span>
					</a>
				<?php endif; ?>

				<?php if ( $reddit ) : ?>
					<a href="<?php echo esc_url( $reddit ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-reddit-alien"></span>
					</a>
				<?php endif; ?>

				<?php if ( $snapchat ) : ?>
					<a href="<?php echo esc_url( $snapchat ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-snapchat-ghost"></span>
					</a>
				<?php endif; ?>

				<?php if ( $whatsapp ) : ?>
					<a href="<?php echo esc_url( $whatsapp ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-whatsapp"></span>
					</a>
				<?php endif; ?>

				<?php if ( $quora ) : ?>
					<a href="<?php echo esc_url( $quora ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-quora"></span>
					</a>
				<?php endif; ?>

				<?php if ( $vine ) : ?>
					<a href="<?php echo esc_url( $vine ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-vine"></span>
					</a>
				<?php endif; ?>

				<?php if ( $digg ) : ?>
					<a href="<?php echo esc_url( $digg ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-digg"></span>
					</a>
				<?php endif; ?>

				<?php if ( $foursquare ) : ?>
					<a href="<?php echo esc_url( $foursquare ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-foursquare"></span>
					</a>
				<?php endif; ?>

				<?php if ( $tripadvisor ) : ?>
					<a href="<?php echo esc_url( $tripadvisor ); ?>" target="_blank" class="social outline rounded">
						<span class="icon fa fa-tripadvisor"></span>
					</a>
				<?php endif; ?>

			</div>
			<?php
			echo wp_kses( $after_widget, $allowed_tags );
		}


		function update( $new, $old){
			$new = wp_parse_args( $new, array(
				'title' => '',
				'facebook' => '',
				'instagram' => '',
				'twitter' => '',
				'googleplus' => '',
				'pinterest' => '',
				'linkedin' => '',
				'vk' => '',
				'dribbble' => '',
				'youtube' => '',
				'vimeo' => '',
				'tumblr' => '',
				'flickr' => '',
				'reddit' => '',
				'snapchat' => '',
				'whatsapp' => '',
				'quora' => '',
				'vine' => '',
				'digg' => '',
				'foursquare' => '',
				'tripadvisor' => ''
			) );
			return $new;
		}

		function form( $instance ) {
			$instance = wp_parse_args( $instance, array(
				'title' => '',
				'facebook' => '',
				'instagram' => '',
				'twitter' => '',
				'googleplus' => '',
				'pinterest' => '',
				'linkedin' => '',
				'vk' => '',
				'dribbble' => '',
				'youtube' => '',
				'vimeo' => '',
				'tumblr' => '',
				'flickr' => '',
				'reddit' => '',
				'snapchat' => '',
				'whatsapp' => '',
				'quora' => '',
				'vine' => '',
				'digg' => '',
				'foursquare' => '',
				'tripadvisor' => ''
			) );
	?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['facebook'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['twitter'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>"><?php esc_html_e( 'Google+ link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'googleplus' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['googleplus'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['instagram'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['pinterest'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'Linkedin link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['linkedin'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>"><?php esc_html_e( 'Vkontakte link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vk' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['vk'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>"><?php esc_html_e( 'Dribbble link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribbble' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['dribbble'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'Youtube link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['youtube'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>"><?php esc_html_e( 'Vimeo link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['vimeo'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>"><?php esc_html_e( 'Tumblr link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tumblr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['tumblr'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>"><?php esc_html_e( 'Flickr link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['flickr'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'reddit' ) ); ?>"><?php esc_html_e( 'Reddit link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'reddit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'reddit' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['reddit'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'snapchat' ) ); ?>"><?php esc_html_e( 'Snapchat link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'snapchat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'snapchat' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['snapchat'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'whatsapp' ) ); ?>"><?php esc_html_e( 'WhatsApp link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'whatsapp' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'whatsapp' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['whatsapp'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'quora' ) ); ?>"><?php esc_html_e( 'Quora link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'quora' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'quora' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['quora'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vine' ) ); ?>"><?php esc_html_e( 'Vine link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vine' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vine' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['vine'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'digg' ) ); ?>"><?php esc_html_e( 'Digg link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'digg' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'digg' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['digg'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'foursquare' ) ); ?>"><?php esc_html_e( 'Foursquare link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'foursquare' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'foursquare' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['foursquare'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tripadvisor' ) ); ?>"><?php esc_html_e( 'TripAdvisor link:', 'norebro-extra' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tripadvisor' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tripadvisor' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['tripadvisor'] ); ?>"/>
		</p>


	<?php
		}
	}


	register_widget( 'norebro_widget_socialbar_subscribe' );

}