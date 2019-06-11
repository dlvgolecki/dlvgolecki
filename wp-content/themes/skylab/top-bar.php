<?php
/**
 * The template for displaying top bar
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?>
	<div id="top-bar-wrapper">
		<div id="top-bar" class="clearfix">
		
			<?php global $woocommerce; ?>
			<?php if ( $woocommerce ) { ?>
				<?php $enable_woocommerce_links = ot_get_option( 'enable_woocommerce_links' ); ?>
				<?php if ( $enable_woocommerce_links == 'enable' ) { ?>
					<div class="woocommerce-links">
						<?php if ( is_user_logged_in() ) { ?>
							<a class="logout" href="<?php echo esc_url( get_permalink( get_option('woocommerce_logout_page_id') ) ); ?>"><?php esc_html_e( 'Logout', 'skylab' ); ?></a>
							<a class="account" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><?php esc_html_e( 'My Account', 'skylab' ); ?></a>
						<?php } else { ?>
							<a class="account" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><?php esc_html_e( 'Login', 'skylab' ); ?></a>
						<?php } ?>
					</div>
				<?php } ?>
			<?php } ?>
							
			<?php $search_header_position = ot_get_option( 'search_header_position' ); ?>
			<?php if ( empty( $search_header_position ) ) { ?>
				<?php $search_header_position = 'header'; ?>
			<?php } ?>
			<?php if ( $search_header_position == 'top_bar' || is_page( 'header-2' ) ) { ?>
				<div class="search-header-wrapper">
					<div class="search-wrapper">
						<div class="search-form-wrapper">
							<?php //get_search_form(); // Search form ?>
							<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="text" class="s field" name="s" placeholder="<?php esc_html_e( 'Search', 'skylab' ) ?>" autocomplete="off" /> 
							</form>
							<span id="remove-search"><i></i></span>
						</div>
					</div>
				
				<span id="search-header-icon">
					<i></i>
				</span>
				</div>
			<?php } ?>
			
			<?php $social_icons_position = ot_get_option( 'social_icons_position' ); ?>
			<?php if ( $social_icons_position == 'top_bar' ) { ?>
				<div class="social-accounts-wrapper">
					<?php get_template_part( 'social-accounts' ); // Social accounts ?>
				</div>
			<?php } ?>
			
			<?php $woocommerce_cart_position = ot_get_option( 'woocommerce_cart_position' ); ?>
			<?php if ( $woocommerce_cart_position == 'top_bar' ) { ?>
				<?php global $woocommerce; ?>
				<?php if ( $woocommerce ) { ?>
					<div class="woocommerce-cart-wrapper">
						<?php if ( ! $woocommerce->cart->cart_contents_count ) { ?>
							<a class="woocommerce-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><i></i></span></a>
						<?php } else { ?>
							<a class="woocommerce-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><i></i> <span class="cart-contents-count"><?php echo $woocommerce->cart->cart_contents_count; ?><span></span></a>
							<div class="product-list-cart">
								<em></em>
								<ul>
								<?php foreach($woocommerce->cart->cart_contents as $cart_item): //var_dump($cart_item); ?>
									<li>
										<a href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
											<?php echo get_the_post_thumbnail( $cart_item['product_id'], 'shop_thumbnail' ); ?>
											<span class="product"><?php echo $cart_item['data']->post->post_title; ?></span>
										</a>
										<?php echo $cart_item['quantity']; ?> x <?php echo $woocommerce->cart->get_product_subtotal( $cart_item['data'], $cart_item['quantity'] ); ?>
									</li>
									<?php endforeach; ?>
								</ul>
								<div class="woocommerce-cart-checkout">
									<a class="button alt" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_checkout_page_id' ) ) ); ?>"><span><?php esc_html_e( 'Checkout', 'skylab' ); ?></span></a>
									<a class="button" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_cart_page_id' ) ) ); ?>"><span><?php esc_html_e( 'View cart', 'skylab' ); ?></span></a>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			<?php } ?>
			
			<?php $top_bar_info = ot_get_option( 'top_bar_info' ); ?>
			<?php if ( ! empty( $top_bar_info ) ) { ?>
				<div class="info-header">
					<?php if ( function_exists( 'icl_t' ) ) { ?>
						<?php echo icl_t( 'OptionTree', 'top_bar_info', $top_bar_info ); ?>
					<?php } else { ?>
						<?php echo wpautop( $top_bar_info ); ?>
					<?php } ?>
				</div>
			<?php } ?>
			
			<?php // WPML
			$enable_wpml_language_switcher = ot_get_option( 'enable_wpml_language_switcher' );
			if ( !empty( $enable_wpml_language_switcher ) ) {
				?>
				<div class="lang_sel-wrapper">
					<?php do_action('icl_language_selector'); ?>
				</div>
			<?php } ?>
			
			<?php if ( has_nav_menu( 'top_bar' ) ) { ?>
				<?php wp_nav_menu( array( 'theme_location' => 'top_bar', 'menu_class' => 'sf-menu', 'container_class' => 'top-bar-menu', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			<?php } ?>
		</div>
	</div>
