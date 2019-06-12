<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.2
 */
defined( 'ABSPATH' ) || exit;

global $post, $product;

?>
<div class="images">

	<?php
		if ( has_post_thumbnail() ) {
	?>
		<div class="slider">
			<ul class="slider-for">
				<?php
				$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
				$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title' => $image_title
					) );
					
				$thumbnail_id = get_post_thumbnail_id();
				$thumbnail_image_link = wp_get_attachment_image_src( $thumbnail_id, 'shop_thumbnail', true );
				
				$attachment_count   = count( $product->get_gallery_attachment_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a href="%s" itemprop="image" class="woocommerce-main-image fresco" data-fresco-group="fresco-group' . esc_attr( $gallery ) . '" data-fresco-options="thumbnail: &#39;%s&#39;, loop: true, thumbnails: &#39;vertical&#39;, overflow: true, effects: {content: { show: 150, hide: 150 },}">%s</a></li>', $image_link, $thumbnail_image_link[0], $image ), $post->ID );
				
				$attachment_ids = $product->get_gallery_attachment_ids();
				$loop = 0;
				foreach ( $attachment_ids as $attachment_id ) {

					$image_link = wp_get_attachment_url( $attachment_id );
					
					$thumbnail_image_link = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail', true );

					if ( ! $image_link )
						continue;

					$classes[] = 'image-'.$attachment_id;

					$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
					$image_class = esc_attr( implode( ' ', $classes ) );
					$image_title = esc_attr( get_the_title( $attachment_id ) );

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a href="%s" itemprop="image" class="woocommerce-main-image fresco" data-fresco-group="fresco-group' . esc_attr( $gallery ) . '" data-fresco-options="thumbnail: &#39;%s&#39;, loop: true, thumbnails: &#39;vertical&#39;, overflow: true, effects: {content: { show: 150, hide: 150 },}">%s</a></li>', $image_link, $thumbnail_image_link[0], $image ), $post->ID );

					$loop++;
				}
				?>
			</ul>
		</div>
			
		<?php
		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>
