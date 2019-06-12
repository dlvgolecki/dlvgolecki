<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $max_value, $min_value;

?>
<div class="woo-quantity">
	<div class="plus">+</div>
	<div class="minus">-</div>
	<?php 
		$min = ' ';
		$max = ' ';
		if ( $min_value ) {
			$min = 'min="' . esc_attr( $min_value ) . '" ';
		}
		if ( $max_value ) {
			$max = 'min="' . esc_attr( $max_value ) . '" ';
		}
	?>
	<input type="number" step="<?php echo esc_attr( $step ); ?>"<?php echo esc_attr( $min ); ?><?php echo esc_attr( $max ); ?>name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'norebro' ) ?>" size="4" />
</div>
