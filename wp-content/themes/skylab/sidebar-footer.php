<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?>

<?php
	if ( ! is_active_sidebar( 'sidebar-4'  )
		&& ! is_active_sidebar( 'sidebar-5' )
		&& ! is_active_sidebar( 'sidebar-6'  )
		&& ! is_active_sidebar( 'sidebar-7'  )
	)
		return;
?>
<div id="supplementary-wrapper" class="clearfix">
	<div id="supplementary" <?php mega_footer_sidebar_class(); ?>>
		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
		<div id="first" class="widget-area clearfix" role="complementary">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		</div><!-- #first .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
		<div id="second" class="widget-area clearfix" role="complementary">
			<?php dynamic_sidebar( 'sidebar-5' ); ?>
		</div><!-- #second .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
		<div id="third" class="widget-area clearfix" role="complementary">
			<?php dynamic_sidebar( 'sidebar-6' ); ?>
		</div><!-- #third .widget-area -->
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'sidebar-7' ) ) : ?>
		<div id="fourth" class="widget-area clearfix" role="complementary">
			<?php dynamic_sidebar( 'sidebar-7' ); ?>
		</div><!-- #fourth .widget-area -->
		<?php endif; ?>
	</div><!-- #supplementary -->
</div><!-- #supplementary-wrapper -->