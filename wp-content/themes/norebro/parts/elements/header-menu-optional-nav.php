<?php
	// Settings
	$header_style = NorebroSettings::header_menu_style();

	$show_search = ! NorebroSettings::get( 'header_hide_search', 'global' );
	$aligment_class = '';
	if ( $header_style == 'style4' ) {
		$show_search = false;
		$aligment_class = ' right';
	}
	if ( $header_style == 'style6' || $header_style == 'style5' ) {
		$show_search = false;
	}

	$have_woocomerce = function_exists( 'WC' );
	$have_woocomerce_wl = function_exists( 'YITH_WCWL' );
	$have_wpml = function_exists( 'icl_get_languages' );
	$wpml_show_in_header = NorebroSettings::wpml_menu_item_is_displayed();

	$cart_visible = NorebroSettings::get( 'woocommerce_cart_icon', 'global' );

	$mobile_social_position = NorebroSettings::get( 'header_mobile_social_position', 'global' );
	$mobile_cart_position = NorebroSettings::get( 'header_mobile_cart_position', 'global' );
	$mobile_lang_position = NorebroSettings::get( 'header_mobile_lang_position', 'global' );

	$wpml_type = NorebroSettings::get( 'wpml_switcher_type', 'global' );
	if ( is_null( $wpml_type ) ) {
		$wpml_type = 'inline';
	}

	$header_have_social = have_rows( 'global_header_menu_social_links', 'option' );
?>

<?php if ( $show_search || ( $have_wpml && $wpml_show_in_header ) || $have_woocomerce || $have_woocomerce_wl || $header_have_social ) : ?>

<ul class="menu-other<?php echo esc_attr( $aligment_class ); ?>">

	<?php if ( $header_style != 'style4' ) : ?>
	<?php if ( $have_woocomerce ) : ?>
		<?php if ( $cart_visible !== false ) : ?>
		<li>
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart<?php if ( $mobile_cart_position == 'inside' ) { echo ' inside'; } ?>">
				<span class="icon">
					<svg version="1.1" viewBox="30 20 40 60" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="19px">
					<path d="M59.4,72.1H40.7c-4.1,0-7-2.6-7.1-6.1l-2.5-27c0-0.1,0-0.1,0-0.2c0-1.5,1.2-2.7,2.9-2.7h32.3c1.5,0,2.8,1.3,2.8,2.9  c0,0.1,0,0.1,0,0.2l-2.5,26.7C66.4,69.4,63.4,72.1,59.4,72.1z M35.1,40.1l2.4,25.6c0,0.1,0,0.1,0,0.2c0,1.5,1.6,2.2,3.1,2.2h18.7  c1.5,0,3.1-0.7,3.1-2.3c0-0.1,0-0.1,0-0.2l2.4-25.5H35.1z"/><path d="M58.4,40.1c-1.1,0-2-0.9-2-2v-2.6c0-3.8-2.6-6.7-6-6.7s-6,2.9-6,6.7v2.6c0,1.1-0.9,2-2,2s-2-0.9-2-2v-2.6  c0-6,4.4-10.7,10-10.7s10,4.7,10,10.7v2.6C60.4,39.2,59.5,40.1,58.4,40.1z"/></svg>
				</span>
				<?php if ( $header_style == 'style6' ) { esc_html_e( 'Cart', 'norebro' ); } ?>
				<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
			</a>
			<div class="submenu submenu_cart <?php if ( ! WC()->cart->is_empty() ) echo 'cart'; ?>">
				<div class="widget_shopping_cart_content">
					<?php woocommerce_mini_cart(); ?>
				</div>
			</div>
		</li>
		<?php endif; ?>

		<?php if ( $have_woocomerce_wl ) : ?>
			<li>
				<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url( 'user' . '/' . get_current_user_id() ) ); ?>" class="wishlist">
					<span class="icon ion-android-favorite-outline"></span>
					<?php if ( $header_style == 'style6' ) { esc_html_e( 'Wishlist', 'norebro' ); } ?>
				</a>
			</li>
		<?php endif; ?>
	<?php endif; ?>
	<?php endif; ?>

	<?php if ( $have_wpml && $wpml_show_in_header ) : ?>
		<li class="languages<?php if ( $mobile_lang_position == 'inside' ) { echo ' inside'; } ?>">
		<?php if ( $wpml_type == 'dropdown' ) : ?>
			<a href="#">
			<?php
				$languages = icl_get_languages('skip_missing=1');
				$curr_lang = array();
				if ( !empty( $languages ) ) {
					foreach( $languages as $language ) {
						if( !empty( $language['active'] ) ) {
							$curr_lang = $language; // This will contain current language info.
							break;
						}
					}
				}
				echo '<img src="' . $curr_lang['country_flag_url'] . '" alt="'.$curr_lang['translated_name'].'" class="icon">';
				echo esc_attr($curr_lang['translated_name']);
			?>
			</a>
			<div class="submenu no-paddings">
				<ul class="sub-nav languages">
					<?php
						$languages = icl_get_languages('orderby=name');
						foreach( $languages as $language ) {
							$class = ( $language['active'] ) ? ' class="active"' : '';
							printf( '<li%s><a href="%s"><img src="%s" alt="%s"> %s</a></li>', $class, $language['url'],
								$language['country_flag_url'], $language['native_name'], $language['native_name'] );
						}
					?>
				</ul>
			</div>
		<?php else: ?>
		<?php
			$languages = icl_get_languages('');
			foreach( $languages as $language ) {
				$class = ( $language['active'] ) ? ' class="active"' : '';
				printf( '<a href="%s"%s><span>%s</span></a>', $language['url'], $class,
					$language['language_code'] );
			}
		?>
		<?php endif; ?>
		</li>
	<?php endif; ?>

	<?php if ( $header_have_social ) : ?>
	<li class="social<?php if ( $mobile_social_position == 'inside' ) { echo ' inside'; } ?>">
		<?php while( have_rows( 'global_header_menu_social_links', 'option' ) ): the_row(); ?>
			<?php
			$target = '';
			if (get_sub_field( 'in_new_tab' )):
				$target = ' target="_blank"';
			endif; ?>
			<?php switch ( get_sub_field( 'social_network' ) ) {
				case 'facebook':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="facebook"'. $target .'><span class="icon fa fa-facebook"></span></a>';
					break;
				case 'twitter':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="twitter"'. $target .'><span class="icon fa fa-twitter"></span></a>';
					break;
				case 'googleplus':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="googleplus"'. $target .'><span class="icon fa fa-google-plus"></span></a>';
					break;
				case 'instagram':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="instagram"'. $target .'><span class="icon fa fa-instagram"></span></a>';
					break;
				case 'dribbble':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="dribbble"'. $target .'><span class="icon fa fa-dribbble"></span></a>';
					break;
				case 'pinterest':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="pinterest"'. $target .'><span class="icon fa fa-pinterest"></span></a>';
					break;
				case 'github':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="github"'. $target .'><span class="icon fa fa-github-alt"></span></a>';
					break;
				case 'linkedin':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="linkedin"'. $target .'><span class="icon fa fa-linkedin"></span></a>';
					break;
				case 'vimeo':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="vimeo"'. $target .'><span class="icon fa fa-vimeo"></span></a>';
					break;
				case 'youtube':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="youtube"'. $target .'><span class="icon fa fa-youtube"></span></a>';
					break;
				case 'vk':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="vk"'. $target .'><span class="icon fa fa-vk"></span></a>';
					break;
				case 'behance':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="behance"'. $target .'><span class="icon fa fa-behance"></span></a>';
					break;
				case 'flickr':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="flickr"'. $target .'><span class="icon fa fa-flickr"></span></a>';
					break;
				case 'reddit':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="reddit"'. $target .'><span class="icon fa fa-reddit-alien"></span></a>';
					break;
				case 'snapchat':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="snapchat"'. $target .'><span class="icon fa fa-snapchat"></span></a>';
					break;
				case 'whatsapp':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="whatsapp"'. $target .'><span class="icon fa fa-whatsapp"></span></a>';
					break;
				case 'quora':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="quora"'. $target .'><span class="icon fa fa-quora"></span></a>';
					break;
				case 'vine':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="vine"'. $target .'><span class="icon fa fa-vine"></span></a>';
					break;
				case 'digg':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="digg"'. $target .'><span class="icon fa fa-digg"></span></a>';
					break;
				case 'foursquare':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="foursquare"'. $target .'><span class="icon fa fa-foursquare"></span></a>';
					break;
				case 'soundcloud':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="soundcloud"'. $target .'><span class="icon fa fa-soundcloud"></span></a>';
					break;
				case 'tripadvisor':
					echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="tripadvisor'. $target .'"><span class="icon fa fa-tripadvisor"></span></a>';
					break;
			} ?>
		<?php endwhile; ?>
	</li>
	<?php endif; ?>

	<?php if ( $show_search ) : ?>
		<li class="search">
			<a data-nav-search="true">
				<span class="icon ion-android-search"></span>
				<?php if ( $header_style == 'style6' ) { esc_html_e( 'Search', 'norebro' ); } ?>
			</a>
		</li>
	<?php endif; ?>
</ul>

<?php endif; ?>


<!-- Mobile menu -->
<div class="hamburger-menu" id="hamburger-menu">
	<a class="hamburger" aria-controls="site-navigation" aria-expanded="false"></a>
</div>
