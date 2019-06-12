<?php

if ( ! class_exists( 'norebro_widget_contact' ) ) {

	class norebro_widget_contact extends WP_Widget {

		function __construct() {
			parent::__construct(
				'norebro_widget_contact',
				'Norebro: ' . esc_html__( 'Contact block', 'norebro-extra' ),
				array( 'description' => esc_html__( 'Displays the author\'s contact information, such as address, phone etc', 'norebro-extra' ) )
			);
		}

		/**
		 * @param array $args
		 * @param array $instance
		 */
		function widget( $args, $instance ) {
			extract( $args );
			$title = ( isset( $instance['title'] ) ) ? $instance['title'] : '';
			$phone = ( isset( $instance['phone'] ) ) ? $instance['phone'] : '';
			$address = ( isset( $instance['address'] ) ) ? $instance['address'] : '';
			$email = ( isset( $instance['address'] ) ) ? $instance['email'] : '';
			$enable_soc_icons = ( isset( $instance['enable_soc_icons'] ) ) ? $instance['enable_soc_icons'] : '';

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
			<ul class="list-box contact-module">
			<?php
				if ( ! empty( $phone ) ) :
			?>
				<li>
					<?php esc_html_e( 'Phone', 'norebro-extra' ); ?>:
					<address><?php echo $phone; ?></address>
				</li>
			<?php
				endif;

				if ( ! empty( $email ) ) :
			?>
				<li>
					<?php esc_html_e( 'Email', 'norebro-extra' ); ?>:
					<address><?php echo $email; ?></address>
				</li>
			<?php
				endif;

				if ( ! empty( $address ) ) :
			?>
				<li>
					<?php esc_html_e( 'Address', 'norebro-extra' ); ?>:
					<address><?php echo $address; ?></address>
				</li>
			<?php
				endif;
			?>
			</ul>
			<?php
			echo wp_kses( $after_widget, $allowed_tags );
		}


		function update( $new, $old ){
			$new = wp_parse_args( $new, array(
				'title' => '',
				'phone' => '',
				'address' => '',
				'email' => '',
				'enable_soc_icons' => '',
			) );
			return $new;
		}

		function form( $instance ) {
			$instance = wp_parse_args( $instance, array(
				'title' => '',
				'phone' => '',
				'address' => '',
				'email' => '',
				'enable_soc_icons' => '',
			) );
			$checked = false;
			if( $instance['enable_soc_icons'] ) {
				$checked = true;
			}
	?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'norebro-extra' ); ?>:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone', 'norebro-extra' ); ?>:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['phone'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'E-mail', 'norebro-extra' ); ?>:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['email'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address', 'norebro-extra' ); ?>:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['address'] ); ?>"/>
		</p>
	<?php
		}
	}

	register_widget( 'norebro_widget_contact' );
}