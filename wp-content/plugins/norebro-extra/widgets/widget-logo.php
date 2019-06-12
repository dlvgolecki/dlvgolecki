<?php

if ( ! class_exists( 'norebro_widget_logo' ) ) {

	class norebro_widget_logo extends SB_WP_Widget {
		
		protected $options;
		
		public function __construct() {

			$this->options = array(
				array(
					'custom_css', 'text', '', 
					'label' => esc_html__( 'Custom CSS classes', 'norebro-extra' ), 
					'input' => 'text'
				)
			);
			
			parent::__construct(
				'norebro_widget_logo',
				'Norebro: ' . esc_html__( 'Logo', 'norebro-extra' ),
				array( 'description' => esc_html__( 'Display site logo', 'norebro-extra' ) )
			);
		}
		
		function widget( $args, $instance ) {
			extract( $args );
			$this->setInstances( $instance, 'filter' );

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

			$css_classes = $this->getInstance( 'custom_css' );
			$logo = NorebroSettings::footer_widget_logo();

			echo wp_kses( $before_widget, $allowed_tags );
			?>
				<div class="theme-logo <?php if ( $css_classes ) { echo esc_attr( $css_classes ); } ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php if ( is_array( $logo ) && $logo['default'] ) : ?>
						<img src="<?php echo esc_url( $logo['default'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<?php else : ?>
						<h3 class="title text-left"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h3>
					<?php endif; ?>
					</a>
				</div>
			<?php

			echo wp_kses( $after_widget, $allowed_tags );
		}
	}

	register_widget( 'norebro_widget_logo' );
}