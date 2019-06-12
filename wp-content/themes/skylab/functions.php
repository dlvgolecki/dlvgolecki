<?php
/**
 * Skylab functions and definitions
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 1170;

/**
 * Options Tree.
 */
 
/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

include_once( trailingslashit( get_template_directory() ) . 'inc/theme-options.php' );
	
/**
 * Tell WordPress to run mega_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'mega_setup' );

if ( ! function_exists( 'mega_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function mega_setup() {

	load_theme_textdomain( 'skylab', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'skylab' ) );
	register_nav_menu( 'secondary', esc_html__( 'Secondary Menu', 'skylab' ) );
	register_nav_menu( 'secondary_header', esc_html__( 'Secondary Menu in Header', 'skylab' ) );
	//register_nav_menu( 'top_bar', esc_html__( 'Top Bar Menu', 'skylab' ) );
	register_nav_menu( 'subfooter', esc_html__( 'Subfooter Menu', 'skylab' ) );
	
	// Add container to wp_nav_menu sub menu
	class mega_Sublevel_Walker extends Walker_Nav_Menu {
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class='sub-menu'><div class='sub-menu-wrapper'>\n";
		}
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</div></ul>\n";
		}
	}

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page and custom backgrounds
	add_theme_support( 'post-thumbnails' );
	
	// Title
	add_theme_support( 'title-tag' );
	
	// Declare WooCommerce support
	add_theme_support( 'woocommerce' );
	
	// Ensure cart contents update when products are added to the cart via AJAX
	add_filter( 'add_to_cart_fragments', 'mega_woocommerce_header_add_to_cart_fragment' );
	 
	function mega_woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		
		ob_start();
		
		?>
		
		<?php $cart_count = WC()->cart->get_cart_contents_count(); ?>

		<div class="woocommerce-cart-wrapper">
			<?php if ( ! $woocommerce->cart->cart_contents_count ) { ?>
				<a class="woocommerce-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><i></i></span></a>
			<?php } else { ?>
				<a class="woocommerce-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><i></i> <span class="cart-contents-count"><?php echo $woocommerce->cart->cart_contents_count; ?></span></span></a>
				<div class="product-list-cart">
											<em></em>
											<ul>
											<?php foreach($woocommerce->cart->cart_contents as $cart_item): ?>
												<li>
													<a href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>" class="cart-product-link">
														<div><div class="cart-thumbnail-wrapper"><?php echo get_the_post_thumbnail( $cart_item['product_id'], 'shop_thumbnail' ); ?></div></div>
														<span class="product"><?php echo $cart_item['data']->post->post_title; ?></span>
													</a>
													<?php echo $cart_item['quantity']; ?> x <?php echo $woocommerce->cart->get_product_subtotal( $cart_item['data'], $cart_item['quantity'] ); ?>
												</li>
												<?php endforeach; ?>
											</ul>
											<div class="woocommerce-cart-checkout">
												<div class="woocommerce-cart-total-wrapper">
													<span class="woocommerce-cart-total-text"><?php esc_html_e( 'Total', 'skylab' ); ?></span><span class="woocommerce-cart-total-number"><?php echo WC()->cart->get_cart_total(); ?></span>
												</div>
												<a class="button alt to-checkout" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_checkout_page_id' ) ) ); ?>"><span><?php esc_html_e( 'To checkout', 'skylab' ); ?></span></a>
												<a class="button to-cart" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_cart_page_id' ) ) ); ?>"><span><?php esc_html_e( 'View cart', 'skylab' ); ?></span></a>
											</div>
										</div>
			<?php } ?>
		</div>
		<?php
		
		$fragments['#page .woocommerce-cart-wrapper'] = ob_get_clean();
		
		return $fragments;
		
	}
	
	// Hook in functions to display the wrappers theme requires
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	
	add_action('woocommerce_before_main_content', 'mega_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'mega_theme_wrapper_end', 10);

	function mega_wrapper_start() {
		echo '<div id="primary">';
	}

	function mega_theme_wrapper_end() {
		echo '</div>';
	}
	
	// Disable WooCommerce breadcrumbs
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	
	// WooCommerce display number products per page.
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
	
	add_filter( 'loop_shop_columns', 'mega_loop_columns' );
	if (!function_exists('mega_loop_columns')) {
		function mega_loop_columns() {
			$shop_columns = ot_get_option( 'shop_columns' );
			if ( empty( $shop_columns ) ) {
				$shop_columns = 3;
			}
			if ( isset($_GET['columns']) && $_GET['columns'] == 3 ) {
				$shop_columns = 3;
			}
			if ( isset($_GET['columns']) && $_GET['columns'] == 4 ) {
				$shop_columns = 4;
			}
			return $shop_columns;
		}
	}
	
	// Cross-Sells Columns
	add_filter( 'woocommerce_cross_sells_columns', 'mega_cross_sells_columns' );
	function mega_cross_sells_columns( $columns ) {
		return 2;
	}
	
	// Cross-Sells Number
	add_filter('woocommerce_cross_sells_total', 'mega_cartCrossSellTotal');
	function mega_cartCrossSellTotal($total) {
		$total = '2';
		return $total;
	}
	
	// WooCommerce sale text
	add_filter( 'woocommerce_sale_flash', 'mega_woocommerce_sale_flash' );
	function mega_woocommerce_sale_flash( $html ) {
		return str_replace( esc_html__( 'Sale!', 'skylab' ), esc_html__( 'Sale', 'skylab' ), $html );
	}
	
	// Change the add to cart text on single product 
	$add_to_cart_text_on_single_product = ot_get_option( 'add_to_cart_text_on_single_product' );
	if ( ! empty( $add_to_cart_text_on_single_product ) ) {
	add_filter( 'woocommerce_product_single_add_to_cart_text', 'mega_custom_cart_button_text' );    // 2.1 +
	}
	function mega_custom_cart_button_text() {
		$add_to_cart_text_on_single_product  = ot_get_option( 'add_to_cart_text_on_single_product' );
		return $add_to_cart_text_on_single_product;
	}
	
	// Modify the default WooCommerce orderby dropdown
	//
	// Options: menu_order, popularity, rating, date, price, price-desc
	// In this example I'm changing the default "Sort by newness" to "Sort by date: newest to oldest"
	function mega_woocommerce_catalog_orderby( $orderby ) {
		$orderby["menu_order"] = esc_html__('Default', 'skylab');
		$orderby["popularity"] = esc_html__('Popularity', 'skylab');
		$orderby["rating"] = esc_html__('Average rating', 'skylab');
		$orderby["date"] = esc_html__('Newness', 'skylab');
		$orderby["price"] = esc_html__('Price: Low to High', 'skylab');
		$orderby["price-desc"] = esc_html__('Price: High to Low', 'skylab');
		return $orderby;
	}
	add_filter( "woocommerce_catalog_orderby", "mega_woocommerce_catalog_orderby", 20 );
	
	// WPML for OptionTree
	if(function_exists('icl_register_string')){
		$top_bar_info = ot_get_option( 'top_bar_info' );
		icl_register_string( 'OptionTree', 'top_bar_info', $top_bar_info );
		$footer_info = ot_get_option( 'footer_info' );
		icl_register_string( 'OptionTree', 'footer_info', $footer_info );
		$add_to_cart_text_on_single_product = ot_get_option( 'add_to_cart_text_on_single_product' );
		icl_register_string( 'OptionTree', 'add_to_cart_text_on_single_product', $add_to_cart_text_on_single_product );
	}
	
	// OptionTree filter on layout images
	function mega_filter_radio_images( $array, $field_id  ) {
		  
		if ( $field_id  == 'shop_layout' ) {
			$array = array(
				array(
				'value'   => 'left-sidebar',
				'label'   => esc_html__( 'Left Sidebar', 'skylab' ),
				'src'     => OT_URL . 'assets/images/layout/left-sidebar.png'
				),
				array(
				'value'   => 'right-sidebar',
				'label'   => esc_html__( 'Right Sidebar', 'skylab' ),
				'src'     => OT_URL . 'assets/images/layout/right-sidebar.png'
				),
				array(
				'value'   => 'full-width',
				'label'   => esc_html__( 'Full Width (no sidebar)', 'skylab' ),
				'src'     => OT_URL . 'assets/images/layout/full-width.png'
			  )
			);
		}
		  
		 return $array;
	  
	}
	add_filter( 'ot_radio_images', 'mega_filter_radio_images', 10, 2 );
	
}
endif; // mega_setup

// Set thumbnail size in settings > media
function mega_after_switch_theme() {
	update_option( 'medium_size_w', 300 );
	update_option( 'medium_size_h', 300 );
	update_option( 'large_size_w', 1170 );
	update_option( 'large_size_h', 0 );
}
add_action( 'after_switch_theme', 'mega_after_switch_theme' );

// Register Theme
class Mega_Envato_Verify {
	function verify_purchase() {
		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true ) {
			$code = get_option('envato_purchase_code_4740718');

			// If you took $code from user input it's a good idea to trim it:

			$code = trim($code);

			// Make sure the code is valid before sending it to Envato:
			
			if (!preg_match("/^([a-z0-9]{8})[-](([a-z0-9]{4})[-]){3}([a-z0-9]{12})$/im", $code)) {
				add_settings_error( 'mega-theme-license-group', 'mega-envato-verify-admin-notice', esc_html__( 'Invalid code.', 'skylab' ), 'error' );
				update_option( 'mega_theme_verify', false );
				return;
			}

			// Retrieve the raw response
			
			global $wp_version;
			$args = array(
				'timeout'     => 20,
				'redirection' => 5,
				'httpversion' => '1.0',
				'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
				'blocking'    => true,
				'headers'     => array(
					'Authorization' => 'Bearer Ba9uDI3ThFjSBXKpmDsURPJsJSYhPdUt',
					'User-Agent' => 'Purchase Verification'
				),
				'cookies'     => array(),
				'body'        => null,
				'compress'    => false,
				'decompress'  => true,
				'sslverify'   => true,
				'stream'      => false,
				'filename'    => null
			);
			
			$response = wp_remote_get( 'https://api.envato.com/v3/market/author/sale?code='. $code, $args );
			$responseCode = wp_remote_retrieve_response_code( $response );

			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				add_settings_error( 'mega-theme-license-group', 'mega-envato-verify-admin-notice', esc_html__( 'Failed to query Envato API: ', 'skylab' ) . $error_message, 'error' );
				update_option( 'mega_theme_verify', false );
				return;
			}

			// Validate response:

			$responseCode = wp_remote_retrieve_response_code( $response );

			if ($responseCode === 404) {
				add_settings_error( 'mega-theme-license-group', 'mega-envato-verify-admin-notice', esc_html__( 'The purchase code was invalid.', 'skylab' ), 'error' );
				update_option( 'mega_theme_verify', false );
				return;
			}

			if ($responseCode !== 200) {
				add_settings_error( 'mega-theme-license-group', 'mega-envato-verify-admin-notice', esc_html__( 'Failed to validate code due to an error: HTTP ', 'skylab' ) . $responseCode . '.', 'error' );
				update_option( 'mega_theme_verify', false );
				return;
			}

			// Verify that the purchase code is for the correct item:
			// (Replace the numbers 4740718 with your item's ID from its URL obviously)

			$body = json_decode($response['body']);

			if ($body->item->id !== 4740718) {
				add_settings_error( 'mega-theme-license-group', 'mega-envato-verify-admin-notice', esc_html__( 'The purchase code provided is for a different item.', 'skylab' ), 'error' );
				update_option( 'mega_theme_verify', false );
				return;
			}

			// The purchase code was valid, implement logic here.
			add_settings_error( 'mega-theme-license-group', 'mega-envato-verify-admin-notice', esc_html__( 'Theme registered.', 'skylab' ), 'updated' );
			update_option( 'mega_theme_verify', true );
		}
	}
}

function mega_theme_license_menu() {
	add_theme_page( esc_html__( 'Register Theme', 'skylab' ), esc_html__( 'Register Theme', 'skylab' ), 'edit_theme_options', 'mt-theme-license', 'mega_theme_license_page');
	add_action( 'admin_init', 'mega_theme_license_settings' );
}
add_action( 'admin_menu', 'mega_theme_license_menu', 99 );

function mega_theme_license_settings() {
	register_setting( 'mega-theme-license-group', 'envato_purchase_code_4740718' );
	register_setting( 'mega-theme-license-group', 'mega_theme_verify' );
}

function mega_theme_license_page() {
	
	$theme = wp_get_theme(); ?>
	<div class="wrap">
	<?php $verify = new Mega_Envato_Verify; ?>
	<?php echo $verify->verify_purchase(); ?>
	<?php $verified = get_option('mega_theme_verify'); ?>
	<?php if ( $verified == true ) { ?>
		<?php $verified_class = 'theme-verified'; ?>
		<?php $verified_text = esc_html__( 'Registered', 'skylab' ); ?>
	<?php } else { ?>
		<?php $verified_class = 'theme-not-verified'; ?>
		<?php $verified_text = esc_html__( 'Not Registered', 'skylab' ); ?>
	<?php } ?>
	<h1><?php echo sprintf( esc_html__( 'Register %1$s Theme', 'skylab' ), $theme ); ?><span class="theme-verification <?php echo esc_attr( $verified_class ); ?>"><?php echo $verified_text; ?></span></h1>
	<?php settings_errors( 'mega-theme-license-group' ); ?>
	<p><?php _e( 'In order to receive all benefits of Skylab theme, you need to activate your copy of the theme. By activating Skylab license you will unlock premium options - <strong>direct theme updates</strong>, access to <strong>demo content library</strong>, <strong>bundled plugins</strong> and <strong>official support.</strong>', 'skylab' ); ?></p>
	
	<form method="post" action="options.php">
		<?php settings_fields( 'mega-theme-license-group' ); ?>
		<?php do_settings_sections( 'mega-theme-license-group' ); ?>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php echo esc_html__( 'Purchase Code', 'skylab' ); ?></th>
				<td>
				<input type="text" class="regular-text" name="envato_purchase_code_4740718" value="<?php echo esc_attr( get_option('envato_purchase_code_4740718') ); ?>" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" />
				<p class="description"><?php printf(
					esc_html__( '%1$s %2$s', 'skylab' ),
					esc_html__( 'You can learn how to find your purchase code', 'skylab' ),
					sprintf(
						'<a href="%s" target="_blank">%s</a>',
						esc_url( 'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-' ),
						esc_html__( 'here.', 'skylab' )
					)
				); ?></p>
				</td>
			</tr>
		</table>
		
		<?php submit_button( sprintf( esc_html__( 'Register %1$s Theme', 'skylab' ), $theme ) ); ?>
	</form>
	</div>
<?php
}

// Import
function mega_import_files() {
  $verified = get_option('mega_theme_verify');
  if ( $verified == true ) {
	$path = 'http://demo.megathe.me/skylab/demo-import/7dq2c28byq4ede6z/';
  } else {
	$path = '';
  }
  return array(
    array(
      'import_file_name'           => 'Loraine',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'loraine/andrjosselin.wordpress.2018-12-25.xml',
      'import_widget_file_url'     => $path .'loraine/demo.megathe.me-skylab-loraine-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/loraine.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/loraine/',
    ),
    array(
      'import_file_name'           => 'Candie',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'candie/juliendhivert.wordpress.2019-02-11.xml',
      'import_widget_file_url'     => $path .'candie/demo.megathe.me-skylab-candie-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/candie.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/candie/',
    ),
	array(
      'import_file_name'           => 'Vivienne',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'vivienne/felipeissas.wordpress.2018-12-25.xml',
      'import_widget_file_url'     => $path .'vivienne/demo.megathe.me-skylab-vivienne-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/vivienne.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/vivienne/',
    ),
	array(
      'import_file_name'           => 'Christen',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'christen/ba-ba.wordpress.2018-12-25.xml',
      'import_widget_file_url'     => $path .'christen/demo.megathe.me-skylab-christen-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/christen.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/christen/',
    ),
	array(
      'import_file_name'           => 'Farah',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'farah/familia.wordpress.2019-02-15.xml',
      'import_widget_file_url'     => $path .'farah/demo.megathe.me-skylab-farah-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/farah.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/farah/',
    ),
	array(
      'import_file_name'           => 'Tashia',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'tashia/joseherrera.wordpress.2018-12-25.xml',
      'import_widget_file_url'     => $path .'tashia/demo.megathe.me-skylab-tashia-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/tashia.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/tashia/',
    ),
	array(
      'import_file_name'           => 'Estella',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'estella/wtr.wordpress.2018-12-25.xml',
      'import_widget_file_url'     => $path .'estella/demo.megathe.me-skylab-estella-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/estella.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/estella/',
    ),
	array(
      'import_file_name'           => 'Vernice',
      'categories'                 => array( 'Fullscreen', 'Horizontal', 'Slideshow' ),
      'import_file_url'            => $path .'vernice/affob.wordpress.2018-12-25.xml',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/vernice.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/vernice/',
    ),
	array(
      'import_file_name'           => 'Florance',
      'categories'                 => array( 'Horizontal', 'Slideshow' ),
      'import_file_url'            => $path .'florance/zsfiajmbor.wordpress.2018-12-25.xml',
      'import_widget_file_url'     => $path .'florance/demo.megathe.me-skylab-florance-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/florance.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/florance/',
    ),
	array(
      'import_file_name'           => 'Jettie',
      'categories'                 => array( 'Horizontal', 'Slideshow' ),
      'import_file_url'            => $path .'jettie/pierreturtaut.wordpress.2018-12-25.xml',
      'import_widget_file_url'     => $path .'jettie/demo.megathe.me-skylab-jettie-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/jettie.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/jettie/',
    ),
	array(
      'import_file_name'           => 'Rashida',
      'categories'                 => array( 'Horizontal', 'Slideshow' ),
      'import_file_url'            => $path .'rashida/yugotakahashi.wordpress.2018-12-25.xml',
      'import_widget_file_url'     => $path .'rashida/demo.megathe.me-skylab-rashida-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/rashida.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/rashida/',
    ),
	array(
      'import_file_name'           => 'Romelia',
      'categories'                 => array( 'Horizontal', 'Slideshow' ),
      'import_file_url'            => $path .'romelia/henrikadamsen.wordpress.2018-12-25.xml',
	  'import_widget_file_url'     => $path .'romelia/demo.megathe.me-skylab-romelia-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/romelia.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/romelia/',
    ),
	array(
      'import_file_name'           => 'Heather',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'heather/caterinabianchinistudio.wordpress.2019-02-11.xml',
	  'import_widget_file_url'     => $path .'heather/demo.megathe.me-skylab-heather-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/heather.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/heather/',
    ),
	array(
      'import_file_name'           => 'Eileen',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'eileen/holgernitschke.wordpress.2019-02-11.xml',
	  'import_widget_file_url'     => $path .'eileen/demo.megathe.me-skylab-eileen-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/eileen.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/eileen/',
    ),
	array(
      'import_file_name'           => 'Claire',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'claire/katiforner.wordpress.2019-02-15.xml',
	  'import_widget_file_url'     => $path .'claire/demo.megathe.me-skylab-claire-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/claire.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/claire/',
    ),
	array(
      'import_file_name'           => 'Wendy',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'wendy/shift.wordpress.2019-02-04.xml',
	  'import_widget_file_url'     => $path .'wendy/demo.megathe.me-skylab-wendy-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/wendy.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/wendy/',
    ),
	array(
      'import_file_name'           => 'Iris',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'iris/nouvelleadministration.wordpress.2019-02-04.xml',
	  'import_widget_file_url'     => $path .'iris/demo.megathe.me-skylab-iris-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/iris.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/iris/',
    ),
	array(
      'import_file_name'           => 'Paulette',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'paulette/simonlalibert.wordpress.2019-02-04.xml',
	  'import_widget_file_url'     => $path .'paulette/demo.megathe.me-skylab-paulette-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/paulette.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/paulette/',
    ),
	array(
      'import_file_name'           => 'Marsha',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'marsha/gianlucagelmini.wordpress.2019-02-15.xml',
	  'import_widget_file_url'     => $path .'marsha/demo.megathe.me-skylab-marsha-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/marsha.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/marsha/',
    ),
	array(
      'import_file_name'           => 'Erin',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'erin/lucyguernier.wordpress.2019-02-11.xml',
	  'import_widget_file_url'     => $path .'erin/demo.megathe.me-skylab-erin-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/erin.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/erin/',
    ),
	array(
      'import_file_name'           => 'Heidi',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'heidi/raphaeliglesias.wordpress.2019-02-04.xml',
	  'import_widget_file_url'     => $path .'heidi/demo.megathe.me-skylab-heidi-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/heidi.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/heidi/',
    ),
	array(
      'import_file_name'           => 'Stacy',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'stacy/morganstephens.wordpress.2019-02-04.xml',
	  'import_widget_file_url'     => $path .'stacy/demo.megathe.me-skylab-stacy-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/stacy.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/stacy/',
    ),
	array(
      'import_file_name'           => 'April',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'april/martinacrepulja.wordpress.2019-02-04.xml',
	  'import_widget_file_url'     => $path .'april/demo.megathe.me-skylab-april-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/april.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/april/',
    ),
	array(
      'import_file_name'           => 'Mindy',
      'categories'                 => array( 'Tiled', 'Vertical' ),
      'import_file_url'            => $path .'mindy/przemekbizon.wordpress.2019-02-11.xml',
	  'import_widget_file_url'     => $path .'mindy/demo.megathe.me-skylab-mindy-widgets.wie',
      'import_preview_image_url'   => 'http://demo.megathe.me/skylab/demo-import/screenshots/mindy.jpg',
      'import_notice'              => '',
      'preview_url'                => 'http://demo.megathe.me/skylab/mindy/',
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'mega_import_files' );

// Import button
function mega_remove_import_button( $hook ) {
	$output='<style>
	.js-ocdi-gl-import-data {
		display: none !important;
	}
	</style>
	<script>
	document.addEventListener("DOMContentLoaded", function(event) {
		var oneClickDemoImportButton = document.querySelectorAll(".js-ocdi-gl-import-data");
		Array.prototype.forEach.call( oneClickDemoImportButton, function( node ) {
			node.parentNode.removeChild( node );
		});
	});
	</script>';
	$verified = get_option('mega_theme_verify');
	if ( $hook == 'appearance_page_pt-one-click-demo-import' && $verified != true ) {
		echo $output;
	}
}
add_action( 'admin_enqueue_scripts', 'mega_remove_import_button' );

// Disable generation of smaller images during the content import
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

// Disable import branding
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function mega_after_import( $selected_import ) {
	$verified = get_option('mega_theme_verify');
	if ( $verified == true ) {
		$path = '/var/www/vhosts/xc6m-pw6r.accessdomain.com/demo.megathe.me/skylab/demo-import/7dq2c28byq4ede6z/';
	} else {
		$path = '';
	}
	// Blog pages show at most
	update_option( 'posts_per_page', 5 );
	// Syndication feeds show the most recent
	update_option( 'posts_per_rss', 5 );
	// For each article in a feed, show
	update_option( 'rss_use_excerpt', 1 );
	if ( 'Loraine' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 870 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Loraine', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);

		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjU6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjI0IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6ImxvZ29fZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjE5OiJsb2dvX2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6ImxvZ29fZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6NDoibG9nbyI7czowOiIiO3M6Mjc6ImxvZ29fZm9yX3RyYW5zcGFyZW50X2hlYWRlciI7czowOiIiO3M6MTU6ImhlaWdodF9mb3JfbG9nbyI7czoyOiIxOCI7czoxMjoiYWNjZW50X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTA6ImJvZHlfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMzoicHJpbWFyeV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE1OiJzZWNvbmRhcnlfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoxMToidGhpcmRfY29sb3IiO3M6NzoiI2YyZjJmMiI7czoxMzoiYm9yZGVyc19jb2xvciI7czo3OiIjZTZlNmU2IjtzOjExOiJsaW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJsaW5rc19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIyOiJwYWdlX2xvYWRfcHJvZ3Jlc3NfYmFyIjtzOjc6ImVuYWJsZWQiO3M6Mjg6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXJfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMDoibW9iaWxlX21lbnVfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMzoibG9nb19nb29nbGVfZm9udF9mYW1pbHkiO3M6MDoiIjtzOjIxOiJsb2dvX2dvb2dsZV9mb250X25hbWUiO3M6MDoiIjtzOjE4OiJwcmltYXJ5X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoxODoiZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjU3OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9OjQwMCw0MDBpLDcwMCw5MDAiO3M6MTY6Imdvb2dsZV9mb250X25hbWUiO3M6NDoiTGF0byI7czoxNToibWVudV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjM6Im1lbnVfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjYxOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9TGF0bzo0MDAsNDAwaSw3MDAsOTAwIjtzOjIxOiJtZW51X2dvb2dsZV9mb250X25hbWUiO3M6NDoiTGF0byI7czoxNDoibWVudV9mb250X3NpemUiO3M6MjoiMTIiO3M6MzE6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6Im1lbnVfdGV4dF90cmFuc2Zvcm0iO3M6OToidXBwZXJjYXNlIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfdGV4dF90cmFuc2Zvcm0iO3M6NDoibm9uZSI7czoxNjoibWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MzM6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MTk6Im1lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMiI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6Im1lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MzI6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czoyNjoibWVudV90ZXh0X2RlY29yYXRpb25faG92ZXIiO3M6NDoibm9uZSI7czoxODoiaGVhZGluZ190eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjY6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjQ3OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9THVzdHJpYSI7czoyNDoiaGVhZGluZ19nb29nbGVfZm9udF9uYW1lIjtzOjc6Ikx1c3RyaWEiO3M6MTQ6ImJvZHlfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJoZWFkaW5nX2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czoyMToibGlua3NfdGV4dF9kZWNvcmF0aW9uIjtzOjk6InVuZGVybGluZSI7czoxNjoibGlua3NfZm9udF9zdHlsZSI7czo2OiJpdGFsaWMiO3M6MTI6ImhlYWRlcl9zdHlsZSI7czo5OiJub25fZml4ZWQiO3M6MzM6ImhlYWRlcl9oZWlnaHRfcmVkdWN0aW9uX3Njcm9sbGluZyI7czo3OiJkaXNhYmxlIjtzOjEzOiJoZWFkZXJfaGVpZ2h0IjtzOjM6IjE5OCI7czoyNjoiaGVhZGVyX2hlaWdodF9vbl9zY3JvbGxpbmciO3M6MzoiMTEyIjtzOjE1OiJoZWFkZXJfcG9zaXRpb24iO3M6MzoidG9wIjtzOjEyOiJsb2dvX2NhcHRpb24iO3M6MDoiIjtzOjEwOiJidXR0b25fdXJsIjtzOjA6IiI7czoxMToiYnV0dG9uX3RleHQiO3M6MDoiIjtzOjIxOiJzb2NpYWxfaWNvbnNfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMjoic2VhcmNoX2hlYWRlcl9wb3NpdGlvbiI7czo0OiJub25lIjtzOjExOiJoZWFkZXJfaW5mbyI7czowOiIiO3M6MjU6Indvb2NvbW1lcmNlX2NhcnRfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMzoiaGVhZGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMToibmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiM5OTk5OTkiO3M6Mjc6Im5hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJoZWFkZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI1OiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImhlYWRlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czoyMzoiaGVhZGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoyNjoiaGVhZGVyX2JvdHRvbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxMzoibWVudV9wb3NpdGlvbiI7czo1OiJyaWdodCI7czoxMzoibG9nb19wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIwOiJzZWNvbmRhcnlfbWVudV9hbGlnbiI7czo1OiJyaWdodCI7czoxMjoidG9wX2Jhcl9pbmZvIjtzOjA6IiI7czoxODoidG9wX2Jhcl9pbmZvX2FsaWduIjtzOjU6InJpZ2h0IjtzOjI0OiJ0b3BfYmFyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxODoidG9wX2Jhcl90ZXh0X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6InRvcF9iYXJfbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJ0b3BfYmFyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyNjoidG9wX2Jhcl9zb2NpYWxfaWNvbnNfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoiYmFja190b190b3BfYnV0dG9uIjtzOjY6ImVuYWJsZSI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2FsaWduIjtzOjU6ImZpeGVkIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3IiO3M6NzoiIzAwMDAwMCI7czozMDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjU6ImZvb3Rlcl93aWRnZXRfdGl0bGVfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNzoiZm9vdGVyX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNjoiZm9vdGVyX3RleHRfc2l6ZSI7czoyOiIxMyI7czoxNzoiZm9vdGVyX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX3RleHRfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoyNToiZm9vdGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJmb290ZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MzA6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfcGFkZGluZyI7czoyOiI1MCI7czozMzoiZm9vdGVyX2JvdHRvbV9hcmVhX2JvdHRvbV9wYWRkaW5nIjtzOjM6IjEwMCI7czoyMzoiZm9vdGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxNToiZm9vdGVyX3BhcmFsbGF4IjtzOjc6ImRpc2FibGUiO3M6Mjc6InNpbmdsZV9wb3J0Zm9saW9fbmF2aWdhdGlvbiI7czo2OiJlbmFibGUiO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjA6IiI7czoyMjoic2luZ2xlX3Bvc3RfbmF2aWdhdGlvbiI7czo2OiJlbmFibGUiO3M6MTg6InNvY2lhbF9saW5rc19zdHlsZSI7czoxOiIyIjtzOjEyOiJzb2NpYWxfbGlua3MiO2E6Mzp7aTowO3M6NzoidHdpdHRlciI7aToxO3M6ODoiZmFjZWJvb2siO2k6MztzOjk6Imluc3RhZ3JhbSI7fXM6MTE6InR3aXR0ZXJfdXJsIjtzOjIwOiJodHRwczovL3R3aXR0ZXIuY29tLyI7czoxMjoiZmFjZWJvb2tfdXJsIjtzOjI0OiJodHRwOi8vd3d3LmZhY2Vib29rLmNvbS8iO3M6MTM6Imluc3RhZ3JhbV91cmwiO3M6MjE6Imh0dHA6Ly9pbnN0YWdyYW0uY29tLyI7czoxMjoibGlua2VkaW5fdXJsIjtzOjI0OiJodHRwOi8vd3d3LmxpbmtlZGluLmNvbS8iO3M6MTM6InBpbnRlcmVzdF91cmwiO3M6MjE6Imh0dHA6Ly9waW50ZXJlc3QuY29tLyI7czo5OiJncGx1c191cmwiO3M6MjQ6Imh0dHBzOi8vcGx1cy5nb29nbGUuY29tLyI7czo5OiJ2aW1lb191cmwiO3M6MTc6Imh0dHA6Ly92aW1lby5jb20vIjtzOjEwOiJmbGlja3JfdXJsIjtzOjIyOiJodHRwOi8vd3d3LmZsaWNrci5jb20vIjtzOjEwOiJ0dW1ibHJfdXJsIjtzOjIzOiJodHRwczovL3d3dy50dW1ibHIuY29tLyI7czoxMToieW91dHViZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cueW91dHViZS5jb20vIjtzOjEyOiJkcmliYmJsZV91cmwiO3M6MjA6Imh0dHA6Ly9kcmliYmJsZS5jb20vIjtzOjExOiJiZWhhbmNlX3VybCI7czoyMzoiaHR0cDovL3d3dy5iZWhhbmNlLm5ldC8iO3M6NjoicHhfdXJsIjtzOjE4OiJodHRwczovLzUwMHB4LmNvbS8iO3M6NjoidmtfdXJsIjtzOjE0OiJodHRwOi8vdmsuY29tLyI7czoxMzoiZW1haWxfYWRkcmVzcyI7czoyMzoicGxhY2Vob2xkZXJAZXhhbXBsZS5jb20iO3M6MjQ6ImVuYWJsZV93b29jb21tZXJjZV9saW5rcyI7czo3OiJkaXNhYmxlIjtzOjExOiJzaG9wX2xheW91dCI7czoxMjoibGVmdC1zaWRlYmFyIjtzOjEyOiJzaG9wX2NvbHVtbnMiO3M6MToiMyI7czoyNjoiaGVhZGVyX2JhY2tncm91bmRfZm9yX3Nob3AiO3M6MDoiIjtzOjM0OiJhZGRfdG9fY2FydF90ZXh0X29uX3NpbmdsZV9wcm9kdWN0IjtzOjA6IiI7czoyMzoicmV2b2x1dGlvbl9zbGlkZXJfYWxpYXMiO3M6MDoiIjtzOjM4OiJhZGRpdGlvbmFsX2luZm9fb25fc2luZ2xlX3Byb2R1Y3RfcGFnZSI7czowOiIiO30=';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Candie' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 870 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Candie', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjY6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjk6InVwcGVyY2FzZSI7czoxNjoibG9nb19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MTk6ImxvZ29fbGV0dGVyX3NwYWNpbmciO3M6MToiNCI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjZjJmMmYyIjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czowOiIiO3M6MjE6ImxvZ29fZ29vZ2xlX2ZvbnRfbmFtZSI7czowOiIiO3M6MTg6InByaW1hcnlfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjE4OiJnb29nbGVfZm9udF9mYW1pbHkiO3M6NTY6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1NdWxpOjQwMCw2MDAsNzAwIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjQ6Ik11bGkiO3M6MTU6Im1lbnVfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjIzOiJtZW51X2dvb2dsZV9mb250X2ZhbWlseSI7czo1NjoiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PU11bGk6NDAwLDYwMCw3MDAiO3M6MjE6Im1lbnVfZ29vZ2xlX2ZvbnRfbmFtZSI7czo0OiJNdWxpIjtzOjE0OiJtZW51X2ZvbnRfc2l6ZSI7czoyOiIxMiI7czozMToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToibWVudV90ZXh0X3RyYW5zZm9ybSI7czo5OiJ1cHBlcmNhc2UiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV90ZXh0X3RyYW5zZm9ybSI7czo0OiJub25lIjtzOjE2OiJtZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjYwMCI7czozMzoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czoxOToibWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIyIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czoxNToibWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czozMjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjI2OiJtZW51X3RleHRfZGVjb3JhdGlvbl9ob3ZlciI7czo0OiJub25lIjtzOjE4OiJoZWFkaW5nX3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyNjoiaGVhZGluZ19nb29nbGVfZm9udF9mYW1pbHkiO3M6NTk6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1QaGlsb3NvcGhlcjo0MDAsNzAwIjtzOjI0OiJoZWFkaW5nX2dvb2dsZV9mb250X25hbWUiO3M6MTE6IlBoaWxvc29waGVyIjtzOjE0OiJib2R5X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToiaGVhZGluZ19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MjE6ImxpbmtzX3RleHRfZGVjb3JhdGlvbiI7czo5OiJ1bmRlcmxpbmUiO3M6MTY6ImxpbmtzX2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjEyOiJoZWFkZXJfc3R5bGUiO3M6OToibm9uX2ZpeGVkIjtzOjMzOiJoZWFkZXJfaGVpZ2h0X3JlZHVjdGlvbl9zY3JvbGxpbmciO3M6NzoiZGlzYWJsZSI7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIxMzAiO3M6MjY6ImhlYWRlcl9oZWlnaHRfb25fc2Nyb2xsaW5nIjtzOjI6IjU0IjtzOjI4OiJlbmFibGVfZnVsbF93aWR0aF9mb3JfaGVhZGVyIjthOjE6e2k6MDtzOjM6InllcyI7fXM6MTU6ImhlYWRlcl9wb3NpdGlvbiI7czozOiJ0b3AiO3M6MTI6ImxvZ29fY2FwdGlvbiI7czowOiIiO3M6MTA6ImJ1dHRvbl91cmwiO3M6MDoiIjtzOjExOiJidXR0b25fdGV4dCI7czowOiIiO3M6MjE6InNvY2lhbF9pY29uc19wb3NpdGlvbiI7czo0OiJub25lIjtzOjIyOiJzZWFyY2hfaGVhZGVyX3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MTE6ImhlYWRlcl9pbmZvIjtzOjA6IiI7czoyNToid29vY29tbWVyY2VfY2FydF9wb3NpdGlvbiI7czo0OiJub25lIjtzOjIzOiJoZWFkZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjIxOiJuYXZpZ2F0aW9uX2xpbmtfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoyNzoibmF2aWdhdGlvbl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImhlYWRlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImhlYWRlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImhlYWRlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImhlYWRlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoyNDoiaGVhZGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjIzOiJoZWFkZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjI2OiJoZWFkZXJfYm90dG9tX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjEzOiJtZW51X3Bvc2l0aW9uIjtzOjU6InJpZ2h0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MjA6InNlY29uZGFyeV9tZW51X2FsaWduIjtzOjU6InJpZ2h0IjtzOjEyOiJ0b3BfYmFyX2luZm8iO3M6MDoiIjtzOjE4OiJ0b3BfYmFyX2luZm9fYWxpZ24iO3M6NToicmlnaHQiO3M6MjQ6InRvcF9iYXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE4OiJ0b3BfYmFyX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoidG9wX2Jhcl9saW5rX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjQ6InRvcF9iYXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjI2OiJ0b3BfYmFyX3NvY2lhbF9pY29uc19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJiYWNrX3RvX3RvcF9idXR0b24iO3M6NjoiZW5hYmxlIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fYWxpZ24iO3M6NToiZml4ZWQiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjMwOiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNToiZm9vdGVyX3dpZGdldF90aXRsZV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJmb290ZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE2OiJmb290ZXJfdGV4dF9zaXplIjtzOjI6IjEzIjtzOjE3OiJmb290ZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI5OiJmb290ZXJfYm90dG9tX2FyZWFfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI5OiJmb290ZXJfYm90dG9tX2FyZWFfdGV4dF9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjI1OiJmb290ZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImZvb3Rlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czozMDoiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9wYWRkaW5nIjtzOjI6IjUwIjtzOjMzOiJmb290ZXJfYm90dG9tX2FyZWFfYm90dG9tX3BhZGRpbmciO3M6MjoiNTAiO3M6MjM6ImZvb3Rlcl90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTU6ImZvb3Rlcl9wYXJhbGxheCI7czo2OiJlbmFibGUiO3M6Mjc6InNpbmdsZV9wb3J0Zm9saW9fbmF2aWdhdGlvbiI7czo2OiJlbmFibGUiO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjA6IiI7czoyMjoic2luZ2xlX3Bvc3RfbmF2aWdhdGlvbiI7czo2OiJlbmFibGUiO3M6MTg6InNvY2lhbF9saW5rc19zdHlsZSI7czoxOiIyIjtzOjEyOiJzb2NpYWxfbGlua3MiO2E6NDp7aTowO3M6NzoidHdpdHRlciI7aToxO3M6ODoiZmFjZWJvb2siO2k6MztzOjk6Imluc3RhZ3JhbSI7aToxNDtzOjU6ImVtYWlsIjt9czoxMToidHdpdHRlcl91cmwiO3M6MjA6Imh0dHBzOi8vdHdpdHRlci5jb20vIjtzOjEyOiJmYWNlYm9va191cmwiO3M6MjQ6Imh0dHA6Ly93d3cuZmFjZWJvb2suY29tLyI7czoxMzoiaW5zdGFncmFtX3VybCI7czoyMToiaHR0cDovL2luc3RhZ3JhbS5jb20vIjtzOjEyOiJsaW5rZWRpbl91cmwiO3M6MjQ6Imh0dHA6Ly93d3cubGlua2VkaW4uY29tLyI7czoxMzoicGludGVyZXN0X3VybCI7czoyMToiaHR0cDovL3BpbnRlcmVzdC5jb20vIjtzOjk6ImdwbHVzX3VybCI7czoyNDoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20vIjtzOjk6InZpbWVvX3VybCI7czoxNzoiaHR0cDovL3ZpbWVvLmNvbS8iO3M6MTA6ImZsaWNrcl91cmwiO3M6MjI6Imh0dHA6Ly93d3cuZmxpY2tyLmNvbS8iO3M6MTA6InR1bWJscl91cmwiO3M6MjM6Imh0dHBzOi8vd3d3LnR1bWJsci5jb20vIjtzOjExOiJ5b3V0dWJlX3VybCI7czoyMzoiaHR0cDovL3d3dy55b3V0dWJlLmNvbS8iO3M6MTI6ImRyaWJiYmxlX3VybCI7czoyMDoiaHR0cDovL2RyaWJiYmxlLmNvbS8iO3M6MTE6ImJlaGFuY2VfdXJsIjtzOjIzOiJodHRwOi8vd3d3LmJlaGFuY2UubmV0LyI7czo2OiJweF91cmwiO3M6MTg6Imh0dHBzOi8vNTAwcHguY29tLyI7czo2OiJ2a191cmwiO3M6MTQ6Imh0dHA6Ly92ay5jb20vIjtzOjEzOiJlbWFpbF9hZGRyZXNzIjtzOjIzOiJwbGFjZWhvbGRlckBleGFtcGxlLmNvbSI7czoyNDoiZW5hYmxlX3dvb2NvbW1lcmNlX2xpbmtzIjtzOjc6ImRpc2FibGUiO3M6MTE6InNob3BfbGF5b3V0IjtzOjEyOiJsZWZ0LXNpZGViYXIiO3M6MTI6InNob3BfY29sdW1ucyI7czoxOiIzIjtzOjI2OiJoZWFkZXJfYmFja2dyb3VuZF9mb3Jfc2hvcCI7czowOiIiO3M6MzQ6ImFkZF90b19jYXJ0X3RleHRfb25fc2luZ2xlX3Byb2R1Y3QiO3M6MDoiIjtzOjIzOiJyZXZvbHV0aW9uX3NsaWRlcl9hbGlhcyI7czowOiIiO3M6Mzg6ImFkZGl0aW9uYWxfaW5mb19vbl9zaW5nbGVfcHJvZHVjdF9wYWdlIjtzOjA6IiI7fQ==';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Vivienne' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Vivienne', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjc6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjI0IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6ImxvZ29fZm9udF93ZWlnaHQiO3M6MzoiOTAwIjtzOjE5OiJsb2dvX2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6ImxvZ29fZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6NDoibG9nbyI7czowOiIiO3M6Mjc6ImxvZ29fZm9yX3RyYW5zcGFyZW50X2hlYWRlciI7czowOiIiO3M6MTU6ImhlaWdodF9mb3JfbG9nbyI7czoyOiIxOCI7czoxMjoiYWNjZW50X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTA6ImJvZHlfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMzoicHJpbWFyeV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE1OiJzZWNvbmRhcnlfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoxMToidGhpcmRfY29sb3IiO3M6NzoiI2YyZjJmMiI7czoxMzoiYm9yZGVyc19jb2xvciI7czo3OiIjZTZlNmU2IjtzOjExOiJsaW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJsaW5rc19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIyOiJwYWdlX2xvYWRfcHJvZ3Jlc3NfYmFyIjtzOjc6ImVuYWJsZWQiO3M6Mjg6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXJfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMDoibW9iaWxlX21lbnVfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMzoibG9nb19nb29nbGVfZm9udF9mYW1pbHkiO3M6MDoiIjtzOjIxOiJsb2dvX2dvb2dsZV9mb250X25hbWUiO3M6MDoiIjtzOjE4OiJwcmltYXJ5X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoxODoiZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjYwOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9VGF2aXJhajo0MDAsNDAwaSw3MDAiO3M6MTY6Imdvb2dsZV9mb250X25hbWUiO3M6NzoiVGF2aXJhaiI7czoxNToibWVudV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjM6Im1lbnVfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjYwOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9VGF2aXJhajo0MDAsNDAwaSw3MDAiO3M6MjE6Im1lbnVfZ29vZ2xlX2ZvbnRfbmFtZSI7czo3OiJUYXZpcmFqIjtzOjE0OiJtZW51X2ZvbnRfc2l6ZSI7czoyOiIxOCI7czozMToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToibWVudV90ZXh0X3RyYW5zZm9ybSI7czo0OiJub25lIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfdGV4dF90cmFuc2Zvcm0iO3M6NDoibm9uZSI7czoxNjoibWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MzM6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MTk6Im1lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6Im1lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MzI6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czoyNjoibWVudV90ZXh0X2RlY29yYXRpb25faG92ZXIiO3M6OToidW5kZXJsaW5lIjtzOjE4OiJoZWFkaW5nX3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyNjoiaGVhZGluZ19nb29nbGVfZm9udF9mYW1pbHkiO3M6NTc6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Xb3JrK1NhbnM6NzAwLDkwMCI7czoyNDoiaGVhZGluZ19nb29nbGVfZm9udF9uYW1lIjtzOjk6IldvcmsgU2FucyI7czoxNDoiYm9keV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6ImhlYWRpbmdfZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjIxOiJsaW5rc190ZXh0X2RlY29yYXRpb24iO3M6OToidW5kZXJsaW5lIjtzOjE2OiJsaW5rc19mb250X3N0eWxlIjtzOjY6Iml0YWxpYyI7czoxMjoiaGVhZGVyX3N0eWxlIjtzOjU6ImZpeGVkIjtzOjMzOiJoZWFkZXJfaGVpZ2h0X3JlZHVjdGlvbl9zY3JvbGxpbmciO3M6NzoiZGlzYWJsZSI7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIxMDQiO3M6MjY6ImhlYWRlcl9oZWlnaHRfb25fc2Nyb2xsaW5nIjtzOjI6IjU0IjtzOjE1OiJoZWFkZXJfcG9zaXRpb24iO3M6MzoidG9wIjtzOjEyOiJsb2dvX2NhcHRpb24iO3M6MDoiIjtzOjEwOiJidXR0b25fdXJsIjtzOjA6IiI7czoxMToiYnV0dG9uX3RleHQiO3M6MDoiIjtzOjIxOiJzb2NpYWxfaWNvbnNfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMjoic2VhcmNoX2hlYWRlcl9wb3NpdGlvbiI7czo0OiJub25lIjtzOjExOiJoZWFkZXJfaW5mbyI7czowOiIiO3M6MjU6Indvb2NvbW1lcmNlX2NhcnRfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMzoiaGVhZGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMToibmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6Mjc6Im5hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJoZWFkZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI1OiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImhlYWRlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czoyMzoiaGVhZGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoyNjoiaGVhZGVyX2JvdHRvbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxMzoibWVudV9wb3NpdGlvbiI7czo1OiJyaWdodCI7czoxMzoibG9nb19wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjE4OiJtZW51X29wYWNpdHlfaG92ZXIiO2E6MTp7aTowO3M6MzoieWVzIjt9czoyMDoic2Vjb25kYXJ5X21lbnVfYWxpZ24iO3M6NToicmlnaHQiO3M6MTI6InRvcF9iYXJfaW5mbyI7czowOiIiO3M6MTg6InRvcF9iYXJfaW5mb19hbGlnbiI7czo1OiJyaWdodCI7czoyNDoidG9wX2Jhcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTg6InRvcF9iYXJfdGV4dF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJ0b3BfYmFyX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNDoidG9wX2Jhcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjY6InRvcF9iYXJfc29jaWFsX2ljb25zX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6ImJhY2tfdG9fdG9wX2J1dHRvbiI7czo2OiJlbmFibGUiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9hbGlnbiI7czo1OiJmaXhlZCI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzA6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI1OiJmb290ZXJfd2lkZ2V0X3RpdGxlX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImZvb3Rlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTY6ImZvb3Rlcl90ZXh0X3NpemUiO3M6MjoiMTMiO3M6MTc6ImZvb3Rlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImZvb3Rlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNDoiZm9vdGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjE2IjtzOjMwOiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX3BhZGRpbmciO3M6MjoiNTAiO3M6MzM6ImZvb3Rlcl9ib3R0b21fYXJlYV9ib3R0b21fcGFkZGluZyI7czoyOiI4MiI7czoyMzoiZm9vdGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxNToiZm9vdGVyX3BhcmFsbGF4IjtzOjc6ImRpc2FibGUiO3M6Mjc6InNpbmdsZV9wb3J0Zm9saW9fbmF2aWdhdGlvbiI7czo2OiJlbmFibGUiO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjA6IiI7czoyMjoic2luZ2xlX3Bvc3RfbmF2aWdhdGlvbiI7czo2OiJlbmFibGUiO3M6MTg6InNvY2lhbF9saW5rc19zdHlsZSI7czoxOiIxIjtzOjI2OiJzb2NpYWxfbGlua3Nfb3BhY2l0eV9ob3ZlciI7YToxOntpOjA7czozOiJ5ZXMiO31zOjEyOiJzb2NpYWxfbGlua3MiO2E6NDp7aToxO3M6ODoiZmFjZWJvb2siO2k6MjtzOjg6ImxpbmtlZGluIjtpOjM7czo5OiJpbnN0YWdyYW0iO2k6NjtzOjU6InZpbWVvIjt9czoxMToidHdpdHRlcl91cmwiO3M6MjA6Imh0dHBzOi8vdHdpdHRlci5jb20vIjtzOjEyOiJmYWNlYm9va191cmwiO3M6MjQ6Imh0dHA6Ly93d3cuZmFjZWJvb2suY29tLyI7czoxMzoiaW5zdGFncmFtX3VybCI7czoyMToiaHR0cDovL2luc3RhZ3JhbS5jb20vIjtzOjEyOiJsaW5rZWRpbl91cmwiO3M6MjQ6Imh0dHA6Ly93d3cubGlua2VkaW4uY29tLyI7czoxMzoicGludGVyZXN0X3VybCI7czoyMToiaHR0cDovL3BpbnRlcmVzdC5jb20vIjtzOjk6ImdwbHVzX3VybCI7czoyNDoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20vIjtzOjk6InZpbWVvX3VybCI7czoxNzoiaHR0cDovL3ZpbWVvLmNvbS8iO3M6MTA6ImZsaWNrcl91cmwiO3M6MjI6Imh0dHA6Ly93d3cuZmxpY2tyLmNvbS8iO3M6MTA6InR1bWJscl91cmwiO3M6MjM6Imh0dHBzOi8vd3d3LnR1bWJsci5jb20vIjtzOjExOiJ5b3V0dWJlX3VybCI7czoyMzoiaHR0cDovL3d3dy55b3V0dWJlLmNvbS8iO3M6MTI6ImRyaWJiYmxlX3VybCI7czoyMDoiaHR0cDovL2RyaWJiYmxlLmNvbS8iO3M6MTE6ImJlaGFuY2VfdXJsIjtzOjIzOiJodHRwOi8vd3d3LmJlaGFuY2UubmV0LyI7czo2OiJweF91cmwiO3M6MTg6Imh0dHBzOi8vNTAwcHguY29tLyI7czo2OiJ2a191cmwiO3M6MTQ6Imh0dHA6Ly92ay5jb20vIjtzOjEzOiJlbWFpbF9hZGRyZXNzIjtzOjIzOiJwbGFjZWhvbGRlckBleGFtcGxlLmNvbSI7czoyNDoiZW5hYmxlX3dvb2NvbW1lcmNlX2xpbmtzIjtzOjc6ImRpc2FibGUiO3M6MTE6InNob3BfbGF5b3V0IjtzOjEyOiJsZWZ0LXNpZGViYXIiO3M6MTI6InNob3BfY29sdW1ucyI7czoxOiIzIjtzOjI2OiJoZWFkZXJfYmFja2dyb3VuZF9mb3Jfc2hvcCI7czowOiIiO3M6MzQ6ImFkZF90b19jYXJ0X3RleHRfb25fc2luZ2xlX3Byb2R1Y3QiO3M6MDoiIjtzOjIzOiJyZXZvbHV0aW9uX3NsaWRlcl9hbGlhcyI7czowOiIiO3M6Mzg6ImFkZGl0aW9uYWxfaW5mb19vbl9zaW5nbGVfcHJvZHVjdF9wYWdlIjtzOjA6IiI7fQ==';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Christen' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Christen', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjc6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjE4IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjk6Imxvd2VyY2FzZSI7czoxNjoibG9nb19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MTk6ImxvZ29fbGV0dGVyX3NwYWNpbmciO3M6MToiNCI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjZjJmMmYyIjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czowOiIiO3M6MjE6ImxvZ29fZ29vZ2xlX2ZvbnRfbmFtZSI7czowOiIiO3M6MTg6InByaW1hcnlfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjE4OiJnb29nbGVfZm9udF9mYW1pbHkiO3M6NTk6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1JbmNvbnNvbGF0YTo0MDAsNzAwIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjExOiJJbmNvbnNvbGF0YSI7czoxNToibWVudV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjM6Im1lbnVfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjU5OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9SW5jb25zb2xhdGE6NDAwLDcwMCI7czoyMToibWVudV9nb29nbGVfZm9udF9uYW1lIjtzOjExOiJJbmNvbnNvbGF0YSI7czoxNDoibWVudV9mb250X3NpemUiO3M6MjoiMTYiO3M6MzE6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6Im1lbnVfdGV4dF90cmFuc2Zvcm0iO3M6NDoibm9uZSI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6Im1lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjMzOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjE5OiJtZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIwIjtzOjE1OiJtZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjMyOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MjY6Im1lbnVfdGV4dF9kZWNvcmF0aW9uX2hvdmVyIjtzOjk6InVuZGVybGluZSI7czoxODoiaGVhZGluZ190eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjY6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjUzOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9S2FybGE6NDAwLDcwMCI7czoyNDoiaGVhZGluZ19nb29nbGVfZm9udF9uYW1lIjtzOjU6IkthcmxhIjtzOjE0OiJib2R5X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToiaGVhZGluZ19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MjE6ImxpbmtzX3RleHRfZGVjb3JhdGlvbiI7czo5OiJ1bmRlcmxpbmUiO3M6MTY6ImxpbmtzX2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjEyOiJoZWFkZXJfc3R5bGUiO3M6NToiZml4ZWQiO3M6MzM6ImhlYWRlcl9oZWlnaHRfcmVkdWN0aW9uX3Njcm9sbGluZyI7czo3OiJkaXNhYmxlIjtzOjEzOiJoZWFkZXJfaGVpZ2h0IjtzOjI6IjY0IjtzOjI2OiJoZWFkZXJfaGVpZ2h0X29uX3Njcm9sbGluZyI7czoyOiI1NCI7czoyODoiZW5hYmxlX2Z1bGxfd2lkdGhfZm9yX2hlYWRlciI7YToxOntpOjA7czozOiJ5ZXMiO31zOjE1OiJoZWFkZXJfcG9zaXRpb24iO3M6MzoidG9wIjtzOjEyOiJsb2dvX2NhcHRpb24iO3M6MDoiIjtzOjEwOiJidXR0b25fdXJsIjtzOjA6IiI7czoxMToiYnV0dG9uX3RleHQiO3M6MDoiIjtzOjIxOiJzb2NpYWxfaWNvbnNfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMjoic2VhcmNoX2hlYWRlcl9wb3NpdGlvbiI7czo0OiJub25lIjtzOjExOiJoZWFkZXJfaW5mbyI7czowOiIiO3M6MjU6Indvb2NvbW1lcmNlX2NhcnRfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMzoiaGVhZGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMToibmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6Mjc6Im5hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJoZWFkZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI1OiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImhlYWRlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czoyMzoiaGVhZGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoyNjoiaGVhZGVyX2JvdHRvbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxMzoibWVudV9wb3NpdGlvbiI7czo1OiJyaWdodCI7czoxMzoibG9nb19wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIwOiJzZWNvbmRhcnlfbWVudV9hbGlnbiI7czo1OiJyaWdodCI7czoxMjoidG9wX2Jhcl9pbmZvIjtzOjA6IiI7czoxODoidG9wX2Jhcl9pbmZvX2FsaWduIjtzOjU6InJpZ2h0IjtzOjI0OiJ0b3BfYmFyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxODoidG9wX2Jhcl90ZXh0X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6InRvcF9iYXJfbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJ0b3BfYmFyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyNjoidG9wX2Jhcl9zb2NpYWxfaWNvbnNfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoiYmFja190b190b3BfYnV0dG9uIjtzOjY6ImVuYWJsZSI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2FsaWduIjtzOjU6ImZpeGVkIjtzOjI4OiJlbmFibGVfZnVsbF93aWR0aF9mb3JfZm9vdGVyIjthOjE6e2k6MDtzOjM6InllcyI7fXM6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjMwOiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNToiZm9vdGVyX3dpZGdldF90aXRsZV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJmb290ZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE2OiJmb290ZXJfdGV4dF9zaXplIjtzOjI6IjEzIjtzOjE3OiJmb290ZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI5OiJmb290ZXJfYm90dG9tX2FyZWFfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI5OiJmb290ZXJfYm90dG9tX2FyZWFfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI1OiJmb290ZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImZvb3Rlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czozMDoiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9wYWRkaW5nIjtzOjI6IjEwIjtzOjMzOiJmb290ZXJfYm90dG9tX2FyZWFfYm90dG9tX3BhZGRpbmciO3M6MjoiNTAiO3M6MjM6ImZvb3Rlcl90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTU6ImZvb3Rlcl9wYXJhbGxheCI7czo3OiJkaXNhYmxlIjtzOjI3OiJzaW5nbGVfcG9ydGZvbGlvX25hdmlnYXRpb24iO3M6NjoiZW5hYmxlIjtzOjE0OiJwb3J0Zm9saW9fcGFnZSI7czowOiIiO3M6MjI6InNpbmdsZV9wb3N0X25hdmlnYXRpb24iO3M6NjoiZW5hYmxlIjtzOjE4OiJzb2NpYWxfbGlua3Nfc3R5bGUiO3M6MToiMSI7czoxMjoic29jaWFsX2xpbmtzIjthOjU6e2k6MDtzOjc6InR3aXR0ZXIiO2k6MTtzOjg6ImZhY2Vib29rIjtpOjM7czo5OiJpbnN0YWdyYW0iO2k6NDtzOjY6InR1bWJsciI7aTo5O3M6NzoieW91dHViZSI7fXM6MTE6InR3aXR0ZXJfdXJsIjtzOjIwOiJodHRwczovL3R3aXR0ZXIuY29tLyI7czoxMjoiZmFjZWJvb2tfdXJsIjtzOjI0OiJodHRwOi8vd3d3LmZhY2Vib29rLmNvbS8iO3M6MTM6Imluc3RhZ3JhbV91cmwiO3M6MjE6Imh0dHA6Ly9pbnN0YWdyYW0uY29tLyI7czoxMjoibGlua2VkaW5fdXJsIjtzOjI0OiJodHRwOi8vd3d3LmxpbmtlZGluLmNvbS8iO3M6MTM6InBpbnRlcmVzdF91cmwiO3M6MjE6Imh0dHA6Ly9waW50ZXJlc3QuY29tLyI7czo5OiJncGx1c191cmwiO3M6MjQ6Imh0dHBzOi8vcGx1cy5nb29nbGUuY29tLyI7czo5OiJ2aW1lb191cmwiO3M6MTc6Imh0dHA6Ly92aW1lby5jb20vIjtzOjEwOiJmbGlja3JfdXJsIjtzOjIyOiJodHRwOi8vd3d3LmZsaWNrci5jb20vIjtzOjEwOiJ0dW1ibHJfdXJsIjtzOjIzOiJodHRwczovL3d3dy50dW1ibHIuY29tLyI7czoxMToieW91dHViZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cueW91dHViZS5jb20vIjtzOjEyOiJkcmliYmJsZV91cmwiO3M6MjA6Imh0dHA6Ly9kcmliYmJsZS5jb20vIjtzOjExOiJiZWhhbmNlX3VybCI7czoyMzoiaHR0cDovL3d3dy5iZWhhbmNlLm5ldC8iO3M6NjoicHhfdXJsIjtzOjE4OiJodHRwczovLzUwMHB4LmNvbS8iO3M6NjoidmtfdXJsIjtzOjE0OiJodHRwOi8vdmsuY29tLyI7czoxMzoiZW1haWxfYWRkcmVzcyI7czoyMzoicGxhY2Vob2xkZXJAZXhhbXBsZS5jb20iO3M6MjQ6ImVuYWJsZV93b29jb21tZXJjZV9saW5rcyI7czo3OiJkaXNhYmxlIjtzOjExOiJzaG9wX2xheW91dCI7czoxMjoibGVmdC1zaWRlYmFyIjtzOjEyOiJzaG9wX2NvbHVtbnMiO3M6MToiMyI7czoyNjoiaGVhZGVyX2JhY2tncm91bmRfZm9yX3Nob3AiO3M6MDoiIjtzOjM0OiJhZGRfdG9fY2FydF90ZXh0X29uX3NpbmdsZV9wcm9kdWN0IjtzOjA6IiI7czoyMzoicmV2b2x1dGlvbl9zbGlkZXJfYWxpYXMiO3M6MDoiIjtzOjM4OiJhZGRpdGlvbmFsX2luZm9fb25fc2luZ2xlX3Byb2R1Y3RfcGFnZSI7czowOiIiO30=';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Farah' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Farah', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjc6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjI4IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6ImxvZ29fZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjE5OiJsb2dvX2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6ImxvZ29fZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6NDoibG9nbyI7czowOiIiO3M6Mjc6ImxvZ29fZm9yX3RyYW5zcGFyZW50X2hlYWRlciI7czowOiIiO3M6MTU6ImhlaWdodF9mb3JfbG9nbyI7czoyOiIxOCI7czoxMjoiYWNjZW50X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTA6ImJvZHlfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMzoicHJpbWFyeV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE1OiJzZWNvbmRhcnlfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoxMToidGhpcmRfY29sb3IiO3M6NzoiI2YyZjJmMiI7czoxMzoiYm9yZGVyc19jb2xvciI7czo3OiIjZTZlNmU2IjtzOjExOiJsaW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJsaW5rc19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIyOiJwYWdlX2xvYWRfcHJvZ3Jlc3NfYmFyIjtzOjc6ImVuYWJsZWQiO3M6Mjg6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXJfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMDoibW9iaWxlX21lbnVfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMzoibG9nb19nb29nbGVfZm9udF9mYW1pbHkiO3M6MDoiIjtzOjIxOiJsb2dvX2dvb2dsZV9mb250X25hbWUiO3M6MDoiIjtzOjE4OiJwcmltYXJ5X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoxODoiZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjU4OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9QXJpbW86NDAwLDQwMGksNzAwIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjU6IkFyaW1vIjtzOjE1OiJtZW51X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyMzoibWVudV9nb29nbGVfZm9udF9mYW1pbHkiO3M6NTM6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1EaWRhY3QrR290aGljIjtzOjIxOiJtZW51X2dvb2dsZV9mb250X25hbWUiO3M6MTM6IkRpZGFjdCBHb3RoaWMiO3M6MTQ6Im1lbnVfZm9udF9zaXplIjtzOjI6IjE4IjtzOjMxOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJtZW51X3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV90ZXh0X3RyYW5zZm9ybSI7czo0OiJub25lIjtzOjE2OiJtZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czozMzoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czoxOToibWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIwIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czoxNToibWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czozMjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjI2OiJtZW51X3RleHRfZGVjb3JhdGlvbl9ob3ZlciI7czo5OiJ1bmRlcmxpbmUiO3M6MTg6ImhlYWRpbmdfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjI2OiJoZWFkaW5nX2dvb2dsZV9mb250X2ZhbWlseSI7czo1MzoiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PURpZGFjdCtHb3RoaWMiO3M6MjQ6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfbmFtZSI7czoxMzoiRGlkYWN0IEdvdGhpYyI7czoxNDoiYm9keV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6ImhlYWRpbmdfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjIxOiJsaW5rc190ZXh0X2RlY29yYXRpb24iO3M6OToidW5kZXJsaW5lIjtzOjE2OiJsaW5rc19mb250X3N0eWxlIjtzOjY6Iml0YWxpYyI7czoxMjoiaGVhZGVyX3N0eWxlIjtzOjE1OiJmaXhlZC1vbi1zY3JvbGwiO3M6MzM6ImhlYWRlcl9oZWlnaHRfcmVkdWN0aW9uX3Njcm9sbGluZyI7czo2OiJlbmFibGUiO3M6MTM6ImhlYWRlcl9oZWlnaHQiO3M6MzoiMTI0IjtzOjI2OiJoZWFkZXJfaGVpZ2h0X29uX3Njcm9sbGluZyI7czoyOiI2NCI7czoyODoiZW5hYmxlX2Z1bGxfd2lkdGhfZm9yX2hlYWRlciI7YToxOntpOjA7czozOiJ5ZXMiO31zOjE1OiJoZWFkZXJfcG9zaXRpb24iO3M6MzoidG9wIjtzOjEyOiJsb2dvX2NhcHRpb24iO3M6MDoiIjtzOjEwOiJidXR0b25fdXJsIjtzOjA6IiI7czoxMToiYnV0dG9uX3RleHQiO3M6MDoiIjtzOjIxOiJzb2NpYWxfaWNvbnNfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMjoic2VhcmNoX2hlYWRlcl9wb3NpdGlvbiI7czo0OiJub25lIjtzOjExOiJoZWFkZXJfaW5mbyI7czowOiIiO3M6MjU6Indvb2NvbW1lcmNlX2NhcnRfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMzoiaGVhZGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMToibmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6Mjc6Im5hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJoZWFkZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI1OiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImhlYWRlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czoyMzoiaGVhZGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoyNjoiaGVhZGVyX2JvdHRvbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxMzoibWVudV9wb3NpdGlvbiI7czo1OiJyaWdodCI7czoxMzoibG9nb19wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIwOiJzZWNvbmRhcnlfbWVudV9hbGlnbiI7czo1OiJyaWdodCI7czoxMjoidG9wX2Jhcl9pbmZvIjtzOjA6IiI7czoxODoidG9wX2Jhcl9pbmZvX2FsaWduIjtzOjU6InJpZ2h0IjtzOjI0OiJ0b3BfYmFyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxODoidG9wX2Jhcl90ZXh0X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6InRvcF9iYXJfbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJ0b3BfYmFyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyNjoidG9wX2Jhcl9zb2NpYWxfaWNvbnNfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoiYmFja190b190b3BfYnV0dG9uIjtzOjc6ImRpc2FibGUiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9hbGlnbiI7czo1OiJmaXhlZCI7czoyODoiZW5hYmxlX2Z1bGxfd2lkdGhfZm9yX2Zvb3RlciI7YToxOntpOjA7czozOiJ5ZXMiO31zOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3IiO3M6NzoiIzAwMDAwMCI7czozMDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjU6ImZvb3Rlcl93aWRnZXRfdGl0bGVfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNzoiZm9vdGVyX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNjoiZm9vdGVyX3RleHRfc2l6ZSI7czoyOiIxNiI7czoxNzoiZm9vdGVyX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNToiZm9vdGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJmb290ZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTYiO3M6MzA6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfcGFkZGluZyI7czoyOiIxNCI7czozMzoiZm9vdGVyX2JvdHRvbV9hcmVhX2JvdHRvbV9wYWRkaW5nIjtzOjI6IjQ2IjtzOjIzOiJmb290ZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjE1OiJmb290ZXJfcGFyYWxsYXgiO3M6NzoiZGlzYWJsZSI7czoyNzoic2luZ2xlX3BvcnRmb2xpb19uYXZpZ2F0aW9uIjtzOjY6ImVuYWJsZSI7czoxNDoicG9ydGZvbGlvX3BhZ2UiO3M6MDoiIjtzOjIyOiJzaW5nbGVfcG9zdF9uYXZpZ2F0aW9uIjtzOjY6ImVuYWJsZSI7czoxODoic29jaWFsX2xpbmtzX3N0eWxlIjtzOjE6IjEiO3M6MTI6InNvY2lhbF9saW5rcyI7YTozOntpOjE7czo4OiJmYWNlYm9vayI7aTozO3M6OToiaW5zdGFncmFtIjtpOjExO3M6NzoiYmVoYW5jZSI7fXM6MTE6InR3aXR0ZXJfdXJsIjtzOjIwOiJodHRwczovL3R3aXR0ZXIuY29tLyI7czoxMjoiZmFjZWJvb2tfdXJsIjtzOjI0OiJodHRwOi8vd3d3LmZhY2Vib29rLmNvbS8iO3M6MTM6Imluc3RhZ3JhbV91cmwiO3M6MjE6Imh0dHA6Ly9pbnN0YWdyYW0uY29tLyI7czoxMjoibGlua2VkaW5fdXJsIjtzOjI0OiJodHRwOi8vd3d3LmxpbmtlZGluLmNvbS8iO3M6MTM6InBpbnRlcmVzdF91cmwiO3M6MjE6Imh0dHA6Ly9waW50ZXJlc3QuY29tLyI7czo5OiJncGx1c191cmwiO3M6MjQ6Imh0dHBzOi8vcGx1cy5nb29nbGUuY29tLyI7czo5OiJ2aW1lb191cmwiO3M6MTc6Imh0dHA6Ly92aW1lby5jb20vIjtzOjEwOiJmbGlja3JfdXJsIjtzOjIyOiJodHRwOi8vd3d3LmZsaWNrci5jb20vIjtzOjEwOiJ0dW1ibHJfdXJsIjtzOjIzOiJodHRwczovL3d3dy50dW1ibHIuY29tLyI7czoxMToieW91dHViZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cueW91dHViZS5jb20vIjtzOjEyOiJkcmliYmJsZV91cmwiO3M6MjA6Imh0dHA6Ly9kcmliYmJsZS5jb20vIjtzOjExOiJiZWhhbmNlX3VybCI7czoyMzoiaHR0cDovL3d3dy5iZWhhbmNlLm5ldC8iO3M6NjoicHhfdXJsIjtzOjE4OiJodHRwczovLzUwMHB4LmNvbS8iO3M6NjoidmtfdXJsIjtzOjE0OiJodHRwOi8vdmsuY29tLyI7czoxMzoiZW1haWxfYWRkcmVzcyI7czoyMzoicGxhY2Vob2xkZXJAZXhhbXBsZS5jb20iO3M6MjQ6ImVuYWJsZV93b29jb21tZXJjZV9saW5rcyI7czo3OiJkaXNhYmxlIjtzOjExOiJzaG9wX2xheW91dCI7czoxMjoibGVmdC1zaWRlYmFyIjtzOjEyOiJzaG9wX2NvbHVtbnMiO3M6MToiMyI7czoyNjoiaGVhZGVyX2JhY2tncm91bmRfZm9yX3Nob3AiO3M6MDoiIjtzOjM0OiJhZGRfdG9fY2FydF90ZXh0X29uX3NpbmdsZV9wcm9kdWN0IjtzOjA6IiI7czoyMzoicmV2b2x1dGlvbl9zbGlkZXJfYWxpYXMiO3M6MDoiIjtzOjM4OiJhZGRpdGlvbmFsX2luZm9fb25fc2luZ2xlX3Byb2R1Y3RfcGFnZSI7czowOiIiO30=';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Tashia' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 371 );
		update_option( 'medium_size_h', 0 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Tashia', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', '' );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjY6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjMwIjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjk6InVwcGVyY2FzZSI7czoxNjoibG9nb19mb250X3dlaWdodCI7czozOiI0MDAiO3M6MTk6ImxvZ29fbGV0dGVyX3NwYWNpbmciO3M6MToiMiI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjZjJmMmYyIjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czowOiIiO3M6MjE6ImxvZ29fZ29vZ2xlX2ZvbnRfbmFtZSI7czowOiIiO3M6MTg6InByaW1hcnlfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjE4OiJnb29nbGVfZm9udF9mYW1pbHkiO3M6NjE6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1RdWlja3NhbmQ6NDAwLDUwMCw3MDAiO3M6MTY6Imdvb2dsZV9mb250X25hbWUiO3M6OToiUXVpY2tzYW5kIjtzOjE1OiJtZW51X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyMzoibWVudV9nb29nbGVfZm9udF9mYW1pbHkiO3M6NjE6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1RdWlja3NhbmQ6NDAwLDUwMCw3MDAiO3M6MjE6Im1lbnVfZ29vZ2xlX2ZvbnRfbmFtZSI7czo5OiJRdWlja3NhbmQiO3M6MTQ6Im1lbnVfZm9udF9zaXplIjtzOjI6IjE4IjtzOjMxOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJtZW51X3RleHRfdHJhbnNmb3JtIjtzOjk6Imxvd2VyY2FzZSI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6Im1lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjMzOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjE5OiJtZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjIiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIwIjtzOjE1OiJtZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjMyOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MjY6Im1lbnVfdGV4dF9kZWNvcmF0aW9uX2hvdmVyIjtzOjk6InVuZGVybGluZSI7czoxODoiaGVhZGluZ190eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjY6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjUwOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9VGVub3IrU2FucyI7czoyNDoiaGVhZGluZ19nb29nbGVfZm9udF9uYW1lIjtzOjEwOiJUZW5vciBTYW5zIjtzOjE0OiJib2R5X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToiaGVhZGluZ19mb250X3dlaWdodCI7czozOiI0MDAiO3M6MjE6ImxpbmtzX3RleHRfZGVjb3JhdGlvbiI7czo5OiJ1bmRlcmxpbmUiO3M6MTY6ImxpbmtzX2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjEyOiJoZWFkZXJfc3R5bGUiO3M6NToiZml4ZWQiO3M6MzM6ImhlYWRlcl9oZWlnaHRfcmVkdWN0aW9uX3Njcm9sbGluZyI7czo3OiJkaXNhYmxlIjtzOjEzOiJoZWFkZXJfaGVpZ2h0IjtzOjI6IjY2IjtzOjI2OiJoZWFkZXJfaGVpZ2h0X29uX3Njcm9sbGluZyI7czoyOiI1NCI7czoyODoiZW5hYmxlX2Z1bGxfd2lkdGhfZm9yX2hlYWRlciI7YToxOntpOjA7czozOiJ5ZXMiO31zOjE1OiJoZWFkZXJfcG9zaXRpb24iO3M6MzoidG9wIjtzOjEyOiJsb2dvX2NhcHRpb24iO3M6MDoiIjtzOjEwOiJidXR0b25fdXJsIjtzOjA6IiI7czoxMToiYnV0dG9uX3RleHQiO3M6MDoiIjtzOjIxOiJzb2NpYWxfaWNvbnNfcG9zaXRpb24iO3M6NjoiaGVhZGVyIjtzOjIyOiJzZWFyY2hfaGVhZGVyX3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MTE6ImhlYWRlcl9pbmZvIjtzOjA6IiI7czoyNToid29vY29tbWVyY2VfY2FydF9wb3NpdGlvbiI7czo0OiJub25lIjtzOjIzOiJoZWFkZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjIxOiJuYXZpZ2F0aW9uX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNzoibmF2aWdhdGlvbl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImhlYWRlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImhlYWRlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImhlYWRlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImhlYWRlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoyNDoiaGVhZGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjIzOiJoZWFkZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjI2OiJoZWFkZXJfYm90dG9tX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjEzOiJtZW51X3Bvc2l0aW9uIjtzOjU6InJpZ2h0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MjA6InNlY29uZGFyeV9tZW51X2FsaWduIjtzOjU6InJpZ2h0IjtzOjEyOiJ0b3BfYmFyX2luZm8iO3M6MDoiIjtzOjE4OiJ0b3BfYmFyX2luZm9fYWxpZ24iO3M6NToicmlnaHQiO3M6MjQ6InRvcF9iYXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE4OiJ0b3BfYmFyX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoidG9wX2Jhcl9saW5rX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjQ6InRvcF9iYXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjI2OiJ0b3BfYmFyX3NvY2lhbF9pY29uc19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJiYWNrX3RvX3RvcF9idXR0b24iO3M6NjoiZW5hYmxlIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fYWxpZ24iO3M6NToiZml4ZWQiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjMwOiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNToiZm9vdGVyX3dpZGdldF90aXRsZV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJmb290ZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE2OiJmb290ZXJfdGV4dF9zaXplIjtzOjI6IjEzIjtzOjE3OiJmb290ZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI5OiJmb290ZXJfYm90dG9tX2FyZWFfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI5OiJmb290ZXJfYm90dG9tX2FyZWFfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI1OiJmb290ZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiM5OTk5OTkiO3M6MjQ6ImZvb3Rlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czozMDoiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9wYWRkaW5nIjtzOjI6IjEwIjtzOjMzOiJmb290ZXJfYm90dG9tX2FyZWFfYm90dG9tX3BhZGRpbmciO3M6MjoiNTAiO3M6MjM6ImZvb3Rlcl90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTU6ImZvb3Rlcl9wYXJhbGxheCI7czo3OiJkaXNhYmxlIjtzOjI3OiJzaW5nbGVfcG9ydGZvbGlvX25hdmlnYXRpb24iO3M6NjoiZW5hYmxlIjtzOjE0OiJwb3J0Zm9saW9fcGFnZSI7czowOiIiO3M6MjI6InNpbmdsZV9wb3N0X25hdmlnYXRpb24iO3M6NjoiZW5hYmxlIjtzOjE4OiJzb2NpYWxfbGlua3Nfc3R5bGUiO3M6MToiMyI7czoxMjoic29jaWFsX2xpbmtzIjthOjM6e2k6MTtzOjg6ImZhY2Vib29rIjtpOjM7czo5OiJpbnN0YWdyYW0iO2k6MTQ7czo1OiJlbWFpbCI7fXM6MTE6InR3aXR0ZXJfdXJsIjtzOjIwOiJodHRwczovL3R3aXR0ZXIuY29tLyI7czoxMjoiZmFjZWJvb2tfdXJsIjtzOjI0OiJodHRwOi8vd3d3LmZhY2Vib29rLmNvbS8iO3M6MTM6Imluc3RhZ3JhbV91cmwiO3M6MjE6Imh0dHA6Ly9pbnN0YWdyYW0uY29tLyI7czoxMjoibGlua2VkaW5fdXJsIjtzOjI0OiJodHRwOi8vd3d3LmxpbmtlZGluLmNvbS8iO3M6MTM6InBpbnRlcmVzdF91cmwiO3M6MjE6Imh0dHA6Ly9waW50ZXJlc3QuY29tLyI7czo5OiJncGx1c191cmwiO3M6MjQ6Imh0dHBzOi8vcGx1cy5nb29nbGUuY29tLyI7czo5OiJ2aW1lb191cmwiO3M6MTc6Imh0dHA6Ly92aW1lby5jb20vIjtzOjEwOiJmbGlja3JfdXJsIjtzOjIyOiJodHRwOi8vd3d3LmZsaWNrci5jb20vIjtzOjEwOiJ0dW1ibHJfdXJsIjtzOjIzOiJodHRwczovL3d3dy50dW1ibHIuY29tLyI7czoxMToieW91dHViZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cueW91dHViZS5jb20vIjtzOjEyOiJkcmliYmJsZV91cmwiO3M6MjA6Imh0dHA6Ly9kcmliYmJsZS5jb20vIjtzOjExOiJiZWhhbmNlX3VybCI7czoyMzoiaHR0cDovL3d3dy5iZWhhbmNlLm5ldC8iO3M6NjoicHhfdXJsIjtzOjE4OiJodHRwczovLzUwMHB4LmNvbS8iO3M6NjoidmtfdXJsIjtzOjE0OiJodHRwOi8vdmsuY29tLyI7czoxMzoiZW1haWxfYWRkcmVzcyI7czoyMzoicGxhY2Vob2xkZXJAZXhhbXBsZS5jb20iO3M6MjQ6ImVuYWJsZV93b29jb21tZXJjZV9saW5rcyI7czo3OiJkaXNhYmxlIjtzOjExOiJzaG9wX2xheW91dCI7czoxMjoibGVmdC1zaWRlYmFyIjtzOjEyOiJzaG9wX2NvbHVtbnMiO3M6MToiMyI7czoyNjoiaGVhZGVyX2JhY2tncm91bmRfZm9yX3Nob3AiO3M6MDoiIjtzOjM0OiJhZGRfdG9fY2FydF90ZXh0X29uX3NpbmdsZV9wcm9kdWN0IjtzOjA6IiI7czoyMzoicmV2b2x1dGlvbl9zbGlkZXJfYWxpYXMiO3M6MDoiIjtzOjM4OiJhZGRpdGlvbmFsX2luZm9fb25fc2luZ2xlX3Byb2R1Y3RfcGFnZSI7czowOiIiO30=';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Estella' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Estella', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjU6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjMyIjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6ImxvZ29fZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjE5OiJsb2dvX2xldHRlcl9zcGFjaW5nIjtzOjE6IjQiO3M6MTU6ImxvZ29fZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6NDoibG9nbyI7czowOiIiO3M6Mjc6ImxvZ29fZm9yX3RyYW5zcGFyZW50X2hlYWRlciI7czowOiIiO3M6MTU6ImhlaWdodF9mb3JfbG9nbyI7czoyOiIxOCI7czoxMjoiYWNjZW50X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTA6ImJvZHlfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMzoicHJpbWFyeV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE1OiJzZWNvbmRhcnlfY29sb3IiO3M6NzoiIzdmN2Y3ZiI7czoxMToidGhpcmRfY29sb3IiO3M6NzoiIzI2MjYyNiI7czoxMzoiYm9yZGVyc19jb2xvciI7czo3OiIjMzMzMzMzIjtzOjExOiJsaW5rc19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE3OiJsaW5rc19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjIyOiJwYWdlX2xvYWRfcHJvZ3Jlc3NfYmFyIjtzOjc6ImVuYWJsZWQiO3M6Mjg6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXJfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMDoibW9iaWxlX21lbnVfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMzoibG9nb19nb29nbGVfZm9udF9mYW1pbHkiO3M6MDoiIjtzOjIxOiJsb2dvX2dvb2dsZV9mb250X25hbWUiO3M6MDoiIjtzOjE4OiJwcmltYXJ5X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoxODoiZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjc2OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9T3BlbitTYW5zOjQwMCw0MDBpLDYwMCw2MDBpLDcwMCw3MDBpIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjk6Ik9wZW4gU2FucyI7czoxNToibWVudV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjM6Im1lbnVfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjc2OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9T3BlbitTYW5zOjQwMCw0MDBpLDYwMCw2MDBpLDcwMCw3MDBpIjtzOjIxOiJtZW51X2dvb2dsZV9mb250X25hbWUiO3M6OToiT3BlbiBTYW5zIjtzOjE0OiJtZW51X2ZvbnRfc2l6ZSI7czoyOiIxMiI7czozMToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToibWVudV90ZXh0X3RyYW5zZm9ybSI7czo5OiJ1cHBlcmNhc2UiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV90ZXh0X3RyYW5zZm9ybSI7czo0OiJub25lIjtzOjE2OiJtZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czozMzoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czoxOToibWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIyIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czoxNToibWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czozMjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjI2OiJtZW51X3RleHRfZGVjb3JhdGlvbl9ob3ZlciI7czo5OiJ1bmRlcmxpbmUiO3M6MTg6ImhlYWRpbmdfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjI2OiJoZWFkaW5nX2dvb2dsZV9mb250X2ZhbWlseSI7czo1NDoiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PU9zd2FsZDo0MDAsNzAwIjtzOjI0OiJoZWFkaW5nX2dvb2dsZV9mb250X25hbWUiO3M6NjoiT3N3YWxkIjtzOjE0OiJib2R5X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToiaGVhZGluZ19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MjE6ImxpbmtzX3RleHRfZGVjb3JhdGlvbiI7czo5OiJ1bmRlcmxpbmUiO3M6MTY6ImxpbmtzX2ZvbnRfc3R5bGUiO3M6NjoiaXRhbGljIjtzOjEyOiJoZWFkZXJfc3R5bGUiO3M6MTU6ImZpeGVkLW9uLXNjcm9sbCI7czozMzoiaGVhZGVyX2hlaWdodF9yZWR1Y3Rpb25fc2Nyb2xsaW5nIjtzOjc6ImRpc2FibGUiO3M6MTM6ImhlYWRlcl9oZWlnaHQiO3M6MjoiNzQiO3M6MjY6ImhlYWRlcl9oZWlnaHRfb25fc2Nyb2xsaW5nIjtzOjI6IjU0IjtzOjE1OiJoZWFkZXJfcG9zaXRpb24iO3M6MzoidG9wIjtzOjEyOiJsb2dvX2NhcHRpb24iO3M6MDoiIjtzOjEwOiJidXR0b25fdXJsIjtzOjA6IiI7czoxMToiYnV0dG9uX3RleHQiO3M6MDoiIjtzOjIxOiJzb2NpYWxfaWNvbnNfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMjoic2VhcmNoX2hlYWRlcl9wb3NpdGlvbiI7czo0OiJub25lIjtzOjExOiJoZWFkZXJfaW5mbyI7czowOiIiO3M6MjU6Indvb2NvbW1lcmNlX2NhcnRfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMzoiaGVhZGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMToibmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6Mjc6Im5hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjE3OiJoZWFkZXJfdGV4dF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE3OiJoZWFkZXJfbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjIzOiJoZWFkZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjI1OiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjQ6ImhlYWRlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czoyMzoiaGVhZGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoyNjoiaGVhZGVyX2JvdHRvbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxMzoibWVudV9wb3NpdGlvbiI7czo1OiJyaWdodCI7czoxMzoibG9nb19wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIwOiJzZWNvbmRhcnlfbWVudV9hbGlnbiI7czo1OiJyaWdodCI7czoxMjoidG9wX2Jhcl9pbmZvIjtzOjA6IiI7czoxODoidG9wX2Jhcl9pbmZvX2FsaWduIjtzOjU6InJpZ2h0IjtzOjI0OiJ0b3BfYmFyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxODoidG9wX2Jhcl90ZXh0X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6InRvcF9iYXJfbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJ0b3BfYmFyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyNjoidG9wX2Jhcl9zb2NpYWxfaWNvbnNfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoiYmFja190b190b3BfYnV0dG9uIjtzOjY6ImVuYWJsZSI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2FsaWduIjtzOjU6ImZpeGVkIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3IiO3M6NzoiI2ZmZmZmZiI7czozMDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjM6ImZvb3Rlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImZvb3Rlcl93aWRnZXRfdGl0bGVfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxNzoiZm9vdGVyX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxNjoiZm9vdGVyX3RleHRfc2l6ZSI7czoyOiIxMyI7czoxNzoiZm9vdGVyX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMzoiZm9vdGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNToiZm9vdGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJmb290ZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MzA6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfcGFkZGluZyI7czoyOiI1MCI7czozMzoiZm9vdGVyX2JvdHRvbV9hcmVhX2JvdHRvbV9wYWRkaW5nIjtzOjI6IjUwIjtzOjIzOiJmb290ZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjE1OiJmb290ZXJfcGFyYWxsYXgiO3M6NzoiZGlzYWJsZSI7czoyNzoic2luZ2xlX3BvcnRmb2xpb19uYXZpZ2F0aW9uIjtzOjY6ImVuYWJsZSI7czoxNDoicG9ydGZvbGlvX3BhZ2UiO3M6MDoiIjtzOjIyOiJzaW5nbGVfcG9zdF9uYXZpZ2F0aW9uIjtzOjY6ImVuYWJsZSI7czoxODoic29jaWFsX2xpbmtzX3N0eWxlIjtzOjE6IjEiO3M6MTI6InNvY2lhbF9saW5rcyI7YTo0OntpOjA7czo3OiJ0d2l0dGVyIjtpOjE7czo4OiJmYWNlYm9vayI7aTozO3M6OToiaW5zdGFncmFtIjtpOjk7czo3OiJ5b3V0dWJlIjt9czoxMToidHdpdHRlcl91cmwiO3M6MjA6Imh0dHBzOi8vdHdpdHRlci5jb20vIjtzOjEyOiJmYWNlYm9va191cmwiO3M6MjQ6Imh0dHA6Ly93d3cuZmFjZWJvb2suY29tLyI7czoxMzoiaW5zdGFncmFtX3VybCI7czoyMToiaHR0cDovL2luc3RhZ3JhbS5jb20vIjtzOjEyOiJsaW5rZWRpbl91cmwiO3M6MjQ6Imh0dHA6Ly93d3cubGlua2VkaW4uY29tLyI7czoxMzoicGludGVyZXN0X3VybCI7czoyMToiaHR0cDovL3BpbnRlcmVzdC5jb20vIjtzOjk6ImdwbHVzX3VybCI7czoyNDoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20vIjtzOjk6InZpbWVvX3VybCI7czoxNzoiaHR0cDovL3ZpbWVvLmNvbS8iO3M6MTA6ImZsaWNrcl91cmwiO3M6MjI6Imh0dHA6Ly93d3cuZmxpY2tyLmNvbS8iO3M6MTA6InR1bWJscl91cmwiO3M6MjM6Imh0dHBzOi8vd3d3LnR1bWJsci5jb20vIjtzOjExOiJ5b3V0dWJlX3VybCI7czoyMzoiaHR0cDovL3d3dy55b3V0dWJlLmNvbS8iO3M6MTI6ImRyaWJiYmxlX3VybCI7czoyMDoiaHR0cDovL2RyaWJiYmxlLmNvbS8iO3M6MTE6ImJlaGFuY2VfdXJsIjtzOjIzOiJodHRwOi8vd3d3LmJlaGFuY2UubmV0LyI7czo2OiJweF91cmwiO3M6MTg6Imh0dHBzOi8vNTAwcHguY29tLyI7czo2OiJ2a191cmwiO3M6MTQ6Imh0dHA6Ly92ay5jb20vIjtzOjEzOiJlbWFpbF9hZGRyZXNzIjtzOjIzOiJwbGFjZWhvbGRlckBleGFtcGxlLmNvbSI7czoyNDoiZW5hYmxlX3dvb2NvbW1lcmNlX2xpbmtzIjtzOjc6ImRpc2FibGUiO3M6MTE6InNob3BfbGF5b3V0IjtzOjEyOiJsZWZ0LXNpZGViYXIiO3M6MTI6InNob3BfY29sdW1ucyI7czoxOiIzIjtzOjI2OiJoZWFkZXJfYmFja2dyb3VuZF9mb3Jfc2hvcCI7czowOiIiO3M6MzQ6ImFkZF90b19jYXJ0X3RleHRfb25fc2luZ2xlX3Byb2R1Y3QiO3M6MDoiIjtzOjIzOiJyZXZvbHV0aW9uX3NsaWRlcl9hbGlhcyI7czowOiIiO3M6Mzg6ImFkZGl0aW9uYWxfaW5mb19vbl9zaW5nbGVfcHJvZHVjdF9wYWdlIjtzOjA6IiI7fQ==';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
		
		// Import Revolution Slider
        if ( class_exists( 'RevSlider' ) ) {
			$slider_array = array(
				'estella/revslider/home.zip'
			);
			
			$slider = new RevSlider();
			
			foreach($slider_array as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
        }
	} else if ( 'Vernice' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Vernice', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjc6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjIwIjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjk6InVwcGVyY2FzZSI7czoxNjoibG9nb19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MTk6ImxvZ29fbGV0dGVyX3NwYWNpbmciO3M6MToiNCI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjZjJmMmYyIjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czowOiIiO3M6MjE6ImxvZ29fZ29vZ2xlX2ZvbnRfbmFtZSI7czowOiIiO3M6MTg6InByaW1hcnlfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjE4OiJnb29nbGVfZm9udF9mYW1pbHkiO3M6Njg6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1PbGQrU3RhbmRhcmQrVFQ6NDAwLDQwMGksNzAwIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjE1OiJPbGQgU3RhbmRhcmQgVFQiO3M6MTU6Im1lbnVfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjIzOiJtZW51X2dvb2dsZV9mb250X2ZhbWlseSI7czo2ODoiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PU9sZCtTdGFuZGFyZCtUVDo0MDAsNDAwaSw3MDAiO3M6MjE6Im1lbnVfZ29vZ2xlX2ZvbnRfbmFtZSI7czoxNToiT2xkIFN0YW5kYXJkIFRUIjtzOjE0OiJtZW51X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czozMToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToibWVudV90ZXh0X3RyYW5zZm9ybSI7czo0OiJub25lIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfdGV4dF90cmFuc2Zvcm0iO3M6NDoibm9uZSI7czoxNjoibWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MzM6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MTk6Im1lbnVfbGV0dGVyX3NwYWNpbmciO3M6MzoiMC41IjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czoxNToibWVudV9mb250X3N0eWxlIjtzOjY6Iml0YWxpYyI7czozMjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjI2OiJtZW51X3RleHRfZGVjb3JhdGlvbl9ob3ZlciI7czo5OiJ1bmRlcmxpbmUiO3M6MTg6ImhlYWRpbmdfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjI2OiJoZWFkaW5nX2dvb2dsZV9mb250X2ZhbWlseSI7czo1MzoiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PUNhYmluOjQwMCw3MDAiO3M6MjQ6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfbmFtZSI7czo1OiJDYWJpbiI7czoxNDoiYm9keV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6ImhlYWRpbmdfZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjIxOiJsaW5rc190ZXh0X2RlY29yYXRpb24iO3M6OToidW5kZXJsaW5lIjtzOjE2OiJsaW5rc19mb250X3N0eWxlIjtzOjY6Iml0YWxpYyI7czoxMjoiaGVhZGVyX3N0eWxlIjtzOjU6ImZpeGVkIjtzOjMzOiJoZWFkZXJfaGVpZ2h0X3JlZHVjdGlvbl9zY3JvbGxpbmciO3M6NzoiZGlzYWJsZSI7czoxMzoiaGVhZGVyX2hlaWdodCI7czoyOiI3OCI7czoyNjoiaGVhZGVyX2hlaWdodF9vbl9zY3JvbGxpbmciO3M6MjoiNTQiO3M6Mjg6ImVuYWJsZV9mdWxsX3dpZHRoX2Zvcl9oZWFkZXIiO2E6MTp7aTowO3M6MzoieWVzIjt9czoxNToiaGVhZGVyX3Bvc2l0aW9uIjtzOjY6ImJvdHRvbSI7czoxMjoibG9nb19jYXB0aW9uIjtzOjA6IiI7czoxMDoiYnV0dG9uX3VybCI7czowOiIiO3M6MTE6ImJ1dHRvbl90ZXh0IjtzOjA6IiI7czoyMToic29jaWFsX2ljb25zX3Bvc2l0aW9uIjtzOjY6ImhlYWRlciI7czoyMjoic2VhcmNoX2hlYWRlcl9wb3NpdGlvbiI7czo0OiJub25lIjtzOjExOiJoZWFkZXJfaW5mbyI7czowOiIiO3M6MjU6Indvb2NvbW1lcmNlX2NhcnRfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMzoiaGVhZGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMToibmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6Mjc6Im5hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJoZWFkZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI1OiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiM5OTk5OTkiO3M6MjQ6ImhlYWRlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxNiI7czoxNzoiaGVhZGVyX3RvcF9ib3JkZXIiO2E6MTp7aTowO3M6MzoieWVzIjt9czoyMzoiaGVhZGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoyNjoiaGVhZGVyX2JvdHRvbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxMzoibWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MjA6InNlY29uZGFyeV9tZW51X2FsaWduIjtzOjU6InJpZ2h0IjtzOjEyOiJ0b3BfYmFyX2luZm8iO3M6MDoiIjtzOjE4OiJ0b3BfYmFyX2luZm9fYWxpZ24iO3M6NToicmlnaHQiO3M6MjQ6InRvcF9iYXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE4OiJ0b3BfYmFyX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoidG9wX2Jhcl9saW5rX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjQ6InRvcF9iYXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjI2OiJ0b3BfYmFyX3NvY2lhbF9pY29uc19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJiYWNrX3RvX3RvcF9idXR0b24iO3M6NjoiZW5hYmxlIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fYWxpZ24iO3M6NToiZml4ZWQiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjMwOiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNToiZm9vdGVyX3dpZGdldF90aXRsZV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJmb290ZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE2OiJmb290ZXJfdGV4dF9zaXplIjtzOjI6IjEzIjtzOjE3OiJmb290ZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI5OiJmb290ZXJfYm90dG9tX2FyZWFfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI5OiJmb290ZXJfYm90dG9tX2FyZWFfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI1OiJmb290ZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImZvb3Rlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czozMDoiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9wYWRkaW5nIjtzOjI6IjUwIjtzOjMzOiJmb290ZXJfYm90dG9tX2FyZWFfYm90dG9tX3BhZGRpbmciO3M6MjoiNTAiO3M6MjM6ImZvb3Rlcl90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNkZWRlZGUiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNkZWRlZGUiO3M6MTU6ImZvb3Rlcl9wYXJhbGxheCI7czo3OiJkaXNhYmxlIjtzOjI3OiJzaW5nbGVfcG9ydGZvbGlvX25hdmlnYXRpb24iO3M6NjoiZW5hYmxlIjtzOjE0OiJwb3J0Zm9saW9fcGFnZSI7czowOiIiO3M6MjI6InNpbmdsZV9wb3N0X25hdmlnYXRpb24iO3M6NjoiZW5hYmxlIjtzOjE4OiJzb2NpYWxfbGlua3Nfc3R5bGUiO3M6MToiMiI7czoxMjoic29jaWFsX2xpbmtzIjthOjQ6e2k6MDtzOjc6InR3aXR0ZXIiO2k6MTtzOjg6ImZhY2Vib29rIjtpOjM7czo5OiJpbnN0YWdyYW0iO2k6MTQ7czo1OiJlbWFpbCI7fXM6MTE6InR3aXR0ZXJfdXJsIjtzOjIwOiJodHRwczovL3R3aXR0ZXIuY29tLyI7czoxMjoiZmFjZWJvb2tfdXJsIjtzOjI0OiJodHRwOi8vd3d3LmZhY2Vib29rLmNvbS8iO3M6MTM6Imluc3RhZ3JhbV91cmwiO3M6MjE6Imh0dHA6Ly9pbnN0YWdyYW0uY29tLyI7czoxMjoibGlua2VkaW5fdXJsIjtzOjI0OiJodHRwOi8vd3d3LmxpbmtlZGluLmNvbS8iO3M6MTM6InBpbnRlcmVzdF91cmwiO3M6MjE6Imh0dHA6Ly9waW50ZXJlc3QuY29tLyI7czo5OiJncGx1c191cmwiO3M6MjQ6Imh0dHBzOi8vcGx1cy5nb29nbGUuY29tLyI7czo5OiJ2aW1lb191cmwiO3M6MTc6Imh0dHA6Ly92aW1lby5jb20vIjtzOjEwOiJmbGlja3JfdXJsIjtzOjIyOiJodHRwOi8vd3d3LmZsaWNrci5jb20vIjtzOjEwOiJ0dW1ibHJfdXJsIjtzOjIzOiJodHRwczovL3d3dy50dW1ibHIuY29tLyI7czoxMToieW91dHViZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cueW91dHViZS5jb20vIjtzOjEyOiJkcmliYmJsZV91cmwiO3M6MjA6Imh0dHA6Ly9kcmliYmJsZS5jb20vIjtzOjExOiJiZWhhbmNlX3VybCI7czoyMzoiaHR0cDovL3d3dy5iZWhhbmNlLm5ldC8iO3M6NjoicHhfdXJsIjtzOjE4OiJodHRwczovLzUwMHB4LmNvbS8iO3M6NjoidmtfdXJsIjtzOjE0OiJodHRwOi8vdmsuY29tLyI7czoxMzoiZW1haWxfYWRkcmVzcyI7czoyMzoicGxhY2Vob2xkZXJAZXhhbXBsZS5jb20iO3M6MjQ6ImVuYWJsZV93b29jb21tZXJjZV9saW5rcyI7czo3OiJkaXNhYmxlIjtzOjExOiJzaG9wX2xheW91dCI7czoxMjoibGVmdC1zaWRlYmFyIjtzOjEyOiJzaG9wX2NvbHVtbnMiO3M6MToiMyI7czoyNjoiaGVhZGVyX2JhY2tncm91bmRfZm9yX3Nob3AiO3M6MDoiIjtzOjM0OiJhZGRfdG9fY2FydF90ZXh0X29uX3NpbmdsZV9wcm9kdWN0IjtzOjA6IiI7czoyMzoicmV2b2x1dGlvbl9zbGlkZXJfYWxpYXMiO3M6MDoiIjtzOjM4OiJhZGRpdGlvbmFsX2luZm9fb25fc2luZ2xlX3Byb2R1Y3RfcGFnZSI7czowOiIiO30=';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
		
		// Import Revolution Slider
        if ( class_exists( 'RevSlider' ) ) {
			$slider_array = array(
				'vernice/revslider/featured-portfolio.zip',
			);
			
			$slider_array1 = array(
				'vernice/revslider/antigua.zip',
				'vernice/revslider/goa-india.zip',
				'vernice/revslider/heart-beats-pacific.zip',
				'vernice/revslider/iceland.zip',
			);
			
			$slider_array2 = array(
				'vernice/revslider/joshua-tree.zip',
				'vernice/revslider/monterrey-mx.zip',
				'vernice/revslider/oahu.zip',
				'vernice/revslider/oregon.zip',
			);
			
			$slider_array3 = array(
				'vernice/revslider/portugal.zip',
				'vernice/revslider/rodeo-beach.zip',
				'vernice/revslider/rome.zip',
				'vernice/revslider/sou-wester-wa.zip',
			);
			
			$slider_array4 = array(
				'vernice/revslider/the-north-sea.zip',
				'vernice/revslider/washington-state.zip'
			);
			
			$slider = new RevSlider();
			
			foreach($slider_array as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array1 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array2 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array3 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array4 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
        }
	} else if ( 'Florance' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 371 );
		update_option( 'medium_size_h', 0 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Florance', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', '' );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjc6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjk6InVwcGVyY2FzZSI7czoxNjoibG9nb19mb250X3dlaWdodCI7czozOiI0MDAiO3M6MTk6ImxvZ29fbGV0dGVyX3NwYWNpbmciO3M6MToiNCI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjZjJmMmYyIjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czowOiIiO3M6MjE6ImxvZ29fZ29vZ2xlX2ZvbnRfbmFtZSI7czowOiIiO3M6MTg6InByaW1hcnlfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjE4OiJnb29nbGVfZm9udF9mYW1pbHkiO3M6NjE6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1GYW53b29kK1RleHQ6NDAwLDQwMGkiO3M6MTY6Imdvb2dsZV9mb250X25hbWUiO3M6MTI6IkZhbndvb2QgVGV4dCI7czoxNToibWVudV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjM6Im1lbnVfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjYxOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9RmFud29vZCtUZXh0OjQwMCw0MDBpIjtzOjIxOiJtZW51X2dvb2dsZV9mb250X25hbWUiO3M6MTI6IkZhbndvb2QgVGV4dCI7czoxNDoibWVudV9mb250X3NpemUiO3M6MjoiMTYiO3M6MzE6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6Im1lbnVfdGV4dF90cmFuc2Zvcm0iO3M6NDoibm9uZSI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6Im1lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjMzOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjE5OiJtZW51X2xldHRlcl9zcGFjaW5nIjtzOjM6IjAuNSI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6Im1lbnVfZm9udF9zdHlsZSI7czo2OiJpdGFsaWMiO3M6MzI6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czoyNjoibWVudV90ZXh0X2RlY29yYXRpb25faG92ZXIiO3M6OToidW5kZXJsaW5lIjtzOjE4OiJoZWFkaW5nX3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyNjoiaGVhZGluZ19nb29nbGVfZm9udF9mYW1pbHkiO3M6NjA6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1RdWF0dHJvY2VudG86NDAwLDcwMCI7czoyNDoiaGVhZGluZ19nb29nbGVfZm9udF9uYW1lIjtzOjEyOiJRdWF0dHJvY2VudG8iO3M6MTQ6ImJvZHlfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJoZWFkaW5nX2ZvbnRfd2VpZ2h0IjtzOjM6IjcwMCI7czoyMToibGlua3NfdGV4dF9kZWNvcmF0aW9uIjtzOjk6InVuZGVybGluZSI7czoxNjoibGlua3NfZm9udF9zdHlsZSI7czo2OiJpdGFsaWMiO3M6MTI6ImhlYWRlcl9zdHlsZSI7czo1OiJmaXhlZCI7czozMzoiaGVhZGVyX2hlaWdodF9yZWR1Y3Rpb25fc2Nyb2xsaW5nIjtzOjc6ImRpc2FibGUiO3M6MTM6ImhlYWRlcl9oZWlnaHQiO3M6MjoiNjQiO3M6MjY6ImhlYWRlcl9oZWlnaHRfb25fc2Nyb2xsaW5nIjtzOjI6IjU0IjtzOjI4OiJlbmFibGVfZnVsbF93aWR0aF9mb3JfaGVhZGVyIjthOjE6e2k6MDtzOjM6InllcyI7fXM6MTU6ImhlYWRlcl9wb3NpdGlvbiI7czozOiJ0b3AiO3M6MTI6ImxvZ29fY2FwdGlvbiI7czowOiIiO3M6MTA6ImJ1dHRvbl91cmwiO3M6MDoiIjtzOjExOiJidXR0b25fdGV4dCI7czowOiIiO3M6MjE6InNvY2lhbF9pY29uc19wb3NpdGlvbiI7czo0OiJub25lIjtzOjIyOiJzZWFyY2hfaGVhZGVyX3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MTE6ImhlYWRlcl9pbmZvIjtzOjA6IiI7czoyNToid29vY29tbWVyY2VfY2FydF9wb3NpdGlvbiI7czo0OiJub25lIjtzOjIzOiJoZWFkZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjIxOiJuYXZpZ2F0aW9uX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNzoibmF2aWdhdGlvbl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImhlYWRlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImhlYWRlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImhlYWRlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImhlYWRlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNDoiaGVhZGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjIzOiJoZWFkZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjI2OiJoZWFkZXJfYm90dG9tX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjEzOiJtZW51X3Bvc2l0aW9uIjtzOjU6InJpZ2h0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MjA6InNlY29uZGFyeV9tZW51X2FsaWduIjtzOjU6InJpZ2h0IjtzOjEyOiJ0b3BfYmFyX2luZm8iO3M6MDoiIjtzOjE4OiJ0b3BfYmFyX2luZm9fYWxpZ24iO3M6NToicmlnaHQiO3M6MjQ6InRvcF9iYXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE4OiJ0b3BfYmFyX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoidG9wX2Jhcl9saW5rX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjQ6InRvcF9iYXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjI2OiJ0b3BfYmFyX3NvY2lhbF9pY29uc19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJiYWNrX3RvX3RvcF9idXR0b24iO3M6NjoiZW5hYmxlIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fYWxpZ24iO3M6NToiZml4ZWQiO3M6Mjg6ImVuYWJsZV9mdWxsX3dpZHRoX2Zvcl9mb290ZXIiO2E6MTp7aTowO3M6MzoieWVzIjt9czoyNDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzA6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI1OiJmb290ZXJfd2lkZ2V0X3RpdGxlX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImZvb3Rlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTY6ImZvb3Rlcl90ZXh0X3NpemUiO3M6MjoiMTMiO3M6MTc6ImZvb3Rlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImZvb3Rlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNDoiZm9vdGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjMwOiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX3BhZGRpbmciO3M6MjoiMTAiO3M6MzM6ImZvb3Rlcl9ib3R0b21fYXJlYV9ib3R0b21fcGFkZGluZyI7czoyOiIxMCI7czoyMzoiZm9vdGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxNToiZm9vdGVyX3BhcmFsbGF4IjtzOjc6ImRpc2FibGUiO3M6Mjc6InNpbmdsZV9wb3J0Zm9saW9fbmF2aWdhdGlvbiI7czo2OiJlbmFibGUiO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjA6IiI7czoyMjoic2luZ2xlX3Bvc3RfbmF2aWdhdGlvbiI7czo2OiJlbmFibGUiO3M6MTg6InNvY2lhbF9saW5rc19zdHlsZSI7czoxOiIyIjtzOjEyOiJzb2NpYWxfbGlua3MiO2E6NDp7aToxO3M6ODoiZmFjZWJvb2siO2k6MjtzOjg6ImxpbmtlZGluIjtpOjM7czo5OiJpbnN0YWdyYW0iO2k6MTE7czo3OiJiZWhhbmNlIjt9czoxMToidHdpdHRlcl91cmwiO3M6MjA6Imh0dHBzOi8vdHdpdHRlci5jb20vIjtzOjEyOiJmYWNlYm9va191cmwiO3M6MjQ6Imh0dHA6Ly93d3cuZmFjZWJvb2suY29tLyI7czoxMzoiaW5zdGFncmFtX3VybCI7czoyMToiaHR0cDovL2luc3RhZ3JhbS5jb20vIjtzOjEyOiJsaW5rZWRpbl91cmwiO3M6MjQ6Imh0dHA6Ly93d3cubGlua2VkaW4uY29tLyI7czoxMzoicGludGVyZXN0X3VybCI7czoyMToiaHR0cDovL3BpbnRlcmVzdC5jb20vIjtzOjk6ImdwbHVzX3VybCI7czoyNDoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20vIjtzOjk6InZpbWVvX3VybCI7czoxNzoiaHR0cDovL3ZpbWVvLmNvbS8iO3M6MTA6ImZsaWNrcl91cmwiO3M6MjI6Imh0dHA6Ly93d3cuZmxpY2tyLmNvbS8iO3M6MTA6InR1bWJscl91cmwiO3M6MjM6Imh0dHBzOi8vd3d3LnR1bWJsci5jb20vIjtzOjExOiJ5b3V0dWJlX3VybCI7czoyMzoiaHR0cDovL3d3dy55b3V0dWJlLmNvbS8iO3M6MTI6ImRyaWJiYmxlX3VybCI7czoyMDoiaHR0cDovL2RyaWJiYmxlLmNvbS8iO3M6MTE6ImJlaGFuY2VfdXJsIjtzOjIzOiJodHRwOi8vd3d3LmJlaGFuY2UubmV0LyI7czo2OiJweF91cmwiO3M6MTg6Imh0dHBzOi8vNTAwcHguY29tLyI7czo2OiJ2a191cmwiO3M6MTQ6Imh0dHA6Ly92ay5jb20vIjtzOjEzOiJlbWFpbF9hZGRyZXNzIjtzOjIzOiJwbGFjZWhvbGRlckBleGFtcGxlLmNvbSI7czoyNDoiZW5hYmxlX3dvb2NvbW1lcmNlX2xpbmtzIjtzOjc6ImRpc2FibGUiO3M6MTE6InNob3BfbGF5b3V0IjtzOjEyOiJsZWZ0LXNpZGViYXIiO3M6MTI6InNob3BfY29sdW1ucyI7czoxOiIzIjtzOjI2OiJoZWFkZXJfYmFja2dyb3VuZF9mb3Jfc2hvcCI7czowOiIiO3M6MzQ6ImFkZF90b19jYXJ0X3RleHRfb25fc2luZ2xlX3Byb2R1Y3QiO3M6MDoiIjtzOjIzOiJyZXZvbHV0aW9uX3NsaWRlcl9hbGlhcyI7czowOiIiO3M6Mzg6ImFkZGl0aW9uYWxfaW5mb19vbl9zaW5nbGVfcHJvZHVjdF9wYWdlIjtzOjA6IiI7fQ==';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
		
		// Import Revolution Slider
        if ( class_exists( 'RevSlider' ) ) {
			$slider_array = array(
				'florance/revslider/featured-portfolio.zip',
			);
			
			$slider_array1 = array(
				'florance/revslider/anna.zip',
				'florance/revslider/babyblue.zip',
				'florance/revslider/beauty-for-new-school-of-makeup-2.zip',
				'florance/revslider/beauty-for-new-school-of-makeup.zip',
			);
			
			$slider_array2 = array(
				'florance/revslider/berta.zip',
				'florance/revslider/dora.zip',
				'florance/revslider/heny.zip',
				'florance/revslider/kafi.zip',
			);
			
			$slider_array3 = array(
				'florance/revslider/lea.zip',
				'florance/revslider/lilla.zip',
				'florance/revslider/linda-lena.zip',
				'florance/revslider/liza.zip',
			);
			
			$slider_array4 = array(
				'florance/revslider/luca.zip',
				'florance/revslider/marianne.zip',
				'florance/revslider/panna.zip',
				'florance/revslider/petra.zip',
			);
			
			$slider_array5 = array(
				'florance/revslider/vengru-campaign.zip',
				'florance/revslider/zsofi.zip',
			);
			
			$slider = new RevSlider();
			
			foreach($slider_array as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array1 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array2 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array3 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array4 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array5 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
        }
	} else if ( 'Jettie' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 371 );
		update_option( 'medium_size_h', 0 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Jettie', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', '' );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjc6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjE4IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6ImxvZ29fZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjE5OiJsb2dvX2xldHRlcl9zcGFjaW5nIjtzOjM6IjAuNSI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjZjJmMmYyIjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czowOiIiO3M6MjE6ImxvZ29fZ29vZ2xlX2ZvbnRfbmFtZSI7czowOiIiO3M6MTg6InByaW1hcnlfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjE4OiJnb29nbGVfZm9udF9mYW1pbHkiO3M6NDc6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1BdmVyYWdlIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjc6IkF2ZXJhZ2UiO3M6MTU6Im1lbnVfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjIzOiJtZW51X2dvb2dsZV9mb250X2ZhbWlseSI7czo0NzoiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PUF2ZXJhZ2UiO3M6MjE6Im1lbnVfZ29vZ2xlX2ZvbnRfbmFtZSI7czo3OiJBdmVyYWdlIjtzOjE0OiJtZW51X2ZvbnRfc2l6ZSI7czoyOiIxNSI7czozMToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToibWVudV90ZXh0X3RyYW5zZm9ybSI7czo0OiJub25lIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfdGV4dF90cmFuc2Zvcm0iO3M6NDoibm9uZSI7czoxNjoibWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MzM6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MTk6Im1lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6Im1lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MzI6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czoyNjoibWVudV90ZXh0X2RlY29yYXRpb25faG92ZXIiO3M6OToidW5kZXJsaW5lIjtzOjE4OiJoZWFkaW5nX3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyNjoiaGVhZGluZ19nb29nbGVfZm9udF9mYW1pbHkiO3M6NTA6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1GamFsbGErT25lIjtzOjI0OiJoZWFkaW5nX2dvb2dsZV9mb250X25hbWUiO3M6MTA6IkZqYWxsYSBPbmUiO3M6MTQ6ImJvZHlfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJoZWFkaW5nX2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czoyMToibGlua3NfdGV4dF9kZWNvcmF0aW9uIjtzOjk6InVuZGVybGluZSI7czoxNjoibGlua3NfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MTI6ImhlYWRlcl9zdHlsZSI7czo1OiJmaXhlZCI7czozMzoiaGVhZGVyX2hlaWdodF9yZWR1Y3Rpb25fc2Nyb2xsaW5nIjtzOjc6ImRpc2FibGUiO3M6MTM6ImhlYWRlcl9oZWlnaHQiO3M6MjoiNjQiO3M6MjY6ImhlYWRlcl9oZWlnaHRfb25fc2Nyb2xsaW5nIjtzOjI6IjU0IjtzOjI4OiJlbmFibGVfZnVsbF93aWR0aF9mb3JfaGVhZGVyIjthOjE6e2k6MDtzOjM6InllcyI7fXM6MTU6ImhlYWRlcl9wb3NpdGlvbiI7czozOiJ0b3AiO3M6MTI6ImxvZ29fY2FwdGlvbiI7czowOiIiO3M6MTA6ImJ1dHRvbl91cmwiO3M6MDoiIjtzOjExOiJidXR0b25fdGV4dCI7czowOiIiO3M6MjE6InNvY2lhbF9pY29uc19wb3NpdGlvbiI7czo0OiJub25lIjtzOjIyOiJzZWFyY2hfaGVhZGVyX3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MTE6ImhlYWRlcl9pbmZvIjtzOjA6IiI7czoyNToid29vY29tbWVyY2VfY2FydF9wb3NpdGlvbiI7czo0OiJub25lIjtzOjIzOiJoZWFkZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjIxOiJuYXZpZ2F0aW9uX2xpbmtfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoyNzoibmF2aWdhdGlvbl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImhlYWRlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImhlYWRlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImhlYWRlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImhlYWRlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNDoiaGVhZGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjIzOiJoZWFkZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjI2OiJoZWFkZXJfYm90dG9tX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjEzOiJtZW51X3Bvc2l0aW9uIjtzOjU6InJpZ2h0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MjA6InNlY29uZGFyeV9tZW51X2FsaWduIjtzOjU6InJpZ2h0IjtzOjEyOiJ0b3BfYmFyX2luZm8iO3M6MDoiIjtzOjE4OiJ0b3BfYmFyX2luZm9fYWxpZ24iO3M6NToicmlnaHQiO3M6MjQ6InRvcF9iYXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE4OiJ0b3BfYmFyX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoidG9wX2Jhcl9saW5rX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjQ6InRvcF9iYXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjI2OiJ0b3BfYmFyX3NvY2lhbF9pY29uc19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJiYWNrX3RvX3RvcF9idXR0b24iO3M6NjoiZW5hYmxlIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fYWxpZ24iO3M6NToiZml4ZWQiO3M6Mjg6ImVuYWJsZV9mdWxsX3dpZHRoX2Zvcl9mb290ZXIiO2E6MTp7aTowO3M6MzoieWVzIjt9czoyNDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzA6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI1OiJmb290ZXJfd2lkZ2V0X3RpdGxlX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImZvb3Rlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTY6ImZvb3Rlcl90ZXh0X3NpemUiO3M6MjoiMTMiO3M6MTc6ImZvb3Rlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV90ZXh0X2NvbG9yIjtzOjc6IiM5OTk5OTkiO3M6MjU6ImZvb3Rlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoyNDoiZm9vdGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjMwOiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX3BhZGRpbmciO3M6MjoiMTAiO3M6MzM6ImZvb3Rlcl9ib3R0b21fYXJlYV9ib3R0b21fcGFkZGluZyI7czoyOiIxMCI7czoyMzoiZm9vdGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxNToiZm9vdGVyX3BhcmFsbGF4IjtzOjc6ImRpc2FibGUiO3M6Mjc6InNpbmdsZV9wb3J0Zm9saW9fbmF2aWdhdGlvbiI7czo2OiJlbmFibGUiO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjA6IiI7czoyMjoic2luZ2xlX3Bvc3RfbmF2aWdhdGlvbiI7czo2OiJlbmFibGUiO3M6MTg6InNvY2lhbF9saW5rc19zdHlsZSI7czoxOiIxIjtzOjEyOiJzb2NpYWxfbGlua3MiO2E6Njp7aTowO3M6NzoidHdpdHRlciI7aToxO3M6ODoiZmFjZWJvb2siO2k6MjtzOjg6ImxpbmtlZGluIjtpOjM7czo5OiJpbnN0YWdyYW0iO2k6MTE7czo3OiJiZWhhbmNlIjtpOjE0O3M6NToiZW1haWwiO31zOjExOiJ0d2l0dGVyX3VybCI7czoyMDoiaHR0cHM6Ly90d2l0dGVyLmNvbS8iO3M6MTI6ImZhY2Vib29rX3VybCI7czoyNDoiaHR0cDovL3d3dy5mYWNlYm9vay5jb20vIjtzOjEzOiJpbnN0YWdyYW1fdXJsIjtzOjIxOiJodHRwOi8vaW5zdGFncmFtLmNvbS8iO3M6MTI6ImxpbmtlZGluX3VybCI7czoyNDoiaHR0cDovL3d3dy5saW5rZWRpbi5jb20vIjtzOjEzOiJwaW50ZXJlc3RfdXJsIjtzOjIxOiJodHRwOi8vcGludGVyZXN0LmNvbS8iO3M6OToiZ3BsdXNfdXJsIjtzOjI0OiJodHRwczovL3BsdXMuZ29vZ2xlLmNvbS8iO3M6OToidmltZW9fdXJsIjtzOjE3OiJodHRwOi8vdmltZW8uY29tLyI7czoxMDoiZmxpY2tyX3VybCI7czoyMjoiaHR0cDovL3d3dy5mbGlja3IuY29tLyI7czoxMDoidHVtYmxyX3VybCI7czoyMzoiaHR0cHM6Ly93d3cudHVtYmxyLmNvbS8iO3M6MTE6InlvdXR1YmVfdXJsIjtzOjIzOiJodHRwOi8vd3d3LnlvdXR1YmUuY29tLyI7czoxMjoiZHJpYmJibGVfdXJsIjtzOjIwOiJodHRwOi8vZHJpYmJibGUuY29tLyI7czoxMToiYmVoYW5jZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cuYmVoYW5jZS5uZXQvIjtzOjY6InB4X3VybCI7czoxODoiaHR0cHM6Ly81MDBweC5jb20vIjtzOjY6InZrX3VybCI7czoxNDoiaHR0cDovL3ZrLmNvbS8iO3M6MTM6ImVtYWlsX2FkZHJlc3MiO3M6MjM6InBsYWNlaG9sZGVyQGV4YW1wbGUuY29tIjtzOjI0OiJlbmFibGVfd29vY29tbWVyY2VfbGlua3MiO3M6NzoiZGlzYWJsZSI7czoxMToic2hvcF9sYXlvdXQiO3M6MTI6ImxlZnQtc2lkZWJhciI7czoxMjoic2hvcF9jb2x1bW5zIjtzOjE6IjMiO3M6MjY6ImhlYWRlcl9iYWNrZ3JvdW5kX2Zvcl9zaG9wIjtzOjA6IiI7czozNDoiYWRkX3RvX2NhcnRfdGV4dF9vbl9zaW5nbGVfcHJvZHVjdCI7czowOiIiO3M6MjM6InJldm9sdXRpb25fc2xpZGVyX2FsaWFzIjtzOjA6IiI7czozODoiYWRkaXRpb25hbF9pbmZvX29uX3NpbmdsZV9wcm9kdWN0X3BhZ2UiO3M6MDoiIjt9';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
		
		// Import Revolution Slider
        if ( class_exists( 'RevSlider' ) ) {
			$slider_array = array(
				'jettie/revslider/featured-portfolio.zip',
			);
			
			$slider_array1 = array(
				'jettie/revslider/argentique-paris-fw2017.zip',
				'jettie/revslider/bm-for-bananamoon-fw17.zip',
				'jettie/revslider/closer.zip',
				'jettie/revslider/fill-in-blue.zip',
			);
			
			$slider_array2 = array(
				'jettie/revslider/freshbrand-ss18.zip',
				'jettie/revslider/ivresses-2.zip',
				'jettie/revslider/ivresses.zip',
				'jettie/revslider/look-at-me-now-for-folkr.zip',
			);
			
			$slider_array3 = array(
				'jettie/revslider/mai68.zip',
				'jettie/revslider/mr-simone-ss2018.zip',
				'jettie/revslider/mykronoz-campaign.zip',
				'jettie/revslider/nomi-magazine.zip',
			);
			
			$slider_array4 = array(
				'jettie/revslider/plastic-queen.zip',
				'jettie/revslider/pumpkin-flamingo-for-lucys-magazine.zip',
				'jettie/revslider/red-dingue-for-kids-magazine.zip',
				'jettie/revslider/sasha.zip',
			);
			
			$slider_array5 = array(
				'jettie/revslider/tashia-london-ss2018.zip',
				'jettie/revslider/the-fashionisto-night-in-paris.zip',
				'jettie/revslider/the-ghost-in-me.zip',
				'jettie/revslider/under-the-bridge.zip',
			);
			
			$slider_array6 = array(
				'jettie/revslider/when-she-wonders.zip',
				'jettie/revslider/mad-candice.zip'
			);
			
			$slider = new RevSlider();
			
			foreach($slider_array as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array1 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array2 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array3 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array4 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array5 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array6 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
        }
	} else if ( 'Rashida' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 371 );
		update_option( 'medium_size_h', 0 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Rashida', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', '' );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjc6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjIwIjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjk6Imxvd2VyY2FzZSI7czoxNjoibG9nb19mb250X3dlaWdodCI7czozOiI5MDAiO3M6MTk6ImxvZ29fbGV0dGVyX3NwYWNpbmciO3M6MToiMiI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjN2Y3ZjdmIjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjMjYyNjI2IjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiMzMzMzMzMiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czowOiIiO3M6MjE6ImxvZ29fZ29vZ2xlX2ZvbnRfbmFtZSI7czowOiIiO3M6MTg6InByaW1hcnlfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjE4OiJnb29nbGVfZm9udF9mYW1pbHkiO3M6NzE6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Bbm9ueW1vdXMrUHJvOjQwMCw0MDBpLDcwMCw3MDBpIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjEzOiJBbm9ueW1vdXMgUHJvIjtzOjE1OiJtZW51X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyMzoibWVudV9nb29nbGVfZm9udF9mYW1pbHkiO3M6NzE6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Bbm9ueW1vdXMrUHJvOjQwMCw0MDBpLDcwMCw3MDBpIjtzOjIxOiJtZW51X2dvb2dsZV9mb250X25hbWUiO3M6MTM6IkFub255bW91cyBQcm8iO3M6MTQ6Im1lbnVfZm9udF9zaXplIjtzOjI6IjEzIjtzOjMxOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJtZW51X3RleHRfdHJhbnNmb3JtIjtzOjk6InVwcGVyY2FzZSI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6Im1lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjMzOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjE5OiJtZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjIiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIwIjtzOjE1OiJtZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjMyOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MjY6Im1lbnVfdGV4dF9kZWNvcmF0aW9uX2hvdmVyIjtzOjk6InVuZGVybGluZSI7czoxODoiaGVhZGluZ190eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjY6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjU1OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9UG9wcGluczo0MDAsNzAwIjtzOjI0OiJoZWFkaW5nX2dvb2dsZV9mb250X25hbWUiO3M6NzoiUG9wcGlucyI7czoxNDoiYm9keV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6ImhlYWRpbmdfZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjIxOiJsaW5rc190ZXh0X2RlY29yYXRpb24iO3M6OToidW5kZXJsaW5lIjtzOjE2OiJsaW5rc19mb250X3N0eWxlIjtzOjY6Iml0YWxpYyI7czoxMjoiaGVhZGVyX3N0eWxlIjtzOjU6ImZpeGVkIjtzOjMzOiJoZWFkZXJfaGVpZ2h0X3JlZHVjdGlvbl9zY3JvbGxpbmciO3M6NzoiZGlzYWJsZSI7czoxMzoiaGVhZGVyX2hlaWdodCI7czoyOiI2NCI7czoyNjoiaGVhZGVyX2hlaWdodF9vbl9zY3JvbGxpbmciO3M6MjoiNTQiO3M6Mjg6ImVuYWJsZV9mdWxsX3dpZHRoX2Zvcl9oZWFkZXIiO2E6MTp7aTowO3M6MzoieWVzIjt9czoxNToiaGVhZGVyX3Bvc2l0aW9uIjtzOjM6InRvcCI7czoxMjoibG9nb19jYXB0aW9uIjtzOjA6IiI7czoxMDoiYnV0dG9uX3VybCI7czowOiIiO3M6MTE6ImJ1dHRvbl90ZXh0IjtzOjA6IiI7czoyMToic29jaWFsX2ljb25zX3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MjI6InNlYXJjaF9oZWFkZXJfcG9zaXRpb24iO3M6NDoibm9uZSI7czoxMToiaGVhZGVyX2luZm8iO3M6MDoiIjtzOjI1OiJ3b29jb21tZXJjZV9jYXJ0X3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MjM6ImhlYWRlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjE6Im5hdmlnYXRpb25fbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI3OiJuYXZpZ2F0aW9uX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoxNzoiaGVhZGVyX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxNzoiaGVhZGVyX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMzoiaGVhZGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyNToiaGVhZGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJoZWFkZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MjM6ImhlYWRlcl90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MjY6ImhlYWRlcl9ib3R0b21fYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTM6Im1lbnVfcG9zaXRpb24iO3M6NToicmlnaHQiO3M6MTM6ImxvZ29fcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMDoic2Vjb25kYXJ5X21lbnVfYWxpZ24iO3M6NToicmlnaHQiO3M6MTI6InRvcF9iYXJfaW5mbyI7czowOiIiO3M6MTg6InRvcF9iYXJfaW5mb19hbGlnbiI7czo1OiJyaWdodCI7czoyNDoidG9wX2Jhcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTg6InRvcF9iYXJfdGV4dF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJ0b3BfYmFyX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNDoidG9wX2Jhcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjY6InRvcF9iYXJfc29jaWFsX2ljb25zX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6ImJhY2tfdG9fdG9wX2J1dHRvbiI7czo2OiJlbmFibGUiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9hbGlnbiI7czo1OiJmaXhlZCI7czoyODoiZW5hYmxlX2Z1bGxfd2lkdGhfZm9yX2Zvb3RlciI7YToxOntpOjA7czozOiJ5ZXMiO31zOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3IiO3M6NzoiI2ZmZmZmZiI7czozMDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjM6ImZvb3Rlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImZvb3Rlcl93aWRnZXRfdGl0bGVfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxNzoiZm9vdGVyX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxNjoiZm9vdGVyX3RleHRfc2l6ZSI7czoyOiIxMyI7czoxNzoiZm9vdGVyX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMzoiZm9vdGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNToiZm9vdGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJmb290ZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MzA6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfcGFkZGluZyI7czoyOiIxMCI7czozMzoiZm9vdGVyX2JvdHRvbV9hcmVhX2JvdHRvbV9wYWRkaW5nIjtzOjI6IjEwIjtzOjIzOiJmb290ZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjE1OiJmb290ZXJfcGFyYWxsYXgiO3M6NzoiZGlzYWJsZSI7czoyNzoic2luZ2xlX3BvcnRmb2xpb19uYXZpZ2F0aW9uIjtzOjY6ImVuYWJsZSI7czoxNDoicG9ydGZvbGlvX3BhZ2UiO3M6MDoiIjtzOjIyOiJzaW5nbGVfcG9zdF9uYXZpZ2F0aW9uIjtzOjY6ImVuYWJsZSI7czoxODoic29jaWFsX2xpbmtzX3N0eWxlIjtzOjE6IjEiO3M6MTI6InNvY2lhbF9saW5rcyI7YTozOntpOjA7czo3OiJ0d2l0dGVyIjtpOjE7czo4OiJmYWNlYm9vayI7aTozO3M6OToiaW5zdGFncmFtIjt9czoxMToidHdpdHRlcl91cmwiO3M6MjA6Imh0dHBzOi8vdHdpdHRlci5jb20vIjtzOjEyOiJmYWNlYm9va191cmwiO3M6MjQ6Imh0dHA6Ly93d3cuZmFjZWJvb2suY29tLyI7czoxMzoiaW5zdGFncmFtX3VybCI7czoyMToiaHR0cDovL2luc3RhZ3JhbS5jb20vIjtzOjEyOiJsaW5rZWRpbl91cmwiO3M6MjQ6Imh0dHA6Ly93d3cubGlua2VkaW4uY29tLyI7czoxMzoicGludGVyZXN0X3VybCI7czoyMToiaHR0cDovL3BpbnRlcmVzdC5jb20vIjtzOjk6ImdwbHVzX3VybCI7czoyNDoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20vIjtzOjk6InZpbWVvX3VybCI7czoxNzoiaHR0cDovL3ZpbWVvLmNvbS8iO3M6MTA6ImZsaWNrcl91cmwiO3M6MjI6Imh0dHA6Ly93d3cuZmxpY2tyLmNvbS8iO3M6MTA6InR1bWJscl91cmwiO3M6MjM6Imh0dHBzOi8vd3d3LnR1bWJsci5jb20vIjtzOjExOiJ5b3V0dWJlX3VybCI7czoyMzoiaHR0cDovL3d3dy55b3V0dWJlLmNvbS8iO3M6MTI6ImRyaWJiYmxlX3VybCI7czoyMDoiaHR0cDovL2RyaWJiYmxlLmNvbS8iO3M6MTE6ImJlaGFuY2VfdXJsIjtzOjIzOiJodHRwOi8vd3d3LmJlaGFuY2UubmV0LyI7czo2OiJweF91cmwiO3M6MTg6Imh0dHBzOi8vNTAwcHguY29tLyI7czo2OiJ2a191cmwiO3M6MTQ6Imh0dHA6Ly92ay5jb20vIjtzOjEzOiJlbWFpbF9hZGRyZXNzIjtzOjIzOiJwbGFjZWhvbGRlckBleGFtcGxlLmNvbSI7czoyNDoiZW5hYmxlX3dvb2NvbW1lcmNlX2xpbmtzIjtzOjc6ImRpc2FibGUiO3M6MTE6InNob3BfbGF5b3V0IjtzOjEyOiJsZWZ0LXNpZGViYXIiO3M6MTI6InNob3BfY29sdW1ucyI7czoxOiIzIjtzOjI2OiJoZWFkZXJfYmFja2dyb3VuZF9mb3Jfc2hvcCI7czowOiIiO3M6MzQ6ImFkZF90b19jYXJ0X3RleHRfb25fc2luZ2xlX3Byb2R1Y3QiO3M6MDoiIjtzOjIzOiJyZXZvbHV0aW9uX3NsaWRlcl9hbGlhcyI7czowOiIiO3M6Mzg6ImFkZGl0aW9uYWxfaW5mb19vbl9zaW5nbGVfcHJvZHVjdF9wYWdlIjtzOjA6IiI7fQ==';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
		
		// Import Revolution Slider
        if ( class_exists( 'RevSlider' ) ) {
			$slider_array = array(
				'rashida/revslider/featured-portfolio.zip',
			);
			
			$slider_array1 = array(
				'rashida/revslider/aicha.zip',
				'rashida/revslider/anica.zip',
				'rashida/revslider/apt-102.zip',
				'rashida/revslider/ax-oak.zip',
			);
			
			$slider_array2 = array(
				'rashida/revslider/banana-leaf.zip',
				'rashida/revslider/cat-burglar.zip',
				'rashida/revslider/class-act.zip',
				'rashida/revslider/clouds-before-the-sun.zip',
			);
			
			$slider_array3 = array(
				'rashida/revslider/emi.zip',
				'rashida/revslider/heart-rock.zip',
				'rashida/revslider/hide-seek.zip',
				'rashida/revslider/human-temperature.zip',
			);
			
			$slider_array4 = array(
				'rashida/revslider/lauren.zip',
				'rashida/revslider/peek-at-you.zip',
				'rashida/revslider/red-pepper.zip',
				'rashida/revslider/riley.zip',
			);
			
			$slider_array5 = array(
				'rashida/revslider/room-to-play.zip',
				'rashida/revslider/serena.zip',
				'rashida/revslider/silver-slither.zip',
				'rashida/revslider/space-above.zip',
			);
			
			$slider_array6 = array(
				'rashida/revslider/sweet-lo.zip',
				'rashida/revslider/vacances.zip',
				'rashida/revslider/william.zip',
				'rashida/revslider/xyz.zip'
			);
			
			$slider = new RevSlider();
			
			foreach($slider_array as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array1 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array2 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array3 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array4 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array5 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array6 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
        }
	} else if ( 'Romelia' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Romelia', 'nav_menu' );
		$secondary_header_menu = get_term_by( 'name', 'Romelia Secondary', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
				'secondary_header' => $secondary_header_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Fashion' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMzA6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjI0IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6ImxvZ29fZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjE5OiJsb2dvX2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6ImxvZ29fZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6NDoibG9nbyI7czowOiIiO3M6Mjc6ImxvZ29fZm9yX3RyYW5zcGFyZW50X2hlYWRlciI7czowOiIiO3M6MTU6ImhlaWdodF9mb3JfbG9nbyI7czoyOiIxOCI7czoxMjoiYWNjZW50X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTA6ImJvZHlfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMzoicHJpbWFyeV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE1OiJzZWNvbmRhcnlfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoxMToidGhpcmRfY29sb3IiO3M6NzoiI2YyZjJmMiI7czoxMzoiYm9yZGVyc19jb2xvciI7czo3OiIjZTZlNmU2IjtzOjExOiJsaW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJsaW5rc19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIyOiJwYWdlX2xvYWRfcHJvZ3Jlc3NfYmFyIjtzOjc6ImVuYWJsZWQiO3M6Mjg6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXJfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMDoibW9iaWxlX21lbnVfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMzoibG9nb19nb29nbGVfZm9udF9mYW1pbHkiO3M6MDoiIjtzOjIxOiJsb2dvX2dvb2dsZV9mb250X25hbWUiO3M6MDoiIjtzOjE4OiJwcmltYXJ5X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoxODoiZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjY3OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9SXN0b2srV2ViOjQwMCw0MDBpLDcwMCw3MDBpIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjk6IklzdG9rIFdlYiI7czoxNToibWVudV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjM6Im1lbnVfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjY3OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9SXN0b2srV2ViOjQwMCw0MDBpLDcwMCw3MDBpIjtzOjIxOiJtZW51X2dvb2dsZV9mb250X25hbWUiO3M6OToiSXN0b2sgV2ViIjtzOjE0OiJtZW51X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czozMToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoxOToibWVudV90ZXh0X3RyYW5zZm9ybSI7czo0OiJub25lIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfdGV4dF90cmFuc2Zvcm0iO3M6NDoibm9uZSI7czoxNjoibWVudV9mb250X3dlaWdodCI7czozOiI3MDAiO3M6MzM6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MTk6Im1lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6Im1lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MzI6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czoyNjoibWVudV90ZXh0X2RlY29yYXRpb25faG92ZXIiO3M6NDoibm9uZSI7czoxODoiaGVhZGluZ190eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjY6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjYyOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9TW9udHNlcnJhdDo0MDAsNzAwLDkwMCI7czoyNDoiaGVhZGluZ19nb29nbGVfZm9udF9uYW1lIjtzOjEwOiJNb250c2VycmF0IjtzOjE0OiJib2R5X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToiaGVhZGluZ19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MjE6ImxpbmtzX3RleHRfZGVjb3JhdGlvbiI7czo5OiJ1bmRlcmxpbmUiO3M6MTY6ImxpbmtzX2ZvbnRfc3R5bGUiO3M6NjoiaXRhbGljIjtzOjEyOiJoZWFkZXJfc3R5bGUiO3M6NToiZml4ZWQiO3M6MzM6ImhlYWRlcl9oZWlnaHRfcmVkdWN0aW9uX3Njcm9sbGluZyI7czo3OiJkaXNhYmxlIjtzOjEzOiJoZWFkZXJfaGVpZ2h0IjtzOjM6IjI1MCI7czoyNjoiaGVhZGVyX2hlaWdodF9vbl9zY3JvbGxpbmciO3M6MjoiNTQiO3M6MTU6ImhlYWRlcl9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjI5OiJwYWRkaW5nX2Zvcl9sZWZ0X3JpZ2h0X2hlYWRlciI7czo3OiJlbmFibGVkIjtzOjQ5OiJjZW50ZXJfY29udGVudF9ob3Jpem9udGFsbHlfZm9yX2xlZnRfcmlnaHRfaGVhZGVyIjtzOjg6ImRpc2FibGVkIjtzOjEyOiJsb2dvX2NhcHRpb24iO3M6MDoiIjtzOjEwOiJidXR0b25fdXJsIjtzOjA6IiI7czoxMToiYnV0dG9uX3RleHQiO3M6MDoiIjtzOjIxOiJzb2NpYWxfaWNvbnNfcG9zaXRpb24iO3M6NjoiaGVhZGVyIjtzOjIyOiJzZWFyY2hfaGVhZGVyX3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MTE6ImhlYWRlcl9pbmZvIjtzOjA6IiI7czoyNToid29vY29tbWVyY2VfY2FydF9wb3NpdGlvbiI7czo0OiJub25lIjtzOjIzOiJoZWFkZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjIxOiJuYXZpZ2F0aW9uX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czo0Mzoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X25hdmlnYXRpb25fbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI3OiJuYXZpZ2F0aW9uX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzk5OTk5OSI7czo0OToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X25hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfdGV4dF9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjE3OiJoZWFkZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJoZWFkZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI1OiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzE6ImhlYWRlcl9zb2NpYWxfbGlua3NfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyNDoiaGVhZGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjIzOiJoZWFkZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjI2OiJoZWFkZXJfYm90dG9tX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjEzOiJtZW51X3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MTM6ImxvZ29fcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMDoic2Vjb25kYXJ5X21lbnVfYWxpZ24iO3M6NToicmlnaHQiO3M6MTI6InRvcF9iYXJfaW5mbyI7czowOiIiO3M6MTg6InRvcF9iYXJfaW5mb19hbGlnbiI7czo1OiJyaWdodCI7czoyNDoidG9wX2Jhcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTg6InRvcF9iYXJfdGV4dF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJ0b3BfYmFyX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNDoidG9wX2Jhcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjY6InRvcF9iYXJfc29jaWFsX2ljb25zX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6ImJhY2tfdG9fdG9wX2J1dHRvbiI7czo2OiJlbmFibGUiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9hbGlnbiI7czo1OiJmaXhlZCI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzA6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI1OiJmb290ZXJfd2lkZ2V0X3RpdGxlX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImZvb3Rlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTY6ImZvb3Rlcl90ZXh0X3NpemUiO3M6MjoiMTMiO3M6MTc6ImZvb3Rlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImZvb3Rlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNDoiZm9vdGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjMwOiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX3BhZGRpbmciO3M6MjoiNTAiO3M6MzM6ImZvb3Rlcl9ib3R0b21fYXJlYV9ib3R0b21fcGFkZGluZyI7czoyOiI1MCI7czoyMzoiZm9vdGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxNToiZm9vdGVyX3BhcmFsbGF4IjtzOjc6ImRpc2FibGUiO3M6Mjc6InNpbmdsZV9wb3J0Zm9saW9fbmF2aWdhdGlvbiI7czo2OiJlbmFibGUiO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjA6IiI7czoyMjoic2luZ2xlX3Bvc3RfbmF2aWdhdGlvbiI7czo3OiJkaXNhYmxlIjtzOjE4OiJzb2NpYWxfbGlua3Nfc3R5bGUiO3M6MToiNCI7czoxMjoic29jaWFsX2xpbmtzIjthOjM6e2k6MDtzOjc6InR3aXR0ZXIiO2k6MTtzOjg6ImZhY2Vib29rIjtpOjM7czo5OiJpbnN0YWdyYW0iO31zOjExOiJ0d2l0dGVyX3VybCI7czoyMDoiaHR0cHM6Ly90d2l0dGVyLmNvbS8iO3M6MTI6ImZhY2Vib29rX3VybCI7czoyNDoiaHR0cDovL3d3dy5mYWNlYm9vay5jb20vIjtzOjEzOiJpbnN0YWdyYW1fdXJsIjtzOjIxOiJodHRwOi8vaW5zdGFncmFtLmNvbS8iO3M6MTI6ImxpbmtlZGluX3VybCI7czoyNDoiaHR0cDovL3d3dy5saW5rZWRpbi5jb20vIjtzOjEzOiJwaW50ZXJlc3RfdXJsIjtzOjIxOiJodHRwOi8vcGludGVyZXN0LmNvbS8iO3M6OToiZ3BsdXNfdXJsIjtzOjI0OiJodHRwczovL3BsdXMuZ29vZ2xlLmNvbS8iO3M6OToidmltZW9fdXJsIjtzOjE3OiJodHRwOi8vdmltZW8uY29tLyI7czoxMDoiZmxpY2tyX3VybCI7czoyMjoiaHR0cDovL3d3dy5mbGlja3IuY29tLyI7czoxMDoidHVtYmxyX3VybCI7czoyMzoiaHR0cHM6Ly93d3cudHVtYmxyLmNvbS8iO3M6MTE6InlvdXR1YmVfdXJsIjtzOjIzOiJodHRwOi8vd3d3LnlvdXR1YmUuY29tLyI7czoxMjoiZHJpYmJibGVfdXJsIjtzOjIwOiJodHRwOi8vZHJpYmJibGUuY29tLyI7czoxMToiYmVoYW5jZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cuYmVoYW5jZS5uZXQvIjtzOjY6InB4X3VybCI7czoxODoiaHR0cHM6Ly81MDBweC5jb20vIjtzOjY6InZrX3VybCI7czoxNDoiaHR0cDovL3ZrLmNvbS8iO3M6MTM6ImVtYWlsX2FkZHJlc3MiO3M6MjM6InBsYWNlaG9sZGVyQGV4YW1wbGUuY29tIjtzOjI0OiJlbmFibGVfd29vY29tbWVyY2VfbGlua3MiO3M6NzoiZGlzYWJsZSI7czoxMToic2hvcF9sYXlvdXQiO3M6MTI6ImxlZnQtc2lkZWJhciI7czoxMjoic2hvcF9jb2x1bW5zIjtzOjE6IjMiO3M6MjY6ImhlYWRlcl9iYWNrZ3JvdW5kX2Zvcl9zaG9wIjtzOjA6IiI7czozNDoiYWRkX3RvX2NhcnRfdGV4dF9vbl9zaW5nbGVfcHJvZHVjdCI7czowOiIiO3M6MjM6InJldm9sdXRpb25fc2xpZGVyX2FsaWFzIjtzOjA6IiI7czozODoiYWRkaXRpb25hbF9pbmZvX29uX3NpbmdsZV9wcm9kdWN0X3BhZ2UiO3M6MDoiIjt9';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
		
		// Import Revolution Slider
        if ( class_exists( 'RevSlider' ) ) {
			$slider_array = array(
				'romelia/revslider/featured-portfolio.zip',
			);
			
			$slider_array1 = array(
				'romelia/revslider/alexandra-martynova.zip',
				'romelia/revslider/ali-osk.zip',
				'romelia/revslider/augusta.zip',
				'romelia/revslider/chic-magazine-no-25.zip',
			);
			
			$slider_array2 = array(
				'romelia/revslider/chic-magazine-no-27.zip',
				'romelia/revslider/christian-dior-resort-2017.zip',
				'romelia/revslider/culture-ss14-campaign.zip',
				'romelia/revslider/desert-story.zip',
			);
			
			$slider_array3 = array(
				'romelia/revslider/dior-aw16-story.zip',
				'romelia/revslider/fault-magazine.zip',
				'romelia/revslider/grazia.zip',
				'romelia/revslider/henrik-fallenius.zip',
			);
			
			$slider_array4 = array(
				'romelia/revslider/ida-rosenberg.zip',
				'romelia/revslider/juliane-gruner.zip',
				'romelia/revslider/louise-kragh-aw17.zip',
				'romelia/revslider/merethe-hvam.zip',
			);
			
			$slider_array5 = array(
				'romelia/revslider/merethe-kaibosh.zip',
				'romelia/revslider/neverland-magazine-sportify.zip',
				'romelia/revslider/olivia-garson.zip',
				'romelia/revslider/other-people-magazine-four.zip',
			);
			
			$slider_array6 = array(
				'romelia/revslider/rebeca-marcos.zip',
				'romelia/revslider/solveig.zip',
				'romelia/revslider/ugly-magazine-flowers.zip',
				'romelia/revslider/ugly-magazine.zip',
			);
			
			$slider_array7 = array(
				'romelia/revslider/underprotection-ss17-swimwear.zip',
				'romelia/revslider/unique-girls.zip',
				'romelia/revslider/velvet-magazine-punked-noir.zip',
				'romelia/revslider/w2g-international.zip'
			);
			
			$slider = new RevSlider();
			
			foreach($slider_array as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array1 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array2 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array3 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array4 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array5 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array6 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array7 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
        }
	} else if ( 'Heather' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Heather', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjU6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjk6InVwcGVyY2FzZSI7czoxNjoibG9nb19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MTk6ImxvZ29fbGV0dGVyX3NwYWNpbmciO3M6MToiMiI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjZjJmMmYyIjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czowOiIiO3M6MjE6ImxvZ29fZ29vZ2xlX2ZvbnRfbmFtZSI7czowOiIiO3M6MTg6InByaW1hcnlfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjE4OiJnb29nbGVfZm9udF9mYW1pbHkiO3M6Njc6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1PcGVuK1NhbnM6NDAwLDQwMGksNzAwLDcwMGkiO3M6MTY6Imdvb2dsZV9mb250X25hbWUiO3M6OToiT3BlbiBTYW5zIjtzOjE1OiJtZW51X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyMzoibWVudV9nb29nbGVfZm9udF9mYW1pbHkiO3M6NTU6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Qb3BwaW5zOjQwMCw3MDAiO3M6MjE6Im1lbnVfZ29vZ2xlX2ZvbnRfbmFtZSI7czo3OiJQb3BwaW5zIjtzOjE0OiJtZW51X2ZvbnRfc2l6ZSI7czoyOiIxMiI7czozMToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoxOToibWVudV90ZXh0X3RyYW5zZm9ybSI7czo5OiJ1cHBlcmNhc2UiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV90ZXh0X3RyYW5zZm9ybSI7czo5OiJ1cHBlcmNhc2UiO3M6MTY6Im1lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjMzOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjE5OiJtZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjIiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIwIjtzOjE1OiJtZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjMyOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MjY6Im1lbnVfdGV4dF9kZWNvcmF0aW9uX2hvdmVyIjtzOjQ6Im5vbmUiO3M6MTg6ImhlYWRpbmdfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjI2OiJoZWFkaW5nX2dvb2dsZV9mb250X2ZhbWlseSI7czo1NToiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PVBvcHBpbnM6NDAwLDcwMCI7czoyNDoiaGVhZGluZ19nb29nbGVfZm9udF9uYW1lIjtzOjc6IlBvcHBpbnMiO3M6MTQ6ImJvZHlfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJoZWFkaW5nX2ZvbnRfd2VpZ2h0IjtzOjM6IjcwMCI7czoyMToibGlua3NfdGV4dF9kZWNvcmF0aW9uIjtzOjk6InVuZGVybGluZSI7czoxNjoibGlua3NfZm9udF9zdHlsZSI7czo2OiJpdGFsaWMiO3M6MTI6ImhlYWRlcl9zdHlsZSI7czo1OiJmaXhlZCI7czozMzoiaGVhZGVyX2hlaWdodF9yZWR1Y3Rpb25fc2Nyb2xsaW5nIjtzOjc6ImRpc2FibGUiO3M6MTM6ImhlYWRlcl9oZWlnaHQiO3M6MzoiMjE5IjtzOjI2OiJoZWFkZXJfaGVpZ2h0X29uX3Njcm9sbGluZyI7czoyOiI1NCI7czoxNToiaGVhZGVyX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MTI6ImxvZ29fY2FwdGlvbiI7czowOiIiO3M6MTA6ImJ1dHRvbl91cmwiO3M6MDoiIjtzOjExOiJidXR0b25fdGV4dCI7czowOiIiO3M6MjE6InNvY2lhbF9pY29uc19wb3NpdGlvbiI7czo2OiJoZWFkZXIiO3M6MjI6InNlYXJjaF9oZWFkZXJfcG9zaXRpb24iO3M6NDoibm9uZSI7czoxMToiaGVhZGVyX2luZm8iO3M6MDoiIjtzOjI1OiJ3b29jb21tZXJjZV9jYXJ0X3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MjM6ImhlYWRlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjE6Im5hdmlnYXRpb25fbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI3OiJuYXZpZ2F0aW9uX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzk5OTk5OSI7czoxNzoiaGVhZGVyX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNzoiaGVhZGVyX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMzoiaGVhZGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyNToiaGVhZGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjOTk5OTk5IjtzOjI0OiJoZWFkZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MjM6ImhlYWRlcl90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MjY6ImhlYWRlcl9ib3R0b21fYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTM6Im1lbnVfcG9zaXRpb24iO3M6NToicmlnaHQiO3M6MTM6ImxvZ29fcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMDoic2Vjb25kYXJ5X21lbnVfYWxpZ24iO3M6NToicmlnaHQiO3M6MTI6InRvcF9iYXJfaW5mbyI7czowOiIiO3M6MTg6InRvcF9iYXJfaW5mb19hbGlnbiI7czo1OiJyaWdodCI7czoyNDoidG9wX2Jhcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTg6InRvcF9iYXJfdGV4dF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJ0b3BfYmFyX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNDoidG9wX2Jhcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjY6InRvcF9iYXJfc29jaWFsX2ljb25zX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6ImJhY2tfdG9fdG9wX2J1dHRvbiI7czo2OiJlbmFibGUiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9hbGlnbiI7czo1OiJmaXhlZCI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzA6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI1OiJmb290ZXJfd2lkZ2V0X3RpdGxlX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImZvb3Rlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTY6ImZvb3Rlcl90ZXh0X3NpemUiO3M6MjoiMTMiO3M6MTc6ImZvb3Rlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImZvb3Rlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNDoiZm9vdGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjMwOiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX3BhZGRpbmciO3M6MjoiNTAiO3M6MzM6ImZvb3Rlcl9ib3R0b21fYXJlYV9ib3R0b21fcGFkZGluZyI7czoyOiI1MCI7czoyMzoiZm9vdGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxNToiZm9vdGVyX3BhcmFsbGF4IjtzOjc6ImRpc2FibGUiO3M6Mjc6InNpbmdsZV9wb3J0Zm9saW9fbmF2aWdhdGlvbiI7czo3OiJkaXNhYmxlIjtzOjE0OiJwb3J0Zm9saW9fcGFnZSI7czowOiIiO3M6MjI6InNpbmdsZV9wb3N0X25hdmlnYXRpb24iO3M6NzoiZGlzYWJsZSI7czoxODoic29jaWFsX2xpbmtzX3N0eWxlIjtzOjE6IjMiO3M6MTI6InNvY2lhbF9saW5rcyI7YTozOntpOjA7czo3OiJ0d2l0dGVyIjtpOjE7czo4OiJmYWNlYm9vayI7aTozO3M6OToiaW5zdGFncmFtIjt9czoxMToidHdpdHRlcl91cmwiO3M6MjA6Imh0dHBzOi8vdHdpdHRlci5jb20vIjtzOjEyOiJmYWNlYm9va191cmwiO3M6MjQ6Imh0dHA6Ly93d3cuZmFjZWJvb2suY29tLyI7czoxMzoiaW5zdGFncmFtX3VybCI7czoyMToiaHR0cDovL2luc3RhZ3JhbS5jb20vIjtzOjEyOiJsaW5rZWRpbl91cmwiO3M6MjQ6Imh0dHA6Ly93d3cubGlua2VkaW4uY29tLyI7czoxMzoicGludGVyZXN0X3VybCI7czoyMToiaHR0cDovL3BpbnRlcmVzdC5jb20vIjtzOjk6ImdwbHVzX3VybCI7czoyNDoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20vIjtzOjk6InZpbWVvX3VybCI7czoxNzoiaHR0cDovL3ZpbWVvLmNvbS8iO3M6MTA6ImZsaWNrcl91cmwiO3M6MjI6Imh0dHA6Ly93d3cuZmxpY2tyLmNvbS8iO3M6MTA6InR1bWJscl91cmwiO3M6MjM6Imh0dHBzOi8vd3d3LnR1bWJsci5jb20vIjtzOjExOiJ5b3V0dWJlX3VybCI7czoyMzoiaHR0cDovL3d3dy55b3V0dWJlLmNvbS8iO3M6MTI6ImRyaWJiYmxlX3VybCI7czoyMDoiaHR0cDovL2RyaWJiYmxlLmNvbS8iO3M6MTE6ImJlaGFuY2VfdXJsIjtzOjIzOiJodHRwOi8vd3d3LmJlaGFuY2UubmV0LyI7czo2OiJweF91cmwiO3M6MTg6Imh0dHBzOi8vNTAwcHguY29tLyI7czo2OiJ2a191cmwiO3M6MTQ6Imh0dHA6Ly92ay5jb20vIjtzOjEzOiJlbWFpbF9hZGRyZXNzIjtzOjIzOiJwbGFjZWhvbGRlckBleGFtcGxlLmNvbSI7czoyNDoiZW5hYmxlX3dvb2NvbW1lcmNlX2xpbmtzIjtzOjc6ImRpc2FibGUiO3M6MTE6InNob3BfbGF5b3V0IjtzOjEyOiJsZWZ0LXNpZGViYXIiO3M6MTI6InNob3BfY29sdW1ucyI7czoxOiIzIjtzOjI2OiJoZWFkZXJfYmFja2dyb3VuZF9mb3Jfc2hvcCI7czowOiIiO3M6MzQ6ImFkZF90b19jYXJ0X3RleHRfb25fc2luZ2xlX3Byb2R1Y3QiO3M6MDoiIjtzOjIzOiJyZXZvbHV0aW9uX3NsaWRlcl9hbGlhcyI7czowOiIiO3M6Mzg6ImFkZGl0aW9uYWxfaW5mb19vbl9zaW5nbGVfcHJvZHVjdF9wYWdlIjtzOjA6IiI7fQ==';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Eileen' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 870 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Eileen', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjU6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjI0IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6ImxvZ29fZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjE5OiJsb2dvX2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6ImxvZ29fZm9udF9zdHlsZSI7czo2OiJpdGFsaWMiO3M6NDoibG9nbyI7czowOiIiO3M6Mjc6ImxvZ29fZm9yX3RyYW5zcGFyZW50X2hlYWRlciI7czowOiIiO3M6MTU6ImhlaWdodF9mb3JfbG9nbyI7czoyOiIxOCI7czoxMjoiYWNjZW50X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTA6ImJvZHlfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMzoicHJpbWFyeV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE1OiJzZWNvbmRhcnlfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoxMToidGhpcmRfY29sb3IiO3M6NzoiI2YyZjJmMiI7czoxMzoiYm9yZGVyc19jb2xvciI7czo3OiIjZTZlNmU2IjtzOjExOiJsaW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJsaW5rc19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIyOiJwYWdlX2xvYWRfcHJvZ3Jlc3NfYmFyIjtzOjc6ImVuYWJsZWQiO3M6Mjg6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXJfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMDoibW9iaWxlX21lbnVfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMzoibG9nb19nb29nbGVfZm9udF9mYW1pbHkiO3M6MDoiIjtzOjIxOiJsb2dvX2dvb2dsZV9mb250X25hbWUiO3M6MDoiIjtzOjE4OiJwcmltYXJ5X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoxODoiZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjczOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9U291cmNlK1NhbnMrUHJvOjQwMCw0MDBpLDcwMCw3MDBpIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjE1OiJTb3VyY2UgU2FucyBQcm8iO3M6MTU6Im1lbnVfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjIzOiJtZW51X2dvb2dsZV9mb250X2ZhbWlseSI7czo3NzoiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PVNvdXJjZStTYW5zK1Bybzo0MDAsNDAwaSw2MDAsNzAwLDcwMGkiO3M6MjE6Im1lbnVfZ29vZ2xlX2ZvbnRfbmFtZSI7czoxNToiU291cmNlIFNhbnMgUHJvIjtzOjE0OiJtZW51X2ZvbnRfc2l6ZSI7czoyOiIxMiI7czozMToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoxOToibWVudV90ZXh0X3RyYW5zZm9ybSI7czo5OiJ1cHBlcmNhc2UiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV90ZXh0X3RyYW5zZm9ybSI7czo0OiJub25lIjtzOjE2OiJtZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjYwMCI7czozMzoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czoxOToibWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIyIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czoxNToibWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czozMjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjI2OiJtZW51X3RleHRfZGVjb3JhdGlvbl9ob3ZlciI7czo0OiJub25lIjtzOjE4OiJoZWFkaW5nX3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyNjoiaGVhZGluZ19nb29nbGVfZm9udF9mYW1pbHkiO3M6NjI6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Mb3JhOjQwMCw0MDBpLDcwMCw3MDBpIjtzOjI0OiJoZWFkaW5nX2dvb2dsZV9mb250X25hbWUiO3M6NDoiTG9yYSI7czoxNDoiYm9keV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6ImhlYWRpbmdfZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjIxOiJsaW5rc190ZXh0X2RlY29yYXRpb24iO3M6OToidW5kZXJsaW5lIjtzOjE2OiJsaW5rc19mb250X3N0eWxlIjtzOjY6Iml0YWxpYyI7czoxMjoiaGVhZGVyX3N0eWxlIjtzOjU6ImZpeGVkIjtzOjMzOiJoZWFkZXJfaGVpZ2h0X3JlZHVjdGlvbl9zY3JvbGxpbmciO3M6NzoiZGlzYWJsZSI7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIyMTkiO3M6MjY6ImhlYWRlcl9oZWlnaHRfb25fc2Nyb2xsaW5nIjtzOjI6IjU0IjtzOjE1OiJoZWFkZXJfcG9zaXRpb24iO3M6NDoibGVmdCI7czoxMjoibG9nb19jYXB0aW9uIjtzOjA6IiI7czoxMDoiYnV0dG9uX3VybCI7czowOiIiO3M6MTE6ImJ1dHRvbl90ZXh0IjtzOjA6IiI7czoyMToic29jaWFsX2ljb25zX3Bvc2l0aW9uIjtzOjY6ImhlYWRlciI7czoyMjoic2VhcmNoX2hlYWRlcl9wb3NpdGlvbiI7czo0OiJub25lIjtzOjExOiJoZWFkZXJfaW5mbyI7czowOiIiO3M6MjU6Indvb2NvbW1lcmNlX2NhcnRfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMzoiaGVhZGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMToibmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6Mjc6Im5hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjOTk5OTk5IjtzOjE3OiJoZWFkZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJoZWFkZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI1OiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImhlYWRlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czoyMzoiaGVhZGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoyNjoiaGVhZGVyX2JvdHRvbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxMzoibWVudV9wb3NpdGlvbiI7czo1OiJyaWdodCI7czoxMzoibG9nb19wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIwOiJzZWNvbmRhcnlfbWVudV9hbGlnbiI7czo1OiJyaWdodCI7czoxMjoidG9wX2Jhcl9pbmZvIjtzOjA6IiI7czoxODoidG9wX2Jhcl9pbmZvX2FsaWduIjtzOjU6InJpZ2h0IjtzOjI0OiJ0b3BfYmFyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxODoidG9wX2Jhcl90ZXh0X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6InRvcF9iYXJfbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJ0b3BfYmFyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyNjoidG9wX2Jhcl9zb2NpYWxfaWNvbnNfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoiYmFja190b190b3BfYnV0dG9uIjtzOjY6ImVuYWJsZSI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2FsaWduIjtzOjU6ImZpeGVkIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3IiO3M6NzoiIzAwMDAwMCI7czozMDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjU6ImZvb3Rlcl93aWRnZXRfdGl0bGVfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNzoiZm9vdGVyX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNjoiZm9vdGVyX3RleHRfc2l6ZSI7czoyOiIxMyI7czoxNzoiZm9vdGVyX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNToiZm9vdGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJmb290ZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MzA6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfcGFkZGluZyI7czoyOiI1MCI7czozMzoiZm9vdGVyX2JvdHRvbV9hcmVhX2JvdHRvbV9wYWRkaW5nIjtzOjI6IjUwIjtzOjIzOiJmb290ZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjE1OiJmb290ZXJfcGFyYWxsYXgiO3M6NzoiZGlzYWJsZSI7czoyNzoic2luZ2xlX3BvcnRmb2xpb19uYXZpZ2F0aW9uIjtzOjc6ImRpc2FibGUiO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjA6IiI7czoyMjoic2luZ2xlX3Bvc3RfbmF2aWdhdGlvbiI7czo3OiJkaXNhYmxlIjtzOjE4OiJzb2NpYWxfbGlua3Nfc3R5bGUiO3M6MToiMiI7czoxMjoic29jaWFsX2xpbmtzIjthOjM6e2k6MTtzOjg6ImZhY2Vib29rIjtpOjM7czo5OiJpbnN0YWdyYW0iO2k6MTE7czo3OiJiZWhhbmNlIjt9czoxMToidHdpdHRlcl91cmwiO3M6MjA6Imh0dHBzOi8vdHdpdHRlci5jb20vIjtzOjEyOiJmYWNlYm9va191cmwiO3M6MjQ6Imh0dHA6Ly93d3cuZmFjZWJvb2suY29tLyI7czoxMzoiaW5zdGFncmFtX3VybCI7czoyMToiaHR0cDovL2luc3RhZ3JhbS5jb20vIjtzOjEyOiJsaW5rZWRpbl91cmwiO3M6MjQ6Imh0dHA6Ly93d3cubGlua2VkaW4uY29tLyI7czoxMzoicGludGVyZXN0X3VybCI7czoyMToiaHR0cDovL3BpbnRlcmVzdC5jb20vIjtzOjk6ImdwbHVzX3VybCI7czoyNDoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20vIjtzOjk6InZpbWVvX3VybCI7czoxNzoiaHR0cDovL3ZpbWVvLmNvbS8iO3M6MTA6ImZsaWNrcl91cmwiO3M6MjI6Imh0dHA6Ly93d3cuZmxpY2tyLmNvbS8iO3M6MTA6InR1bWJscl91cmwiO3M6MjM6Imh0dHBzOi8vd3d3LnR1bWJsci5jb20vIjtzOjExOiJ5b3V0dWJlX3VybCI7czoyMzoiaHR0cDovL3d3dy55b3V0dWJlLmNvbS8iO3M6MTI6ImRyaWJiYmxlX3VybCI7czoyMDoiaHR0cDovL2RyaWJiYmxlLmNvbS8iO3M6MTE6ImJlaGFuY2VfdXJsIjtzOjIzOiJodHRwOi8vd3d3LmJlaGFuY2UubmV0LyI7czo2OiJweF91cmwiO3M6MTg6Imh0dHBzOi8vNTAwcHguY29tLyI7czo2OiJ2a191cmwiO3M6MTQ6Imh0dHA6Ly92ay5jb20vIjtzOjEzOiJlbWFpbF9hZGRyZXNzIjtzOjIzOiJwbGFjZWhvbGRlckBleGFtcGxlLmNvbSI7czoyNDoiZW5hYmxlX3dvb2NvbW1lcmNlX2xpbmtzIjtzOjc6ImRpc2FibGUiO3M6MTE6InNob3BfbGF5b3V0IjtzOjEyOiJsZWZ0LXNpZGViYXIiO3M6MTI6InNob3BfY29sdW1ucyI7czoxOiIzIjtzOjI2OiJoZWFkZXJfYmFja2dyb3VuZF9mb3Jfc2hvcCI7czowOiIiO3M6MzQ6ImFkZF90b19jYXJ0X3RleHRfb25fc2luZ2xlX3Byb2R1Y3QiO3M6MDoiIjtzOjIzOiJyZXZvbHV0aW9uX3NsaWRlcl9hbGlhcyI7czowOiIiO3M6Mzg6ImFkZGl0aW9uYWxfaW5mb19vbl9zaW5nbGVfcHJvZHVjdF9wYWdlIjtzOjA6IiI7fQ==';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Claire' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Claire', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjU6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjI0IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6ImxvZ29fZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjE5OiJsb2dvX2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6ImxvZ29fZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6NDoibG9nbyI7czowOiIiO3M6Mjc6ImxvZ29fZm9yX3RyYW5zcGFyZW50X2hlYWRlciI7czowOiIiO3M6MTU6ImhlaWdodF9mb3JfbG9nbyI7czoyOiIxOCI7czoxMjoiYWNjZW50X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTA6ImJvZHlfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMzoicHJpbWFyeV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE1OiJzZWNvbmRhcnlfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoxMToidGhpcmRfY29sb3IiO3M6NzoiI2YyZjJmMiI7czoxMzoiYm9yZGVyc19jb2xvciI7czo3OiIjZTZlNmU2IjtzOjExOiJsaW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJsaW5rc19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIyOiJwYWdlX2xvYWRfcHJvZ3Jlc3NfYmFyIjtzOjc6ImVuYWJsZWQiO3M6Mjg6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXJfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMDoibW9iaWxlX21lbnVfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMzoibG9nb19nb29nbGVfZm9udF9mYW1pbHkiO3M6MDoiIjtzOjIxOiJsb2dvX2dvb2dsZV9mb250X25hbWUiO3M6MDoiIjtzOjE4OiJwcmltYXJ5X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoxODoiZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjY5OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9UHJvemErTGlicmU6NDAwLDQwMGksNzAwLDcwMGkiO3M6MTY6Imdvb2dsZV9mb250X25hbWUiO3M6MTE6IlByb3phIExpYnJlIjtzOjE1OiJtZW51X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyMzoibWVudV9nb29nbGVfZm9udF9mYW1pbHkiO3M6Njk6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Qcm96YStMaWJyZTo0MDAsNDAwaSw3MDAsNzAwaSI7czoyMToibWVudV9nb29nbGVfZm9udF9uYW1lIjtzOjExOiJQcm96YSBMaWJyZSI7czoxNDoibWVudV9mb250X3NpemUiO3M6MjoiMTYiO3M6MzE6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3NpemUiO3M6MjoiMTQiO3M6MTk6Im1lbnVfdGV4dF90cmFuc2Zvcm0iO3M6NDoibm9uZSI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6Im1lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjMzOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjE5OiJtZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIwIjtzOjE1OiJtZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjMyOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MjY6Im1lbnVfdGV4dF9kZWNvcmF0aW9uX2hvdmVyIjtzOjQ6Im5vbmUiO3M6MTg6ImhlYWRpbmdfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjI2OiJoZWFkaW5nX2dvb2dsZV9mb250X2ZhbWlseSI7czo2NzoiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PUNvcm1vcmFudCtHYXJhbW9uZDo3MDAsNzAwaSI7czoyNDoiaGVhZGluZ19nb29nbGVfZm9udF9uYW1lIjtzOjE4OiJDb3Jtb3JhbnQgR2FyYW1vbmQiO3M6MTQ6ImJvZHlfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJoZWFkaW5nX2ZvbnRfd2VpZ2h0IjtzOjM6IjcwMCI7czoyMToibGlua3NfdGV4dF9kZWNvcmF0aW9uIjtzOjk6InVuZGVybGluZSI7czoxNjoibGlua3NfZm9udF9zdHlsZSI7czo2OiJpdGFsaWMiO3M6MTI6ImhlYWRlcl9zdHlsZSI7czo1OiJmaXhlZCI7czozMzoiaGVhZGVyX2hlaWdodF9yZWR1Y3Rpb25fc2Nyb2xsaW5nIjtzOjc6ImRpc2FibGUiO3M6MTM6ImhlYWRlcl9oZWlnaHQiO3M6MzoiMjE5IjtzOjI2OiJoZWFkZXJfaGVpZ2h0X29uX3Njcm9sbGluZyI7czoyOiI1NCI7czoxNToiaGVhZGVyX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MTI6ImxvZ29fY2FwdGlvbiI7czowOiIiO3M6MTA6ImJ1dHRvbl91cmwiO3M6MDoiIjtzOjExOiJidXR0b25fdGV4dCI7czowOiIiO3M6MjE6InNvY2lhbF9pY29uc19wb3NpdGlvbiI7czo2OiJoZWFkZXIiO3M6MjI6InNlYXJjaF9oZWFkZXJfcG9zaXRpb24iO3M6NDoibm9uZSI7czoxMToiaGVhZGVyX2luZm8iO3M6MDoiIjtzOjI1OiJ3b29jb21tZXJjZV9jYXJ0X3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MjM6ImhlYWRlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjE6Im5hdmlnYXRpb25fbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI3OiJuYXZpZ2F0aW9uX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzk5OTk5OSI7czoxNzoiaGVhZGVyX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNzoiaGVhZGVyX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMzoiaGVhZGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyNToiaGVhZGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJoZWFkZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MjM6ImhlYWRlcl90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MjY6ImhlYWRlcl9ib3R0b21fYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTM6Im1lbnVfcG9zaXRpb24iO3M6NToicmlnaHQiO3M6MTM6ImxvZ29fcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMDoic2Vjb25kYXJ5X21lbnVfYWxpZ24iO3M6NToicmlnaHQiO3M6MTI6InRvcF9iYXJfaW5mbyI7czowOiIiO3M6MTg6InRvcF9iYXJfaW5mb19hbGlnbiI7czo1OiJyaWdodCI7czoyNDoidG9wX2Jhcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTg6InRvcF9iYXJfdGV4dF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJ0b3BfYmFyX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNDoidG9wX2Jhcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjY6InRvcF9iYXJfc29jaWFsX2ljb25zX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6ImJhY2tfdG9fdG9wX2J1dHRvbiI7czo2OiJlbmFibGUiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9hbGlnbiI7czo1OiJmaXhlZCI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzA6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI1OiJmb290ZXJfd2lkZ2V0X3RpdGxlX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImZvb3Rlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTY6ImZvb3Rlcl90ZXh0X3NpemUiO3M6MjoiMTMiO3M6MTc6ImZvb3Rlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImZvb3Rlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNDoiZm9vdGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjMwOiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX3BhZGRpbmciO3M6MjoiNTAiO3M6MzM6ImZvb3Rlcl9ib3R0b21fYXJlYV9ib3R0b21fcGFkZGluZyI7czoyOiI1MCI7czoyMzoiZm9vdGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxNToiZm9vdGVyX3BhcmFsbGF4IjtzOjc6ImRpc2FibGUiO3M6Mjc6InNpbmdsZV9wb3J0Zm9saW9fbmF2aWdhdGlvbiI7czo3OiJkaXNhYmxlIjtzOjE0OiJwb3J0Zm9saW9fcGFnZSI7czowOiIiO3M6MjI6InNpbmdsZV9wb3N0X25hdmlnYXRpb24iO3M6NzoiZGlzYWJsZSI7czoxODoic29jaWFsX2xpbmtzX3N0eWxlIjtzOjE6IjIiO3M6MTI6InNvY2lhbF9saW5rcyI7YTozOntpOjM7czo5OiJpbnN0YWdyYW0iO2k6ODtzOjk6InBpbnRlcmVzdCI7aToxMTtzOjc6ImJlaGFuY2UiO31zOjExOiJ0d2l0dGVyX3VybCI7czoyMDoiaHR0cHM6Ly90d2l0dGVyLmNvbS8iO3M6MTI6ImZhY2Vib29rX3VybCI7czoyNDoiaHR0cDovL3d3dy5mYWNlYm9vay5jb20vIjtzOjEzOiJpbnN0YWdyYW1fdXJsIjtzOjIxOiJodHRwOi8vaW5zdGFncmFtLmNvbS8iO3M6MTI6ImxpbmtlZGluX3VybCI7czoyNDoiaHR0cDovL3d3dy5saW5rZWRpbi5jb20vIjtzOjEzOiJwaW50ZXJlc3RfdXJsIjtzOjIxOiJodHRwOi8vcGludGVyZXN0LmNvbS8iO3M6OToiZ3BsdXNfdXJsIjtzOjI0OiJodHRwczovL3BsdXMuZ29vZ2xlLmNvbS8iO3M6OToidmltZW9fdXJsIjtzOjE3OiJodHRwOi8vdmltZW8uY29tLyI7czoxMDoiZmxpY2tyX3VybCI7czoyMjoiaHR0cDovL3d3dy5mbGlja3IuY29tLyI7czoxMDoidHVtYmxyX3VybCI7czoyMzoiaHR0cHM6Ly93d3cudHVtYmxyLmNvbS8iO3M6MTE6InlvdXR1YmVfdXJsIjtzOjIzOiJodHRwOi8vd3d3LnlvdXR1YmUuY29tLyI7czoxMjoiZHJpYmJibGVfdXJsIjtzOjIwOiJodHRwOi8vZHJpYmJibGUuY29tLyI7czoxMToiYmVoYW5jZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cuYmVoYW5jZS5uZXQvIjtzOjY6InB4X3VybCI7czoxODoiaHR0cHM6Ly81MDBweC5jb20vIjtzOjY6InZrX3VybCI7czoxNDoiaHR0cDovL3ZrLmNvbS8iO3M6MTM6ImVtYWlsX2FkZHJlc3MiO3M6MjM6InBsYWNlaG9sZGVyQGV4YW1wbGUuY29tIjtzOjI0OiJlbmFibGVfd29vY29tbWVyY2VfbGlua3MiO3M6NzoiZGlzYWJsZSI7czoxMToic2hvcF9sYXlvdXQiO3M6MTI6ImxlZnQtc2lkZWJhciI7czoxMjoic2hvcF9jb2x1bW5zIjtzOjE6IjMiO3M6MjY6ImhlYWRlcl9iYWNrZ3JvdW5kX2Zvcl9zaG9wIjtzOjA6IiI7czozNDoiYWRkX3RvX2NhcnRfdGV4dF9vbl9zaW5nbGVfcHJvZHVjdCI7czowOiIiO3M6MjM6InJldm9sdXRpb25fc2xpZGVyX2FsaWFzIjtzOjA6IiI7czozODoiYWRkaXRpb25hbF9pbmZvX29uX3NpbmdsZV9wcm9kdWN0X3BhZ2UiO3M6MDoiIjt9';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Wendy' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Wendy', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Projects' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjk6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjE4IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjk6InVwcGVyY2FzZSI7czoxNjoibG9nb19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MTk6ImxvZ29fbGV0dGVyX3NwYWNpbmciO3M6MToiMiI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjZjJmMmYyIjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czo1MToiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PVBUK1NhbnM6NzAwIjtzOjIxOiJsb2dvX2dvb2dsZV9mb250X25hbWUiO3M6NzoiUFQgU2FucyI7czoxODoicHJpbWFyeV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MTg6Imdvb2dsZV9mb250X2ZhbWlseSI7czo2MjoiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PUxhdG86NDAwLDQwMGksNzAwLDcwMGkiO3M6MTY6Imdvb2dsZV9mb250X25hbWUiO3M6NDoiTGF0byI7czoxNToibWVudV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjM6Im1lbnVfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjUyOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9TGF0bzo0MDAsNzAwIjtzOjIxOiJtZW51X2dvb2dsZV9mb250X25hbWUiO3M6NDoiTGF0byI7czoxNDoibWVudV9mb250X3NpemUiO3M6MjoiMTIiO3M6MzE6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3NpemUiO3M6MjoiMTQiO3M6MTk6Im1lbnVfdGV4dF90cmFuc2Zvcm0iO3M6OToidXBwZXJjYXNlIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfdGV4dF90cmFuc2Zvcm0iO3M6NDoibm9uZSI7czoxNjoibWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MzM6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MTk6Im1lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMiI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6Im1lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MzI6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czoyNjoibWVudV90ZXh0X2RlY29yYXRpb25faG92ZXIiO3M6NDoibm9uZSI7czoxODoiaGVhZGluZ190eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjY6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjUxOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9UFQrU2Fuczo3MDAiO3M6MjQ6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfbmFtZSI7czo3OiJQVCBTYW5zIjtzOjE0OiJib2R5X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToiaGVhZGluZ19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MjE6ImxpbmtzX3RleHRfZGVjb3JhdGlvbiI7czo5OiJ1bmRlcmxpbmUiO3M6MTY6ImxpbmtzX2ZvbnRfc3R5bGUiO3M6NjoiaXRhbGljIjtzOjEyOiJoZWFkZXJfc3R5bGUiO3M6NToiZml4ZWQiO3M6MzM6ImhlYWRlcl9oZWlnaHRfcmVkdWN0aW9uX3Njcm9sbGluZyI7czo3OiJkaXNhYmxlIjtzOjEzOiJoZWFkZXJfaGVpZ2h0IjtzOjM6IjIxOSI7czoyNjoiaGVhZGVyX2hlaWdodF9vbl9zY3JvbGxpbmciO3M6MjoiNTQiO3M6MTU6ImhlYWRlcl9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjI5OiJwYWRkaW5nX2Zvcl9sZWZ0X3JpZ2h0X2hlYWRlciI7czo3OiJlbmFibGVkIjtzOjQ5OiJjZW50ZXJfY29udGVudF9ob3Jpem9udGFsbHlfZm9yX2xlZnRfcmlnaHRfaGVhZGVyIjtzOjg6ImRpc2FibGVkIjtzOjEyOiJsb2dvX2NhcHRpb24iO3M6MDoiIjtzOjEwOiJidXR0b25fdXJsIjtzOjA6IiI7czoxMToiYnV0dG9uX3RleHQiO3M6MDoiIjtzOjIxOiJzb2NpYWxfaWNvbnNfcG9zaXRpb24iO3M6NjoiaGVhZGVyIjtzOjIyOiJzZWFyY2hfaGVhZGVyX3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MTE6ImhlYWRlcl9pbmZvIjtzOjA6IiI7czoyNToid29vY29tbWVyY2VfY2FydF9wb3NpdGlvbiI7czo0OiJub25lIjtzOjIzOiJoZWFkZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjIxOiJuYXZpZ2F0aW9uX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czo0Mzoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X25hdmlnYXRpb25fbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI3OiJuYXZpZ2F0aW9uX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzk5OTk5OSI7czo0OToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X25hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJoZWFkZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI1OiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImhlYWRlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czoyMzoiaGVhZGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoyNjoiaGVhZGVyX2JvdHRvbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxMzoibWVudV9wb3NpdGlvbiI7czo1OiJyaWdodCI7czoxMzoibG9nb19wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIwOiJzZWNvbmRhcnlfbWVudV9hbGlnbiI7czo1OiJyaWdodCI7czoxMjoidG9wX2Jhcl9pbmZvIjtzOjA6IiI7czoxODoidG9wX2Jhcl9pbmZvX2FsaWduIjtzOjU6InJpZ2h0IjtzOjI0OiJ0b3BfYmFyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxODoidG9wX2Jhcl90ZXh0X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6InRvcF9iYXJfbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJ0b3BfYmFyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyNjoidG9wX2Jhcl9zb2NpYWxfaWNvbnNfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoiYmFja190b190b3BfYnV0dG9uIjtzOjY6ImVuYWJsZSI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2FsaWduIjtzOjU6ImZpeGVkIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3IiO3M6NzoiIzAwMDAwMCI7czozMDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjU6ImZvb3Rlcl93aWRnZXRfdGl0bGVfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNzoiZm9vdGVyX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNjoiZm9vdGVyX3RleHRfc2l6ZSI7czoyOiIxMyI7czoxNzoiZm9vdGVyX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNToiZm9vdGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJmb290ZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MzA6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfcGFkZGluZyI7czoyOiI1MCI7czozMzoiZm9vdGVyX2JvdHRvbV9hcmVhX2JvdHRvbV9wYWRkaW5nIjtzOjI6IjUwIjtzOjIzOiJmb290ZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjE1OiJmb290ZXJfcGFyYWxsYXgiO3M6NzoiZGlzYWJsZSI7czoyNzoic2luZ2xlX3BvcnRmb2xpb19uYXZpZ2F0aW9uIjtzOjc6ImRpc2FibGUiO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjA6IiI7czoyMjoic2luZ2xlX3Bvc3RfbmF2aWdhdGlvbiI7czo3OiJkaXNhYmxlIjtzOjE4OiJzb2NpYWxfbGlua3Nfc3R5bGUiO3M6MToiNSI7czoxMjoic29jaWFsX2xpbmtzIjthOjM6e2k6MTtzOjg6ImZhY2Vib29rIjtpOjM7czo5OiJpbnN0YWdyYW0iO2k6MTE7czo3OiJiZWhhbmNlIjt9czoxMToidHdpdHRlcl91cmwiO3M6MjA6Imh0dHBzOi8vdHdpdHRlci5jb20vIjtzOjEyOiJmYWNlYm9va191cmwiO3M6MjQ6Imh0dHA6Ly93d3cuZmFjZWJvb2suY29tLyI7czoxMzoiaW5zdGFncmFtX3VybCI7czoyMToiaHR0cDovL2luc3RhZ3JhbS5jb20vIjtzOjEyOiJsaW5rZWRpbl91cmwiO3M6MjQ6Imh0dHA6Ly93d3cubGlua2VkaW4uY29tLyI7czoxMzoicGludGVyZXN0X3VybCI7czoyMToiaHR0cDovL3BpbnRlcmVzdC5jb20vIjtzOjk6ImdwbHVzX3VybCI7czoyNDoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20vIjtzOjk6InZpbWVvX3VybCI7czoxNzoiaHR0cDovL3ZpbWVvLmNvbS8iO3M6MTA6ImZsaWNrcl91cmwiO3M6MjI6Imh0dHA6Ly93d3cuZmxpY2tyLmNvbS8iO3M6MTA6InR1bWJscl91cmwiO3M6MjM6Imh0dHBzOi8vd3d3LnR1bWJsci5jb20vIjtzOjExOiJ5b3V0dWJlX3VybCI7czoyMzoiaHR0cDovL3d3dy55b3V0dWJlLmNvbS8iO3M6MTI6ImRyaWJiYmxlX3VybCI7czoyMDoiaHR0cDovL2RyaWJiYmxlLmNvbS8iO3M6MTE6ImJlaGFuY2VfdXJsIjtzOjIzOiJodHRwOi8vd3d3LmJlaGFuY2UubmV0LyI7czo2OiJweF91cmwiO3M6MTg6Imh0dHBzOi8vNTAwcHguY29tLyI7czo2OiJ2a191cmwiO3M6MTQ6Imh0dHA6Ly92ay5jb20vIjtzOjEzOiJlbWFpbF9hZGRyZXNzIjtzOjIzOiJwbGFjZWhvbGRlckBleGFtcGxlLmNvbSI7czoyNDoiZW5hYmxlX3dvb2NvbW1lcmNlX2xpbmtzIjtzOjc6ImRpc2FibGUiO3M6MTE6InNob3BfbGF5b3V0IjtzOjEyOiJsZWZ0LXNpZGViYXIiO3M6MTI6InNob3BfY29sdW1ucyI7czoxOiIzIjtzOjI2OiJoZWFkZXJfYmFja2dyb3VuZF9mb3Jfc2hvcCI7czowOiIiO3M6MzQ6ImFkZF90b19jYXJ0X3RleHRfb25fc2luZ2xlX3Byb2R1Y3QiO3M6MDoiIjtzOjIzOiJyZXZvbHV0aW9uX3NsaWRlcl9hbGlhcyI7czowOiIiO3M6Mzg6ImFkZGl0aW9uYWxfaW5mb19vbl9zaW5nbGVfcHJvZHVjdF9wYWdlIjtzOjA6IiI7fQ==';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Iris' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Iris', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMzA6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjI0IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6ImxvZ29fZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjE5OiJsb2dvX2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6ImxvZ29fZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6NDoibG9nbyI7czowOiIiO3M6Mjc6ImxvZ29fZm9yX3RyYW5zcGFyZW50X2hlYWRlciI7czowOiIiO3M6MTU6ImhlaWdodF9mb3JfbG9nbyI7czoyOiIxOCI7czoxMjoiYWNjZW50X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTA6ImJvZHlfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMzoicHJpbWFyeV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE1OiJzZWNvbmRhcnlfY29sb3IiO3M6NzoiIzdmN2Y3ZiI7czoxMToidGhpcmRfY29sb3IiO3M6NzoiIzI2MjYyNiI7czoxMzoiYm9yZGVyc19jb2xvciI7czo3OiIjMzMzMzMzIjtzOjExOiJsaW5rc19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE3OiJsaW5rc19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjIyOiJwYWdlX2xvYWRfcHJvZ3Jlc3NfYmFyIjtzOjc6ImVuYWJsZWQiO3M6Mjg6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXJfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMDoibW9iaWxlX21lbnVfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMzoibG9nb19nb29nbGVfZm9udF9mYW1pbHkiO3M6MDoiIjtzOjIxOiJsb2dvX2dvb2dsZV9mb250X25hbWUiO3M6MDoiIjtzOjE4OiJwcmltYXJ5X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoxODoiZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjU3OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9V29yaytTYW5zOjQwMCw3MDAiO3M6MTY6Imdvb2dsZV9mb250X25hbWUiO3M6OToiV29yayBTYW5zIjtzOjE1OiJtZW51X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyMzoibWVudV9nb29nbGVfZm9udF9mYW1pbHkiO3M6NDk6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Xb3JrK1NhbnMiO3M6MjE6Im1lbnVfZ29vZ2xlX2ZvbnRfbmFtZSI7czo5OiJXb3JrIFNhbnMiO3M6MTQ6Im1lbnVfZm9udF9zaXplIjtzOjI6IjE2IjtzOjMxOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zaXplIjtzOjI6IjE0IjtzOjE5OiJtZW51X3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV90ZXh0X3RyYW5zZm9ybSI7czo0OiJub25lIjtzOjE2OiJtZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czozMzoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czoxOToibWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIwIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czoxNToibWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czozMjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjI2OiJtZW51X3RleHRfZGVjb3JhdGlvbl9ob3ZlciI7czo0OiJub25lIjtzOjE4OiJoZWFkaW5nX3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyNjoiaGVhZGluZ19nb29nbGVfZm9udF9mYW1pbHkiO3M6NDk6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1FY3phcjo3MDAiO3M6MjQ6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfbmFtZSI7czo1OiJFY3phciI7czoxNDoiYm9keV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6ImhlYWRpbmdfZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjIxOiJsaW5rc190ZXh0X2RlY29yYXRpb24iO3M6OToidW5kZXJsaW5lIjtzOjE2OiJsaW5rc19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czoxMjoiaGVhZGVyX3N0eWxlIjtzOjU6ImZpeGVkIjtzOjMzOiJoZWFkZXJfaGVpZ2h0X3JlZHVjdGlvbl9zY3JvbGxpbmciO3M6NzoiZGlzYWJsZSI7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIyNTAiO3M6MjY6ImhlYWRlcl9oZWlnaHRfb25fc2Nyb2xsaW5nIjtzOjI6IjU0IjtzOjE1OiJoZWFkZXJfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyOToicGFkZGluZ19mb3JfbGVmdF9yaWdodF9oZWFkZXIiO3M6ODoiZGlzYWJsZWQiO3M6NDk6ImNlbnRlcl9jb250ZW50X2hvcml6b250YWxseV9mb3JfbGVmdF9yaWdodF9oZWFkZXIiO3M6ODoiZGlzYWJsZWQiO3M6MTI6ImxvZ29fY2FwdGlvbiI7czowOiIiO3M6MTA6ImJ1dHRvbl91cmwiO3M6MDoiIjtzOjExOiJidXR0b25fdGV4dCI7czowOiIiO3M6MjE6InNvY2lhbF9pY29uc19wb3NpdGlvbiI7czo2OiJoZWFkZXIiO3M6MjI6InNlYXJjaF9oZWFkZXJfcG9zaXRpb24iO3M6NDoibm9uZSI7czoxMToiaGVhZGVyX2luZm8iO3M6MDoiIjtzOjI1OiJ3b29jb21tZXJjZV9jYXJ0X3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MjM6ImhlYWRlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjE6Im5hdmlnYXRpb25fbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjQzOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6Mjc6Im5hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjN2Y3ZjdmIjtzOjQ5OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbmF2aWdhdGlvbl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiM3ZjdmN2YiO3M6MTc6ImhlYWRlcl90ZXh0X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTc6ImhlYWRlcl9saW5rX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjM6ImhlYWRlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjU6ImhlYWRlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzdmN2Y3ZiI7czozMToiaGVhZGVyX3NvY2lhbF9saW5rc19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjI0OiJoZWFkZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MjM6ImhlYWRlcl90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MjY6ImhlYWRlcl9ib3R0b21fYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTM6Im1lbnVfcG9zaXRpb24iO3M6NDoibGVmdCI7czoxMzoibG9nb19wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIwOiJzZWNvbmRhcnlfbWVudV9hbGlnbiI7czo1OiJyaWdodCI7czoxMjoidG9wX2Jhcl9pbmZvIjtzOjA6IiI7czoxODoidG9wX2Jhcl9pbmZvX2FsaWduIjtzOjU6InJpZ2h0IjtzOjI0OiJ0b3BfYmFyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxODoidG9wX2Jhcl90ZXh0X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6InRvcF9iYXJfbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJ0b3BfYmFyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyNjoidG9wX2Jhcl9zb2NpYWxfaWNvbnNfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoiYmFja190b190b3BfYnV0dG9uIjtzOjY6ImVuYWJsZSI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2FsaWduIjtzOjU6ImZpeGVkIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3IiO3M6NzoiI2ZmZmZmZiI7czozMDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjM6ImZvb3Rlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjU6ImZvb3Rlcl93aWRnZXRfdGl0bGVfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNzoiZm9vdGVyX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNjoiZm9vdGVyX3RleHRfc2l6ZSI7czoyOiIxMyI7czoxNzoiZm9vdGVyX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNToiZm9vdGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJmb290ZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MzA6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfcGFkZGluZyI7czoyOiI1MCI7czozMzoiZm9vdGVyX2JvdHRvbV9hcmVhX2JvdHRvbV9wYWRkaW5nIjtzOjI6IjUwIjtzOjIzOiJmb290ZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjE1OiJmb290ZXJfcGFyYWxsYXgiO3M6NzoiZGlzYWJsZSI7czoyNzoic2luZ2xlX3BvcnRmb2xpb19uYXZpZ2F0aW9uIjtzOjc6ImRpc2FibGUiO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjA6IiI7czoyMjoic2luZ2xlX3Bvc3RfbmF2aWdhdGlvbiI7czo3OiJkaXNhYmxlIjtzOjE4OiJzb2NpYWxfbGlua3Nfc3R5bGUiO3M6MToiMiI7czoxMjoic29jaWFsX2xpbmtzIjthOjM6e2k6MDtzOjc6InR3aXR0ZXIiO2k6MTtzOjg6ImZhY2Vib29rIjtpOjExO3M6NzoiYmVoYW5jZSI7fXM6MTE6InR3aXR0ZXJfdXJsIjtzOjIwOiJodHRwczovL3R3aXR0ZXIuY29tLyI7czoxMjoiZmFjZWJvb2tfdXJsIjtzOjI0OiJodHRwOi8vd3d3LmZhY2Vib29rLmNvbS8iO3M6MTM6Imluc3RhZ3JhbV91cmwiO3M6MjE6Imh0dHA6Ly9pbnN0YWdyYW0uY29tLyI7czoxMjoibGlua2VkaW5fdXJsIjtzOjI0OiJodHRwOi8vd3d3LmxpbmtlZGluLmNvbS8iO3M6MTM6InBpbnRlcmVzdF91cmwiO3M6MjE6Imh0dHA6Ly9waW50ZXJlc3QuY29tLyI7czo5OiJncGx1c191cmwiO3M6MjQ6Imh0dHBzOi8vcGx1cy5nb29nbGUuY29tLyI7czo5OiJ2aW1lb191cmwiO3M6MTc6Imh0dHA6Ly92aW1lby5jb20vIjtzOjEwOiJmbGlja3JfdXJsIjtzOjIyOiJodHRwOi8vd3d3LmZsaWNrci5jb20vIjtzOjEwOiJ0dW1ibHJfdXJsIjtzOjIzOiJodHRwczovL3d3dy50dW1ibHIuY29tLyI7czoxMToieW91dHViZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cueW91dHViZS5jb20vIjtzOjEyOiJkcmliYmJsZV91cmwiO3M6MjA6Imh0dHA6Ly9kcmliYmJsZS5jb20vIjtzOjExOiJiZWhhbmNlX3VybCI7czoyMzoiaHR0cDovL3d3dy5iZWhhbmNlLm5ldC8iO3M6NjoicHhfdXJsIjtzOjE4OiJodHRwczovLzUwMHB4LmNvbS8iO3M6NjoidmtfdXJsIjtzOjE0OiJodHRwOi8vdmsuY29tLyI7czoxMzoiZW1haWxfYWRkcmVzcyI7czoyMzoicGxhY2Vob2xkZXJAZXhhbXBsZS5jb20iO3M6MjQ6ImVuYWJsZV93b29jb21tZXJjZV9saW5rcyI7czo3OiJkaXNhYmxlIjtzOjExOiJzaG9wX2xheW91dCI7czoxMjoibGVmdC1zaWRlYmFyIjtzOjEyOiJzaG9wX2NvbHVtbnMiO3M6MToiMyI7czoyNjoiaGVhZGVyX2JhY2tncm91bmRfZm9yX3Nob3AiO3M6MDoiIjtzOjM0OiJhZGRfdG9fY2FydF90ZXh0X29uX3NpbmdsZV9wcm9kdWN0IjtzOjA6IiI7czoyMzoicmV2b2x1dGlvbl9zbGlkZXJfYWxpYXMiO3M6MDoiIjtzOjM4OiJhZGRpdGlvbmFsX2luZm9fb25fc2luZ2xlX3Byb2R1Y3RfcGFnZSI7czowOiIiO30=';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
		
		// Import Revolution Slider
        if ( class_exists( 'RevSlider' ) ) {
			$slider_array = array(
				'iris/revslider/featured-portfolio.zip',
			);
			
			$slider_array1 = array(
				'iris/revslider/ablestar.zip',
				'iris/revslider/cda-pleurer-des-souvenirs.zip',
				'iris/revslider/elisapie-the-ballad-of-the-runaway-girl.zip',
				'iris/revslider/faire-oeuvre-utile.zip',
			);
			
			$slider_array2 = array(
				'iris/revslider/lez-spread-the-word-mag.zip',
				'iris/revslider/lécole-des-vertiges.zip',
				'iris/revslider/mile-wright-co.zip',
				'iris/revslider/mutek-2018.zip',
			);
			
			$slider_array3 = array(
				'iris/revslider/mutek-identity-makeover.zip',
				'iris/revslider/mutek17.zip',
				'iris/revslider/noemiah.zip',
				'iris/revslider/silent-partners-studio.zip',
			);
			
			$slider_array4 = array(
				'iris/revslider/un-herbier-de-montreal.zip',
			);
			
			$slider = new RevSlider();
			
			foreach($slider_array as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array1 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array2 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array3 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
			foreach($slider_array4 as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
        }
	} else if ( 'Paulette' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Paulette', 'nav_menu' );
		$secondary_header_menu = get_term_by( 'name', 'Paulette Secondary', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
				'secondary_header' => $secondary_header_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Projects' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjk6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjIwIjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjk6InVwcGVyY2FzZSI7czoxNjoibG9nb19mb250X3dlaWdodCI7czozOiI5MDAiO3M6MTk6ImxvZ29fbGV0dGVyX3NwYWNpbmciO3M6MToiMiI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjZjJmMmYyIjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czo1MzoiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PVJ1YmlrOjcwMCw5MDAiO3M6MjE6ImxvZ29fZ29vZ2xlX2ZvbnRfbmFtZSI7czo1OiJSdWJpayI7czoxODoicHJpbWFyeV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MTg6Imdvb2dsZV9mb250X2ZhbWlseSI7czo2OToiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PVJvYm90bytNb25vOjQwMCw0MDBpLDcwMCw3MDBpIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjExOiJSb2JvdG8gTW9ubyI7czoxNToibWVudV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjM6Im1lbnVfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjU5OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9Um9ib3RvK01vbm86NDAwLDcwMCI7czoyMToibWVudV9nb29nbGVfZm9udF9uYW1lIjtzOjExOiJSb2JvdG8gTW9ubyI7czoxNDoibWVudV9mb250X3NpemUiO3M6MjoiMTIiO3M6MzE6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3NpemUiO3M6MjoiMTQiO3M6MTk6Im1lbnVfdGV4dF90cmFuc2Zvcm0iO3M6OToidXBwZXJjYXNlIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfdGV4dF90cmFuc2Zvcm0iO3M6NDoibm9uZSI7czoxNjoibWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MzM6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MTk6Im1lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMiI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6Im1lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MzI6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czoyNjoibWVudV90ZXh0X2RlY29yYXRpb25faG92ZXIiO3M6NDoibm9uZSI7czoxODoiaGVhZGluZ190eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjY6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjQ5OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9UnViaWs6NzAwIjtzOjI0OiJoZWFkaW5nX2dvb2dsZV9mb250X25hbWUiO3M6NToiUnViaWsiO3M6MTQ6ImJvZHlfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJoZWFkaW5nX2ZvbnRfd2VpZ2h0IjtzOjM6IjcwMCI7czoyMToibGlua3NfdGV4dF9kZWNvcmF0aW9uIjtzOjk6InVuZGVybGluZSI7czoxNjoibGlua3NfZm9udF9zdHlsZSI7czo2OiJpdGFsaWMiO3M6MTI6ImhlYWRlcl9zdHlsZSI7czo1OiJmaXhlZCI7czozMzoiaGVhZGVyX2hlaWdodF9yZWR1Y3Rpb25fc2Nyb2xsaW5nIjtzOjc6ImRpc2FibGUiO3M6MTM6ImhlYWRlcl9oZWlnaHQiO3M6MzoiMjE5IjtzOjI2OiJoZWFkZXJfaGVpZ2h0X29uX3Njcm9sbGluZyI7czoyOiI1NCI7czoxNToiaGVhZGVyX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6Mjk6InBhZGRpbmdfZm9yX2xlZnRfcmlnaHRfaGVhZGVyIjtzOjc6ImVuYWJsZWQiO3M6NDk6ImNlbnRlcl9jb250ZW50X2hvcml6b250YWxseV9mb3JfbGVmdF9yaWdodF9oZWFkZXIiO3M6ODoiZGlzYWJsZWQiO3M6MTI6ImxvZ29fY2FwdGlvbiI7czowOiIiO3M6MTA6ImJ1dHRvbl91cmwiO3M6MDoiIjtzOjExOiJidXR0b25fdGV4dCI7czowOiIiO3M6MjE6InNvY2lhbF9pY29uc19wb3NpdGlvbiI7czo2OiJoZWFkZXIiO3M6MjI6InNlYXJjaF9oZWFkZXJfcG9zaXRpb24iO3M6NDoibm9uZSI7czoxMToiaGVhZGVyX2luZm8iO3M6MDoiIjtzOjI1OiJ3b29jb21tZXJjZV9jYXJ0X3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MjM6ImhlYWRlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjE6Im5hdmlnYXRpb25fbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjQzOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiM5OTk5OTkiO3M6Mjc6Im5hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjOTk5OTk5IjtzOjQ5OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbmF2aWdhdGlvbl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImhlYWRlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImhlYWRlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImhlYWRlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImhlYWRlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoyNDoiaGVhZGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjIzOiJoZWFkZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjI2OiJoZWFkZXJfYm90dG9tX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjEzOiJtZW51X3Bvc2l0aW9uIjtzOjU6InJpZ2h0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MjA6InNlY29uZGFyeV9tZW51X2FsaWduIjtzOjU6InJpZ2h0IjtzOjEyOiJ0b3BfYmFyX2luZm8iO3M6MDoiIjtzOjE4OiJ0b3BfYmFyX2luZm9fYWxpZ24iO3M6NToicmlnaHQiO3M6MjQ6InRvcF9iYXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE4OiJ0b3BfYmFyX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoidG9wX2Jhcl9saW5rX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjQ6InRvcF9iYXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjI2OiJ0b3BfYmFyX3NvY2lhbF9pY29uc19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJiYWNrX3RvX3RvcF9idXR0b24iO3M6NjoiZW5hYmxlIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fYWxpZ24iO3M6NToiZml4ZWQiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjMwOiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNToiZm9vdGVyX3dpZGdldF90aXRsZV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJmb290ZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE2OiJmb290ZXJfdGV4dF9zaXplIjtzOjI6IjEzIjtzOjE3OiJmb290ZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI5OiJmb290ZXJfYm90dG9tX2FyZWFfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI5OiJmb290ZXJfYm90dG9tX2FyZWFfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI1OiJmb290ZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImZvb3Rlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czozMDoiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9wYWRkaW5nIjtzOjI6IjUwIjtzOjMzOiJmb290ZXJfYm90dG9tX2FyZWFfYm90dG9tX3BhZGRpbmciO3M6MjoiNTAiO3M6MjM6ImZvb3Rlcl90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTU6ImZvb3Rlcl9wYXJhbGxheCI7czo3OiJkaXNhYmxlIjtzOjI3OiJzaW5nbGVfcG9ydGZvbGlvX25hdmlnYXRpb24iO3M6NzoiZGlzYWJsZSI7czoxNDoicG9ydGZvbGlvX3BhZ2UiO3M6MDoiIjtzOjIyOiJzaW5nbGVfcG9zdF9uYXZpZ2F0aW9uIjtzOjc6ImRpc2FibGUiO3M6MTg6InNvY2lhbF9saW5rc19zdHlsZSI7czoxOiI1IjtzOjEyOiJzb2NpYWxfbGlua3MiO2E6NDp7aToxO3M6ODoiZmFjZWJvb2siO2k6MjtzOjg6ImxpbmtlZGluIjtpOjM7czo5OiJpbnN0YWdyYW0iO2k6MTE7czo3OiJiZWhhbmNlIjt9czoxMToidHdpdHRlcl91cmwiO3M6MjA6Imh0dHBzOi8vdHdpdHRlci5jb20vIjtzOjEyOiJmYWNlYm9va191cmwiO3M6MjQ6Imh0dHA6Ly93d3cuZmFjZWJvb2suY29tLyI7czoxMzoiaW5zdGFncmFtX3VybCI7czoyMToiaHR0cDovL2luc3RhZ3JhbS5jb20vIjtzOjEyOiJsaW5rZWRpbl91cmwiO3M6MjQ6Imh0dHA6Ly93d3cubGlua2VkaW4uY29tLyI7czoxMzoicGludGVyZXN0X3VybCI7czoyMToiaHR0cDovL3BpbnRlcmVzdC5jb20vIjtzOjk6ImdwbHVzX3VybCI7czoyNDoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20vIjtzOjk6InZpbWVvX3VybCI7czoxNzoiaHR0cDovL3ZpbWVvLmNvbS8iO3M6MTA6ImZsaWNrcl91cmwiO3M6MjI6Imh0dHA6Ly93d3cuZmxpY2tyLmNvbS8iO3M6MTA6InR1bWJscl91cmwiO3M6MjM6Imh0dHBzOi8vd3d3LnR1bWJsci5jb20vIjtzOjExOiJ5b3V0dWJlX3VybCI7czoyMzoiaHR0cDovL3d3dy55b3V0dWJlLmNvbS8iO3M6MTI6ImRyaWJiYmxlX3VybCI7czoyMDoiaHR0cDovL2RyaWJiYmxlLmNvbS8iO3M6MTE6ImJlaGFuY2VfdXJsIjtzOjIzOiJodHRwOi8vd3d3LmJlaGFuY2UubmV0LyI7czo2OiJweF91cmwiO3M6MTg6Imh0dHBzOi8vNTAwcHguY29tLyI7czo2OiJ2a191cmwiO3M6MTQ6Imh0dHA6Ly92ay5jb20vIjtzOjEzOiJlbWFpbF9hZGRyZXNzIjtzOjIzOiJwbGFjZWhvbGRlckBleGFtcGxlLmNvbSI7czoyNDoiZW5hYmxlX3dvb2NvbW1lcmNlX2xpbmtzIjtzOjc6ImRpc2FibGUiO3M6MTE6InNob3BfbGF5b3V0IjtzOjEyOiJsZWZ0LXNpZGViYXIiO3M6MTI6InNob3BfY29sdW1ucyI7czoxOiIzIjtzOjI2OiJoZWFkZXJfYmFja2dyb3VuZF9mb3Jfc2hvcCI7czowOiIiO3M6MzQ6ImFkZF90b19jYXJ0X3RleHRfb25fc2luZ2xlX3Byb2R1Y3QiO3M6MDoiIjtzOjIzOiJyZXZvbHV0aW9uX3NsaWRlcl9hbGlhcyI7czowOiIiO3M6Mzg6ImFkZGl0aW9uYWxfaW5mb19vbl9zaW5nbGVfcHJvZHVjdF9wYWdlIjtzOjA6IiI7fQ==';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Marsha' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Marsha', 'nav_menu' );
		$secondary_header_menu = get_term_by( 'name', 'Marsha Secondary', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
				'secondary_header' => $secondary_header_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Selected' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMzA6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjI0IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6ImxvZ29fZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjE5OiJsb2dvX2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6ImxvZ29fZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6NDoibG9nbyI7czowOiIiO3M6Mjc6ImxvZ29fZm9yX3RyYW5zcGFyZW50X2hlYWRlciI7czowOiIiO3M6MTU6ImhlaWdodF9mb3JfbG9nbyI7czoyOiIxOCI7czoxMjoiYWNjZW50X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTA6ImJvZHlfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMzoicHJpbWFyeV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE1OiJzZWNvbmRhcnlfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoxMToidGhpcmRfY29sb3IiO3M6NzoiI2YyZjJmMiI7czoxMzoiYm9yZGVyc19jb2xvciI7czo3OiIjZTZlNmU2IjtzOjExOiJsaW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJsaW5rc19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIyOiJwYWdlX2xvYWRfcHJvZ3Jlc3NfYmFyIjtzOjc6ImVuYWJsZWQiO3M6Mjg6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXJfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMDoibW9iaWxlX21lbnVfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMzoibG9nb19nb29nbGVfZm9udF9mYW1pbHkiO3M6MDoiIjtzOjIxOiJsb2dvX2dvb2dsZV9mb250X25hbWUiO3M6MDoiIjtzOjE4OiJwcmltYXJ5X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoxODoiZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjU3OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9V29yaytTYW5zOjQwMCw3MDAiO3M6MTY6Imdvb2dsZV9mb250X25hbWUiO3M6OToiV29yayBTYW5zIjtzOjE1OiJtZW51X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyMzoibWVudV9nb29nbGVfZm9udF9mYW1pbHkiO3M6NDk6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Xb3JrK1NhbnMiO3M6MjE6Im1lbnVfZ29vZ2xlX2ZvbnRfbmFtZSI7czo5OiJXb3JrIFNhbnMiO3M6MTQ6Im1lbnVfZm9udF9zaXplIjtzOjI6IjE2IjtzOjMxOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zaXplIjtzOjI6IjE0IjtzOjE5OiJtZW51X3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV90ZXh0X3RyYW5zZm9ybSI7czo0OiJub25lIjtzOjE2OiJtZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czozMzoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czoxOToibWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIwIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czoxNToibWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czozMjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjI2OiJtZW51X3RleHRfZGVjb3JhdGlvbl9ob3ZlciI7czo0OiJub25lIjtzOjE4OiJoZWFkaW5nX3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyNjoiaGVhZGluZ19nb29nbGVfZm9udF9mYW1pbHkiO3M6NTQ6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1TcGFjZStNb25vOjcwMCI7czoyNDoiaGVhZGluZ19nb29nbGVfZm9udF9uYW1lIjtzOjEwOiJTcGFjZSBNb25vIjtzOjE0OiJib2R5X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToiaGVhZGluZ19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MjE6ImxpbmtzX3RleHRfZGVjb3JhdGlvbiI7czo5OiJ1bmRlcmxpbmUiO3M6MTY6ImxpbmtzX2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjEyOiJoZWFkZXJfc3R5bGUiO3M6NToiZml4ZWQiO3M6MzM6ImhlYWRlcl9oZWlnaHRfcmVkdWN0aW9uX3Njcm9sbGluZyI7czo3OiJkaXNhYmxlIjtzOjEzOiJoZWFkZXJfaGVpZ2h0IjtzOjM6IjIxOSI7czoyNjoiaGVhZGVyX2hlaWdodF9vbl9zY3JvbGxpbmciO3M6MjoiNTQiO3M6MTU6ImhlYWRlcl9wb3NpdGlvbiI7czo1OiJyaWdodCI7czoyOToicGFkZGluZ19mb3JfbGVmdF9yaWdodF9oZWFkZXIiO3M6ODoiZGlzYWJsZWQiO3M6NDk6ImNlbnRlcl9jb250ZW50X2hvcml6b250YWxseV9mb3JfbGVmdF9yaWdodF9oZWFkZXIiO3M6ODoiZGlzYWJsZWQiO3M6MTI6ImxvZ29fY2FwdGlvbiI7czowOiIiO3M6MTA6ImJ1dHRvbl91cmwiO3M6MDoiIjtzOjExOiJidXR0b25fdGV4dCI7czowOiIiO3M6MjE6InNvY2lhbF9pY29uc19wb3NpdGlvbiI7czo2OiJoZWFkZXIiO3M6MjI6InNlYXJjaF9oZWFkZXJfcG9zaXRpb24iO3M6NDoibm9uZSI7czoxMToiaGVhZGVyX2luZm8iO3M6MDoiIjtzOjI1OiJ3b29jb21tZXJjZV9jYXJ0X3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MjM6ImhlYWRlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjE6Im5hdmlnYXRpb25fbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjQzOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6Mjc6Im5hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjOTk5OTk5IjtzOjQ5OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbmF2aWdhdGlvbl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImhlYWRlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImhlYWRlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImhlYWRlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImhlYWRlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzk5OTk5OSI7czozMToiaGVhZGVyX3NvY2lhbF9saW5rc19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI0OiJoZWFkZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MjM6ImhlYWRlcl90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MjY6ImhlYWRlcl9ib3R0b21fYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTM6Im1lbnVfcG9zaXRpb24iO3M6NToicmlnaHQiO3M6MTM6ImxvZ29fcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMDoic2Vjb25kYXJ5X21lbnVfYWxpZ24iO3M6NToicmlnaHQiO3M6MTI6InRvcF9iYXJfaW5mbyI7czowOiIiO3M6MTg6InRvcF9iYXJfaW5mb19hbGlnbiI7czo1OiJyaWdodCI7czoyNDoidG9wX2Jhcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTg6InRvcF9iYXJfdGV4dF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJ0b3BfYmFyX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNDoidG9wX2Jhcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjY6InRvcF9iYXJfc29jaWFsX2ljb25zX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6ImJhY2tfdG9fdG9wX2J1dHRvbiI7czo2OiJlbmFibGUiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9hbGlnbiI7czo1OiJmaXhlZCI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzA6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI1OiJmb290ZXJfd2lkZ2V0X3RpdGxlX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImZvb3Rlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTY6ImZvb3Rlcl90ZXh0X3NpemUiO3M6MjoiMTMiO3M6MTc6ImZvb3Rlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImZvb3Rlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNDoiZm9vdGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjMwOiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX3BhZGRpbmciO3M6MjoiNTAiO3M6MzM6ImZvb3Rlcl9ib3R0b21fYXJlYV9ib3R0b21fcGFkZGluZyI7czoyOiI1MCI7czoyMzoiZm9vdGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxNToiZm9vdGVyX3BhcmFsbGF4IjtzOjc6ImRpc2FibGUiO3M6Mjc6InNpbmdsZV9wb3J0Zm9saW9fbmF2aWdhdGlvbiI7czo3OiJkaXNhYmxlIjtzOjE0OiJwb3J0Zm9saW9fcGFnZSI7czowOiIiO3M6MjI6InNpbmdsZV9wb3N0X25hdmlnYXRpb24iO3M6NzoiZGlzYWJsZSI7czoxODoic29jaWFsX2xpbmtzX3N0eWxlIjtzOjE6IjEiO3M6MTI6InNvY2lhbF9saW5rcyI7YTo0OntpOjE7czo4OiJmYWNlYm9vayI7aToyO3M6ODoibGlua2VkaW4iO2k6MztzOjk6Imluc3RhZ3JhbSI7aToxMTtzOjc6ImJlaGFuY2UiO31zOjExOiJ0d2l0dGVyX3VybCI7czoyMDoiaHR0cHM6Ly90d2l0dGVyLmNvbS8iO3M6MTI6ImZhY2Vib29rX3VybCI7czoyNDoiaHR0cDovL3d3dy5mYWNlYm9vay5jb20vIjtzOjEzOiJpbnN0YWdyYW1fdXJsIjtzOjIxOiJodHRwOi8vaW5zdGFncmFtLmNvbS8iO3M6MTI6ImxpbmtlZGluX3VybCI7czoyNDoiaHR0cDovL3d3dy5saW5rZWRpbi5jb20vIjtzOjEzOiJwaW50ZXJlc3RfdXJsIjtzOjIxOiJodHRwOi8vcGludGVyZXN0LmNvbS8iO3M6OToiZ3BsdXNfdXJsIjtzOjI0OiJodHRwczovL3BsdXMuZ29vZ2xlLmNvbS8iO3M6OToidmltZW9fdXJsIjtzOjE3OiJodHRwOi8vdmltZW8uY29tLyI7czoxMDoiZmxpY2tyX3VybCI7czoyMjoiaHR0cDovL3d3dy5mbGlja3IuY29tLyI7czoxMDoidHVtYmxyX3VybCI7czoyMzoiaHR0cHM6Ly93d3cudHVtYmxyLmNvbS8iO3M6MTE6InlvdXR1YmVfdXJsIjtzOjIzOiJodHRwOi8vd3d3LnlvdXR1YmUuY29tLyI7czoxMjoiZHJpYmJibGVfdXJsIjtzOjIwOiJodHRwOi8vZHJpYmJibGUuY29tLyI7czoxMToiYmVoYW5jZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cuYmVoYW5jZS5uZXQvIjtzOjY6InB4X3VybCI7czoxODoiaHR0cHM6Ly81MDBweC5jb20vIjtzOjY6InZrX3VybCI7czoxNDoiaHR0cDovL3ZrLmNvbS8iO3M6MTM6ImVtYWlsX2FkZHJlc3MiO3M6MjM6InBsYWNlaG9sZGVyQGV4YW1wbGUuY29tIjtzOjI0OiJlbmFibGVfd29vY29tbWVyY2VfbGlua3MiO3M6NzoiZGlzYWJsZSI7czoxMToic2hvcF9sYXlvdXQiO3M6MTI6ImxlZnQtc2lkZWJhciI7czoxMjoic2hvcF9jb2x1bW5zIjtzOjE6IjMiO3M6MjY6ImhlYWRlcl9iYWNrZ3JvdW5kX2Zvcl9zaG9wIjtzOjA6IiI7czozNDoiYWRkX3RvX2NhcnRfdGV4dF9vbl9zaW5nbGVfcHJvZHVjdCI7czowOiIiO3M6MjM6InJldm9sdXRpb25fc2xpZGVyX2FsaWFzIjtzOjA6IiI7czozODoiYWRkaXRpb25hbF9pbmZvX29uX3NpbmdsZV9wcm9kdWN0X3BhZ2UiO3M6MDoiIjt9';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Erin' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Erin', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMzA6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjk6InVwcGVyY2FzZSI7czoxNjoibG9nb19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MTk6ImxvZ29fbGV0dGVyX3NwYWNpbmciO3M6MToiMiI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjN2Y3ZjdmIjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjMjYyNjI2IjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiMzMzMzMzMiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czowOiIiO3M6MjE6ImxvZ29fZ29vZ2xlX2ZvbnRfbmFtZSI7czowOiIiO3M6MTg6InByaW1hcnlfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjE4OiJnb29nbGVfZm9udF9mYW1pbHkiO3M6NTg6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1QYXRod2F5K0dvdGhpYytPbmUiO3M6MTY6Imdvb2dsZV9mb250X25hbWUiO3M6MTg6IlBhdGh3YXkgR290aGljIE9uZSI7czoxNToibWVudV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjM6Im1lbnVfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjU4OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9UGF0aHdheStHb3RoaWMrT25lIjtzOjIxOiJtZW51X2dvb2dsZV9mb250X25hbWUiO3M6MTg6IlBhdGh3YXkgR290aGljIE9uZSI7czoxNDoibWVudV9mb250X3NpemUiO3M6MjoiMTQiO3M6MzE6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3NpemUiO3M6MjoiMTQiO3M6MTk6Im1lbnVfdGV4dF90cmFuc2Zvcm0iO3M6OToidXBwZXJjYXNlIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfdGV4dF90cmFuc2Zvcm0iO3M6OToidXBwZXJjYXNlIjtzOjE2OiJtZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czozMzoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czoxOToibWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIyIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czoxNToibWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czozMjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjI2OiJtZW51X3RleHRfZGVjb3JhdGlvbl9ob3ZlciI7czo0OiJub25lIjtzOjE4OiJoZWFkaW5nX3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyNjoiaGVhZGluZ19nb29nbGVfZm9udF9mYW1pbHkiO3M6NDk6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1DYXJkbzo3MDAiO3M6MjQ6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfbmFtZSI7czo1OiJDYXJkbyI7czoxNDoiYm9keV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6ImhlYWRpbmdfZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjIxOiJsaW5rc190ZXh0X2RlY29yYXRpb24iO3M6OToidW5kZXJsaW5lIjtzOjE2OiJsaW5rc19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czoxMjoiaGVhZGVyX3N0eWxlIjtzOjU6ImZpeGVkIjtzOjMzOiJoZWFkZXJfaGVpZ2h0X3JlZHVjdGlvbl9zY3JvbGxpbmciO3M6NzoiZGlzYWJsZSI7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIyMTkiO3M6MjY6ImhlYWRlcl9oZWlnaHRfb25fc2Nyb2xsaW5nIjtzOjI6IjU0IjtzOjE1OiJoZWFkZXJfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyOToicGFkZGluZ19mb3JfbGVmdF9yaWdodF9oZWFkZXIiO3M6NzoiZW5hYmxlZCI7czo0OToiY2VudGVyX2NvbnRlbnRfaG9yaXpvbnRhbGx5X2Zvcl9sZWZ0X3JpZ2h0X2hlYWRlciI7czo4OiJkaXNhYmxlZCI7czoxMjoibG9nb19jYXB0aW9uIjtzOjA6IiI7czoxMDoiYnV0dG9uX3VybCI7czowOiIiO3M6MTE6ImJ1dHRvbl90ZXh0IjtzOjA6IiI7czoyMToic29jaWFsX2ljb25zX3Bvc2l0aW9uIjtzOjY6ImhlYWRlciI7czoyMjoic2VhcmNoX2hlYWRlcl9wb3NpdGlvbiI7czo0OiJub25lIjtzOjExOiJoZWFkZXJfaW5mbyI7czowOiIiO3M6MjU6Indvb2NvbW1lcmNlX2NhcnRfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMzoiaGVhZGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMToibmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6NDM6InNlY29uZGFyeV9oZWFkZXJfbWVudV9uYXZpZ2F0aW9uX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNzoibmF2aWdhdGlvbl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiM3ZjdmN2YiO3M6NDk6InNlY29uZGFyeV9oZWFkZXJfbWVudV9uYXZpZ2F0aW9uX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzdmN2Y3ZiI7czoxNzoiaGVhZGVyX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxNzoiaGVhZGVyX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMzoiaGVhZGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyNToiaGVhZGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjN2Y3ZjdmIjtzOjMxOiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjQ6ImhlYWRlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czoyMzoiaGVhZGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoyNjoiaGVhZGVyX2JvdHRvbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxMzoibWVudV9wb3NpdGlvbiI7czo1OiJyaWdodCI7czoxMzoibG9nb19wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIwOiJzZWNvbmRhcnlfbWVudV9hbGlnbiI7czo1OiJyaWdodCI7czoxMjoidG9wX2Jhcl9pbmZvIjtzOjA6IiI7czoxODoidG9wX2Jhcl9pbmZvX2FsaWduIjtzOjU6InJpZ2h0IjtzOjI0OiJ0b3BfYmFyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxODoidG9wX2Jhcl90ZXh0X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6InRvcF9iYXJfbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJ0b3BfYmFyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyNjoidG9wX2Jhcl9zb2NpYWxfaWNvbnNfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoiYmFja190b190b3BfYnV0dG9uIjtzOjY6ImVuYWJsZSI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2FsaWduIjtzOjU6ImZpeGVkIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3IiO3M6NzoiI2ZmZmZmZiI7czozMDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjM6ImZvb3Rlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjU6ImZvb3Rlcl93aWRnZXRfdGl0bGVfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNzoiZm9vdGVyX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNjoiZm9vdGVyX3RleHRfc2l6ZSI7czoyOiIxMyI7czoxNzoiZm9vdGVyX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNToiZm9vdGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJmb290ZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MzA6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfcGFkZGluZyI7czoyOiI1MCI7czozMzoiZm9vdGVyX2JvdHRvbV9hcmVhX2JvdHRvbV9wYWRkaW5nIjtzOjI6IjUwIjtzOjIzOiJmb290ZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjE1OiJmb290ZXJfcGFyYWxsYXgiO3M6NzoiZGlzYWJsZSI7czoyNzoic2luZ2xlX3BvcnRmb2xpb19uYXZpZ2F0aW9uIjtzOjc6ImRpc2FibGUiO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjA6IiI7czoyMjoic2luZ2xlX3Bvc3RfbmF2aWdhdGlvbiI7czo3OiJkaXNhYmxlIjtzOjE4OiJzb2NpYWxfbGlua3Nfc3R5bGUiO3M6MToiMiI7czoxMjoic29jaWFsX2xpbmtzIjthOjI6e2k6MjtzOjg6ImxpbmtlZGluIjtpOjM7czo5OiJpbnN0YWdyYW0iO31zOjExOiJ0d2l0dGVyX3VybCI7czoyMDoiaHR0cHM6Ly90d2l0dGVyLmNvbS8iO3M6MTI6ImZhY2Vib29rX3VybCI7czoyNDoiaHR0cDovL3d3dy5mYWNlYm9vay5jb20vIjtzOjEzOiJpbnN0YWdyYW1fdXJsIjtzOjIxOiJodHRwOi8vaW5zdGFncmFtLmNvbS8iO3M6MTI6ImxpbmtlZGluX3VybCI7czoyNDoiaHR0cDovL3d3dy5saW5rZWRpbi5jb20vIjtzOjEzOiJwaW50ZXJlc3RfdXJsIjtzOjIxOiJodHRwOi8vcGludGVyZXN0LmNvbS8iO3M6OToiZ3BsdXNfdXJsIjtzOjI0OiJodHRwczovL3BsdXMuZ29vZ2xlLmNvbS8iO3M6OToidmltZW9fdXJsIjtzOjE3OiJodHRwOi8vdmltZW8uY29tLyI7czoxMDoiZmxpY2tyX3VybCI7czoyMjoiaHR0cDovL3d3dy5mbGlja3IuY29tLyI7czoxMDoidHVtYmxyX3VybCI7czoyMzoiaHR0cHM6Ly93d3cudHVtYmxyLmNvbS8iO3M6MTE6InlvdXR1YmVfdXJsIjtzOjIzOiJodHRwOi8vd3d3LnlvdXR1YmUuY29tLyI7czoxMjoiZHJpYmJibGVfdXJsIjtzOjIwOiJodHRwOi8vZHJpYmJibGUuY29tLyI7czoxMToiYmVoYW5jZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cuYmVoYW5jZS5uZXQvIjtzOjY6InB4X3VybCI7czoxODoiaHR0cHM6Ly81MDBweC5jb20vIjtzOjY6InZrX3VybCI7czoxNDoiaHR0cDovL3ZrLmNvbS8iO3M6MTM6ImVtYWlsX2FkZHJlc3MiO3M6MjM6InBsYWNlaG9sZGVyQGV4YW1wbGUuY29tIjtzOjI0OiJlbmFibGVfd29vY29tbWVyY2VfbGlua3MiO3M6NzoiZGlzYWJsZSI7czoxMToic2hvcF9sYXlvdXQiO3M6MTI6ImxlZnQtc2lkZWJhciI7czoxMjoic2hvcF9jb2x1bW5zIjtzOjE6IjMiO3M6MjY6ImhlYWRlcl9iYWNrZ3JvdW5kX2Zvcl9zaG9wIjtzOjA6IiI7czozNDoiYWRkX3RvX2NhcnRfdGV4dF9vbl9zaW5nbGVfcHJvZHVjdCI7czowOiIiO3M6MjM6InJldm9sdXRpb25fc2xpZGVyX2FsaWFzIjtzOjA6IiI7czozODoiYWRkaXRpb25hbF9pbmZvX29uX3NpbmdsZV9wcm9kdWN0X3BhZ2UiO3M6MDoiIjt9';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Heidi' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Heidi', 'nav_menu' );
		$secondary_header_menu = get_term_by( 'name', 'Heidi Secondary', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
				'secondary_header' => $secondary_header_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjk6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjIyIjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6ImxvZ29fZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjE5OiJsb2dvX2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6ImxvZ29fZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6NDoibG9nbyI7czowOiIiO3M6Mjc6ImxvZ29fZm9yX3RyYW5zcGFyZW50X2hlYWRlciI7czowOiIiO3M6MTU6ImhlaWdodF9mb3JfbG9nbyI7czoyOiIxOCI7czoxMjoiYWNjZW50X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTA6ImJvZHlfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMzoicHJpbWFyeV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE1OiJzZWNvbmRhcnlfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoxMToidGhpcmRfY29sb3IiO3M6NzoiI2YyZjJmMiI7czoxMzoiYm9yZGVyc19jb2xvciI7czo3OiIjZTZlNmU2IjtzOjExOiJsaW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJsaW5rc19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIyOiJwYWdlX2xvYWRfcHJvZ3Jlc3NfYmFyIjtzOjc6ImVuYWJsZWQiO3M6Mjg6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXJfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMDoibW9iaWxlX21lbnVfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMzoibG9nb19nb29nbGVfZm9udF9mYW1pbHkiO3M6MDoiIjtzOjIxOiJsb2dvX2dvb2dsZV9mb250X25hbWUiO3M6MDoiIjtzOjE4OiJwcmltYXJ5X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoxODoiZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjUwOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9VGVub3IrU2FucyI7czoxNjoiZ29vZ2xlX2ZvbnRfbmFtZSI7czoxMDoiVGVub3IgU2FucyI7czoxNToibWVudV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjM6Im1lbnVfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjUwOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9VGVub3IrU2FucyI7czoyMToibWVudV9nb29nbGVfZm9udF9uYW1lIjtzOjEwOiJUZW5vciBTYW5zIjtzOjE0OiJtZW51X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czozMToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoxOToibWVudV90ZXh0X3RyYW5zZm9ybSI7czo0OiJub25lIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfdGV4dF90cmFuc2Zvcm0iO3M6NDoibm9uZSI7czoxNjoibWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MzM6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MTk6Im1lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6Im1lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MzI6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czoyNjoibWVudV90ZXh0X2RlY29yYXRpb25faG92ZXIiO3M6NDoibm9uZSI7czoxODoiaGVhZGluZ190eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjY6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjUzOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9QXJjaGl2bytCbGFjayI7czoyNDoiaGVhZGluZ19nb29nbGVfZm9udF9uYW1lIjtzOjEzOiJBcmNoaXZvIEJsYWNrIjtzOjE0OiJib2R5X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToiaGVhZGluZ19mb250X3dlaWdodCI7czozOiI0MDAiO3M6MjE6ImxpbmtzX3RleHRfZGVjb3JhdGlvbiI7czo5OiJ1bmRlcmxpbmUiO3M6MTY6ImxpbmtzX2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjEyOiJoZWFkZXJfc3R5bGUiO3M6NToiZml4ZWQiO3M6MzM6ImhlYWRlcl9oZWlnaHRfcmVkdWN0aW9uX3Njcm9sbGluZyI7czo3OiJkaXNhYmxlIjtzOjEzOiJoZWFkZXJfaGVpZ2h0IjtzOjM6IjIxOSI7czoyNjoiaGVhZGVyX2hlaWdodF9vbl9zY3JvbGxpbmciO3M6MjoiNTQiO3M6MTU6ImhlYWRlcl9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjI5OiJwYWRkaW5nX2Zvcl9sZWZ0X3JpZ2h0X2hlYWRlciI7czo3OiJlbmFibGVkIjtzOjQ5OiJjZW50ZXJfY29udGVudF9ob3Jpem9udGFsbHlfZm9yX2xlZnRfcmlnaHRfaGVhZGVyIjtzOjg6ImRpc2FibGVkIjtzOjEyOiJsb2dvX2NhcHRpb24iO3M6MDoiIjtzOjEwOiJidXR0b25fdXJsIjtzOjA6IiI7czoxMToiYnV0dG9uX3RleHQiO3M6MDoiIjtzOjIxOiJzb2NpYWxfaWNvbnNfcG9zaXRpb24iO3M6NjoiaGVhZGVyIjtzOjIyOiJzZWFyY2hfaGVhZGVyX3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MTE6ImhlYWRlcl9pbmZvIjtzOjA6IiI7czoyNToid29vY29tbWVyY2VfY2FydF9wb3NpdGlvbiI7czo0OiJub25lIjtzOjIzOiJoZWFkZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjIxOiJuYXZpZ2F0aW9uX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czo0Mzoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X25hdmlnYXRpb25fbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI3OiJuYXZpZ2F0aW9uX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzk5OTk5OSI7czo0OToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X25hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJoZWFkZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI1OiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImhlYWRlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czoyMzoiaGVhZGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoyNjoiaGVhZGVyX2JvdHRvbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxMzoibWVudV9wb3NpdGlvbiI7czo1OiJyaWdodCI7czoxMzoibG9nb19wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIwOiJzZWNvbmRhcnlfbWVudV9hbGlnbiI7czo1OiJyaWdodCI7czoxMjoidG9wX2Jhcl9pbmZvIjtzOjA6IiI7czoxODoidG9wX2Jhcl9pbmZvX2FsaWduIjtzOjU6InJpZ2h0IjtzOjI0OiJ0b3BfYmFyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxODoidG9wX2Jhcl90ZXh0X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6InRvcF9iYXJfbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJ0b3BfYmFyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyNjoidG9wX2Jhcl9zb2NpYWxfaWNvbnNfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoiYmFja190b190b3BfYnV0dG9uIjtzOjY6ImVuYWJsZSI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2FsaWduIjtzOjU6ImZpeGVkIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3IiO3M6NzoiIzAwMDAwMCI7czozMDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjU6ImZvb3Rlcl93aWRnZXRfdGl0bGVfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNzoiZm9vdGVyX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNjoiZm9vdGVyX3RleHRfc2l6ZSI7czoyOiIxMyI7czoxNzoiZm9vdGVyX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNToiZm9vdGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJmb290ZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MzA6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfcGFkZGluZyI7czoyOiI1MCI7czozMzoiZm9vdGVyX2JvdHRvbV9hcmVhX2JvdHRvbV9wYWRkaW5nIjtzOjI6IjUwIjtzOjIzOiJmb290ZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjE1OiJmb290ZXJfcGFyYWxsYXgiO3M6NzoiZGlzYWJsZSI7czoyNzoic2luZ2xlX3BvcnRmb2xpb19uYXZpZ2F0aW9uIjtzOjc6ImRpc2FibGUiO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjA6IiI7czoyMjoic2luZ2xlX3Bvc3RfbmF2aWdhdGlvbiI7czo3OiJkaXNhYmxlIjtzOjE4OiJzb2NpYWxfbGlua3Nfc3R5bGUiO3M6MToiMiI7czoxMjoic29jaWFsX2xpbmtzIjthOjM6e2k6MjtzOjg6ImxpbmtlZGluIjtpOjM7czo5OiJpbnN0YWdyYW0iO2k6MTE7czo3OiJiZWhhbmNlIjt9czoxMToidHdpdHRlcl91cmwiO3M6MjA6Imh0dHBzOi8vdHdpdHRlci5jb20vIjtzOjEyOiJmYWNlYm9va191cmwiO3M6MjQ6Imh0dHA6Ly93d3cuZmFjZWJvb2suY29tLyI7czoxMzoiaW5zdGFncmFtX3VybCI7czoyMToiaHR0cDovL2luc3RhZ3JhbS5jb20vIjtzOjEyOiJsaW5rZWRpbl91cmwiO3M6MjQ6Imh0dHA6Ly93d3cubGlua2VkaW4uY29tLyI7czoxMzoicGludGVyZXN0X3VybCI7czoyMToiaHR0cDovL3BpbnRlcmVzdC5jb20vIjtzOjk6ImdwbHVzX3VybCI7czoyNDoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20vIjtzOjk6InZpbWVvX3VybCI7czoxNzoiaHR0cDovL3ZpbWVvLmNvbS8iO3M6MTA6ImZsaWNrcl91cmwiO3M6MjI6Imh0dHA6Ly93d3cuZmxpY2tyLmNvbS8iO3M6MTA6InR1bWJscl91cmwiO3M6MjM6Imh0dHBzOi8vd3d3LnR1bWJsci5jb20vIjtzOjExOiJ5b3V0dWJlX3VybCI7czoyMzoiaHR0cDovL3d3dy55b3V0dWJlLmNvbS8iO3M6MTI6ImRyaWJiYmxlX3VybCI7czoyMDoiaHR0cDovL2RyaWJiYmxlLmNvbS8iO3M6MTE6ImJlaGFuY2VfdXJsIjtzOjIzOiJodHRwOi8vd3d3LmJlaGFuY2UubmV0LyI7czo2OiJweF91cmwiO3M6MTg6Imh0dHBzOi8vNTAwcHguY29tLyI7czo2OiJ2a191cmwiO3M6MTQ6Imh0dHA6Ly92ay5jb20vIjtzOjEzOiJlbWFpbF9hZGRyZXNzIjtzOjIzOiJwbGFjZWhvbGRlckBleGFtcGxlLmNvbSI7czoyNDoiZW5hYmxlX3dvb2NvbW1lcmNlX2xpbmtzIjtzOjc6ImRpc2FibGUiO3M6MTE6InNob3BfbGF5b3V0IjtzOjEyOiJsZWZ0LXNpZGViYXIiO3M6MTI6InNob3BfY29sdW1ucyI7czoxOiIzIjtzOjI2OiJoZWFkZXJfYmFja2dyb3VuZF9mb3Jfc2hvcCI7czowOiIiO3M6MzQ6ImFkZF90b19jYXJ0X3RleHRfb25fc2luZ2xlX3Byb2R1Y3QiO3M6MDoiIjtzOjIzOiJyZXZvbHV0aW9uX3NsaWRlcl9hbGlhcyI7czowOiIiO3M6Mzg6ImFkZGl0aW9uYWxfaW5mb19vbl9zaW5nbGVfcHJvZHVjdF9wYWdlIjtzOjA6IiI7fQ==';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Stacy' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Stacy', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMzA6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjE4IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjk6InVwcGVyY2FzZSI7czoxNjoibG9nb19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MTk6ImxvZ29fbGV0dGVyX3NwYWNpbmciO3M6MToiMiI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjZjJmMmYyIjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czowOiIiO3M6MjE6ImxvZ29fZ29vZ2xlX2ZvbnRfbmFtZSI7czowOiIiO3M6MTg6InByaW1hcnlfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjE4OiJnb29nbGVfZm9udF9mYW1pbHkiO3M6NTk6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1JbmNvbnNvbGF0YTo0MDAsNzAwIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjExOiJJbmNvbnNvbGF0YSI7czoxNToibWVudV90eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjM6Im1lbnVfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjU5OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9SW5jb25zb2xhdGE6NDAwLDcwMCI7czoyMToibWVudV9nb29nbGVfZm9udF9uYW1lIjtzOjExOiJJbmNvbnNvbGF0YSI7czoxNDoibWVudV9mb250X3NpemUiO3M6MjoiMTQiO3M6MzE6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6Im1lbnVfdGV4dF90cmFuc2Zvcm0iO3M6OToidXBwZXJjYXNlIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfdGV4dF90cmFuc2Zvcm0iO3M6NDoibm9uZSI7czoxNjoibWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MzM6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MTk6Im1lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMiI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6Im1lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MzI6InNlY29uZGFyeV9oZWFkZXJfbWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czoyNjoibWVudV90ZXh0X2RlY29yYXRpb25faG92ZXIiO3M6NDoibm9uZSI7czoxODoiaGVhZGluZ190eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjY6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjUzOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9Tm90bytTYW5zOjcwMCI7czoyNDoiaGVhZGluZ19nb29nbGVfZm9udF9uYW1lIjtzOjk6Ik5vdG8gU2FucyI7czoxNDoiYm9keV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6ImhlYWRpbmdfZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjIxOiJsaW5rc190ZXh0X2RlY29yYXRpb24iO3M6OToidW5kZXJsaW5lIjtzOjE2OiJsaW5rc19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czoxMjoiaGVhZGVyX3N0eWxlIjtzOjU6ImZpeGVkIjtzOjMzOiJoZWFkZXJfaGVpZ2h0X3JlZHVjdGlvbl9zY3JvbGxpbmciO3M6NzoiZGlzYWJsZSI7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIyMTkiO3M6MjY6ImhlYWRlcl9oZWlnaHRfb25fc2Nyb2xsaW5nIjtzOjI6IjU0IjtzOjI4OiJlbmFibGVfZnVsbF93aWR0aF9mb3JfaGVhZGVyIjthOjE6e2k6MDtzOjM6InllcyI7fXM6MTU6ImhlYWRlcl9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjI5OiJwYWRkaW5nX2Zvcl9sZWZ0X3JpZ2h0X2hlYWRlciI7czo3OiJlbmFibGVkIjtzOjQ5OiJjZW50ZXJfY29udGVudF9ob3Jpem9udGFsbHlfZm9yX2xlZnRfcmlnaHRfaGVhZGVyIjtzOjg6ImRpc2FibGVkIjtzOjEyOiJsb2dvX2NhcHRpb24iO3M6MDoiIjtzOjEwOiJidXR0b25fdXJsIjtzOjA6IiI7czoxMToiYnV0dG9uX3RleHQiO3M6MDoiIjtzOjIxOiJzb2NpYWxfaWNvbnNfcG9zaXRpb24iO3M6NjoiaGVhZGVyIjtzOjIyOiJzZWFyY2hfaGVhZGVyX3Bvc2l0aW9uIjtzOjQ6Im5vbmUiO3M6MTE6ImhlYWRlcl9pbmZvIjtzOjA6IiI7czoyNToid29vY29tbWVyY2VfY2FydF9wb3NpdGlvbiI7czo0OiJub25lIjtzOjIzOiJoZWFkZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjIxOiJuYXZpZ2F0aW9uX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czo0Mzoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X25hdmlnYXRpb25fbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI3OiJuYXZpZ2F0aW9uX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzk5OTk5OSI7czo0OToic2Vjb25kYXJ5X2hlYWRlcl9tZW51X25hdmlnYXRpb25fbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJoZWFkZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJoZWFkZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI1OiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiM5OTk5OTkiO3M6MjQ6ImhlYWRlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxNiI7czoyMzoiaGVhZGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoyNjoiaGVhZGVyX2JvdHRvbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxMzoibWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MjA6InNlY29uZGFyeV9tZW51X2FsaWduIjtzOjU6InJpZ2h0IjtzOjEyOiJ0b3BfYmFyX2luZm8iO3M6MDoiIjtzOjE4OiJ0b3BfYmFyX2luZm9fYWxpZ24iO3M6NToicmlnaHQiO3M6MjQ6InRvcF9iYXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE4OiJ0b3BfYmFyX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoidG9wX2Jhcl9saW5rX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjQ6InRvcF9iYXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjI2OiJ0b3BfYmFyX3NvY2lhbF9pY29uc19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJiYWNrX3RvX3RvcF9idXR0b24iO3M6NjoiZW5hYmxlIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fYWxpZ24iO3M6NToiZml4ZWQiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjMwOiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNToiZm9vdGVyX3dpZGdldF90aXRsZV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJmb290ZXJfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE2OiJmb290ZXJfdGV4dF9zaXplIjtzOjI6IjEzIjtzOjE3OiJmb290ZXJfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI5OiJmb290ZXJfYm90dG9tX2FyZWFfbGlua19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjI5OiJmb290ZXJfYm90dG9tX2FyZWFfdGV4dF9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI1OiJmb290ZXJfc29jaWFsX2xpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImZvb3Rlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czozMDoiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9wYWRkaW5nIjtzOjI6IjUwIjtzOjMzOiJmb290ZXJfYm90dG9tX2FyZWFfYm90dG9tX3BhZGRpbmciO3M6MjoiNTAiO3M6MjM6ImZvb3Rlcl90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNkZWRlZGUiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNkZWRlZGUiO3M6MTU6ImZvb3Rlcl9wYXJhbGxheCI7czo3OiJkaXNhYmxlIjtzOjI3OiJzaW5nbGVfcG9ydGZvbGlvX25hdmlnYXRpb24iO3M6NzoiZGlzYWJsZSI7czoxNDoicG9ydGZvbGlvX3BhZ2UiO3M6MDoiIjtzOjIyOiJzaW5nbGVfcG9zdF9uYXZpZ2F0aW9uIjtzOjc6ImRpc2FibGUiO3M6MTg6InNvY2lhbF9saW5rc19zdHlsZSI7czoxOiIyIjtzOjEyOiJzb2NpYWxfbGlua3MiO2E6Mzp7aTozO3M6OToiaW5zdGFncmFtIjtpOjQ7czo2OiJ0dW1ibHIiO2k6ODtzOjk6InBpbnRlcmVzdCI7fXM6MTE6InR3aXR0ZXJfdXJsIjtzOjIwOiJodHRwczovL3R3aXR0ZXIuY29tLyI7czoxMjoiZmFjZWJvb2tfdXJsIjtzOjI0OiJodHRwOi8vd3d3LmZhY2Vib29rLmNvbS8iO3M6MTM6Imluc3RhZ3JhbV91cmwiO3M6MjE6Imh0dHA6Ly9pbnN0YWdyYW0uY29tLyI7czoxMjoibGlua2VkaW5fdXJsIjtzOjI0OiJodHRwOi8vd3d3LmxpbmtlZGluLmNvbS8iO3M6MTM6InBpbnRlcmVzdF91cmwiO3M6MjE6Imh0dHA6Ly9waW50ZXJlc3QuY29tLyI7czo5OiJncGx1c191cmwiO3M6MjQ6Imh0dHBzOi8vcGx1cy5nb29nbGUuY29tLyI7czo5OiJ2aW1lb191cmwiO3M6MTc6Imh0dHA6Ly92aW1lby5jb20vIjtzOjEwOiJmbGlja3JfdXJsIjtzOjIyOiJodHRwOi8vd3d3LmZsaWNrci5jb20vIjtzOjEwOiJ0dW1ibHJfdXJsIjtzOjIzOiJodHRwczovL3d3dy50dW1ibHIuY29tLyI7czoxMToieW91dHViZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cueW91dHViZS5jb20vIjtzOjEyOiJkcmliYmJsZV91cmwiO3M6MjA6Imh0dHA6Ly9kcmliYmJsZS5jb20vIjtzOjExOiJiZWhhbmNlX3VybCI7czoyMzoiaHR0cDovL3d3dy5iZWhhbmNlLm5ldC8iO3M6NjoicHhfdXJsIjtzOjE4OiJodHRwczovLzUwMHB4LmNvbS8iO3M6NjoidmtfdXJsIjtzOjE0OiJodHRwOi8vdmsuY29tLyI7czoxMzoiZW1haWxfYWRkcmVzcyI7czoyMzoicGxhY2Vob2xkZXJAZXhhbXBsZS5jb20iO3M6MjQ6ImVuYWJsZV93b29jb21tZXJjZV9saW5rcyI7czo3OiJkaXNhYmxlIjtzOjExOiJzaG9wX2xheW91dCI7czoxMjoibGVmdC1zaWRlYmFyIjtzOjEyOiJzaG9wX2NvbHVtbnMiO3M6MToiMyI7czoyNjoiaGVhZGVyX2JhY2tncm91bmRfZm9yX3Nob3AiO3M6MDoiIjtzOjM0OiJhZGRfdG9fY2FydF90ZXh0X29uX3NpbmdsZV9wcm9kdWN0IjtzOjA6IiI7czoyMzoicmV2b2x1dGlvbl9zbGlkZXJfYWxpYXMiO3M6MDoiIjtzOjM4OiJhZGRpdGlvbmFsX2luZm9fb25fc2luZ2xlX3Byb2R1Y3RfcGFnZSI7czowOiIiO30=';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
		
		// Import Revolution Slider
        if ( class_exists( 'RevSlider' ) ) {
			$slider_array = array(
				'stacy/revslider/featured-portfolio.zip',
			);
			
			$slider = new RevSlider();
			
			foreach($slider_array as $filepath) {
				$slider->importSliderFromPost(true,true,$path.$filepath);
			}
        }
	} else if ( 'April' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'April', 'nav_menu' );
		$secondary_header_menu = get_term_by( 'name', 'April Secondary', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
				'secondary_header' => $secondary_header_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Projects' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMjk6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjI0IjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6ImxvZ29fZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjE5OiJsb2dvX2xldHRlcl9zcGFjaW5nIjtzOjE6IjAiO3M6MTU6ImxvZ29fZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6NDoibG9nbyI7czowOiIiO3M6Mjc6ImxvZ29fZm9yX3RyYW5zcGFyZW50X2hlYWRlciI7czowOiIiO3M6MTU6ImhlaWdodF9mb3JfbG9nbyI7czoyOiIxOCI7czoxMjoiYWNjZW50X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTA6ImJvZHlfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMzoicHJpbWFyeV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE1OiJzZWNvbmRhcnlfY29sb3IiO3M6NzoiIzk5OTk5OSI7czoxMToidGhpcmRfY29sb3IiO3M6NzoiI2YyZjJmMiI7czoxMzoiYm9yZGVyc19jb2xvciI7czo3OiIjZTZlNmU2IjtzOjExOiJsaW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjE3OiJsaW5rc19jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIyOiJwYWdlX2xvYWRfcHJvZ3Jlc3NfYmFyIjtzOjc6ImVuYWJsZWQiO3M6Mjg6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXJfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMDoibW9iaWxlX21lbnVfcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMzoibG9nb19nb29nbGVfZm9udF9mYW1pbHkiO3M6MDoiIjtzOjIxOiJsb2dvX2dvb2dsZV9mb250X25hbWUiO3M6MDoiIjtzOjE4OiJwcmltYXJ5X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoxODoiZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjU1OiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9U2ludG9ueTo0MDAsNzAwIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjc6IlNpbnRvbnkiO3M6MTU6Im1lbnVfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjIzOiJtZW51X2dvb2dsZV9mb250X2ZhbWlseSI7czo1NToiaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PVNpbnRvbnk6NDAwLDcwMCI7czoyMToibWVudV9nb29nbGVfZm9udF9uYW1lIjtzOjc6IlNpbnRvbnkiO3M6MTQ6Im1lbnVfZm9udF9zaXplIjtzOjI6IjE2IjtzOjMxOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zaXplIjtzOjI6IjE0IjtzOjE5OiJtZW51X3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV90ZXh0X3RyYW5zZm9ybSI7czo0OiJub25lIjtzOjE2OiJtZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czozMzoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfd2VpZ2h0IjtzOjM6IjQwMCI7czoxOToibWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIwIjtzOjM2OiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfbGV0dGVyX3NwYWNpbmciO3M6MToiMCI7czoxNToibWVudV9mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czozMjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjI2OiJtZW51X3RleHRfZGVjb3JhdGlvbl9ob3ZlciI7czo0OiJub25lIjtzOjE4OiJoZWFkaW5nX3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyNjoiaGVhZGluZ19nb29nbGVfZm9udF9mYW1pbHkiO3M6NTA6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1SdWZpbmE6NzAwIjtzOjI0OiJoZWFkaW5nX2dvb2dsZV9mb250X25hbWUiO3M6NjoiUnVmaW5hIjtzOjE0OiJib2R5X2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxOToiaGVhZGluZ19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MjE6ImxpbmtzX3RleHRfZGVjb3JhdGlvbiI7czo5OiJ1bmRlcmxpbmUiO3M6MTY6ImxpbmtzX2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjEyOiJoZWFkZXJfc3R5bGUiO3M6NToiZml4ZWQiO3M6MzM6ImhlYWRlcl9oZWlnaHRfcmVkdWN0aW9uX3Njcm9sbGluZyI7czo3OiJkaXNhYmxlIjtzOjEzOiJoZWFkZXJfaGVpZ2h0IjtzOjM6IjIxOSI7czoyNjoiaGVhZGVyX2hlaWdodF9vbl9zY3JvbGxpbmciO3M6MjoiNTQiO3M6MTU6ImhlYWRlcl9wb3NpdGlvbiI7czo1OiJyaWdodCI7czoyOToicGFkZGluZ19mb3JfbGVmdF9yaWdodF9oZWFkZXIiO3M6ODoiZGlzYWJsZWQiO3M6NDk6ImNlbnRlcl9jb250ZW50X2hvcml6b250YWxseV9mb3JfbGVmdF9yaWdodF9oZWFkZXIiO3M6NzoiZW5hYmxlZCI7czoxMjoibG9nb19jYXB0aW9uIjtzOjA6IiI7czoxMDoiYnV0dG9uX3VybCI7czowOiIiO3M6MTE6ImJ1dHRvbl90ZXh0IjtzOjA6IiI7czoyMToic29jaWFsX2ljb25zX3Bvc2l0aW9uIjtzOjY6ImhlYWRlciI7czoyMjoic2VhcmNoX2hlYWRlcl9wb3NpdGlvbiI7czo0OiJub25lIjtzOjExOiJoZWFkZXJfaW5mbyI7czowOiIiO3M6MjU6Indvb2NvbW1lcmNlX2NhcnRfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMzoiaGVhZGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMToibmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6NDM6InNlY29uZGFyeV9oZWFkZXJfbWVudV9uYXZpZ2F0aW9uX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNzoibmF2aWdhdGlvbl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiM5OTk5OTkiO3M6NDk6InNlY29uZGFyeV9oZWFkZXJfbWVudV9uYXZpZ2F0aW9uX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoxNzoiaGVhZGVyX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNzoiaGVhZGVyX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMzoiaGVhZGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyNToiaGVhZGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJoZWFkZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MjM6ImhlYWRlcl90b3BfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MjY6ImhlYWRlcl9ib3R0b21fYm9yZGVyX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTM6Im1lbnVfcG9zaXRpb24iO3M6NToicmlnaHQiO3M6MTM6ImxvZ29fcG9zaXRpb24iO3M6NDoibGVmdCI7czoyMDoic2Vjb25kYXJ5X21lbnVfYWxpZ24iO3M6NToicmlnaHQiO3M6MTI6InRvcF9iYXJfaW5mbyI7czowOiIiO3M6MTg6InRvcF9iYXJfaW5mb19hbGlnbiI7czo1OiJyaWdodCI7czoyNDoidG9wX2Jhcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTg6InRvcF9iYXJfdGV4dF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjE4OiJ0b3BfYmFyX2xpbmtfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNDoidG9wX2Jhcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjY6InRvcF9iYXJfc29jaWFsX2ljb25zX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6ImJhY2tfdG9fdG9wX2J1dHRvbiI7czo2OiJlbmFibGUiO3M6MjQ6ImJhY2tfdG9fdG9wX2J1dHRvbl9hbGlnbiI7czo1OiJmaXhlZCI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzA6ImJhY2tfdG9fdG9wX2J1dHRvbl9jb2xvcl9ob3ZlciI7czo3OiIjMDAwMDAwIjtzOjIzOiJmb290ZXJfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI1OiJmb290ZXJfd2lkZ2V0X3RpdGxlX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImZvb3Rlcl90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTY6ImZvb3Rlcl90ZXh0X3NpemUiO3M6MjoiMTMiO3M6MTc6ImZvb3Rlcl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MzU6ImZvb3Rlcl9ib3R0b21fYXJlYV9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6Mjk6ImZvb3Rlcl9ib3R0b21fYXJlYV90ZXh0X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MjU6ImZvb3Rlcl9zb2NpYWxfbGlua3NfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNDoiZm9vdGVyX3NvY2lhbF9saW5rc19zaXplIjtzOjI6IjEzIjtzOjMwOiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX3BhZGRpbmciO3M6MjoiNTAiO3M6MzM6ImZvb3Rlcl9ib3R0b21fYXJlYV9ib3R0b21fcGFkZGluZyI7czoyOiI1MCI7czoyMzoiZm9vdGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxNToiZm9vdGVyX3BhcmFsbGF4IjtzOjc6ImRpc2FibGUiO3M6Mjc6InNpbmdsZV9wb3J0Zm9saW9fbmF2aWdhdGlvbiI7czo3OiJkaXNhYmxlIjtzOjE0OiJwb3J0Zm9saW9fcGFnZSI7czowOiIiO3M6MjI6InNpbmdsZV9wb3N0X25hdmlnYXRpb24iO3M6NzoiZGlzYWJsZSI7czoxODoic29jaWFsX2xpbmtzX3N0eWxlIjtzOjE6IjIiO3M6MTI6InNvY2lhbF9saW5rcyI7YTozOntpOjI7czo4OiJsaW5rZWRpbiI7aToxMDtzOjg6ImRyaWJiYmxlIjtpOjExO3M6NzoiYmVoYW5jZSI7fXM6MTE6InR3aXR0ZXJfdXJsIjtzOjIwOiJodHRwczovL3R3aXR0ZXIuY29tLyI7czoxMjoiZmFjZWJvb2tfdXJsIjtzOjI0OiJodHRwOi8vd3d3LmZhY2Vib29rLmNvbS8iO3M6MTM6Imluc3RhZ3JhbV91cmwiO3M6MjE6Imh0dHA6Ly9pbnN0YWdyYW0uY29tLyI7czoxMjoibGlua2VkaW5fdXJsIjtzOjI0OiJodHRwOi8vd3d3LmxpbmtlZGluLmNvbS8iO3M6MTM6InBpbnRlcmVzdF91cmwiO3M6MjE6Imh0dHA6Ly9waW50ZXJlc3QuY29tLyI7czo5OiJncGx1c191cmwiO3M6MjQ6Imh0dHBzOi8vcGx1cy5nb29nbGUuY29tLyI7czo5OiJ2aW1lb191cmwiO3M6MTc6Imh0dHA6Ly92aW1lby5jb20vIjtzOjEwOiJmbGlja3JfdXJsIjtzOjIyOiJodHRwOi8vd3d3LmZsaWNrci5jb20vIjtzOjEwOiJ0dW1ibHJfdXJsIjtzOjIzOiJodHRwczovL3d3dy50dW1ibHIuY29tLyI7czoxMToieW91dHViZV91cmwiO3M6MjM6Imh0dHA6Ly93d3cueW91dHViZS5jb20vIjtzOjEyOiJkcmliYmJsZV91cmwiO3M6MjA6Imh0dHA6Ly9kcmliYmJsZS5jb20vIjtzOjExOiJiZWhhbmNlX3VybCI7czoyMzoiaHR0cDovL3d3dy5iZWhhbmNlLm5ldC8iO3M6NjoicHhfdXJsIjtzOjE4OiJodHRwczovLzUwMHB4LmNvbS8iO3M6NjoidmtfdXJsIjtzOjE0OiJodHRwOi8vdmsuY29tLyI7czoxMzoiZW1haWxfYWRkcmVzcyI7czoyMzoicGxhY2Vob2xkZXJAZXhhbXBsZS5jb20iO3M6MjQ6ImVuYWJsZV93b29jb21tZXJjZV9saW5rcyI7czo3OiJkaXNhYmxlIjtzOjExOiJzaG9wX2xheW91dCI7czoxMjoibGVmdC1zaWRlYmFyIjtzOjEyOiJzaG9wX2NvbHVtbnMiO3M6MToiMyI7czoyNjoiaGVhZGVyX2JhY2tncm91bmRfZm9yX3Nob3AiO3M6MDoiIjtzOjM0OiJhZGRfdG9fY2FydF90ZXh0X29uX3NpbmdsZV9wcm9kdWN0IjtzOjA6IiI7czoyMzoicmV2b2x1dGlvbl9zbGlkZXJfYWxpYXMiO3M6MDoiIjtzOjM4OiJhZGRpdGlvbmFsX2luZm9fb25fc2luZ2xlX3Byb2R1Y3RfcGFnZSI7czowOiIiO30=';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	} else if ( 'Mindy' === $selected_import['import_file_name'] ) {
		// Set thumbnail size in settings > media
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 300 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 0 );
		
		// Assign menus to their locations
		$main_menu = get_term_by( 'name', 'Mindy', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		// Assign front page and posts page
		$front_page_id = get_page_by_title( 'Work' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
		
		// OptionTree options
		// The exported theme options string
        $ot_export_data = 'YToxMzA6e3M6MTQ6ImxvZ29fZm9udF9zaXplIjtzOjI6IjIwIjtzOjE5OiJsb2dvX3RleHRfdHJhbnNmb3JtIjtzOjk6InVwcGVyY2FzZSI7czoxNjoibG9nb19mb250X3dlaWdodCI7czozOiI3MDAiO3M6MTk6ImxvZ29fbGV0dGVyX3NwYWNpbmciO3M6MToiMiI7czoxNToibG9nb19mb250X3N0eWxlIjtzOjY6Im5vcm1hbCI7czo0OiJsb2dvIjtzOjA6IiI7czoyNzoibG9nb19mb3JfdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjA6IiI7czoxNToiaGVpZ2h0X2Zvcl9sb2dvIjtzOjI6IjE4IjtzOjEyOiJhY2NlbnRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxMDoiYm9keV9jb2xvciI7czo3OiIjZmZmZmZmIjtzOjEzOiJwcmltYXJ5X2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czo3OiIjOTk5OTk5IjtzOjExOiJ0aGlyZF9jb2xvciI7czo3OiIjZjJmMmYyIjtzOjEzOiJib3JkZXJzX2NvbG9yIjtzOjc6IiNlNmU2ZTYiO3M6MTE6ImxpbmtzX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6MTc6ImxpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjI6InBhZ2VfbG9hZF9wcm9ncmVzc19iYXIiO3M6NzoiZW5hYmxlZCI7czoyODoicGFnZV9sb2FkX3Byb2dyZXNzX2Jhcl9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjIwOiJtb2JpbGVfbWVudV9wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIzOiJsb2dvX2dvb2dsZV9mb250X2ZhbWlseSI7czowOiIiO3M6MjE6ImxvZ29fZ29vZ2xlX2ZvbnRfbmFtZSI7czowOiIiO3M6MTg6InByaW1hcnlfdHlwb2dyYXBoeSI7YToxOntzOjExOiJmb250LWZhbWlseSI7czowOiIiO31zOjE4OiJnb29nbGVfZm9udF9mYW1pbHkiO3M6Njg6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0OjQwMCw0MDBpLDcwMCw3MDBpIjtzOjE2OiJnb29nbGVfZm9udF9uYW1lIjtzOjEwOiJNb250c2VycmF0IjtzOjE1OiJtZW51X3R5cG9ncmFwaHkiO2E6MTp7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjt9czoyMzoibWVudV9nb29nbGVfZm9udF9mYW1pbHkiO3M6Njg6Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0OjQwMCw0MDBpLDcwMCw3MDBpIjtzOjIxOiJtZW51X2dvb2dsZV9mb250X25hbWUiO3M6MTA6Ik1vbnRzZXJyYXQiO3M6MTQ6Im1lbnVfZm9udF9zaXplIjtzOjI6IjEyIjtzOjMxOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE5OiJtZW51X3RleHRfdHJhbnNmb3JtIjtzOjk6InVwcGVyY2FzZSI7czozNjoic2Vjb25kYXJ5X2hlYWRlcl9tZW51X3RleHRfdHJhbnNmb3JtIjtzOjQ6Im5vbmUiO3M6MTY6Im1lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjMzOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjE5OiJtZW51X2xldHRlcl9zcGFjaW5nIjtzOjE6IjIiO3M6MzY6InNlY29uZGFyeV9oZWFkZXJfbWVudV9sZXR0ZXJfc3BhY2luZyI7czoxOiIwIjtzOjE1OiJtZW51X2ZvbnRfc3R5bGUiO3M6Njoibm9ybWFsIjtzOjMyOiJzZWNvbmRhcnlfaGVhZGVyX21lbnVfZm9udF9zdHlsZSI7czo2OiJub3JtYWwiO3M6MjY6Im1lbnVfdGV4dF9kZWNvcmF0aW9uX2hvdmVyIjtzOjk6InVuZGVybGluZSI7czoxODoiaGVhZGluZ190eXBvZ3JhcGh5IjthOjE6e3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7fXM6MjY6ImhlYWRpbmdfZ29vZ2xlX2ZvbnRfZmFtaWx5IjtzOjUzOiJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9RmlyYStTYW5zOjcwMCI7czoyNDoiaGVhZGluZ19nb29nbGVfZm9udF9uYW1lIjtzOjk6IkZpcmEgU2FucyI7czoxNDoiYm9keV9mb250X3NpemUiO3M6MjoiMTYiO3M6MTk6ImhlYWRpbmdfZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjIxOiJsaW5rc190ZXh0X2RlY29yYXRpb24iO3M6OToidW5kZXJsaW5lIjtzOjE2OiJsaW5rc19mb250X3N0eWxlIjtzOjY6Iml0YWxpYyI7czoxMjoiaGVhZGVyX3N0eWxlIjtzOjk6Im5vbl9maXhlZCI7czozMzoiaGVhZGVyX2hlaWdodF9yZWR1Y3Rpb25fc2Nyb2xsaW5nIjtzOjc6ImRpc2FibGUiO3M6MTM6ImhlYWRlcl9oZWlnaHQiO3M6MjoiODQiO3M6MjY6ImhlYWRlcl9oZWlnaHRfb25fc2Nyb2xsaW5nIjtzOjI6IjU0IjtzOjE1OiJoZWFkZXJfcG9zaXRpb24iO3M6MzoidG9wIjtzOjI5OiJwYWRkaW5nX2Zvcl9sZWZ0X3JpZ2h0X2hlYWRlciI7czo3OiJlbmFibGVkIjtzOjQ5OiJjZW50ZXJfY29udGVudF9ob3Jpem9udGFsbHlfZm9yX2xlZnRfcmlnaHRfaGVhZGVyIjtzOjg6ImRpc2FibGVkIjtzOjEyOiJsb2dvX2NhcHRpb24iO3M6MDoiIjtzOjEwOiJidXR0b25fdXJsIjtzOjA6IiI7czoxMToiYnV0dG9uX3RleHQiO3M6MDoiIjtzOjIxOiJzb2NpYWxfaWNvbnNfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMjoic2VhcmNoX2hlYWRlcl9wb3NpdGlvbiI7czo0OiJub25lIjtzOjExOiJoZWFkZXJfaW5mbyI7czowOiIiO3M6MjU6Indvb2NvbW1lcmNlX2NhcnRfcG9zaXRpb24iO3M6NDoibm9uZSI7czoyMzoiaGVhZGVyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyMToibmF2aWdhdGlvbl9saW5rX2NvbG9yIjtzOjc6IiMwMDAwMDAiO3M6NDM6InNlY29uZGFyeV9oZWFkZXJfbWVudV9uYXZpZ2F0aW9uX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNzoibmF2aWdhdGlvbl9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6NDk6InNlY29uZGFyeV9oZWFkZXJfbWVudV9uYXZpZ2F0aW9uX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoxNzoiaGVhZGVyX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNzoiaGVhZGVyX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMzoiaGVhZGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyNToiaGVhZGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjMxOiJoZWFkZXJfc29jaWFsX2xpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjQ6ImhlYWRlcl9zb2NpYWxfbGlua3Nfc2l6ZSI7czoyOiIxMyI7czoyMzoiaGVhZGVyX3RvcF9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoyNjoiaGVhZGVyX2JvdHRvbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U2ZTZlNiI7czoxMzoibWVudV9wb3NpdGlvbiI7czo1OiJyaWdodCI7czoxMzoibG9nb19wb3NpdGlvbiI7czo0OiJsZWZ0IjtzOjIwOiJzZWNvbmRhcnlfbWVudV9hbGlnbiI7czo1OiJyaWdodCI7czoxMjoidG9wX2Jhcl9pbmZvIjtzOjA6IiI7czoxODoidG9wX2Jhcl9pbmZvX2FsaWduIjtzOjU6InJpZ2h0IjtzOjI0OiJ0b3BfYmFyX2JhY2tncm91bmRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxODoidG9wX2Jhcl90ZXh0X2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTg6InRvcF9iYXJfbGlua19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI0OiJ0b3BfYmFyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyNjoidG9wX2Jhcl9zb2NpYWxfaWNvbnNfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxODoiYmFja190b190b3BfYnV0dG9uIjtzOjY6ImVuYWJsZSI7czoyNDoiYmFja190b190b3BfYnV0dG9uX2FsaWduIjtzOjU6ImZpeGVkIjtzOjI0OiJiYWNrX3RvX3RvcF9idXR0b25fY29sb3IiO3M6NzoiIzAwMDAwMCI7czozMDoiYmFja190b190b3BfYnV0dG9uX2NvbG9yX2hvdmVyIjtzOjc6IiMwMDAwMDAiO3M6MjM6ImZvb3Rlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjU6ImZvb3Rlcl93aWRnZXRfdGl0bGVfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNzoiZm9vdGVyX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNjoiZm9vdGVyX3RleHRfc2l6ZSI7czoyOiIxMyI7czoxNzoiZm9vdGVyX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyMzoiZm9vdGVyX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2JhY2tncm91bmRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3IiO3M6NzoiIzAwMDAwMCI7czozNToiZm9vdGVyX2JvdHRvbV9hcmVhX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiIzAwMDAwMCI7czoyOToiZm9vdGVyX2JvdHRvbV9hcmVhX3RleHRfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoyNToiZm9vdGVyX3NvY2lhbF9saW5rc19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJmb290ZXJfc29jaWFsX2xpbmtzX3NpemUiO3M6MjoiMTMiO3M6MzA6ImZvb3Rlcl9ib3R0b21fYXJlYV90b3BfcGFkZGluZyI7czoyOiIyMCI7czozMzoiZm9vdGVyX2JvdHRvbV9hcmVhX2JvdHRvbV9wYWRkaW5nIjtzOjI6IjUwIjtzOjIzOiJmb290ZXJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjM1OiJmb290ZXJfYm90dG9tX2FyZWFfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjZTZlNmU2IjtzOjE1OiJmb290ZXJfcGFyYWxsYXgiO3M6NzoiZGlzYWJsZSI7czoyNzoic2luZ2xlX3BvcnRmb2xpb19uYXZpZ2F0aW9uIjtzOjY6ImVuYWJsZSI7czoxNDoicG9ydGZvbGlvX3BhZ2UiO3M6MDoiIjtzOjIyOiJzaW5nbGVfcG9zdF9uYXZpZ2F0aW9uIjtzOjY6ImVuYWJsZSI7czoxODoic29jaWFsX2xpbmtzX3N0eWxlIjtzOjE6IjEiO3M6MTI6InNvY2lhbF9saW5rcyI7YTozOntpOjM7czo5OiJpbnN0YWdyYW0iO2k6ODtzOjk6InBpbnRlcmVzdCI7aToxMDtzOjg6ImRyaWJiYmxlIjt9czoxMToidHdpdHRlcl91cmwiO3M6MjA6Imh0dHBzOi8vdHdpdHRlci5jb20vIjtzOjEyOiJmYWNlYm9va191cmwiO3M6MjQ6Imh0dHA6Ly93d3cuZmFjZWJvb2suY29tLyI7czoxMzoiaW5zdGFncmFtX3VybCI7czoyMToiaHR0cDovL2luc3RhZ3JhbS5jb20vIjtzOjEyOiJsaW5rZWRpbl91cmwiO3M6MjQ6Imh0dHA6Ly93d3cubGlua2VkaW4uY29tLyI7czoxMzoicGludGVyZXN0X3VybCI7czoyMToiaHR0cDovL3BpbnRlcmVzdC5jb20vIjtzOjk6ImdwbHVzX3VybCI7czoyNDoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20vIjtzOjk6InZpbWVvX3VybCI7czoxNzoiaHR0cDovL3ZpbWVvLmNvbS8iO3M6MTA6ImZsaWNrcl91cmwiO3M6MjI6Imh0dHA6Ly93d3cuZmxpY2tyLmNvbS8iO3M6MTA6InR1bWJscl91cmwiO3M6MjM6Imh0dHBzOi8vd3d3LnR1bWJsci5jb20vIjtzOjExOiJ5b3V0dWJlX3VybCI7czoyMzoiaHR0cDovL3d3dy55b3V0dWJlLmNvbS8iO3M6MTI6ImRyaWJiYmxlX3VybCI7czoyMDoiaHR0cDovL2RyaWJiYmxlLmNvbS8iO3M6MTE6ImJlaGFuY2VfdXJsIjtzOjIzOiJodHRwOi8vd3d3LmJlaGFuY2UubmV0LyI7czo2OiJweF91cmwiO3M6MTg6Imh0dHBzOi8vNTAwcHguY29tLyI7czo2OiJ2a191cmwiO3M6MTQ6Imh0dHA6Ly92ay5jb20vIjtzOjEzOiJlbWFpbF9hZGRyZXNzIjtzOjIzOiJwbGFjZWhvbGRlckBleGFtcGxlLmNvbSI7czoyNDoiZW5hYmxlX3dvb2NvbW1lcmNlX2xpbmtzIjtzOjc6ImRpc2FibGUiO3M6MTE6InNob3BfbGF5b3V0IjtzOjEyOiJsZWZ0LXNpZGViYXIiO3M6MTI6InNob3BfY29sdW1ucyI7czoxOiIzIjtzOjI2OiJoZWFkZXJfYmFja2dyb3VuZF9mb3Jfc2hvcCI7czowOiIiO3M6MzQ6ImFkZF90b19jYXJ0X3RleHRfb25fc2luZ2xlX3Byb2R1Y3QiO3M6MDoiIjtzOjIzOiJyZXZvbHV0aW9uX3NsaWRlcl9hbGlhcyI7czowOiIiO3M6Mzg6ImFkZGl0aW9uYWxfaW5mb19vbl9zaW5nbGVfcHJvZHVjdF9wYWdlIjtzOjA6IiI7fQ==';
        $ot_theme_options = unserialize(ot_decode($ot_export_data));
        update_option(ot_options_id(), $ot_theme_options);
		
		// Easy Social Share Buttons options
		if ( class_exists( 'ESSB_Manager' ) ) {
			$essb_export_data = '{"topbar_contentarea_pos":"left","bottombar_contentarea_pos":"left","flyin_position":"right","sis_network_order":["facebook","twitter","google","linkedin","pinterest","tumblr","reddit","digg","delicious","vkontakte","odnoklassniki"],"sis_position":"top-left","sis_style":"tiny","sis_orientation":"horizontal","heroshare_second_type":"top","postbar_button_style":"recommended","postbar_counter_pos":"hidden","point_position":"bottomright","point_open_auto":"no","point_style":"simple","point_shape":"round","point_button_style":"recommended","point_template":"6","point_counter_pos":"inside","mobile_sharebuttonsbar_count":"1","sharebar_counter_pos":"inside","sharebar_total_counter_pos":"before","sharepoint_counter_pos":"inside","sharepoint_total_counter_pos":"before","display_in_types":["post"],"display_excerpt_pos":"top","content_position":"content_bottom","afterclose_type":"follow","afterclose_like_cols":"onecol","aftershare_optin_design":"design1","networks":["facebook","twitter","pinterest","tumblr"],"more_button_func":"1","share_button_func":"1","share_button_counter":"hidden","twitter_message_optimize_method":"1","subscribe_function":"form","subscribe_optin_design":"design1","subscribe_optin_design_popup":"design1","mail_function":"form","mail_function_security":"level1","flattr_lang":"sq_AL","style":"1001","button_style":"button","counter_pos":"hidden","total_counter_pos":"hidden","fullwidth_align":"left","fullwidth_share_buttons_columns":"1","counter_recover_mode":"unchanged","counter_recover_protocol":"unchanged","counter_recover_prefixdomain":"unchanged","twitter_counters":"self","force_counters_admin_type":"wp","ga_tracking_mode":"simple","esml_history":"1","esml_access":"manage_options","twitter_card_type":"summary","twitter_shareshort":"true","shorturl_type":"wp","shorturl_bitlyapi_version":"previous","affwp_active_mode":"id","user_network_name_facebook":"Share","user_network_name_twitter":"Tweet","user_network_name_pinterest":"Pin","user_network_name_tumblr":"Post"}';
			$essb_export_data = wp_specialchars_decode ( $essb_export_data );
			$essb_export_data = stripslashes ( $essb_export_data );
				
			$essb_imported_options = json_decode ( $essb_export_data, true );
			
			if (is_array($essb_imported_options)) {
				update_option(ESSB3_OPTIONS_NAME, $essb_imported_options);
			}
		}
	}

}
add_action( 'pt-ocdi/after_import', 'mega_after_import' );

// Auto plugin activation
require_once( get_template_directory() . '/inc/class-tgm-plugin-activation.php' );
add_action('tgmpa_register', 'mega_register_required_plugins');
function mega_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'WPBakery Page Builder', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> 'http://megathe.me/bundled-plugins/hm3rz9g3g48qpzx2/js_composer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or mega, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'WPBakery Page Builder Addon for Skylab Theme', // The plugin name
			'slug'     				=> 'wpbakery-page-builder-addon-for-skylab-theme', // The plugin slug (typically the folder name)
			'source'   				=> 'http://megathe.me/bundled-plugins/hm3rz9g3g48qpzx2/wpbakery-page-builder-addon-for-skylab-theme.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or mega, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> 'http://megathe.me/bundled-plugins/hm3rz9g3g48qpzx2/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or mega, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Portfolio Post Type', // The plugin name
			'slug'     				=> 'mega-portfolio-post-type', // The plugin slug (typically the folder name)
			'source'   				=> 'http://megathe.me/bundled-plugins/hm3rz9g3g48qpzx2/mega-portfolio-post-type.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or mega, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Easy Social Share Buttons for WordPress', // The plugin name
			'slug'     				=> 'easy-social-share-buttons3', // The plugin slug (typically the folder name)
			'source'   				=> 'http://megathe.me/bundled-plugins/hm3rz9g3g48qpzx2/easy-social-share-buttons3.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or mega, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false
		),
		array(
			'name' 		=> 'SVG Support',
			'slug' 		=> 'svg-support',
			'required' 	=> false
		),
		array(
			'name' 		=> 'One Click Demo Import',
			'slug' 		=> 'one-click-demo-import',
			'required' 	=> false
		)
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'mega',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => 'http://demo.megathe.me/bundled-plugins/hm3rz9g3g48qpzx2',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa($plugins, $config);
}

// Register theme notice
function mega_register_theme_notice() {
	$verified = get_option('mega_theme_verify');
	if ( $verified != true ) {
		$screen = get_current_screen();
		if ( $screen->id != 'appearance_page_mt-theme-license' ) {
		?>
		<div class="notice notice-warning is-dismissible">
			<p><strong><?php echo __( 'In order to receive all benefits of Skylab theme, you need to activate your copy of the theme. By activating Skylab license you will unlock premium options - <em>direct theme updates</em>, access to <em>demo content library</em>, <em>bundled plugins</em> and <em>official support.</em>', 'skylab' ); ?></strong></p>
			<p><strong><a href="<?php echo admin_url( 'themes.php?page=mt-theme-license' ) ?>"><?php echo __( 'Register Skylab Theme', 'skylab' ) ?></a></strong></p>
		</div>
		<?php
		}
	}
}
add_action( 'admin_notices', 'mega_register_theme_notice' );


/**
 * Sets the post excerpt length.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function mega_excerpt_length( $length ) {
	return 55;
}
add_filter( 'excerpt_length', 'mega_excerpt_length' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis.
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function mega_auto_excerpt_more( $more ) {
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'mega_auto_excerpt_more' );

/**
 * Get taxonomies terms links.
 */
function mega_custom_taxonomies_terms_links() {
	global $post, $post_id;
	// get post by post id
	$post = get_post( $post->ID );
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies( $post_type );
	foreach ( $taxonomies as $taxonomy ) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term ) {
				$out[] = $term->name;
			}
			$return = join( ', ', $out );
			return $return;
		}
	}
}

// Get current URL
if ( ! function_exists( 'mega_get_current_page_url' ) ) {
	function mega_get_current_page_url() {
	  global $wp;
	  return add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( '/'. $wp->request ) );
	}
}

/**
 * Remove title attribute from images.
 */
function mega_wp_get_attachment_image_attributes_title_filter( $attr ) {
	unset( $attr['title'] );
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'mega_wp_get_attachment_image_attributes_title_filter' );

/**
 * Register our sidebars and widgetized areas.
 */
function mega_widgets_init() {

	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'skylab' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Page Sidebar', 'skylab' ),
		'id' => 'sidebar-2',
		'description' => esc_html__( 'An optional widget area for your pages', 'skylab' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Shop Sidebar', 'skylab' ),
		'id' => 'sidebar-3',
		'description' => esc_html__( 'An optional widget area for your shop page', 'skylab' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer Area One', 'skylab' ),
		'id' => 'sidebar-4',
		'description' => esc_html__( 'An optional widget area for your footer', 'skylab' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer Area Two', 'skylab' ),
		'id' => 'sidebar-5',
		'description' => esc_html__( 'An optional widget area for your footer', 'skylab' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer Area Three', 'skylab' ),
		'id' => 'sidebar-6',
		'description' => esc_html__( 'An optional widget area for your footer', 'skylab' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer Area Four', 'skylab' ),
		'id' => 'sidebar-7',
		'description' => esc_html__( 'An optional widget area for your footer', 'skylab' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Subfooter Area One', 'skylab' ),
		'id' => 'sidebar-8',
		'description' => esc_html__( 'An optional widget area for your subfooter', 'skylab' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Subfooter Area Two', 'skylab' ),
		'id' => 'sidebar-9',
		'description' => esc_html__( 'An optional widget area for your subfooter', 'skylab' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Subfooter Area Three', 'skylab' ),
		'id' => 'sidebar-10',
		'description' => esc_html__( 'An optional widget area for your subfooter', 'skylab' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	//register_sidebar( array(
		//'name' => esc_html__( 'Secondary Menu Area One', 'skylab' ),
		//'id' => 'sidebar-11',
		//'description' => esc_html__( 'An optional widget area for your secondary menu', 'skylab' ),
		//'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		//'after_widget' => "</aside>",
		//'before_title' => '<h3 class="widget-title"><span>',
		//'after_title' => '</span></h3>',
	//) );
	
	register_widget( 'Mega_Social_Accounts' );
}
add_action( 'widgets_init', 'mega_widgets_init' );

/**
 * Adds Mega_Social_Accounts widget.
 */
class Mega_Social_Accounts extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'social_accounts_widget', // Base ID
			esc_html__( 'Social Links', 'skylab' ), // Name
			array( 'description' => esc_html__( 'A Social Links Widget', 'skylab' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		$align = isset( $instance['align'] ) ? esc_attr( $instance['align'] ) : 'left';
		$style = isset( $instance['style'] ) ? esc_attr( $instance['style'] ) : '1';
		?>
		<div class="social-links-wrapper align-<?php echo esc_attr( $align ); ?> social-links-style-<?php echo esc_attr( $style ); ?>  clearfix">
		<?php
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		get_template_part( 'social-links' );
		?>
		</div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$align = isset( $instance['align'] ) ? esc_attr( $instance['align'] ) : '';
		$style = isset( $instance['style'] ) ? esc_attr( $instance['style'] ) : '';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'skylab' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		
		<p><label><?php esc_html_e('Align', 'skylab'); ?>:</label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'align' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'align' ) ); ?>">
            <?php $options = array('left', 'center', 'right');
			 foreach ($options as $option) {
				echo '<option value="' . esc_attr( $option ) . '" id="' . esc_attr( $option ) . '"',
				$align == $option ? ' selected="selected"' : '', '>', esc_html( $option ), '</option>';
			}
				?>
            </select>
        </p>
		
		<p><label><?php esc_html_e('Style', 'skylab'); ?>:</label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
            <?php $options = array('1', '2', '3', '4');
			 foreach ($options as $option) {
				echo '<option value="' . esc_attr( $option ) . '" id="' . esc_attr( $option ) . '"',
				$style == $option ? ' selected="selected"' : '', '>', esc_html( $option ), '</option>';
			}
				?>
            </select>
        </p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['align'] = strip_tags($new_instance['align']);
		$instance['style'] = strip_tags($new_instance['style']);
		$instance['size'] = strip_tags($new_instance['size']);

		return $instance;
	}

} // class Mega_Social_Accounts

if ( ! function_exists( 'mega_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function mega_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo sanitize_html_class( $nav_id ); ?>">
			<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'skylab' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older Posts <i class="nav-pagination-single-right"></i>', 'skylab' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( esc_html__( '<i class="nav-pagination-single-left"></i> Newer Posts', 'skylab' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // mega_content_nav

if ( ! function_exists( 'mega_pagination_content_nav' ) ) :
/**
 * Display navigation to next/previous pages with pagination when applicable
 */
function mega_pagination_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="<?php echo sanitize_html_class( $nav_id ); ?>">
			
			<?php $big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'prev_text' => '<span class="meta-nav">'. esc_html__('Prev', 'skylab') .'</span>',
				'next_text' => '<span class="meta-nav">'. esc_html__('Next', 'skylab') .'</span>',
				'end_size' => 1,
				'before_page_number' => '<span>',
				'after_page_number' => '</span>'
			) ); ?>
		</nav>
	<?php endif;
}
endif; // mega_pagination_content_nav

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function mega_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;
		
	if ( is_active_sidebar( 'sidebar-6' ) )
		$count++;
		
	if ( is_active_sidebar( 'sidebar-7' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one clearfix';
			break;
		case '2':
			$class = 'two clearfix';
			break;
		case '3':
			$class = 'three clearfix';
			break;
		case '4':
			$class = 'four clearfix';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

/**
 * Count the number of subfooter sidebars to enable dynamic classes for the subfooter
 */
function mega_subfooter_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-8' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-9' ) )
		$count++;
		
	if ( is_active_sidebar( 'sidebar-10' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one clearfix';
			break;
		case '2':
			$class = 'two clearfix';
			break;
		case '3':
			$class = 'three clearfix';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

/**
 * Return the URL for the first link found in the post content.
 *
 * @return string|bool URL or false when no link is present.
 */
function mega_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

if ( ! function_exists( 'mega_comment' ) ) :
/**
 * Template for comments and pingbacks.
 */
function mega_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', 'skylab' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'skylab' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="avatar vcard">
					<?php
						$avatar_size = 100;

						echo get_avatar( $comment, $avatar_size );

					?>

				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'skylab' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content">
			<div class="comment-author vcard">
					<?php

						// translators: 1: comment author, 2: date and time */
						printf( esc_html__( '%1$s %2$s', 'skylab' ),
							
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s" class="comment-time"><span>%3$s</span></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								//sprintf( esc_html__( '%1$s %2$s', 'skylab' ), get_comment_date('M j, Y'), get_comment_time() )
								sprintf( esc_html__( '%1$s', 'skylab' ), get_comment_date('M j, Y') )
							)
						);
						
						$sep = '<span class="sep"> / </span>';
						if ( comments_open() ) :
						endif; // End if comments_open()
							edit_comment_link( esc_html__( 'Edit', 'skylab' ), '' . $sep . '<span class="edit-link">', '</span>' );
					?>

			</div><!-- .comment-author .vcard -->
				
			<?php comment_text(); ?>
			
			<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'skylab' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			
			</div>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for mega_comment()

if ( ! function_exists( 'mega_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function mega_posted_on() {
		echo '<p class="entry-date-wrapper"><span class="entry-date">'. esc_html( get_the_date() ) .'</span></p>';
	}
}

	/**
	 * Create WP3 menu areas.
	 */
	register_nav_menus( array( 'primary' => 'Primary Menu' ) );

/**
 * Adds classes to the array of body classes.
 */
function mega_body_classes( $classes ) {

	if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_singular() && ! is_home() )
		$classes[] = 'singular';
	
	// Sidebar
	if ( is_active_sidebar( 'sidebar-1' ) && is_home() || is_singular( 'post' ) && is_active_sidebar( 'sidebar-1' ) )
		$classes[] = 'main-sidebar-is-active';
		
	// Empty Cart
	global $woocommerce;
	if ( $woocommerce && is_cart() ) {
		if((sizeof($woocommerce->cart->cart_contents)) == 0) {
			$classes[] = 'empty-cart';
		}
	}
	
	// No products
	if ( $woocommerce && is_shop() && ! have_posts() || $woocommerce && is_product_category() && ! have_posts() ) {
		$classes[] = 'no-products';
	}
	
	$footer_parallax = ot_get_option( 'footer_parallax' );
	if ( $footer_parallax == 'enable' ) {
		$classes[] = 'footer-parallax-enabled';
	} else if ( $footer_parallax == 'enable_on_homepage_only' && is_front_page() ) {
		$classes[] = 'footer-parallax-enabled';
	}
	
	// WooCommerce lightbox
	global $woocommerce;
	if ( $woocommerce ) {
		$lightbox_en = get_option( 'woocommerce_enable_lightbox' );
		global $post;
		if ( $lightbox_en == 'yes' && ( is_product() || $lightbox_en == 'yes' && ( ! empty( $post->post_content ) && strstr( $post->post_content, '[product_page' ) ) ) ) {
			$classes[] = 'woocommerce-lightbox-enabled';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'mega_body_classes' );

/**
 * Loads a set of CSS and/or Javascript documents. 
 */
function mega_enqueue_admin_scripts( $hook ) {
	wp_register_style( 'mega-admin', get_template_directory_uri() . '/css/mega-admin.css' );
	if ( $hook == 'appearance_page_mt-theme-license' || $hook == 'appearance_page_pt-one-click-demo-import' ) {
		wp_enqueue_style( 'mega-admin' );
	}
	if ( class_exists( 'WPB_VC_VERSION' ) ) {
		
		wp_register_style( 'mega-js_composer_extend', get_template_directory_uri() . '/vc_extend/assets/css/mega-js_composer_extend.css' );
		
		wp_register_script( 'mega-vc-testimonials-section', get_template_directory_uri().'/vc_extend/assets/js/mega-vc-testimonials-section.js', array('vc_accordion_script'), '', true );
		wp_register_script( 'mega-vc-team-slider-section', get_template_directory_uri().'/vc_extend/assets/js/mega-vc-team-slider-section.js', array('vc_accordion_script'), '', true );
		if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' )
			return;
		wp_enqueue_script( 'mega-vc-testimonials-section' );
		wp_enqueue_script( 'mega-vc-team-slider-section' );
		wp_enqueue_style( 'mega-js_composer_extend' );
	}
}
add_action( 'admin_enqueue_scripts', 'mega_enqueue_admin_scripts', 9999 );

/**
 * A safe way to add/enqueue a CSS/JavaScript. 
 */
 function mega_enqueue_scripts() {
	// A safe way to register a JavaScript file.
	wp_register_style( 'mega-style', get_template_directory_uri() . '/style.css' );
	wp_register_style( 'fresco', get_template_directory_uri() . '/css/fresco.css' );
	wp_register_style( 'mega-woocommerce', get_template_directory_uri() . '/css/mega-woocommerce.css' );
	wp_enqueue_style( 'mega-style', array() );
	
	wp_register_script( 'imagesloaded-pkgd', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'hover-intent', get_template_directory_uri() . '/js/jquery.hoverIntent.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'smartresize', get_template_directory_uri() . '/js/jquery.smartresize.js', array( 'jquery' ), false, true );
	wp_register_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'lazyloadxt', get_template_directory_uri() . '/js/jquery.lazyloadxt.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'lazyloadxt-bg', get_template_directory_uri() . '/js/jquery.lazyloadxt.bg.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'select2', get_template_directory_uri() . '/js/select2.full.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'skrollr', get_template_directory_uri() . '/js/skrollr.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'transit', get_template_directory_uri() . '/js/jquery.transit.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'vivus', get_template_directory_uri() . '/js/vivus.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'countUp', get_template_directory_uri() . '/js/countUp.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'barrating', get_template_directory_uri() . '/js/jquery.barrating.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'fresco', get_template_directory_uri() . '/js/fresco.js', array( 'jquery' ), false, true );
	wp_register_script( 'typed', get_template_directory_uri() . '/js/typed.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'isotope-pkgd', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'mega-portfolio', get_template_directory_uri() . '/js/jquery.portfolio.js', array( 'jquery' ), false, true );
	wp_register_script( 'mega-blog', get_template_directory_uri() . '/js/jquery.blog.js',array( 'jquery' ), false, true );
	wp_register_script( 'infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'mega-gallery', get_template_directory_uri() . '/js/jquery.gallery.js', array( 'jquery' ), false, true );
	wp_register_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'wc-quantity-increment', get_template_directory_uri() . '/js/wc-quantity-increment.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'mega-add-to-cart-simple-ajax', get_template_directory_uri() . '/js/add-to-cart-simple_ajax.js', array( 'jquery' ), false, true );
	wp_register_script( 'background-check', get_template_directory_uri() . '/js/background-check.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'mega-init', get_template_directory_uri() . '/js/jquery.init.js', array( 'jquery' ), false, true );

	wp_enqueue_style( 'js_composer_front' );
	wp_enqueue_script( 'wpb_composer_front_js' );
	wp_enqueue_style('js_composer_custom_css');
	
	if ( is_singular('post') && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	global $woocommerce;
	if ( $woocommerce ) {
		wp_enqueue_style( 'mega-woocommerce', array() );
		
		$lightbox_en = get_option( 'woocommerce_enable_lightbox' );
		global $post;
		if ( is_product() || ( ! empty( $post->post_content ) && strstr( $post->post_content, '[product_page' ) ) ) {
			wp_enqueue_script( 'slick' );
		}
		wp_enqueue_script( 'wc-quantity-increment' );
		$enable_carousel_slider_for_related_products_on_single_product_page = ot_get_option( 'enable_carousel_slider_for_related_products_on_single_product_page' );
		if ( ! empty( $enable_carousel_slider_for_related_products_on_single_product_page ) ) {
			$lightbox_en = get_option( 'woocommerce_enable_lightbox' );
			global $post;
			if ( is_product() || ( ! empty( $post->post_content ) && strstr( $post->post_content, '[product_page' ) ) ) {
				wp_enqueue_script( 'owl-carousel' );
			}
		}
		global $post;
		if ( is_product() || ( ! empty( $post->post_content ) && strstr( $post->post_content, '[product_page' ) ) ) {
			wp_enqueue_script( 'mega-add-to-cart-simple-ajax' );
		}
	}
	
	// select2 dropdowns in the cart shipping calculator
	if ( $woocommerce ) {
		if ( is_product() ) {
			wp_enqueue_script( 'barrating' );
		}
		
		if ( is_cart() ) {
			$assets_path = str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/';
			wp_register_script( 'select2', $assets_path . 'js/select2/select2.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'select2' );
			wp_enqueue_style( 'select2', $assets_path . 'css/select2.css' );
		}
	}
	
	// Blog posts default
	if ( is_archive() || is_author() || is_category() || is_home() || is_tag() || is_search() ) {
		wp_enqueue_script( 'isotope-pkgd' );
		wp_enqueue_script( 'waypoints' );
		wp_enqueue_script( 'mega-blog' );
		$current_url = mega_get_current_page_url();
		$finishedMsg = esc_html__( 'No more posts to load', 'skylab' );
		wp_localize_script( 'mega-blog', 'megaBlog', array( 'loader' => get_template_directory_uri() .'/images/spinner-light.svg', 'current_url' => $current_url, 'finishedMsg' => $finishedMsg ) );
		wp_enqueue_script( 'infinitescroll' );
	}
	
	wp_enqueue_script( 'imagesloaded-pkgd' );
	wp_enqueue_script( 'hover-intent' );
	wp_enqueue_script( 'superfish' );
	wp_enqueue_script( 'smartresize' );
	wp_enqueue_script( 'waypoints' );
	wp_enqueue_script( 'lazyloadxt' );
	wp_enqueue_script( 'lazyloadxt-bg' );
	wp_enqueue_script( 'easing' );
	//wp_enqueue_script( 'select2' );
	wp_enqueue_script( 'skrollr' );
	wp_enqueue_script( 'transit' );
	wp_enqueue_script( 'theia-sticky-sidebar' );
	wp_enqueue_script( 'background-check' );
	wp_enqueue_script( 'mega-init' );
	
}
add_action( 'wp_enqueue_scripts', 'mega_enqueue_scripts', 10 );

/**
 * Pace options.
 */
function mega_page_load_progress_bar_init() {
	$output="<script>paceOptions = {
		ajax: false,
		document: false,
		restartOnPushState: false,
	}</script>
	<style>
	/* =pace
	----------------------------------------------- */
	@keyframes fadeOutPace {
		0% {
			opacity: 1;
		}
		100% {
			opacity: 0;
		}
	}
	.pace {
		-webkit-pointer-events: none;
		pointer-events: none;
		-webkit-user-select: none;
		-moz-user-select: none;
		user-select: none;

		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 4px;
		z-index: 10000;
	}
	.pace-inactive {
		animation: fadeOutPace .3s cubic-bezier(0,0.9,0.3,1) forwards 0s;
	}
	.pace .pace-progress {
		background: #000;
		position: absolute;
		z-index: 2000;
		top: 0;
		right: 100%;
		width: 100%;
		height: 4px;
	}
	.pace .pace-progress-inner {
		display: block;
		position: absolute;
		right: 0px;
		width: 100px;
		height: 100%;
		box-shadow: 0 0 10px #000, 0 0 5px #000;
		opacity: 1.0;
		transform: rotate(3deg) translate(0px, -4px);
		box-shadow: none;
		display: none;
	}
	.pace .pace-activity {
		display: block;
		position: fixed;
		z-index: 2000;
		top: 15px;
		right: 15px;
		width: 14px;
		height: 14px;
		border: solid 2px transparent;
		border-top-color: #000;
		border-left-color: #000;
		border-radius: 10px;
		-webkit-animation: pace-spinner 400ms ease infinite;
		-moz-animation: pace-spinner 400ms ease infinite;
		-ms-animation: pace-spinner 400ms ease infinite;
		-o-animation: pace-spinner 400ms ease infinite;
		animation: pace-spinner 400ms ease infinite;

		display: none;
	}
	@keyframes pace-spinner {
	  0% { transform: rotate(0deg); transform: rotate(0deg); }
	  100% { transform: rotate(360deg); transform: rotate(360deg); }
	}
	</style>
	<script type='text/javascript' src='".get_template_directory_uri()."/js/pace.min.js'></script>";
	$page_load_progress_bar = ot_get_option( 'page_load_progress_bar' );
	if ( empty( $page_load_progress_bar ) ) {
		$page_load_progress_bar = 'enabled';
	}
	if ( $page_load_progress_bar == 'enabled' ) {
	echo $output;
	}
}
add_action( 'wp_head', 'mega_page_load_progress_bar_init', 0 );

/**
 * Initialize jQuery Plugins.
 */
function mega_initialize_jquery_plugins() {
	
?>
	<!-- JavaScript
    ================================================== -->
	<?php $center_logo_and_menu = ot_get_option( 'center_logo_and_menu' ); ?>
	<?php if ( empty( $center_logo_and_menu ) ) { ?>
	
	<?php $header_style = ot_get_option( 'header_style' ); ?>
	<?php if ( empty( $header_style ) ) { ?>
		<?php $header_style = 'non_fixed'; ?>
	<?php } ?>
	<?php if ( $header_style == 'fixed' ) { ?>
		<script>
		// Transition
		jQuery(document).ready(function($) {
			if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
				var $addTransition = $( '#header, #site-title, #site-title img, #access, .search-header-wrapper, #header .social-links-wrapper, .woocommerce-cart-wrapper, #header-wrapper #s, #header-wrapper .info-header, #secondary-menu-dropdown, #log-wrapper, #wpml-wrapper, #button-wrapper, .woocommerce-links-wrapper, .yith-wishlist-wrapper' );
				$addTransition.addClass( 'transition' );
			}
		});
		</script>
		
	<?php } // End if ( $header_style == 'fixed' ) ?>
	
	<?php $header_position = ot_get_option( 'header_position' ); ?>
	<?php if ( empty( $header_position ) ) { ?>
		<?php $header_position = 'top'; ?>
	<?php } ?>
	<?php if ( $header_style == 'fixed-on-scroll' && in_array($header_position, array("top", "bottom")) ) { ?>
		<script>
		// Transition
		jQuery(document).ready(function($) {
			if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
				var $addTransition = $( '#header, #site-title, #site-title img, #access, .search-header-wrapper, #header .social-links-wrapper, .woocommerce-cart-wrapper, #header-wrapper #s, #header-wrapper .info-header, #secondary-menu-dropdown, #log-wrapper, #wpml-wrapper, #button-wrapper, .woocommerce-links-wrapper, .yith-wishlist-wrapper' );
				$addTransition.addClass( 'transition' );
			}
		});
		</script>
		
		<script>
		// Sticky header on scroll
		jQuery(document).ready(function($) {
			jQuery(window).load(function() {
				$("#header").clone(false).addClass( 'ghost-header' ).appendTo($("#header-wrapper"));
				
				$('.ghost-header .sf-menu').superfish({
					animation: {},
					animationOut: {},
					speed: 0,
					speedOut: 0,
				});
				
				var $header = $('#header');
				var offset = $(window).height() - $header.outerHeight() - 1;
				$(window).scroll(function(){
					if ($(this).scrollTop() > offset) {
						$(".ghost-header").addClass("ghost-header-show");
					} else {
						$(".ghost-header").removeClass("ghost-header-show");
					}
				});
			});
		});
		</script>
		
	<?php } // End if ( $header_style == 'fixed-on-scroll' ) ?>
	
	
	<?php } else { ?>
	
		
		<?php $header_style = ot_get_option( 'header_style' ); ?>
		<?php if ( empty( $header_style ) ) { ?>
			<?php $header_style = 'fixed'; ?>
		<?php } ?>
		<?php $header_height_reduction_scrolling = ot_get_option( 'header_height_reduction_scrolling' ); ?>
		<?php if ( empty( $header_height_reduction_scrolling ) ) { ?>
			<?php $header_height_reduction_scrolling = 'disable'; ?>
		<?php } ?>
		
		<?php if ( $header_style == 'fixed' ) { ?>
			<script>
			// Transition
			jQuery(document).ready(function($) {
				var $addTransition = $( '#header, #site-title, #site-title img, #access, .search-header-wrapper, #header .social-links-wrapper, .woocommerce-cart-wrapper, #header-wrapper #s, #header-wrapper .info-header, #secondary-menu-dropdown, #log-wrapper, #wpml-wrapper, #button-wrapper, .center-logo-and-menu-enabled #access-wrapper' );
				$addTransition.addClass( 'transition' );
			});
			</script>
			
			
			<script>
			// Sticky header
			var sticky = document.querySelector('.center-logo-and-menu-enabled #access-wrapper');
			
			var origOffsetY = sticky.offsetTop;
			var hasScrollY = 'scrollY' in window;

			function onScroll(e) {
			  var y = hasScrollY ? window.scrollY : document.documentElement.scrollTop;
			  <?php if ( $header_height_reduction_scrolling == 'enable' ) { ?>
			   y >= origOffsetY ? sticky.classList.add('fixed', 'header-height-on-scrolling') : sticky.classList.remove('fixed', 'header-height-on-scrolling');
			  <?php } else { ?>
			   y >= origOffsetY ? sticky.classList.add('fixed') : sticky.classList.remove('fixed');
			  <?php } ?>
			}

			if (document.addEventListener) {
				 document.addEventListener('scroll', onScroll); 
			} else if (document.attachEvent)  {
				 document.attachEvent('onscroll', onScroll);
			}
			</script>
			
		<?php } // End if ( $header_style == 'fixed' ) ?>
		
	
	<?php } // End if empty( $center_logo_and_menu ) ) ?>
	
	<?php $header_height = ot_get_option( 'header_height' ); ?>
	<?php if ( empty( $header_height ) ) { ?>
		<?php $header_height = 64; ?>
	<?php } ?>
	
	<?php $header_height_reduction_scrolling = ot_get_option( 'header_height_reduction_scrolling' ); ?>
	<?php if ( empty( $header_height_reduction_scrolling ) ) { ?>
		<?php $header_height_reduction_scrolling = 'disable'; ?>
	<?php } ?>
	
	<?php $header_height_on_scrolling = ot_get_option( 'header_height_on_scrolling' ); ?>
	<?php if ( empty( $header_height_on_scrolling ) ) { ?>
		<?php $header_height_on_scrolling = 54; ?>
	<?php } ?>
	
	<?php $center_logo_and_menu = ot_get_option( 'center_logo_and_menu' ); ?>
	<?php $menu_height_on_scrolling = ot_get_option( 'menu_height_on_scrolling' ); ?>
	<?php if ( empty( $menu_height_on_scrolling ) ) { ?>
		<?php $menu_height_on_scrolling = 40; ?>
	<?php } ?>
	
	<?php if ( $header_height_reduction_scrolling == 'enable' ) { ?>
		<?php if ( ! empty( $center_logo_and_menu ) ) { ?>
			<?php $offset = $menu_height_on_scrolling; ?>
		<?php } else { ?>
			<?php $offset = $header_height_on_scrolling + 30; ?>
		<?php } ?>
	<?php } else { ?>
		<?php if ( $header_style == 'fixed' ) { ?>
			<?php $offset = $header_height + 30; ?>
		<?php } else { ?>
			<?php $offset = 40; ?>
		<?php } ?>
	<?php } ?>
	
	<?php $header_position = ot_get_option( 'header_position' ); ?>
	<?php if ( empty( $header_position ) ) { ?>
		<?php $header_position = 'top'; ?>
	<?php } ?>
	
	<?php $offsetBottom = 40; ?>
	<?php if ( $header_position == 'top' ) { ?>
		<?php $offsetTop = $offset; ?>
	<?php } else if ( $header_position == 'bottom' ) { ?>
		<?php $offsetTop = 40; ?>
		<?php $offsetBottom = $header_height + 30; ?>
	<?php } else { ?>
		<?php $offsetTop = 40; ?>
	<?php } ?>
	<script>
	// theia-sticky-sidebar
	jQuery(document).ready(function($) {
		var $stickySidebarEnabled = $( '.sticky-sidebar-enabled' );
		if ($stickySidebarEnabled.length) {
			$stickySidebarEnabled.each(function(){
				if ( $(this).attr('class').indexOf('additional-margin-top') > -1) {
					var num_id_top = $(this).attr('class').match(/additional-margin-top-(\d+)/)[1];
				} else {
					var num_id_top = <?php echo $offsetTop; ?>;
				}
				if ( $(this).attr('class').indexOf('additional-margin-bottom') > -1) {
					var num_id_bottom = $(this).attr('class').match(/additional-margin-bottom-(\d+)/)[1];
				} else {
					var num_id_bottom = 0;
				}
				$(this).find( '.vc_column_container' ).theiaStickySidebar({
					// Settings
					additionalMarginTop: num_id_top,
					additionalMarginBottom: num_id_bottom,
					minWidth: 1023
				});
			});
		}
		
		<?php
		$header_position = ot_get_option( 'header_position' );
		if ( empty( $header_position ) ) {
			$header_position = 'top';
		}
		if ( $header_position == 'left' || $header_position == 'right' ) {
		?>
// Left, Right Header, Primary and Secondary
		var $headerMainWrapper = $( '#header-main-wrapper' );
		$headerMainWrapper.find( '.vc_column_container' ).theiaStickySidebar({
			// Settings
			additionalMarginTop: <?php echo $offsetTop; ?>,
			additionalMarginBottom: <?php echo $offsetBottom; ?>,
			minWidth: 1023
		});
		<?php } else  { ?>
		
		// Blog
		$( '.main-sidebar-is-active #main-content > .vc_column_container' ).theiaStickySidebar({
			// Settings
			additionalMarginTop: <?php echo $offsetTop; ?>,
			additionalMarginBottom: <?php echo $offsetBottom; ?>,
			minWidth: 1023
		});
		
		<?php } ?>
		
		// WooCommerce
		$(".woocommerce-pagination").insertAfter("#main");
		$( '.archive.woocommerce-page #primary, .archive.woocommerce-page #secondary' ).theiaStickySidebar({
			// Settings
			additionalMarginTop: <?php echo $offsetTop + 30; ?>,
			additionalMarginBottom: <?php echo $offsetBottom; ?>,
			minWidth: 1023
		});
		
		$( '.woocommerce-MyAccount-navigation, .woocommerce-MyAccount-content' ).theiaStickySidebar({
			// Settings
			additionalMarginTop: <?php echo $offsetTop + 30; ?>,
			additionalMarginBottom: <?php echo $offsetBottom; ?>,
			minWidth: 1023
		});
	});
	</script>
	
	<script>
	// Scroll Down Button Slider
	jQuery(document).ready(function($) {
		$(".down-button").on('click', function( e ) {
			$('html, body').animate({
				scrollTop: $(this).closest('.wpb_row').next().offset().top - <?php echo $offsetTop; ?>
			}, 900, 'easeInOutExpo' );
		});
	});
	</script>
	
	<script>
	// Anchor link offset
	function offsetAnchor() {
		if(location.hash.length !== 0) {
			window.scrollTo(window.scrollX, window.scrollY - <?php echo $offsetTop; ?>);
		}
	}

	// This will capture hash changes while on the page
	window.addEventListener("hashchange", offsetAnchor);

	// This is here so that when you enter the page with a hash,
	// it can provide the offset in that case too. Having a timeout
	// seems necessary to allow the browser to jump to the anchor first.
	window.setTimeout(offsetAnchor, 1); // The delay of 1 is arbitrary and may not always work right.
	</script>
	
	<?php $disable_right_click = ot_get_option( 'disable_right_click' ); ?>
	<?php if ( ! empty( $disable_right_click ) ) { ?>
		<script>
			jQuery(window).load(function() {
				jQuery('img, .tp-bgimg, .rsImg').bind("contextmenu", function (e) {
					return false; /* Disables right click */
				});
			});
		</script>
	<?php } ?>
<?php
}
add_action( 'wp_footer', 'mega_initialize_jquery_plugins', 99 );

/**
 * Load up our theme meta boxes and related code.
 */
	load_template( trailingslashit( get_template_directory() ) . 'inc/meta-box-option-tree.php' );
	
/**
 * Adds classes to the array of body classes.
 */
function mega_body_shop_classes( $classes ) {
		
	// Shop layout
	global $woocommerce;
	if ( $woocommerce ) {
		if ( is_shop() || is_product_category() ) {
			$shop_layout = ot_get_option( 'shop_layout' );
			if ( empty( $shop_layout ) ) {
				$shop_layout = 'shop-left-sidebar';
			}
			if ( $shop_layout == 'right-sidebar' )
				$classes[] = 'shop-right-sidebar';
			else if ( $shop_layout == 'left-sidebar' || isset($_GET['sidebar']) && $_GET['sidebar'] == 'enable' )
				$classes[] = 'shop-left-sidebar';
			else $classes[] = 'shop-no-sidebar';
			
			$shop_columns = ot_get_option( 'shop_columns' );
			if ( isset($_GET['columns']) && $_GET['columns'] == 3 ) {
				$shop_columns = 3;
			}
			if ( isset($_GET['columns']) && $_GET['columns'] == 4 ) {
				$shop_columns = 4;
			}
			if ( $shop_columns == 2 ) {
				$classes[] = 'shop-2-columns';
			} else if ( $shop_columns == 3 ) {
				$classes[] = 'shop-3-columns';
			} else if ( $shop_columns == 4 ) {
				$classes[] = 'shop-4-columns';
			}
		}
	}

	return $classes;
}
add_filter( 'body_class', 'mega_body_shop_classes' );

/**
 * Filter Primary Typography Fonts.
 */
function mega_filter_ot_recognized_font_families( $array, $field_id ) {
  if ( $field_id == 'primary_typography' || $field_id == 'menu_typography' || $field_id == 'heading_typography' ) {
  
	$systemFontSelect = array(
		'Arial' => 'Arial',
		'Calibri' => 'Calibri',
		'Century Gothic' => 'Century Gothic',
		'Courier' => 'Courier',
		'Courier New' => 'Courier New',
		'Georgia' => 'Georgia',
		'Modern' => 'Modern',
		'Tahoma' => 'Tahoma',
		'Times New Roman' => 'Times New Roman',
		'Trebuchet MS' => 'Trebuchet MS',
		'Verdana' => 'Verdana'
	);
  
    $array = $systemFontSelect;
  }
  
  return $array;
  
}
add_filter( 'ot_recognized_font_families', 'mega_filter_ot_recognized_font_families', 10, 2 );

/**
 * Google Fonts
 */
function mega_enqueue_google_fonts() {
	$google_font_family = ot_get_option( 'google_font_family' );
	if ( empty( $google_font_family ) ) {
		$google_font_family = 'https://fonts.googleapis.com/css?family=Lato';
	}
	if ( ! empty( $google_font_family ) ) {
		echo '<link href="'. esc_url( $google_font_family ) .'" rel="stylesheet" type="text/css">';
	}
}
add_action( 'wp_head', 'mega_enqueue_google_fonts', 2 );

function mega_enqueue_menu_google_fonts() {
	$menu_google_font_family = ot_get_option( 'menu_google_font_family' );
	if ( empty( $menu_google_font_family ) ) {
		$menu_google_font_family = 'https://fonts.googleapis.com/css?family=Lato:400,300';
	}
	if ( ! empty( $menu_google_font_family ) ) {
		echo '<link href="'. esc_url( $menu_google_font_family ) .'" rel="stylesheet" type="text/css">';
	}
}
add_action( 'wp_head', 'mega_enqueue_menu_google_fonts', 2 );

function mega_enqueue_heading_google_fonts() {
	$heading_google_font_family = ot_get_option( 'heading_google_font_family' );
	if ( empty( $heading_google_font_family ) ) {
		$heading_google_font_family = 'https://fonts.googleapis.com/css?family=Lato:700';
	}
	if ( ! empty( $heading_google_font_family ) ) {
		echo '<link href="'. esc_url( $heading_google_font_family ) .'" rel="stylesheet" type="text/css">';
	}
}
add_action( 'wp_head', 'mega_enqueue_heading_google_fonts', 2 );

function mega_enqueue_logo_google_fonts() {
	$logo_google_font_family = ot_get_option( 'logo_google_font_family' );
	if ( ! empty( $logo_google_font_family ) ) {
		echo '<link href="'. esc_url( $logo_google_font_family ) .'" rel="stylesheet" type="text/css">';
	}
}
add_action( 'wp_head', 'mega_enqueue_logo_google_fonts', 2 );

/**
 * Add a style block to the theme for the primary typography.
 */
function mega_print_primary_typography() {
	$primary_typography = ot_get_option( 'primary_typography', array() );
	
	$google_font_name = ot_get_option( 'google_font_name' );
	
	if ( empty( $google_font_name ) ) {
		$google_font_name = 'Lato';
		$primary_font = 'Lato';
	} else {
		$primary_font = $google_font_name;
	}
	
	// Don't do anything if the font-family is empty.
	if ( ! empty( $primary_typography['font-family'] ) || ! empty( $google_font_name ) ) {
	
		wp_enqueue_style( 'mega-style' );
		
		$primary_typography_css = "
	
		/* Primary Typography */
		body, input, textarea, select, button, #cancel-comment-reply-link {
			font-family: '{$primary_font}', sans-serif;
		}
		/* Special Class */
		.primary-typography {
			font-family: '{$primary_font}', sans-serif !important;
			font-weight: 400 !important;
			letter-spacing: 0 !important;
		}";
		
		wp_add_inline_style( 'mega-style', $primary_typography_css );
	}
}
add_action( 'wp_enqueue_scripts', 'mega_print_primary_typography' );

/**
 * Add a style block to the theme for the menu typography.
 */
function mega_print_menu_typography() {
	$menu_typography = ot_get_option( 'menu_typography' );
	
	$menu_google_font_name = ot_get_option( 'menu_google_font_name' );
	
	if ( empty( $menu_google_font_name ) ) {
		$menu_google_font_name = 'Lato';
		$menu_font = 'Lato';
	} else {
		$menu_font = $menu_google_font_name;
	}
	
	// Don't do anything if the font-family is empty.
	if ( ! empty( $menu_typography['font-family'] ) || ! empty( $menu_google_font_name ) ) {
	
		wp_enqueue_style( 'mega-style' );
		
		$menu_typography_css = "
	
		/* Menu Typography */
		#access ul,
		.mobile-menu,
		#mobile-menu-dropdown,
		#log-wrapper,
		#wpml-wrapper,
		.button-wrapper,
		#footer-access ul,
		#secondary-menu-wrapper .secondary-menu {
			font-family: '{$menu_font}', sans-serif;
		}";
		
		wp_add_inline_style( 'mega-style', $menu_typography_css );
	}
}
add_action( 'wp_enqueue_scripts', 'mega_print_menu_typography' );

/**
 * Add a style block to the theme for the heading typography.
 */
function mega_print_heading_typography() {
	$heading_typography = ot_get_option( 'heading_typography' );
	
	$heading_google_font_name = ot_get_option( 'heading_google_font_name' );
	
	if ( empty( $heading_google_font_name ) ) {
		$heading_google_font_name = 'Lato';
		$heading_font = 'Lato';
	} else {
		$heading_font = $heading_google_font_name;
	}
	
	// Don't do anything if the font-family is empty.
	if ( ! empty( $heading_typography['font-family'] ) || ! empty( $heading_google_font_name ) ) {
	
		wp_enqueue_style( 'mega-style' );
		
		$heading_typography_css = "
	
		/* Heading Typography */
		h1, h2, h3, h4, h5, h6,
		#site-title a,
		.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,
		.wpb_content_element .wpb_accordion_header a,
		.tp-caption.skylab_very_big_white,
		.tp-caption.skylab_very_big_black,
		.woocommerce #page div.product .woocommerce-tabs ul.tabs li a,
		.vc_tta-title-text,
		#content #filters a,
		#content .post-thumbnail .wpb_button_a,
		.tag-links a,
		#main #nav-pagination-single a .title-wrapper,
		.tparrows.skylab a .title-wrapper,
		#respond #cancel-comment-reply-link,
		.mt-testimonials-style-9 .mt-testimonial .testimonial-name,
		.comments-nav a {
			font-family: '{$heading_font}', sans-serif;
		}
		#content .gw-go-col.gw-go-clean-style14 .gw-go-btn,
		.gw-go-btn,
		.gw-go-header,
		.secondary-font,
		.tp-button,
		#page .woocommerce ul.products li.product h3,
		#page .woocommerce ul.products li.product .price,
		.scroll-down-button,
		#content .yikes-easy-mc-form .yikes-easy-mc-submit-button,
		.wpcf7-submit,
		.secondary-typography,
		.vc_btn3,
		#respond #submit,
		#page .essb_template_skylab li a,
		#page .essb_template_skylab-minimal li a,
		.comment-reply-link,
		.slick-slider-wrapper .paging-info,
		.entry-content .more-link,
		#content .nav-pagination a,
		.dots,
		#content .nav-pagination > span,
		.fancybox-infobar,
		.rev_slider .tp-revslider-slidesli .mt-caption {
			font-family: '{$heading_font}', sans-serif !important;
		}";
		
		wp_add_inline_style( 'mega-style', $heading_typography_css );
	}
}
add_action( 'wp_enqueue_scripts', 'mega_print_heading_typography' );

/**
 * Add a style block to the theme for the logo typography.
 */
function mega_print_logo_typography() {
	$logo_typography = ot_get_option( 'logo_typography' );
	
	$logo_google_font_name = ot_get_option( 'logo_google_font_name' );
	
	// Don't do anything if the font-family is empty.
	if ( ! empty( $logo_typography['font-family'] ) || ! empty( $logo_google_font_name ) ) {
	
		wp_enqueue_style( 'mega-style' );
		
		$logo_typography_css = "
	
		/* Logo Typography */
		#site-title a {
			font-family: '{$logo_google_font_name}', sans-serif !important;
		}";
		
		wp_add_inline_style( 'mega-style', $logo_typography_css );
	}
}
add_action( 'wp_enqueue_scripts', 'mega_print_logo_typography' );

/**
 * Add a style block to the theme for the accent color.
 */
function mega_print_accent_color_style() {
	$accent_color = ot_get_option( 'accent_color' );
	
	// Don't do anything if the accent color is empty or the default.
	if ( empty( $accent_color ) || $accent_color == '#000000' )
		return;
	
		$rgb_accent_color = mega_hex2rgb( $accent_color );
	
		wp_enqueue_style( 'mega-style' );
		
		$accent_color_css = "
	
		/* Accent color */
		#access ul .current-menu-ancestor > a span:after,
		#branding #access ul li a:active span:after,
		#branding #access ul li a:hover span:after,
		#access ul li.sfHover > a span:after,
		#access ul .current-menu-item > a span:after,
		#access ul .current_page_item > a span:after,
		.lightbox-video-wrapper.lightbox-video-style-3 .play-button,
		.lightbox-video-wrapper.lightbox-video-style-2 .play-button,
		#page .infinite-scroll-button-style-3 .load-more:hover #infscr-loading div,
		.pace .pace-progress,
		#page .title-visible a.content-wrapper:hover .special-button .vc_btn3:after,
		#page .title-visible a.content-wrapper:hover .special-button .vc_btn3 span:before {
			background: {$accent_color};
		}
		#to-top.fixed:hover {
			fill: {$accent_color};
		}
		.pace .pace-progress-inner {
			box-shadow: 0 0 10px {$accent_color}, 0 0 5px {$accent_color};
		}
		.pace .pace-activity {
			border-top-color: {$accent_color};
			border-left-color: {$accent_color};
		}
		#content .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,
		#content .wpb_content_element.tabs-custom .wpb_tabs_nav li.ui-tabs-active,
		#content .wpb_content_element.tabs-custom-2 .wpb_tabs_nav li.ui-tabs-active a,
		#content .wpb_content_element.tabs-custom-3 .wpb_tabs_nav li.ui-tabs-active a,
		.woocommerce #page nav.woocommerce-pagination ul li a:hover,
		.woocommerce-page #page nav.woocommerce-pagination ul li a:hover,
		#order_review_wrapper,
		#respond input#submit,
		#content .skylab-navigation .sb-navigation-left:hover:after,
		#content .skylab-navigation .sb-navigation-right:hover:after,
		.wpcf7-submit,
		#respond input#submit:hover,
		body #page .woocommerce-cart-checkout a.button.alt,
		.woocommerce #page a.button.alt,
		.woocommerce #page button.button.alt,
		.woocommerce #page input.button.alt,
		.woocommerce #page #respond input#submit.alt,
		.woocommerce #page #content input.button.alt,
		.woocommerce-page #page a.button.alt,
		.woocommerce-page #page button.button.alt,
		.woocommerce-page #page input.button.alt,
		.woocommerce-page #page #respond input#submit.alt,
		.woocommerce-page #page #content input.button.alt,
		.woocommerce #page #respond input#submit,
		.woocommerce-page #page #respond input#submit,
		#content .testimonialsslider .flex-control-paging li a.flex-active,
		.woocommerce #page .widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce-page #page .widget_price_filter .ui-slider .ui-slider-handle,
		.lightbox-video-wrapper.lightbox-video-style-3 .play-button,
		#main .skylab .tp-bullet.selected,
		.owl-mt-theme .owl-dots .owl-dot.active span,
		#content .infinite-scroll-button-style-3 .load-more:hover span,
		.owl-carousel.nav-style-2 .owl-nav .owl-next:hover,
		.owl-carousel.nav-style-2 .owl-nav .owl-prev:hover,
		#content .style-4 .social-links .social:hover,
		.lightbox-video-wrapper.lightbox-video-style-2 .play-button,
		.nav-menu ul li ul,
		#page .ubermenu-skin-none .ubermenu-item .ubermenu-submenu-type-mega,
		#page .ubermenu-skin-none .ubermenu-item .ubermenu-submenu-drop,
		.portfolio-style-6 .portfolio-link {
			border-color: {$accent_color};
		}
		#main .skylab .tp-bullet.selected {
			border-color: {$accent_color} !important;
		}
		.date-wrapper .entry-date,
		.woocommerce #page .quantity .plus:hover,
		.woocommerce .quantity .minus:hover,
		.woocommerce #page #content .quantity .plus:hover,
		.woocommerce #page #content .quantity .minus:hover,
		.woocommerce-page #page .quantity .plus:hover,
		.woocommerce-page #page .quantity .minus:hover,
		.woocommerce-page #page #content .quantity .plus:hover,
		.woocommerce-page #page #content .quantity .minus:hover,
		.woocommerce #page .widget_price_filter .price_slider_wrapper .ui-widget-content,
		.woocommerce-page #page .widget_price_filter .price_slider_wrapper .ui-widget-content,
		#respond input#submit:hover,
		.wpcf7-submit:hover,
		body #page .woocommerce-cart-checkout a.button.alt:hover,
		.woocommerce #page a.button.alt:hover,
		.woocommerce #page button.button.alt:hover,
		.woocommerce #page input.button.alt:hover,
		.woocommerce #page #respond input#submit.alt:hover,
		.woocommerce #page #content input.button.alt:hover,
		.woocommerce-page #page a.button.alt:hover,
		.woocommerce-page #page button.button.alt:hover,
		.woocommerce-page #page input.button.alt:hover,
		.woocommerce-page #page #respond input#submit.alt:hover,
		.woocommerce-page #page #content input.button.alt:hover,
		.woocommerce #page #respond input#submit:hover,
		.woocommerce-page #page #respond input#submit:hover,
		body #page .woocommerce-cart-checkout a.button.alt,
		.marketing-tour .custom-pack-icon:after,
		.row-header-center h2:before,
		.testimonial-wrapper .custom-pack-icon:after,
		#content .testimonialsslider .flex-control-paging li a.flex-active,
		.testimonial-big .testimonial-name-title-wrapper .testimonial-name:before,
		#page .woocommerce ul.products li.product h3:after,
		.teaser_grid_container .entry-meta:after,
		.horizontal-border h1:before,
		.wpcf7-submit,
		.woocommerce-page #page ul.products li.product h3:after,
		#page .woocommerce span.onsale,
		.woocommerce #page span.onsale,
		.woocommerce #page a.button.alt,
		.woocommerce #page button.button.alt,
		.woocommerce #page input.button.alt,
		.woocommerce #page #respond input#submit.alt,
		.woocommerce #page #content input.button.alt,
		.woocommerce-page #page a.button.alt,
		.woocommerce-page #page button.button.alt,
		.woocommerce-page #page input.button.alt,
		.woocommerce-page #page #respond input#submit.alt,
		.woocommerce-page #page #content input.button.alt,
		.woocommerce-page .select2-results .select2-highlighted,
		#content .full-width .marketing-tour-8:hover,
		#content .style-4 .social-links .social:hover,
		#page .infinite-scroll-button-style-2 .load-more:hover span:before,
		#page .infinite-scroll-button-style-2 .load-more:hover .load-more-button-text:after,
		#content .marketing-tour-wrapper.marketing-tour-10:hover .wpb_button_a span:before,
		#content .gallery-alternative-view-content .wpb_button_a,
		.image-carousel-alternative-style-3 .image-carousel-item:hover,
		.person.person-style-7:hover,
		.posts-style-6 .wpb_thumbnails-alternative .link_image:hover,
		#page .special-button .vc_btn3:hover span:before,
		#page .special-button-2 .vc_btn3:hover span:before,
		#page .posts-style-4 .wpb_thumbnails-alternative .link_image:hover .special-button-2 .vc_btn3 span:before,
		#page .posts-style-5 .wpb_thumbnails-alternative .link_image:hover .hentry-text-wrapper,
		.posts-style-7 .wpb_thumbnails-alternative .link_image:hover,
		#page .posts-style-8 .wpb_thumbnails-alternative .link_image:hover .special-button-2 .vc_btn3 span:before,
		#page .special-button .vc_btn3:hover:after,
		.title-visible a.content-wrapper:hover h2 span:before,
		.portfolio-style-6 .portfolio-link {
			background: {$accent_color};
		}
		.detailholder .entry-meta:after,
		#page .special .woocommerce ul.products li.product .price:before,
		#respond input#submit {
			background: {$accent_color} !important;
		}
		.gallery-alternative-style-5 .gallery-alternative-item:hover .gallery-alternative-bg {
			background: rgba(" . $rgb_accent_color[0] . ", " . $rgb_accent_color[1] . ", " . $rgb_accent_color[2] . ", .7);
		}
		#page .woocommerce form .form-row .required,
		.woocommerce #page a.button:hover,
		.woocommerce #page button.button:hover,
		.woocommerce #page input.button:hover,
		.woocommerce #page #content input.button:hover,
		.woocommerce-page #page a.button:hover,
		.woocommerce-page #page button.button:hover,
		.woocommerce-page #page input.button:hover,
		.woocommerce-page #page #content input.button:hover,
		.woocommerce #page a.button,
		.woocommerce #page button.button,
		.woocommerce #page input.button,
		.woocommerce #page #content input.button,
		.woocommerce-page #page a.button,
		.woocommerce-page #page button.button,
		.woocommerce-page #page input.button,
		.woocommerce-page #page #content input.button,
		.single-product #page div.sharedaddy h3.sd-title,
		.woocommerce #page div.product span.price,
		.woocommerce #page div.product p.price,
		.woocommerce #page #content div.product span.price,
		.woocommerce #page #content div.product p.price,
		.woocommerce-page #page div.product span.price,
		.woocommerce-page #page div.product p.price,
		.woocommerce-page #page #content div.product span.price,
		.woocommerce-page #page #content div.product p.price,
		.woocommerce #page ul.products li.product .price,
		.woocommerce-page #page ul.products li.product .price,
		.single-post .big-header-enabled .entry-header-wrapper .entry-meta a,
		#page div.sharedaddy h3.sd-title,
		.single-portfolio #page div.sharedaddy h3.sd-title,
		.require,
		.social-icons-text,
		.special-list li strong,
		#top-bar-wrapper #remove-search:hover,
		#branding .woocommerce-cart-wrapper ul li a,
		#top-bar-wrapper .woocommerce-cart-wrapper ul li a,
		#page .woocommerce ul.products li.product .price,
		#supplementary .marketing-tour .custom-pack-icon,
		.testimonialsslider .slides .testimonial-name-title-wrapper .testimonial-title,
		#content #filters a,
		.info-header [class^='icon-'],
		.info-header [class*=' icon-'],
		.below-content-entry-meta a:hover,
		.title-visible a.portfolio-data:hover h2,
		.title-visible .portfolio-data:hover,
		a,
		#wp-calendar #today,
		.comment-reply-link:hover,
		.comment-edit-link:hover,
		.comment-author a:hover,
		#site-generator a:hover,
		#site-generator .social-links .social:hover,
		.wpb_thumbnails h2 a:hover,
		.wpb_thumbnails h3 a:hover,
		.teaser_grid_container .comments-link a:hover,
		.teaser_grid_container .comments-link a:hover i:before,
		.wpb_grid.columns_count_1 .teaser_grid_container .comments-link a:hover,
		.wpb_grid.columns_count_1 footer.entry-meta a:hover,
		.columns_count_1 .entry-meta a:hover,
		#content .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon:before,
		#content .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,
		#content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:focus,
		#content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:active,
		#content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:hover,
		#content .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
		#content .wpb_content_element.tabs-custom-2 .wpb_tabs_nav li.ui-state-hover a,
		#content .wpb_content_element.tabs-custom-3 .wpb_tabs_nav li.ui-state-hover a,
		#content .wpb_tour.wpb_content_element .wpb_tabs_nav li a.ui-tabs-active,
		#content .wpb_tour.wpb_content_element .wpb_tabs_nav li a:hover,
		.person-desc-wrapper a,
		.woocommerce ul.products li.product a:hover,
		.woocommerce-page ul.products li.product a:hover,
		.woocommerce ul.products li.product a:hover h3,
		.woocommerce-page ul.products li.product a:hover h3,
		.woocommerce ul.products li.product .posted_in a:hover,
		.woocommerce-page ul.products li.product .posted_in a:hover,
		.woocommerce #page table.cart a.remove:hover,
		.woocommerce #page #content table.cart a.remove:hover,
		.woocommerce-page #page table.cart a.remove:hover,
		.woocommerce-page #page #content table.cart a.remove:hover,
		.woocommerce p.stars a.star-1:hover:after,
		.woocommerce p.stars a.star-2:hover:after,
		.woocommerce p.stars a.star-3:hover:after,
		.woocommerce p.stars a.star-4:hover:after,
		.woocommerce p.stars a.star-5:hover:after,
		.woocommerce-page p.stars a.star-1:hover:after,
		.woocommerce-page p.stars a.star-2:hover:after,
		.woocommerce-page p.stars a.star-3:hover:after,
		.woocommerce-page p.stars a.star-4:hover:after,
		.woocommerce-page p.stars a.star-5:hover:after,
		.woocommerce #page .products .star-rating,
		.woocommerce-page #page .products .star-rating,
		.woocommerce #page .star-rating,
		.woocommerce-page #page .star-rating,
		.more-link,
		.archive footer.entry-meta .tag-links a:hover,
		.search footer.entry-meta .tag-links a:hover,
		.blog footer.entry-meta .tag-links a:hover,
		.single-post footer.entry-meta .tag-links a:hover,
		#colophon .social-links .social:hover,
		#branding #access .woocommerce-cart-wrapper ul li a,
		#content .skylab-navigation .sb-navigation-left:hover:after,
		#content .skylab-navigation .sb-navigation-right:hover:after,
		.lightbox-video-wrapper .play-button:hover i:before,
		.lightbox-video-wrapper.lightbox-video-style-3 .play-button:hover i:before,
		#content .infinite-scroll-button-style-3 .load-more:hover span:before,
		.owl-carousel.nav-style-2 .owl-nav .owl-next:hover:before,
		.owl-carousel.nav-style-2 .owl-nav .owl-prev:hover:before,
		.lightbox-video-wrapper.lightbox-video-style-2 .play-button:hover i:before,
		.person-desc-wrapper .social:hover,
		#content .infinite-scroll-button-style-3 .load-more:hover #infscr-loading:before,
		#content .style-2 .social-links .social:hover,
		#page .infinite-scroll-button-style-2 .load-more.vc_btn3.vc_btn3-color-blue.vc_btn3-style-modern,
		#content .marketing-tour-1:hover .marketing-tour .custom-pack-icon,
		.marketing-tour-wrapper.marketing-tour-10 .wpb_button_a,
		.marketing-tour-wrapper.marketing-tour-10 .wpb_button_a:hover,
		.mt-testimonials-style-1 .mt-testimonial:before,
		#content .team-slider-wrapper .wpb_content_element:before,
		.team-slider-wrapper .social:hover,
		.testimonial-single-style-1 .testimonial-single-name-title-wrapper:before,
		#content .mt-testimonials-style-8 .wpb_content_element:before,
		.testimonial-single-style-2 .testimonial-single-content:before,
		.person-style-6 .person-title,
		.mt-testimonials-style-3 .mt-testimonial:before,
		.person-style-7 .person-author,
		#page .special-button .vc_btn3,
		#page .special-button-2 .vc_btn3,
		#page .dark .special-button .vc_btn3:hover:after,
		#page .text-disabled .scroll-down-button:hover,
		.gallery-alternative-style-4 .gallery-alternative-item:hover h2:after,
		.gallery-alternative-style-5 .gallery-alternative-item:hover h2:after,
		.title-visible .entry-header h2,
		.title-visible a.content-wrapper:hover h2,
		.portfolio-style-5 .title-visible a.content-wrapper:hover h2:after,
		#content .filters a:hover {
			color: {$accent_color};
		}
		#page .infinite-scroll-button-style-2 .load-more .load-more-button-text:after,
		.marketing-tour-content-wpb-button-wrapper,
		#content .gallery-alternative-view-content .wpb_button_a,
		#page .special-button .vc_btn3:after,
		.title-visible .entry-header h2:after {
			border-color: {$accent_color};
		}
		#page .sd-social-icon .sd-content ul li[class*='share-'] a.sd-button:hover,
		#top-bar #lang_sel:hover .lang_sel_sel,
		#top-bar #lang_sel a:hover,
		.tagcloud a:hover,
		.woocommerce #page table.cart a.remove:hover,
		.woocommerce #page #content table.cart a.remove:hover,
		.woocommerce-page #page table.cart a.remove:hover,
		.woocommerce-page #page #content table.cart a.remove:hover,
		#page .woocommerce .return-to-shop a.button {
			color: {$accent_color} !important;
		}
		#top-bar #lang_sel:hover .lang_sel_sel {
			color: {$accent_color} !important;
		}";
		
		wp_add_inline_style( 'mega-style', $accent_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_accent_color_style' );

/**
 * Add a style block to the theme for the body color.
 */
function mega_print_body_color_style() {
	$body_color = ot_get_option( 'body_color' );
	
	// Don't do anything if the body color is empty or the default.
	if ( empty( $body_color ) || $body_color == '#ffffff' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$body_color_css = "
	
		/* Body color */
		body {
			background-color: {$body_color} !important;
		}
		input[type=text],
		input[type=password],
		input[type=email],
		input[type=tel],
		input[type=number],
		textarea,
		#page #nav-pagination-single a .content-wrapper,
		.tparrows.skylab a .content-wrapper,
		.post-info-wrapper {
			background: {$body_color};
		}
		#respond #submit,
		#respond #submit:hover,
		.columns_count_1 .wpb_thumbnails-alternative .more-link:hover,
		.wpcf7-submit,
		#content .wpcf7-submit:hover,
		.columns_count_1 .wpb_thumbnails-alternative .sticky .more-link,
		.post-info-button,
		#branding .nav-menu ul li li a:hover,
		#branding .nav-menu ul li li.sfHover > a,
		#branding .nav-menu ul li .current-menu-item > a,
		#branding .nav-menu ul li .current_page_item > a {
			color: {$body_color};
		}
		#page .essb_template_skylab li a:hover,
		#page .easy-social-share-button-custom-addition .essb_links .essb_link_sharebtn a .essb_icon,
		#page .easy-social-share-button-custom-addition .essb_links .essb_link_sharebtn a:focus .essb_icon,
		#page .easy-social-share-button-custom-addition .essb_links .essb_link_sharebtn a:hover .essb_icon {
			color: {$body_color} !important;
		}";
		wp_add_inline_style( 'mega-style', $body_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_body_color_style' );

/**
 * Add a style block to the theme for the primary color.
 */
function mega_print_primary_color_style() {
	$primary_color = ot_get_option( 'primary_color' );
	
	// Don't do anything if the primary color is empty or the default.
	if ( empty( $primary_color ) || $primary_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$primary_color_css = "
	
		/* Primary color */
		body,
		input,
		textarea,
		input[type=text]:focus,
		input[type=password]:focus,
		input[type=email]:focus,
		input[type=number]:focus,
		input[type=tel]:focus,
		input[type=number]:focus,
		textarea:focus,
		h1, h2, h3, h4, h5, h6,
		h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
		h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
		.entry-title,
		.entry-title a,
		#main #nav-pagination-single a,
		#main #nav-pagination-single a:hover,
		#main #nav-pagination-single .previous:before,
		#main #nav-pagination-single .next:before,
		.slick-slider-wrapper .paging-info,
		.slick-prev:before,
		.slick-next:before,
		.comment-reply-link,
		.comment-author a:hover,
		.comment-reply-link:hover,
		#respond a:hover,
		#page .entry-header-wrapper .entry-header .entry-meta .cat-links a:hover,
		#page .entry-header-wrapper .entry-header .entry-meta a:hover,
		#content .nav-pagination a,
		.dots,
		#content .nav-pagination > span,
		#content .nav-pagination a:hover,
		#content .nav-pagination .next:before,
		#content .nav-pagination .prev:before,
		.columns_count_1 .wpb_thumbnails-alternative .more-link,
		.skylab.tparrows:before,
		.wpb_thumbnails-alternative .more-link-wrapper .more-link:hover,
		#page .infinite-scroll-button-style-2 .load-more.vc_btn3.vc_btn3-style-modern,
		.entry-content .more-link,
		#page #nav-pagination-single .previous:before,
		#page #nav-pagination-single .next:before,
		#page #nav-pagination-single .title-wrapper,
		.sticky .entry-header .entry-meta .cat-links a,
		.sticky .entry-header .entry-meta .cat-links,
		.sticky .entry-header .entry-meta .entry-date-wrapper,
		.sticky .entry-header .entry-meta .comments-link,
		.sticky .entry-header .author a,
		.sticky .entry-meta .sep,
		.sticky .sep {
			color: {$primary_color};
		}
		#page .essb_template_skylab li a,
		#page .easy-social-share-button-custom .essb_links_list-drop li a {
			color: {$primary_color} !important;
		}
		input[type=text]:focus,
		input[type=password]:focus,
		input[type=email]:focus,
		input[type=number]:focus,
		input[type=tel]:focus,
		input[type=number]:focus, textarea:focus,
		#access .nav-menu ul li .sub-menu-wrapper:before {
			border-color: {$primary_color};
		}
		#respond #submit,
		#respond #submit:hover,
		.columns_count_1 .wpb_thumbnails-alternative .more-link:hover,
		.wpcf7-submit,
		#content .wpcf7-submit:hover,
		.columns_count_1 .wpb_thumbnails-alternative .sticky .more-link,
		.post-info-button,
		#page .nav-menu ul li .sub-menu-wrapper,
		#access .nav-menu ul li .sub-menu-wrapper:before {
			background: {$primary_color};
		}
		#page .essb_template_skylab li a:hover,
		#page .easy-social-share-button-custom-addition .essb_links .essb_link_sharebtn a .essb_icon,
		#page .easy-social-share-button-custom-addition .essb_links .essb_link_sharebtn a:focus .essb_icon,
		#page .easy-social-share-button-custom-addition .essb_links .essb_link_sharebtn a:hover .essb_icon {
			background: {$primary_color} !important;
		}
		.path {
			stroke: {$primary_color};
		}";
		
		wp_add_inline_style( 'mega-style', $primary_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_primary_color_style' );

/**
 * Add a style block to the theme for the secondary color.
 */
function mega_print_secondary_color_style() {
	$secondary_color = ot_get_option( 'secondary_color' );
	
	// Don't do anything if the secondary color is empty or the default.
	if ( empty( $secondary_color ) || $secondary_color == '#999999' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$secondary_color_css = "
	
		/* Secondary color */
		.entry-header .entry-meta .cat-links a,
		.entry-meta p,
		.entry-header .entry-meta .cat-links,
		.entry-header .entry-meta .entry-date-wrapper,
		.entry-header .entry-meta .comments-link,
		.entry-header .author a,
		.entry-meta .sep,
		.sep,
		.tag-links a,
		#content .tag-links a:hover,
		.commentlist li.comment .fn,
		.comment-time,
		.comment-edit-link,
		.comment-author .fn .url,
		#respond a,
		.gallery-caption,
		.load-more-wrapper,
		.entry-meta {
			color: {$secondary_color};
		}";
		
		wp_add_inline_style( 'mega-style', $secondary_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_secondary_color_style' );

/**
 * Add a style block to the theme for the third color.
 */
function mega_print_third_color_style() {
	$third_color = ot_get_option( 'third_color' );
	
	// Don't do anything if the third color is empty or the default.
	if ( empty( $third_color ) || $third_color == '#f2f2f2' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$third_color_css = "
	
		/* Third color */
		.tag-links a,
		.block-portfolio .hentry .lazy,
		.block-gallery-alternative .gallery-alternative-item .lazy,
		#content .wpb_thumbnails-fluid article .lazy,
		.wpb_single_image .lazy,
		.image-carousel-item .lazy,
		.portfolio-carousel .owl-item .lazy,
		.slick-slide .lazy,
		.owl-item .lazy,
		.person .lazy,
		.featured-image.lazy,
		.columns_count_1 .wpb_thumbnails-alternative .more-link,
		.sticky,
		#page .easy-social-share-button-custom .essb_links_list-drop,
		#page .easy-social-share-button-custom .essb_links_list-drop:before,
		#page .easy-social-share-button-custom .essb_links_list-drop:after {
			background: {$third_color};
		}
		#page .easy-social-share-button-custom .essb_links_list-drop,
		#page .easy-social-share-button-custom .essb_links_list-drop:before {
			border-color: {$third_color};
		}
		#page .essb_template_skylab li a {
			background: {$third_color} !important;
		}";
		
		wp_add_inline_style( 'mega-style', $third_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_third_color_style' );

/**
 * Add a style block to the theme for the borders color.
 */
function mega_print_borders_color_style() {
	$borders_color = ot_get_option( 'borders_color' );
	
	// Don't do anything if the borders color is empty or the default.
	if ( empty( $borders_color ) || $borders_color == '#e6e6e6' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$borders_color_css = "
	
		/* Borders color */
		input[type=text],
		input[type=password],
		input[type=email],
		input[type=tel],
		input[type=number], textarea,
		#comments-wrapper,
		.commentlist > li.comment > .comment,
		.commentlist .children li.comment > .comment,
		.mobile-menu-wrapper,
		.mobile-menu-wrapper .nav-menu .menu-item,
		#page .posts-style-9 .wpb_thumbnails-fluid article,
		.post-info-wrapper,
		.mobile-menu-wrapper .close-button,
		.nav-menu .drop-icon {
			border-color: {$borders_color};
		}";
		
		wp_add_inline_style( 'mega-style', $borders_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_borders_color_style' );

/**
 * Add a style block to the theme for the links color.
 */
function mega_print_links_color_style() {
	$links_color = ot_get_option( 'links_color' );
	
	// Don't do anything if the links color color is empty or the default.
	if ( empty( $links_color ) || $links_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$links_color_css = "
	
		/* Links color */
		a {
			color: {$links_color};
		}
		.entry-content a:before {
			background: {$links_color};
		}";
		
		wp_add_inline_style( 'mega-style', $links_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_links_color_style' );

/**
 * Add a style block to the theme for the links color - hover/active.
 */
function mega_print_links_color_hover_style() {
	$links_color_hover = ot_get_option( 'links_color_hover' );
	
	// Don't do anything if the links color - hover/active is empty or the default.
	if ( empty( $links_color_hover ) || $links_color_hover == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$links_color_hover_css = "
	
		/* Links color - hover/active */
		a:hover {
			color: {$links_color_hover};
		}
		.entry-content a:hover:after {
			background: {$links_color_hover};
		}";
		
		wp_add_inline_style( 'mega-style', $links_color_hover_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_links_color_hover_style' );

/**
 * Add a style block to the theme for the body font size.
 */
function mega_print_body_font_size_style() {
	$body_font_size = ot_get_option( 'body_font_size' );
	
	// Don't do anything if the body font size is the default.
	if ( empty( $body_font_size ) || $body_font_size == 16 )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$body_font_size_css = "
	
		/* Body Font Size */
		body,
		input,
		textarea,
		input[type=text],
		input[type=password],
		input[type=email],
		input[type=tel],
		input[type=number],
		textarea {
			font-size: {$body_font_size}px;
		}";
		
		wp_add_inline_style( 'mega-style', $body_font_size_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_body_font_size_style' );

/**
 * Add a style block to the theme for the page load progress bar color.
 */
function mega_print_page_load_progress_bar_color_style() {
	$page_load_progress_bar_color = ot_get_option( 'page_load_progress_bar_color' );
	
	// Don't do anything if the page load progress bar color is empty or the default.
	if ( empty( $page_load_progress_bar_color ) || $page_load_progress_bar_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$page_load_progress_bar_color_css = "
	
		/* Page load progress bar color */
		.pace .pace-progress {
			background: {$page_load_progress_bar_color} !important;
		}
		.pace .pace-progress-inner {
			box-shadow: 0 0 10px {$page_load_progress_bar_color}, 0 0 5px {$page_load_progress_bar_color};
		}";
		
		wp_add_inline_style( 'mega-style', $page_load_progress_bar_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_page_load_progress_bar_color_style' );

/**
 * Add a style block to the theme for the header background color.
 */
function mega_print_header_background_color_style() {
	$header_background_color = ot_get_option( 'header_background_color' );
	
	// Don't do anything if the header background color is empty or the default.
	if ( empty( $header_background_color ) || $header_background_color == '#ffffff' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$header_background_color_css = "
	
		/* Header Background Color */
		.header,
		.ghost-header,
		#megaMenu.megaMenuHorizontal ul.megaMenu > li.menu-item > ul.sub-menu.sub-menu-1,
		.mobile-menu-wrapper {
			background: {$header_background_color};
		}
		.header,
		#megaMenu.megaMenuHorizontal ul.megaMenu > li > a,
		#megaMenu.megaMenuHorizontal ul.megaMenu > li > span.um-anchoremulator {
			border-color: {$header_background_color};
		}";
		
		wp_add_inline_style( 'mega-style', $header_background_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_background_color_style' );

/**
 * Add a style block to the theme for the header height on scrolling.
 */
function mega_print_header_height_on_scrolling_style() {
	
	// Don't do anything if the header style is not fixed on scroll.
	$header_style = ot_get_option( 'header_style' );
	if ( empty( $header_style ) ) {
		$header_style = 'fixed';
	}
	if ( $header_style == 'non_fixed' || $header_style == 'fixed' )
		return;
	
	// Don't do anything if the header height on scrolling is disabled.
	$header_height_reduction_scrolling = ot_get_option( 'header_height_reduction_scrolling' );
	if ( empty( $header_height_reduction_scrolling ) ) {
		$header_height_reduction_scrolling = 'disable';
	}
	if ( $header_height_reduction_scrolling == 'disable' )
		return;
	
		$header_height_on_scrolling = ot_get_option( 'header_height_on_scrolling' );
	
		wp_enqueue_style( 'mega-style' );
		
		$header_height_on_scrolling_css = "
	
		/* Header Height on Scrolling */
		#header.ghost-header {
			height: {$header_height_on_scrolling}px;
		}";
		
		wp_add_inline_style( 'mega-style', $header_height_on_scrolling_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_height_on_scrolling_style' );

/**
 * Add a style block to the theme for the right/left padding for left/right header.
 */
function mega_print_padding_for_left_right_header_style() {
	
	// Don't do anything if the header position is not left/right.
	$header_position = ot_get_option( 'header_position' );
	if ( empty( $header_position ) ) {
		$header_position = 'top';
	}
	if ( $header_position == 'top' || $header_position == 'bottom' )
		return;
	
	// Don't do anything if the right/left padding for left/right is enabled.
	$padding_for_left_right_header = ot_get_option( 'padding_for_left_right_header' );
	if ( empty( $padding_for_left_right_header ) ) {
		$padding_for_left_right_header = 'enabled';
	}
	if ( $padding_for_left_right_header == 'enabled' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		if ( $header_position == 'left' ) {
		
		$padding_for_left_right_header_css = "
	
		/* Right/Left Padding for Left/Right Header */
		.header-position-left #header-wrapper > .vc_column-inner {
			padding-right: 0;
		}";
		
		} else if ( $header_position == 'right' ) {
			
		$padding_for_left_right_header_css = "
		
		/* Right/Left Padding for Left/Right Header */
		.header-position-right #header-wrapper > .vc_column-inner {
			padding-left: 0;
		}";
		
		}
		
		wp_add_inline_style( 'mega-style', $padding_for_left_right_header_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_padding_for_left_right_header_style' );

/**
 * Add a style block to the theme for the center content horizontally for left/right header.
 */
function mega_print_center_content_horizontally_for_left_right_header_style() {
	
	// Don't do anything if the header position is not left/right.
	$header_position = ot_get_option( 'header_position' );
	if ( empty( $header_position ) ) {
		$header_position = 'top';
	}
	if ( $header_position == 'top' || $header_position == 'bottom' )
		return;
	
	// Don't do anything if the center content horizontally for left right header is disabled.
	$center_content_horizontally_for_left_right_header = ot_get_option( 'center_content_horizontally_for_left_right_header' );
	if ( empty( $center_content_horizontally_for_left_right_header ) ) {
		$center_content_horizontally_for_left_right_header = 'disabled';
	}
	if ( $center_content_horizontally_for_left_right_header == 'disabled' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$center_content_horizontally_for_left_right_header_css = "
	
		/* Center Content Horizontally for Left/Right Header */
		.header-position-left #site-title,
		.header-position-right #site-title,
		.header-position-left .nav-menu ul,
		.header-position-right .nav-menu ul {
			text-align: center;
		}
		.header-position-left .nav-menu ul li,
		.header-position-right .nav-menu ul li {
			width: 100%;
		}
		.header-position-left #access .social-links-wrapper,
		.header-position-right #access .social-links-wrapper {
			justify-content: center;
		}";
		
		wp_add_inline_style( 'mega-style', $center_content_horizontally_for_left_right_header_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_center_content_horizontally_for_left_right_header_style' );

/**
 * Add a style block to the theme for the navigation link color.
 */
function mega_print_navigation_link_color_style() {
	$navigation_link_color = ot_get_option( 'navigation_link_color' );
	
	// Don't do anything if the navigation link color is empty or the default.
	if ( empty( $navigation_link_color ) || $navigation_link_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$navigation_link_color_css = "
	
		/* Navigation Link color */
		#megaMenu ul.megaMenu > li > a,
		#megaMenu ul.megaMenu > li > span.um-anchoremulator,
		#branding .woocommerce-cart,
		#search-header-icon i:before,
		#megaMenu ul ul.sub-menu li > a,
		#megaMenu ul li.ss-nav-menu-mega ul ul.sub-menu li > a,
		#megaMenu ul ul.sub-menu li > a,
		#megaMenu ul li.ss-nav-menu-mega ul.sub-menu-1 > li > span.um-anchoremulator,
		.header .nav-menu > ul > li > a,
		#mobile-menu-dropdown,
		#mobile-menu-dropdown i:before {
			color: {$navigation_link_color};
		}
		.header  .nav-menu ul li a span:after {
			background: {$navigation_link_color};
		}
		#site-title path {
			stroke: {$navigation_link_color};
		}";
		
		wp_add_inline_style( 'mega-style', $navigation_link_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_navigation_link_color_style' );

/**
 * Add a style block to the theme for the secondary menu in header navigation link color.
 */
function mega_print_secondary_header_menu_navigation_link_color_style() {
	$secondary_header_menu_navigation_link_color = ot_get_option( 'secondary_header_menu_navigation_link_color' );
	
	// Don't do anything if the secondary menu in header navigation link color is empty or the default.
	if ( empty( $secondary_header_menu_navigation_link_color ) || $secondary_header_menu_navigation_link_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$secondary_header_menu_navigation_link_color_css = "
	
		/* Secondary Menu in Header Navigation Link color */
		.nav-menu-secondary-header ul a {
			color: {$secondary_header_menu_navigation_link_color};
		}";
		
		wp_add_inline_style( 'mega-style', $secondary_header_menu_navigation_link_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_secondary_header_menu_navigation_link_color_style' );

/**
 * Add a style block to the theme for the navigation link color - hover/active.
 */
function mega_print_navigation_link_color_hover_style() {
	$navigation_link_color_hover = ot_get_option( 'navigation_link_color_hover' );
	
	// Don't do anything if the navigation link color - hover/active is empty or the default.
	if ( empty( $navigation_link_color_hover ) || $navigation_link_color_hover == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$navigation_link_color_hover_css = "
	
		/* Navigation Link color - Hover/Active */
		#branding .woocommerce-cart:hover,
		#branding #search-header-icon:hover i:before,
		#branding .woocommerce-cart-wrapper ul li a:hover,
		.header .nav-menu-primary-header > ul > li > a:active,
		.header .nav-menu-primary-header > ul > li > a:hover,
		.header .nav-menu-primary-header > ul > li.sfHover > a,
		.header .nav-menu-primary-header > ul > .current-menu-item > a,
		.header .nav-menu-primary-header > ul > .current_page_item > a,
		.header .nav-menu-primary-header > ul > .current-menu-ancestor > a,
		.header .access-mobile-menu-wrapper .nav-menu-primary-header ul li a:hover {
			color: {$navigation_link_color_hover};
		}
		#page .ubermenu-skin-none .ubermenu-item.ubermenu-current-menu-ancestor.ubermenu-item-level-0 > .ubermenu-target,
		#page .ubermenu-skin-none .ubermenu-item-level-0:hover > .ubermenu-target,
		#page .ubermenu-skin-none .ubermenu-item-level-0.ubermenu-active > .ubermenu-target,
		.transparent-header #header .ubermenu-skin-none .ubermenu-item-level-0:hover > .ubermenu-target,
		.transparent-header #header .ubermenu-skin-none .ubermenu-item-level-0.ubermenu-active > .ubermenu-target {
			color: {$navigation_link_color_hover};
		}
		.header .nav-menu-primary-header > ul > li > a:active span:after,
		.header .nav-menu-primary-header > ul > li > a:hover span:after,
		.header .nav-menu-primary-header > ul li.sfHover > a span:after,
		.header .nav-menu-primary-header > ul .current-menu-item > a span:after,
		.header .nav-menu-primary-header > ul .current_page_item > a span:after,
		.header .nav-menu-primary-header > ul .current-menu-parent > a span:after,
		.nav-menu .drop-icon-helper:before,
		.nav-menu .drop-icon-helper:after {
			background: {$navigation_link_color_hover};
		}
		.single-portfolio .header .nav-menu-primary-header > ul .menu-item-portfolio > a,
		.single-post .header .nav-menu-primary-header > ul .menu-item-blog > a {
			color: {$navigation_link_color_hover};
		}
		.single-portfolio .header .nav-menu-primary-header > ul .menu-item-portfolio > a span:after,
		.single-post .header .nav-menu-primary-header > ul .menu-item-blog > a span:after {
			background: {$navigation_link_color_hover};
		}";
		
		wp_add_inline_style( 'mega-style', $navigation_link_color_hover_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_navigation_link_color_hover_style' );

/**
 * Add a style block to the theme for the secondary menu in header navigation link color - hover/active.
 */
function mega_print_secondary_menu_in_header_navigation_link_color_hover_style() {
	$secondary_menu_in_header_navigation_link_color_hover = ot_get_option( 'secondary_menu_in_header_navigation_link_color_hover' );
	
	// Don't do anything if the secondary menu in header navigation link color - hover/active is empty or the default.
	if ( empty( $secondary_menu_in_header_navigation_link_color_hover ) || $secondary_menu_in_header_navigation_link_color_hover == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$secondary_menu_in_header_navigation_link_color_hover_css = "
	
		/* Secondary Menu in Header Navigation Link color - Hover/Active */
		.header .nav-menu-secondary-header > ul > li > a:active,
		.header .nav-menu-secondary-header > ul > li > a:hover,
		.header .nav-menu-secondary-header > ul > li.sfHover > a,
		.header .nav-menu-secondary-header > ul > .current-menu-item > a,
		.header .nav-menu-secondary-header > ul > .current_page_item > a,
		.header .nav-menu-secondary-header > ul > .current-menu-ancestor > a,
		.header .access-mobile-menu-wrapper .nav-menu-secondary-header ul li a:hover {
			color: {$secondary_menu_in_header_navigation_link_color_hover};
		}";
		
		wp_add_inline_style( 'mega-style', $secondary_menu_in_header_navigation_link_color_hover_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_secondary_menu_in_header_navigation_link_color_hover_style' );

/**
 * Add a style block to the theme for the header text color.
 */
function mega_print_header_text_color_style() {
	$header_text_color = ot_get_option( 'header_text_color' );
	
	// Don't do anything if the header text color is empty or the default.
	if ( empty( $header_text_color ) || $header_text_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$header_text_color_css = "
	
		/* Header Text Color */
		#page .info-header {
			color: {$header_text_color} !important;
		}";
		
		wp_add_inline_style( 'mega-style', $header_text_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_text_color_style' );

/**
 * Add a style block to the theme for the header link color.
 */
function mega_print_header_link_color_style() {
	$header_link_color = ot_get_option( 'header_link_color' );
	
	// Don't do anything if the header link color is empty or the default.
	if ( empty( $header_link_color ) || $header_link_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$header_link_color_css = "
	
		/* Header Link Color */
		#site-title a,
		#page .info-header a {
			color: {$header_link_color};
		}
		.mobile-menu-dropdown .menu-line,
		.mobile-menu-dropdown .menu-line:before,
		.mobile-menu-dropdown .menu-line:after,
		.mobile-menu-dropdown.open .menu-line:before,
		.mobile-menu-dropdown.open .menu-line:after {
			background: {$header_link_color};
		}";
		
		wp_add_inline_style( 'mega-style', $header_link_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_link_color_style' );

/**
 * Add a style block to the theme for the header link color - hover/active.
 */
function mega_print_header_link_color_hover_style() {
	$header_link_color_hover = ot_get_option( 'header_link_color_hover' );
	
	// Don't do anything if the header link color - hover/active is empty or the default.
	if ( empty( $header_link_color_hover ) || $header_link_color_hover == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$header_link_color_hover_css = "
	
		/* Header Link Color - Hover/Active */
		#site-title a,
		#page .info-header a:hover {
			color: {$header_link_color_hover};
		}";
		
		wp_add_inline_style( 'mega-style', $header_link_color_hover_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_link_color_hover_style' );

/**
 * Add a style block to the theme for the header social links color.
 */
function mega_print_header_social_links_color_style() {
	$header_social_links_color = ot_get_option( 'header_social_links_color' );
	
	// Don't do anything if the header social links color is empty or the default.
	if ( empty( $header_social_links_color ) || $header_social_links_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$social_links_style = ot_get_option( 'social_links_style' );
		if ( empty( $social_links_style ) ) {
			$social_links_style = '1';
		}
		
		if ( $social_links_style == '3' || $social_links_style == '6' ) {
		
		$header_social_links_color_css = "
	
		/* Header Social Links Color */
		#header-wrapper .social-links-style-3 .social-links .social,
		#header-wrapper .social-links-style-6 .social-links .social {
			background: {$header_social_links_color};
		}";
		
		} else {
			
		$header_social_links_color_css = "
	
		/* Header Social Links Color */
		#header-wrapper .social-links .social {
			color: {$header_social_links_color};
		}";
			
		}
		
		wp_add_inline_style( 'mega-style', $header_social_links_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_social_links_color_style' );

/**
 * Add a style block to the theme for the header social links color - hover/active.
 */
function mega_print_header_social_links_color_hover_style() {
	$header_social_links_color_hover = ot_get_option( 'header_social_links_color_hover' );
	
	// Don't do anything if the header social links color - hover/active is empty or the default.
	if ( empty( $header_social_links_color_hover ) || $header_social_links_color_hover == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$social_links_style = ot_get_option( 'social_links_style' );
		if ( empty( $social_links_style ) ) {
			$social_links_style = '1';
		}
		
		if ( $social_links_style == '3' || $social_links_style == '6' ) {
		
		$header_social_links_color_hover_css = "
	
		/* Header Social Links Color - Hover/Active */
		#header-wrapper .social-links-style-3 .social-links .social:hover,
		#header-wrapper .social-links-style-6 .social-links .social:hover {
			background: {$header_social_links_color_hover};
		}";
		
		} else {
			
		$header_social_links_color_hover_css = "
	
		/* Header Social Links Color - Hover/Active */
		#header-wrapper .social-links .social:hover {
			color: {$header_social_links_color_hover};
		}";
			
		}
		
		wp_add_inline_style( 'mega-style', $header_social_links_color_hover_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_social_links_color_hover_style' );

/**
 * Add a style block to the theme for the menu opacity on hover.
 */
function mega_print_social_links_opacity_hover_style() {
	$social_links_opacity_hover = ot_get_option( 'social_links_opacity_hover' );
	
	// Don't do anything if the social_links opacity on hover is empty.
	if ( empty( $social_links_opacity_hover ) )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$social_links_opacity_hover_css = "
	
		/* Social Links Opacity on Hover */
		.social-links-wrapper:hover .social {
			opacity: .5;
		}
		.social-links-wrapper:hover .social:hover {
			opacity: 1;
		}";
		
		wp_add_inline_style( 'mega-style', $social_links_opacity_hover_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_social_links_opacity_hover_style' );

/**
 * Add a style block to the theme for the header social links size.
 */
function mega_print_header_social_links_size_style() {
	$header_social_links_size = ot_get_option( 'header_social_links_size' );
	
	// Don't do anything if the header social links size is the default.
	if ( $header_social_links_size == 13 )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$header_social_links_size_css = "
	
		/* Header Social Links Size */
		#header-wrapper .social-icon:before {
			font-size: {$header_social_links_size}px;
		}";
		
		wp_add_inline_style( 'mega-style', $header_social_links_size_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_social_links_size_style' );

/**
 * Add a style block to the theme for the header top border.
 */
function mega_print_header_top_border_style() {
	$header_top_border = ot_get_option( 'header_top_border' );
	
	// Don't do anything if the header top border is empty or the default.
	if ( empty( $header_top_border ) )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$header_top_border_css = "
	
		/* Header Border Top */
		#header {
			border-top: 1px solid #e6e6e6;
		}";
		
		wp_add_inline_style( 'mega-style', $header_top_border_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_top_border_style' );

/**
 * Add a style block to the theme for the header top border color.
 */
function mega_print_header_top_border_color_style() {
	$header_top_border_color = ot_get_option( 'header_top_border_color' );
	
	// Don't do anything if the header top border color is empty or the default.
	if ( empty( $header_top_border_color ) || $header_top_border_color == '#e6e6e6' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$header_top_border_color_css = "
	
		/* Header Top Border Color */
		.header,
		.left-menu #header {
			border-top-color: {$header_top_border_color};
		}";
		
		wp_add_inline_style( 'mega-style', $header_top_border_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_top_border_color_style' );

/**
 * Add a style block to the theme for the header bottom border.
 */
function mega_print_header_bottom_border_style() {
	$header_bottom_border = ot_get_option( 'header_bottom_border' );
	
	// Don't do anything if the header bottom border is empty or the default.
	if ( empty( $header_bottom_border ) )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$header_bottom_border_css = "
	
		/* Header Border Bottom */
		.header,
		.ghost-header {
			border-bottom: 1px solid #e6e6e6;
		}";
		
		wp_add_inline_style( 'mega-style', $header_bottom_border_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_bottom_border_style' );

/**
 * Add a style block to the theme for the header bottom border color.
 */
function mega_print_header_bottom_border_color_style() {
	$header_bottom_border_color = ot_get_option( 'header_bottom_border_color' );
	
	// Don't do anything if the header bottom border color is empty or the default.
	if ( empty( $header_bottom_border_color ) || $header_bottom_border_color == '#e6e6e6' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$header_bottom_border_color_css = "
	
		/* Header Bottom Border Color */
		.header,
		.ghost-header {
			border-bottom-color: {$header_bottom_border_color};
		}";
		
		wp_add_inline_style( 'mega-style', $header_bottom_border_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_bottom_border_color_style' );

/**
 * Add a style block to the theme for the logo font size.
 */
function mega_print_logo_font_size_style() {
	$logo_font_size = ot_get_option( 'logo_font_size' );
	
	// Don't do anything if the logo font size is the default.
	if ( $logo_font_size == 24 )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$logo_font_size_css = "
	
		/* Logo Font Size */
		#site-title a {
			font-size: {$logo_font_size}px;
		}";
		
		wp_add_inline_style( 'mega-style', $logo_font_size_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_logo_font_size_style' );

/**
 * Add a style block to the theme for the logo text transform.
 */
function mega_print_logo_text_transform_style() {
	$logo_text_transform = ot_get_option( 'logo_text_transform' );
	
	// Don't do anything if the logo text transform is empty or the default.
	if ( empty( $logo_text_transform ) || $logo_text_transform == 'none' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$logo_text_transform_css = "
	
		/* Logo Text Transform */
		#site-title a {
			text-transform: {$logo_text_transform};
		}";
		
		wp_add_inline_style( 'mega-style', $logo_text_transform_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_logo_text_transform_style' );

/**
 * Add a style block to the theme for the logo font weight.
 */
function mega_print_logo_font_weight_style() {
	$logo_font_weight = ot_get_option( 'logo_font_weight' );
	
	// Don't do anything if the logo font weight is empty or the default.
	if ( empty( $logo_font_weight ) || $logo_font_weight == '700' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$logo_font_weight_css = "
	
		/* Logo Font Weight */
		#site-title a {
			font-weight: {$logo_font_weight};
		}";
		
		wp_add_inline_style( 'mega-style', $logo_font_weight_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_logo_font_weight_style' );

/**
 * Add a style block to the theme for the logo letter spacing.
 */
function mega_print_logo_letter_spacing_style() {
	$logo_letter_spacing = ot_get_option( 'logo_letter_spacing' );
	
	// Don't do anything if the logo letter spacing is empty or the default.
	if ( empty( $logo_letter_spacing ) || $logo_letter_spacing == '0' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$logo_letter_spacing_css = "
	
		/* Logo Letter Spacing */
		#site-title a {
			letter-spacing: {$logo_letter_spacing}px;
		}";
		
		wp_add_inline_style( 'mega-style', $logo_letter_spacing_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_logo_letter_spacing_style' );

/**
 * Add a style block to the theme for the logo font style.
 */
function mega_print_logo_font_style_style() {
	$logo_font_style = ot_get_option( 'logo_font_style' );
	
	// Don't do anything if the logo font style is empty or the default.
	if ( empty( $logo_font_style ) || $logo_font_style == 'normal' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$logo_font_weight_css = "
	
		/* Logo Font Style */
		#site-title a {
			font-style: {$logo_font_style};
		}";
		
		wp_add_inline_style( 'mega-style', $logo_font_weight_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_logo_font_style_style' );

/**
 * Add a style block to the theme for the height for svg logo.
 */
function mega_print_height_for_logo_style() {
	
	$logo = ot_get_option( 'logo' );
	if ( empty( $logo ) )
		return;
		
	// Check file type
	$id = mega_custom_get_attachment_id( $logo );
	$type =  get_post_mime_type( $id );
	$mime_type = explode('/', $type);
	if ( ! isset($mime_type['1'])) {
		$mime_type['1'] = null;
	}
	$type = $mime_type['1'];
	
	$height_for_logo = ot_get_option( 'height_for_logo' );
	if ( empty( $height_for_logo ) ) {
		$height_for_logo = 18;
	}
	
	wp_enqueue_style( 'mega-style' );
	
	$height_for_logo_css = "
	
	/* Height for Logo */
	#site-title .logo-svg,
	.sticky-header #site-title .logo-svg,
	#site-title .logo-default {
		height: {$height_for_logo}px;
		max-height: none;
	}";
	
	wp_add_inline_style( 'mega-style', $height_for_logo_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_height_for_logo_style' );

/**
 * Add a style block to the theme for the header height.
 */
function mega_print_header_height_style() {
	
	$center_logo_and_menu = ot_get_option( 'center_logo_and_menu' );
	
	$header_position = ot_get_option( 'header_position' );
	if ( empty( $header_position ) ) {
		$header_position = 'top';
	}
	$header_height = ot_get_option( 'header_height' );
	if ( empty( $header_height ) ) {
		$header_height = 64;
	}
	
	if ( empty( $center_logo_and_menu ) ) {
		
		wp_enqueue_style( 'mega-style' );
		
		if ( $header_position == 'left' || $header_position == 'right' ) {
		
		$header_height_css = "
		
		/* Header Width */
		@media (min-width: 1023px) {
			#header-wrapper {
				width: {$header_height}px;
			}
		}";
			
		} else if ( $header_position == 'bottom' ) {
			
		$header_height_css = "
	
		/* Header Height */
		#header {
			height: {$header_height}px;
		}
		#main,
		#header-wrapper .search-wrapper,
		#top-bar-wrapper .search-wrapper {
			padding-bottom: {$header_height}px;
		}";
		
		} else {
			
		$header_height_css = "
		
		/* Header Height */
		#header {
			height: {$header_height}px;
		}
		#main,
		#header-wrapper .search-wrapper,
		#top-bar-wrapper .search-wrapper {
			padding-top: {$header_height}px;
		}";
			
		}
		
		wp_add_inline_style( 'mega-style', $header_height_css );
		
	} else {
		
		wp_enqueue_style( 'mega-style' );
		
		$header_height_css = "
		
		/* Header Height */
		.center-logo-and-menu-enabled #branding {
			height: {$header_height}px;
		}";
		
		wp_add_inline_style( 'mega-style', $header_height_css );
	}
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_height_style' );

/**
 * Add a style block to the theme for the header height reduction on scrolling.
 */
function mega_print_header_height_reduction_on_scrolling_style() {
	
	// Don't do anything if the header style is disabled.
	$header_style = ot_get_option( 'header_style' );
	if ( empty( $header_style ) ) {
		$header_style = 'fixed';
	}
	if ( $header_style == 'non_fixed' )
		return;
	
	// Don't do anything if the header height reduction scrolling is disabled.
	$header_height_reduction_scrolling = ot_get_option( 'header_height_reduction_scrolling' );
	if ( empty( $header_height_reduction_scrolling ) ) {
		$header_height_reduction_scrolling = 'disable';
	}
	if ( $header_height_reduction_scrolling == 'disable' )
		return;
	// Don't do anything if the header height on scrolling is empty or the default.
	$header_height_on_scrolling = ot_get_option( 'header_height_on_scrolling' );
	if ( empty( $header_height_on_scrolling ) || $header_height_on_scrolling == 74 )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$header_height_on_scrolling_css = "
	
		/* Header Height Reduction on Scrolling */
		#header.header-height-on-scrolling {
			height: {$header_height_on_scrolling}px;
		}";
		
		wp_add_inline_style( 'mega-style', $header_height_on_scrolling_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_header_height_reduction_on_scrolling_style' );

/**
 * Add a style block to the theme for the logo position.
 */
function mega_print_logo_position_style() {
	$logo_position = ot_get_option( 'logo_position' );
	
	// Don't do anything if the logo position is empty or the default.
	if ( empty( $logo_position ) || $logo_position == 'left' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		if ( $logo_position == 'center' ) {
		
			$logo_position_css = "
		
			/* Logo Position */
			#site-title {
				float: none;
				justify-content: center;
				position: absolute;
				width: 100%;
				z-index: 900;
				
				width: auto;
				left: 50%;
				transform: translateX(-50%);
			}";
		
		} else {
			
			$logo_position_css = "
		
			/* Logo Position */
			#site-title {
				float: right;
				margin-right: 0;
				margin-left: 50px;
			}";
			
		}
		
		wp_add_inline_style( 'mega-style', $logo_position_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_logo_position_style' );

/**
 * Add a style block to the theme for the menu opacity on hover.
 */
function mega_print_menu_opacity_hover_style() {
	$menu_opacity_hover = ot_get_option( 'menu_opacity_hover' );
	
	// Don't do anything if the menu opacity on hover is empty.
	if ( empty( $menu_opacity_hover ) )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$menu_opacity_hover_css = "
	
		/* Menu Opacity on Hover */
		#branding .nav-menu > ul:hover > li > a {
			opacity: .5;
		}
		#branding .nav-menu > ul > li:hover > a {
			opacity: 1;
		}";
		
		wp_add_inline_style( 'mega-style', $menu_opacity_hover_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_menu_opacity_hover_style' );

/**
 * Add a style block to the theme for the menu position.
 */
function mega_print_menu_position_style() {
	$menu_position = ot_get_option( 'menu_position' );
	$header_position = ot_get_option( 'header_position' );
	if ( empty( $header_position ) ) {
		$header_position = 'top';
	}
	
	// Don't do anything if the menu position is empty or the default.
	if ( empty( $menu_position ) || $menu_position == 'right' )
		return;
	
	if ( ! empty( $menu_position ) && $menu_position == 'left' ) {
		$menu_position = 'left';
	} else if ( ! empty( $menu_position ) && $menu_position == 'center' ) {
		$menu_position = 'center';
	}
	
	if ( $menu_position == 'left' ) {
		
		wp_enqueue_style( 'mega-style' );
		
		$menu_position_css = "
		
		/* Menu Position */
		.nav-menu-primary-header,
		.ubermenu {
			float: left;
		}
		#access .nav-menu-primary-header > ul {
			text-align: left;
			position: relative;
		}";
		
		wp_add_inline_style( 'mega-style', $menu_position_css );
	}
	
	if ( $menu_position == 'center' ) {
		
		wp_enqueue_style( 'mega-style' );
		
		if ( $header_position == 'left' ||  $header_position == 'right' ) {
		
		$menu_position_css = "
		
		/* Menu Position */
		.header-position-left .nav-menu {
			margin-top: auto;
		}";
		
		} else {
			
		$menu_position_css = "
		
		/* Menu Position */
		#access .nav-menu-primary-header {
			margin-left: 0;
			float: none;
		}
		#access .nav-menu-primary-header > ul {
			float: none;
			text-align: center !important;
			position: absolute;
			width: 100%;
		}";
			
		}
		
		wp_add_inline_style( 'mega-style', $menu_position_css );
	}
}
add_action( 'wp_enqueue_scripts', 'mega_print_menu_position_style' );

/**
 * Add a style block to the theme for the menu font size.
 */
function mega_print_menu_font_size_style() {
	$menu_font_size = ot_get_option( 'menu_font_size' );
	
	// Don't do anything if the menu font size is the default.
	if ( $menu_font_size == 16 )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$menu_font_size_css = "
	
		/* Menu Font Size */
		.header .nav-menu-primary-header ul {
			font-size: {$menu_font_size}px;
		}";
		
		wp_add_inline_style( 'mega-style', $menu_font_size_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_menu_font_size_style' );

/**
 * Add a style block to the theme for the secondary menu in header font size.
 */
function mega_print_secondary_header_menu_font_size_style() {
	$secondary_header_menu_font_size = ot_get_option( 'secondary_header_menu_font_size' );
	
	// Don't do anything if the secondary menu in header font size is the default.
	if ( $secondary_header_menu_font_size == 16 )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$secondary_header_menu_font_size_css = "
	
		/* Secondary Menu in Header Font Size */
		.header .nav-menu-secondary-header ul {
			font-size: {$secondary_header_menu_font_size}px;
		}";
		
		wp_add_inline_style( 'mega-style', $secondary_header_menu_font_size_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_secondary_header_menu_font_size_style' );

/**
 * Add a style block to the theme for the menu text transform.
 */
function mega_print_menu_text_transform_style() {
	$menu_text_transform = ot_get_option( 'menu_text_transform' );
	
	// Don't do anything if the menu text transform is empty or the default.
	if ( empty( $menu_text_transform ) || $menu_text_transform == 'none' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$menu_text_transform_css = "
	
		/* Menu Text Transform */
		.header .nav-menu-primary-header ul {
			text-transform: {$menu_text_transform};
		}";
		
		wp_add_inline_style( 'mega-style', $menu_text_transform_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_menu_text_transform_style' );

/**
 * Add a style block to the theme for the secondary menu in header text transform.
 */
function mega_print_secondary_header_menu_text_transform_style() {
	$secondary_header_menu_text_transform = ot_get_option( 'secondary_header_menu_text_transform' );
	
	// Don't do anything if the secondary menu in header text transform is empty or the default.
	if ( empty( $secondary_header_menu_text_transform ) || $secondary_header_menu_text_transform == 'none' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$secondary_header_menu_text_transform_css = "
	
		/* Secondary Menu in Header Text Transform */
		.header .nav-menu-secondary-header ul {
			text-transform: {$secondary_header_menu_text_transform};
		}";
		
		wp_add_inline_style( 'mega-style', $secondary_header_menu_text_transform_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_secondary_header_menu_text_transform_style' );

/**
 * Add a style block to the theme for the menu font weight.
 */
function mega_print_menu_font_weight_style() {
	$menu_font_weight = ot_get_option( 'menu_font_weight' );
	
	// Don't do anything if the menu font weight is empty or the default.
	if ( empty( $menu_font_weight ) || $menu_font_weight == '400' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$menu_font_weight_css = "
	
		/* Menu Font Weight */
		.header .nav-menu-primary-header ul {
			font-weight: {$menu_font_weight};
		}";
		
		wp_add_inline_style( 'mega-style', $menu_font_weight_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_menu_font_weight_style' );

/**
 * Add a style block to the theme for the secondary menu in header font weight.
 */
function mega_print_secondary_header_menu_font_weight_style() {
	$secondary_header_menu_font_weight = ot_get_option( 'secondary_header_menu_font_weight' );
	
	// Don't do anything if the secondary menu in header font weight is empty or the default.
	if ( empty( $secondary_header_menu_font_weight ) || $secondary_header_menu_font_weight == '400' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$secondary_header_menu_font_weight_css = "
	
		/* Secondary Menu in Header Font Weight */
		.header .nav-menu-secondary-header ul {
			font-weight: {$secondary_header_menu_font_weight};
		}";
		
		wp_add_inline_style( 'mega-style', $secondary_header_menu_font_weight_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_secondary_header_menu_font_weight_style' );

/**
 * Add a style block to the theme for the menu letter spacing.
 */
function mega_print_menu_letter_spacing_style() {
	$menu_letter_spacing = ot_get_option( 'menu_letter_spacing' );
	
	// Don't do anything if the menu letter spacing is empty or the default.
	if ( empty( $menu_letter_spacing ) || $menu_letter_spacing == '0' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$menu_letter_spacing_css = "
	
		/* Menu Letter Spacing */
		.header .nav-menu-primary-header ul {
			letter-spacing: {$menu_letter_spacing}px;
		}
		.info-header .nav-menu ul {
			letter-spacing: {$menu_letter_spacing}px;
		}";
		
		wp_add_inline_style( 'mega-style', $menu_letter_spacing_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_menu_letter_spacing_style' );

/**
 * Add a style block to the theme for the secondary menu in header letter spacing.
 */
function mega_print_secondary_header_menu_letter_spacing_style() {
	$secondary_header_menu_letter_spacing = ot_get_option( 'secondary_header_menu_letter_spacing' );
	
	// Don't do anything if the secondary menu in header letter spacing is empty or the default.
	if ( empty( $secondary_header_menu_letter_spacing ) || $secondary_header_menu_letter_spacing == '0' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$secondary_header_menu_letter_spacing_css = "
	
		/* Secondary Menu in Header Letter Spacing */
		.header .nav-menu-secondary-header ul {
			letter-spacing: {$secondary_header_menu_letter_spacing}px;
		}";
		
		wp_add_inline_style( 'mega-style', $secondary_header_menu_letter_spacing_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_secondary_header_menu_letter_spacing_style' );

/**
 * Add a style block to the theme for the menu font style.
 */
function mega_print_menu_font_style_style() {
	$menu_font_style = ot_get_option( 'menu_font_style' );
	
	// Don't do anything if the menu font style is empty or the default.
	if ( empty( $menu_font_style ) || $menu_font_style == 'normal' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$menu_font_style_css = "
	
		/* Menu Font Style */
		.header .nav-menu-primary-header ul a {
			font-style: {$menu_font_style};
		}";
		
		wp_add_inline_style( 'mega-style', $menu_font_style_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_menu_font_style_style' );

/**
 * Add a style block to the theme for the secondary menu in header font style.
 */
function mega_print_secondary_header_menu_font_style_style() {
	$secondary_header_menu_font_style = ot_get_option( 'secondary_header_menu_font_style' );
	
	// Don't do anything if the secondary menu in header font style is empty or the default.
	if ( empty( $secondary_header_menu_font_style ) || $secondary_header_menu_font_style == 'normal' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$secondary_header_menu_font_style_font_style_css = "
	
		/* Secondary Menu in Header Font Style */
		.header .nav-menu-secondary-header ul {
			font-style: {$secondary_header_menu_font_style_font_style_css};
		}";
		
		wp_add_inline_style( 'mega-style', $menu_font_style_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_secondary_header_menu_font_style_style' );

/**
 * Add a style block to the theme for the menu text decoration - hover/active style.
 */
function mega_print_menu_text_decoration_hover_style() {
	$menu_text_decoration_hover = ot_get_option( 'menu_text_decoration_hover' );
	
	// Don't do anything if the menu text decoration - hover/active is empty or the default.
	if ( empty( $menu_text_decoration_hover ) || $menu_text_decoration_hover == 'underline' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$menu_text_decoration_hover_css = "
	
		/* Menu Text Decoration - Hover/Active */
		.header .nav-menu ul li a span:after {
			display: none;
		}";
		
		wp_add_inline_style( 'mega-style', $menu_text_decoration_hover_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_menu_text_decoration_hover_style' );

/**
 * Add a style block to the theme for the heading font weight.
 */
function mega_print_heading_font_weight_style() {
	$heading_font_weight = ot_get_option( 'heading_font_weight' );
	
	// Don't do anything if the heading font weight is empty or the default.
	if ( empty( $heading_font_weight ) || $heading_font_weight == '700' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$heading_font_weight_css = "
	
		/* Heading Font Weight */
		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		blockquote,
		.comment-reply-link,
		.slick-slider-wrapper .paging-info,
		#respond #submit,
		#main #nav-pagination-single a .content-wrapper,
		.tparrows.skylab a .title-wrapper,
		#page .essb_template_skylab li a .essb_network_name,
		.entry-content .more-link,
		.wpcf7-submit,
		.load-more-button-text {
			font-weight: {$heading_font_weight};
		}";
		
		wp_add_inline_style( 'mega-style', $heading_font_weight_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_heading_font_weight_style' );

/**
 * Add a style block to the theme for the links text decoration style.
 */
function mega_print_links_text_decoration_style() {
	$links_text_decoration = ot_get_option( 'links_text_decoration' );
	
	// Don't do anything if the links text decoration is empty or the default.
	if ( empty( $links_text_decoration ) || $links_text_decoration == 'underline' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$links_text_decoration_css = "
	
		/* Links Text Decoration */
		a {
			text-decoration: none;
		}
		.entry-content a:before,
		.entry-content a:after {
			display: none;
		}";
		
		wp_add_inline_style( 'mega-style', $links_text_decoration_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_links_text_decoration_style' );

/**
 * Add a style block to the theme for the links font style.
 */
function mega_print_links_font_style_style() {
	$links_font_style = ot_get_option( 'links_font_style' );
	
	// Don't do anything if the links font style is empty or the default.
	if ( empty( $links_font_style ) || $links_font_style == 'italic' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$links_font_style_css = "
	
		/* Links Font Style */
		a {
			font-style: {$links_font_style};
		}";
		
		wp_add_inline_style( 'mega-style', $links_font_style_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_links_font_style_style' );

/**
 * Add a style block to the theme for the top bar info align.
 */
function mega_print_top_bar_info_align_style() {
	$top_bar_info_align = ot_get_option( 'top_bar_info_align' );
	
	// Don't do anything if the top bar info align is empty or the default.
	if ( empty( $top_bar_info_align ) || $top_bar_info_align == 'right' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$top_bar_info_align_css = "
	
		/* Top Bar Info Align */
		#top-bar .info-header {
			float: {$top_bar_info_align};
			margin-left: 0;
		}";
		
		wp_add_inline_style( 'mega-style', $top_bar_info_align_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_top_bar_info_align_style' );

/**
 * Add a style block to the theme for the top bar background color.
 */
function mega_print_top_bar_background_color_style() {
	$top_bar_background_color = ot_get_option( 'top_bar_background_color' );
	
	// Don't do anything if the header top bar background color is empty or the default.
	if ( empty( $top_bar_background_color ) || $top_bar_background_color == '#07111f' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$top_bar_background_color_css = "
	
		/* Top Bar Background Color */
		#top-bar-wrapper,
		#top-bar #lang_sel ul ul {
			background: {$top_bar_background_color};
		}";
		
		wp_add_inline_style( 'mega-style', $top_bar_background_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_top_bar_background_color_style' );

/**
 * Add a style block to the theme for the top bar text color.
 */
function mega_print_top_bar_text_color_style() {
	$top_bar_text_color = ot_get_option( 'top_bar_text_color' );
	
	// Don't do anything if the header top bar text color is empty or the default.
	if ( empty( $top_bar_text_color ) || $top_bar_text_color == '#ffffff' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$top_bar_text_color_css = "
	
		/* Top Bar Text Color */
		#top-bar,
		#top-bar .social-links .social,
		#top-bar #search-header-icon i:before {
			color: {$top_bar_text_color};
		}";
		
		wp_add_inline_style( 'mega-style', $top_bar_text_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_top_bar_text_color_style' );

/**
 * Add a style block to the theme for the top bar link color.
 */
function mega_print_top_bar_link_color_style() {
	$top_bar_link_color = ot_get_option( 'top_bar_link_color' );
	
	// Don't do anything if the header top bar link color is empty or the default.
	if ( empty( $top_bar_link_color ) || $top_bar_link_color == '#999999' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$top_bar_link_color_css = "
	
		/* Top Bar Link Color */
		#top-bar #lang_sel a,
		#top-bar #lang_sel a:visited,
		.woocommerce-links a,
		#top-bar .info-header a,
		#top-bar .social-links .social:hover,
		#top-bar #search-header-icon:hover i:before,
		#top-bar .info-header [class^='icon-'],
		#top-bar .info-header [class*=' icon-'] {
			color: {$top_bar_link_color};
		}";
		
		wp_add_inline_style( 'mega-style', $top_bar_link_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_top_bar_link_color_style' );

/**
 * Add a style block to the theme for the top bar link color - hover/active.
 */
function mega_print_top_bar_link_color_hover_style() {
	$top_bar_link_color_hover = ot_get_option( 'top_bar_link_color_hover' );
	
	// Don't do anything if the header top bar link color - hover/active is empty or the default.
	if ( empty( $top_bar_link_color_hover ) || $top_bar_link_color_hover == '#ffffff' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$top_bar_link_color_hover_css = "
	
		/* Top Bar Link Color - Hover/Active */
		.woocommerce-links a:hover,
		#top-bar #lang_sel a:hover,
		#top-bar .social-links .social:hover,
		#top-bar a:hover,
		#top-bar .info-header a:hover,
		#top-bar #search-header-icon:hover i:before {
			color: {$top_bar_link_color_hover};
		}
		#top-bar #lang_sel:hover .lang_sel_sel {
			color: {$top_bar_link_color_hover} !important;
		}";
		
		wp_add_inline_style( 'mega-style', $top_bar_link_color_hover_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_top_bar_link_color_hover_style' );

/**
 * Add a style block to the theme for the top bar social icons color.
 */
function mega_print_top_bar_social_icons_color_style() {
	$top_bar_social_icons_color = ot_get_option( 'top_bar_social_icons_color' );
	
	// Don't do anything if the social icons color is empty or the default.
	if ( empty( $top_bar_social_icons_color ) || $top_bar_social_icons_color == '#999999' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$top_bar_social_icons_color_css = "
	
		/* Social Icons color */
		#top-bar .social-links .social {
			color: {$top_bar_social_icons_color};
		}";
		
		wp_add_inline_style( 'mega-style', $top_bar_social_icons_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_top_bar_social_icons_color_style' );

/**
 * Add a style block to the theme for the secondary menu position.
 */
function mega_print_secondary_menu_position_style() {
	$secondary_menu_position = ot_get_option( 'secondary_menu_position' );
	
	// Don't do anything if the secondary menu position is empty or the default.
	if ( empty( $secondary_menu_position ) || $secondary_menu_position == 'right' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$secondary_menu_position_css = "
	
		/* Secondary Menu Position */
		#secondary-menu-dropdown {
			float: {$secondary_menu_position};
			margin-left: 0 !important;
			margin-right: 42px !important;
		}";
		
		wp_add_inline_style( 'mega-style', $secondary_menu_position_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_secondary_menu_position_style' );

/**
 * Add a style block to the theme for the back to top button color.
 */
function mega_print_back_to_top_button_color_style() {
	$back_to_top_button_color = ot_get_option( 'back_to_top_button_color' );
	
	// Don't do anything if the back to top button color is empty or the default.
	if ( empty( $back_to_top_button_color ) || $back_to_top_button_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$back_to_top_button_color_css = "
	
		/* Back To Top Button Color */
		#to-top i {
			color: {$back_to_top_button_color};
		}";
		
		wp_add_inline_style( 'mega-style', $back_to_top_button_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_back_to_top_button_color_style' );

/**
 * Add a style block to the theme for the back to top button color - hover/active.
 */
function mega_print_back_to_top_button_color_hover_style() {
	$back_to_top_button_color_hover = ot_get_option( 'back_to_top_button_color_hover' );
	
	// Don't do anything if the back to top button color - hover/active is empty or the default.
	if ( empty( $back_to_top_button_color_hover ) || $back_to_top_button_color_hover == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$back_to_top_button_color_hover_css = "
	
		/* Back To Top Button Color - Hover/Active */
		#to-top:hover i {
			color: {$back_to_top_button_color_hover};
		}";
		
		wp_add_inline_style( 'mega-style', $back_to_top_button_color_hover_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_back_to_top_button_color_hover_style' );

/**
 * Add a style block to the theme for the footer background color.
 */
function mega_print_footer_background_color_style() {
	$footer_background_color = ot_get_option( 'footer_background_color' );
	
	// Don't do anything if the footer background color is empty or the default.
	if ( empty( $footer_background_color ) || $footer_background_color == '#ffffff' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_background_color_css = "
	
		/* Footer Background Color */
		#colophon {
			background-color: {$footer_background_color};
		}";
		
		wp_add_inline_style( 'mega-style', $footer_background_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_background_color_style' );

/**
 * Add a style block to the theme for the footer widget title color.
 */
function mega_print_footer_widget_title_color_style() {
	$footer_widget_title_color = ot_get_option( 'footer_widget_title_color' );
	
	// Don't do anything if the footer widget title color is empty or the default.
	if ( empty( $footer_widget_title_color ) || $footer_widget_title_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_widget_title_color_css = "
	
		/* Footer Widget Title Color */
		#supplementary .widget-title,
		#colophon h3 {
			color: {$footer_widget_title_color};
		}";
		
		wp_add_inline_style( 'mega-style', $footer_widget_title_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_widget_title_color_style' );

/**
 * Add a style block to the theme for the footer text color.
 */
function mega_print_footer_text_color_style() {
	$footer_text_color = ot_get_option( 'footer_text_color' );
	
	// Don't do anything if the footer text color is empty or the default.
	if ( empty($footer_text_color) || $footer_text_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_text_color_css = "
	
		/* Footer Text Color */
		#colophon .widget,
		#supplementary p,
		#supplementary .widget ul li,
		#supplementary .post-date,
		#colophon .social-links .social {
			color: {$footer_text_color};
		}";
		
		wp_add_inline_style( 'mega-style', $footer_text_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_text_color_style' );

/**
 * Add a style block to the theme for the footer text size.
 */
function mega_print_footer_text_size_style() {
	$footer_text_size = ot_get_option( 'footer_text_size' );
	
	// Don't do anything if the footer text size is empty or the default.
	if ( empty($footer_text_size) || $footer_text_size == '13' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_text_size_css = "
	
		/* Footer Text Size */
		#site-generator p {
			font-size: {$footer_text_size}px;
		}";
		
		wp_add_inline_style( 'mega-style', $footer_text_size_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_text_size_style' );

/**
 * Add a style block to the theme for the footer link color.
 */
function mega_print_footer_link_color_style() {
	$footer_link_color = ot_get_option( 'footer_link_color' );
	
	// Don't do anything if the footer link color is empty or the default.
	if ( empty($footer_link_color) || $footer_link_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_link_color_css = "

		/* Footer Link Color */
		#supplementary .widget a,
		#wp-calendar #today {
			color: {$footer_link_color};
		}";
		
		wp_add_inline_style( 'mega-style', $footer_link_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_link_color_style' );

/**
 * Add a style block to the theme for the footer link color - hover/active.
 */
function mega_print_footer_link_color_hover_style() {
	$footer_link_color_hover = ot_get_option( 'footer_link_color_hover' );
	
	// Don't do anything if the footer link color - hover/active is empty or the default.
	if ( empty($footer_link_color_hover) || $footer_link_color_hover == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_link_color_hover_css = "
	
		/* Footer Link Color - Hover/Active */
		#supplementary .widget a:hover,
		#colophon .social-links .social:hover {
			color: {$footer_link_color_hover};
		}";
		
		wp_add_inline_style( 'mega-style', $footer_link_color_hover_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_link_color_hover_style' );

/**
 * Add a style block to the theme for the footer bottom area background color.
 */
function mega_print_footer_bottom_area_background_color_style() {
	$footer_bottom_area_background_color = ot_get_option( 'footer_bottom_area_background_color' );
	
	// Don't do anything if the footer bottom area background color is empty or the default.
	if ( empty( $footer_bottom_area_background_color ) || $footer_bottom_area_background_color == '#ffffff' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_bottom_area_background_color_css = "
	
		/* Footer Bottom Area Background Color */
		#site-generator-wrapper,
		#supplementary .widget .tagcloud a {
			background-color: {$footer_bottom_area_background_color};
		}";
		
		wp_add_inline_style( 'mega-style', $footer_bottom_area_background_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_bottom_area_background_color_style' );

/**
 * Add a style block to the theme for the footer bottom area link color.
 */
function mega_print_footer_bottom_area_link_color_style() {
	$footer_bottom_area_link_color = ot_get_option( 'footer_bottom_area_link_color' );
	
	// Don't do anything if the footer bottom area link color is empty or the default.
	if ( empty($footer_bottom_area_link_color) || $footer_bottom_area_link_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_bottom_area_link_color_css = "
	
		/* Footer Bottom Area Link Color */
		#site-generator a {
			color: {$footer_bottom_area_link_color};
		}";
		
		wp_add_inline_style( 'mega-style', $footer_bottom_area_link_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_bottom_area_link_color_style' );

/**
 * Add a style block to the theme for the footer bottom area link color - hover/active.
 */
function mega_print_footer_bottom_area_link_color_hover_style() {
	$footer_bottom_area_link_color_hover = ot_get_option( 'footer_bottom_area_link_color_hover' );
	
	// Don't do anything if the footer bottom area link color - hover/active is empty or the default.
	if ( empty($footer_bottom_area_link_color_hover) || $footer_bottom_area_link_color_hover == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_bottom_area_link_color_hover_css = "
	
		/* Footer Bottom Area Link Color - Hover/Active */
		#site-generator a:hover {
			color: {$footer_bottom_area_link_color_hover};
		}";
		
		wp_add_inline_style( 'mega-style', $footer_bottom_area_link_color_hover_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_bottom_area_link_color_hover_style' );

/**
 * Add a style block to the theme for the footer bottom area text color.
 */
function mega_print_footer_bottom_area_text_color_style() {
	$footer_bottom_area_text_color = ot_get_option( 'footer_bottom_area_text_color' );
	
	// Don't do anything if the footer bottom area text color is empty or the default.
	if ( empty($footer_bottom_area_text_color) || $footer_bottom_area_text_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_bottom_area_text_color_css = "
	
		/* Footer Bottom Area Text Color */
		#subfooter-supplementary .widget {
			color: {$footer_bottom_area_text_color};
		}";
		
		wp_add_inline_style( 'mega-style', $footer_bottom_area_text_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_bottom_area_text_color_style' );

/**
 * Add a style block to the theme for the footer social links color.
 */
function mega_print_footer_social_links_color_style() {
	$footer_social_links_color = ot_get_option( 'footer_social_links_color' );
	
	// Don't do anything if the footer social links color is empty or the default.
	if ( empty($footer_social_links_color) || $footer_social_links_color == '#000000' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_social_links_color_css = "
	
		/* Footer Social Links Color */
		#colophon .social-links .social {
			color: {$footer_social_links_color};
		}
		#colophon .social-links-style-3 .social-links .social,
		#colophon .social-links-style-6 .social-links .social {
			color: #fff;
			background: {$footer_social_links_color};
		}";
		
		wp_add_inline_style( 'mega-style', $footer_social_links_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_social_links_color_style' );

/**
 * Add a style block to the theme for the footer social links size.
 */
function mega_print_footer_social_links_size_style() {
	$footer_social_links_size = ot_get_option( 'footer_social_links_size' );
	
	// Don't do anything if the footer social links size is empty or the default.
	if ( empty($footer_social_links_size) || $footer_social_links_size == '13' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_social_links_size_css = "
	
		/* Footer Social Links Size */
		#colophon .social-icon:before {
			font-size: {$footer_social_links_size}px;
		}";
		
		wp_add_inline_style( 'mega-style', $footer_social_links_size_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_social_links_size_style' );

/**
 * Add a style block to the theme for the footer bottom area top padding.
 */
function mega_print_footer_bottom_area_top_padding_style() {
	$footer_bottom_area_top_padding = ot_get_option( 'footer_bottom_area_top_padding' );
	
	// Don't do anything if the footer bottom area top padding is empty or the default.
	if ( $footer_bottom_area_top_padding == '50' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_bottom_area_top_padding_css = "
	
		/* Footer Bottom Area Top Padding */
		#site-generator {
			padding-top: {$footer_bottom_area_top_padding}px;
		}";
		
		wp_add_inline_style( 'mega-style', $footer_bottom_area_top_padding_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_bottom_area_top_padding_style' );

/**
 * Add a style block to the theme for the footer bottom area bottom padding.
 */
function mega_print_footer_bottom_area_bottom_padding_style() {
	$footer_bottom_area_bottom_padding = ot_get_option( 'footer_bottom_area_bottom_padding' );
	
	// Don't do anything if the footer bottom area bottom padding is empty or the default.
	if ( $footer_bottom_area_bottom_padding == '50' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_bottom_area_bottom_padding_css = "
	
		/* Footer Bottom Area Bottom Padding */
		#site-generator {
			padding-bottom: {$footer_bottom_area_bottom_padding}px;
		}";
		
		wp_add_inline_style( 'mega-style', $footer_bottom_area_bottom_padding_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_bottom_area_bottom_padding_style' );

/**
 * Add a style block to the theme for the footer top border.
 */
function mega_print_footer_top_border_style() {
	$footer_top_border = ot_get_option( 'footer_top_border' );
	
	// Don't do anything if the footer top border is empty.
	if ( empty( $footer_top_border ) )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_top_border_css = "
	
		/* Footer Border Top */
		#colophon {
			border-top: 1px solid #e6e6e6;
		}";
		
		wp_add_inline_style( 'mega-style', $footer_top_border_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_top_border_style' );

/**
 * Add a style block to the theme for the footer top border color.
 */
function mega_print_footer_top_border_color_style() {
	$footer_top_border_color = ot_get_option( 'footer_top_border_color' );
	
	// Don't do anything if the footer top border color is empty or the default.
	if ( empty( $footer_top_border_color ) || $footer_top_border_color == '#ffffff' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_top_border_color_css = "
	
		/* Footer Top Border Color */
		#colophon {
			border-color: {$footer_top_border_color};
		}";
		
		wp_add_inline_style( 'mega-style', $footer_top_border_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_top_border_color_style' );

/**
 * Add a style block to the theme for the footer bottom area top border.
 */
function mega_print_footer_bottom_area_top_border_style() {
	$footer_bottom_area_top_border = ot_get_option( 'footer_bottom_area_top_border' );
	
	// Don't do anything if the footer bottom area top border is empty.
	if ( empty( $footer_bottom_area_top_border ) )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_bottom_area_top_border_css = "
	
		/* Footer Bottom Area Border Top */
		#site-generator-wrapper {
			border-top: 1px solid #e6e6e6;
		}";
		
		wp_add_inline_style( 'mega-style', $footer_bottom_area_top_border_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_bottom_area_top_border_style' );

/**
 * Add a style block to the theme for the footer bottom area top border color.
 */
function mega_print_footer_bottom_area_top_border_color_style() {
	$footer_bottom_area_top_border_color = ot_get_option( 'footer_bottom_area_top_border_color' );
	
	// Don't do anything if the footer bottom area top border color is empty or the default.
	if ( empty( $footer_bottom_area_top_border_color ) || $footer_bottom_area_top_border_color == '#e6e6e6' )
		return;
	
		wp_enqueue_style( 'mega-style' );
		
		$footer_bottom_area_top_border_color_css = "
	
		/* Footer Bottom Area Top Border Color */
		#site-generator-wrapper {
			border-color: {$footer_bottom_area_top_border_color};
		}";
		
		wp_add_inline_style( 'mega-style', $footer_bottom_area_top_border_color_css );
}
add_action( 'wp_enqueue_scripts', 'mega_print_footer_bottom_area_top_border_color_style' );

/**
 * Get Attachement ID from URL.
 */
function mega_get_attachment_id( $url ) {

    $dir = wp_upload_dir();
    $dir = trailingslashit($dir['baseurl']);

    if( false === strpos( $url, $dir ) )
        return false;

    $file = basename($url);

    $query = array(
        'post_type' => 'attachment',
        'fields' => 'ids',
        'meta_query' => array(
            array(
                'value' => $file,
                'compare' => 'LIKE',
            )
        )
    );

    $query['meta_query'][0]['key'] = '_wp_attached_file';
    $ids = get_posts( $query );

    foreach( $ids as $id )
        if( $url == array_shift( wp_get_attachment_image_src($id, 'full') ) )
            return $id;

    $query['meta_query'][0]['key'] = '_wp_attachment_metadata';
    $ids = get_posts( $query );

    foreach( $ids as $id ) {

        $meta = wp_get_attachment_metadata($id);

        foreach( $meta['sizes'] as $size => $values )
            if( $values['file'] == $file && $url == array_shift( wp_get_attachment_image_src($id, $size) ) ) {
				return $id;
            }
    }

    return false;
}

/**
 * Filter Primary Typography Fields.
 */
function mega_filter_typography_fields( $array, $field_id ) {
  if ( $field_id == 'primary_typography' ) {
    $array = array(
		'font-family'
    );
  }
  
  return $array;
}
add_filter( 'ot_recognized_typography_fields', 'mega_filter_typography_fields', 10, 2 );

/**
 * Filter Menu Typography Fields.
 */
function mega_filter_menu_typography_fields( $array, $field_id ) {
  if ( $field_id == 'menu_typography' ) {
    $array = array(
		'font-family'
    );
  }
  
  return $array;
}
add_filter( 'ot_recognized_typography_fields', 'mega_filter_menu_typography_fields', 10, 2 );

/**
 * Filter Heading Typography Fields.
 */
function mega_filter_heading_typography_fields( $array, $field_id ) {
  if ( $field_id == 'heading_typography' ) {
    $array = array(
		'font-family'
    );
  }
  
  return $array;
}
add_filter( 'ot_recognized_typography_fields', 'mega_filter_heading_typography_fields', 10, 2 );

// Convert Hex Color to RGB
function mega_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; // returns an array with the rgb values
}

/**
 * Contact Form 7 Custom AJAX Loader
 */
function mega_wpcf7_ajax_loader () {
	return get_template_directory_uri() .'/images/spinner.svg';
}
add_filter( 'wpcf7_ajax_loader', 'mega_wpcf7_ajax_loader' );

/**
 * Alter the three dots gif that gets added to the submit button on AJAX forms.
 * @param string $url The URL to the three dots preloader image you want to use (default: YIKES_MC_URL . 'includes/images/loading-dots.gif' )
 */
function mega_yikes_mailchimp_three_dots( $url ) {
  return get_template_directory_uri() .'/images/spinner-light.svg';
}
add_filter( 'yikes-mailchimp-loading-dots', 'mega_yikes_mailchimp_three_dots' );

// A function that gets image ID's from URLs for OptionTree
function mega_custom_get_attachment_id( $guid ) {
  global $wpdb;

  /* nothing to find return false */
  if ( ! $guid )
    return false;

  /* get the ID */
  $id = $wpdb->get_var( $wpdb->prepare(
    "
    SELECT  p.ID
    FROM    $wpdb->posts p
    WHERE   p.guid = %s
            AND p.post_type = %s
    ",
    $guid,
    'attachment'
  ) );

  /* the ID was not found, try getting it the expensive WordPress way */
  if ( $id == 0 )
    $id = url_to_postid( $guid );

  return $id;
}

// WooCommerce redefine woocommerce_output_related_products()
add_filter( 'woocommerce_output_related_products_args', 'mega_related_products_args' );
  function mega_related_products_args( $args ) {
	$enable_carousel_slider_for_related_products_on_single_product_page = ot_get_option( 'enable_carousel_slider_for_related_products_on_single_product_page' );
    if ( ! empty( $enable_carousel_slider_for_related_products_on_single_product_page ) ) {
		$number = 9;
   } else {
		$number = 3;
   }
	  
	$args['posts_per_page'] = $number; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}

// Remove WooCommerce styles and scripts unless inside the store.
function mega_woo_scripts() {
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	global $woocommerce;
	if ( $woocommerce ) {
			
		global $post;
		if ( ( is_product() || ( ! empty( $post->post_content ) && strstr( $post->post_content, '[product_page' ) ) ) ) {
			wp_enqueue_script( 'fresco' );
			wp_enqueue_style( 'fresco', array() );
		}
		
		wp_dequeue_script('wc-single-product');
		wp_register_script( 'mega-wc-single-product', get_template_directory_uri() . '/js/single-product.js', array( 'jquery' ), false, true );
		if ( is_product() || ( ! empty( $post->post_content ) && strstr( $post->post_content, '[product_page' ) ) ) {
			wp_localize_script( 'mega-wc-single-product', 'wc_single_product_params', array( 'i18n_required_rating_text' => esc_attr__( 'Please select a rating', 'skylab' ), 'review_rating_required' => get_option( 'woocommerce_review_rating_required' ) ) );
			wp_enqueue_script( 'mega-wc-single-product' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'mega_woo_scripts', 99 );

// Search results number
function mega_change_wp_search_size($query) {
    if ( $query->is_search ) // Make sure it is a search page
        $query->query_vars['posts_per_page'] = 10;

    return $query; // Return our modified query variables
}
add_filter('pre_get_posts', 'mega_change_wp_search_size');

// WooCommerce Change the PayPal icon on the checkout page
function mega_woocommerce_paypal_icon($iconUrl) {
    return 'https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_200x51.png';
}
add_filter('woocommerce_paypal_icon', 'mega_woocommerce_paypal_icon');

// WooCommerce Add to cart Ajax for simple products
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	/* AJAX add to cart simple */
	add_action( 'wp_ajax_woocommerce_add_to_cart_simple_mega', 'mega_add_to_cart_simple_callback' );
	add_action( 'wp_ajax_nopriv_woocommerce_add_to_cart_simple_mega', 'mega_add_to_cart_simple_callback' );
	
	function mega_add_to_cart_simple_callback() {
		
		ob_start();
		
		$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
		$quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
	
		if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) ) {
			do_action( 'woocommerce_ajax_added_to_cart', $product_id );
			if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
				wc_add_to_cart_message( $product_id );
			}
	
			// Return fragments
			WC_AJAX::get_refreshed_fragments();
		} else {
			$this->json_headers();
	
			// If there was an error adding to the cart, redirect to the product page to show any errors
			$data = array(
				'error' => true,
				'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
				);
			echo json_encode( $data );
		}
		die();
	}
}

// Easy Social Share Buttons template
function mega_essb_skylab_initialze($templates) {
	$templates['1001'] = 'Skylab';
	$templates['1002'] = 'Skylab Minimal';
	return $templates;
}
add_filter( 'essb4_templates', 'mega_essb_skylab_initialze' );

function mega_essb_skylab_class($class, $template_id) {
	if ($template_id == '1001') {
		$class = 'skylab';
	} else if ($template_id == '1002') {
		$class = 'skylab-minimal';
	}
	
	return $class;
}
add_filter('essb4_templates_class', 'mega_essb_skylab_class', 10, 2);

// Change YITH add to cart button text on wishlist page
add_filter( 'yith_wcwl_add_to_cart_label', 'mega_yith_wcwl_add_to_cart_label' );
function mega_yith_wcwl_add_to_cart_label() {
	return '<span><span>'. esc_html__( 'Add to cart', 'skylab' ) .'</span></span><i></i>';
}

// Password form
function mega_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
    <p>'. esc_html__( "This content is password protected. To view it please enter your password below:", 'skylab' ) .'</p><label for="'. $label . '">' . esc_html__( "Password:", 'skylab' ) .' </label><input name="post_password" id="'. $label .'" type="password" size="20" maxlength="20" placeholder="'. esc_attr__( 'Password', 'skylab' ) .'" /><span class="submit-button-wrapper post_password"><input type="submit" name="Submit" value="' . esc_attr__( "Enter", 'skylab' ) . '" /></span></form>';
	
    return $output;
}
add_filter( 'the_password_form', 'mega_password_form' );

// Content Before, After
function mega_content_before_after($content) {
	// Single Post Tags List
    if( is_singular( 'post' ) ) {
		$after_content = '';
		
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', '' );
		if ( $tags_list ) {
			$after_content .= '<span class="tag-links">';
				$after_content .= '<span class="tag-title">'. esc_html__( 'Tags: ', 'skylab' ) .'</span>';
				$after_content .= $tags_list;
			$after_content .= '</span>';
		}
        $full_content = $content . $after_content;
		
		return $full_content;
    } else {
		return $content;
	}
}
add_filter( 'the_content', 'mega_content_before_after' );

// WPBakery Page Builder Define Post Types by Default
$vc_default_post_types_list = array(
    'page',
	'post',
    'portfolio'
);

if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
	vc_set_default_editor_post_types( $vc_default_post_types_list );
}

// WPBakery Page Builder and Slider Revolution Remove License Activation Notice
function mega_remove_license_activation_notice() {
	$output='<style>
	.vc_license-activation-notice,
	.rs-update-notice-wrap,
	.rs-dashboard #activation_dw .rs-status-red {
		display: none;
	}
	.rs-dashboard #activation_dw .rs-status-red-wrap .rs-dash-title {
		color: inherit;
	}
	</style>';
	echo $output;
}
add_action( 'admin_head', 'mega_remove_license_activation_notice' );

// Easy Social Share Buttons for WordPress Theme Integration
function mega_essb_is_in_theme() {
	return true;
}
add_filter('essb_is_theme_integrated', 'mega_essb_is_in_theme');