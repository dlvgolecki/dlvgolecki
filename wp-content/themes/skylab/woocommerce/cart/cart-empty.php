<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

?>

<div class="cart-empty-wrapper">
<h2 class="cart-empty"><?php esc_html_e( 'Your cart is currently empty.', 'skylab' ) ?></h2>

<?php
/**
 * @hooked wc_empty_cart_message - 10
 */
do_action( 'woocommerce_cart_is_empty' );
?>

<a href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) ); ?>"><?php esc_html_e( 'Start shopping', 'skylab' ) ?></a>
</div>