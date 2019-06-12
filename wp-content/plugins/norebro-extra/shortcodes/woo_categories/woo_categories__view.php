<?php

/**
* Visual Composer Norebro WooCommerce categories shortcode view
*/

?>
<div class="woocommerce norebro-woocommerce-sc <?php echo $css_class; ?>" 
	id="<?php echo esc_attr( $woo_categories_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>
	<div class="vc_row">
		<ul class="woo-products">

		<?php foreach ( $woo_categories as $category ) : ?>
			<li class="product-category vc_col-md-<?php echo $layout_columns_class; ?>">
				<div class="wrap">
					<img src="<?php echo esc_url( $category->image ); ?>" alt="<?php echo esc_attr( $category->title ); ?>" />
					<div class="info-wrap<?php echo $layout_class . $alignment_class; ?>">
							<div class="content-center">
								<div class="wrap">
									<?php if ( $subtitle_position == 'top' ) : ?>
									<div class="description">
										<?php echo $category->description; ?>
									</div>
									<?php endif; ?>

									<h3 class="second-title">
										<a href="<?php echo esc_url( $category->url ); ?>"><?php echo $category->title; ?></a>
									</h3>

									<?php if ( $subtitle_position == 'bottom' ) : ?>
									<div class="description">
										<?php echo $category->description; ?>
									</div>
									<?php endif; ?>
									<a href="<?php echo esc_url( $category->url ); ?>" class="shop-now btn <?php echo $button_class; ?>">
										<?php esc_html_e( 'Shop now', 'norebro-extra' ); ?>
									</a>
									<?php if ( $layout == 'boxed' ) : ?>
									<span class="plus ion-ios-plus-empty"></span>
									<?php endif; ?>
								</div>
							</div>
						</div>
				</div>
			</li>
		<?php endforeach; ?>
		
		</ul>
	</div>
</div>