<?php
/**
 * The Subfooter widget areas.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if ( ! is_active_sidebar( 'sidebar-8'  )
		&& ! is_active_sidebar( 'sidebar-9' )
		&& ! is_active_sidebar( 'sidebar-10'  )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>
<div id="subfooter-supplementary-wrapper" class="clearfix">
	<div id="subfooter-supplementary" <?php mega_subfooter_sidebar_class(); ?>>
		<?php if ( is_active_sidebar( 'sidebar-8' ) ) : ?>
		<div id="fifth" class="widget-area clearfix" role="complementary">
			<?php dynamic_sidebar( 'sidebar-8' ); ?>
		</div><!-- #fifth .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-9' ) ) : ?>
		<div id="sixth" class="widget-area clearfix" role="complementary">
			<?php dynamic_sidebar( 'sidebar-9' ); ?>
		</div><!-- #sixth .widget-area -->
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'sidebar-10' ) ) : ?>
		<div id="seventh" class="widget-area clearfix" role="complementary">
			<?php dynamic_sidebar( 'sidebar-10' ); ?>
		</div><!-- #seventh .widget-area -->
		<?php endif; ?>
		
	</div><!-- #subfooter-supplementary -->
</div><!-- #subfooter-supplementary-wrapper -->