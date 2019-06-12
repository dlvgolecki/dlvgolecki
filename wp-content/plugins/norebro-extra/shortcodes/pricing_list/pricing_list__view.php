<?php

/**
* Visual Composer Norebro Pricing List shortcode view
*/

?>
<div class="norebro-menu-list-sc menu-list<?php echo $css_class; ?>"
	id="<?php echo esc_attr( $menu_list_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?>
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>
	
	<table>
		<tr>
			<td class="title">
				<?php if ( $name ): ?>
				<h4 class="title name text-left"><?php echo $name; ?></h4>
				<?php endif; ?>
			</td>
			
			<td class="line"></td>

			<td class="title">
				<h4 class="title price text-right">
					<?php if ( $regular_price && $sale_price ) : ?>
						<del><?php echo $regular_price; ?></del>
						<ins><?php echo $sale_price; ?></ins>
					<?php endif; ?>
					<?php if ( $regular_price && ! $sale_price ) : ?>
						<ins><?php echo $regular_price; ?></ins>
					<?php endif; ?>
					<?php if ( ! $regular_price && $sale_price ) : ?>
						<ins><?php echo $sale_price; ?></ins>
					<?php endif; ?>
				</h4>
			</td>
		</tr>
	</table>

	<div class="content">
		<?php if ( $mark ): ?>
		<div class="brand-bg-color new"><?php esc_html_e( 'NEW', 'norebro-extra' ); ?></div>	
		<?php endif; ?>
		<p>
			<?php if ( $indigriends ) { echo $indigriends; } ?>
		</p>
	</div>

</div>