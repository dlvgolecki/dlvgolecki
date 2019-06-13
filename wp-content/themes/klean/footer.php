<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package klean
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	<div id="footer-sidebar" class="widget-area clear container" role="complementary">
	<?php do_action( 'before_sidebar' ); ?>
	<?php 
		if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
		<div class="footer-column col-lg-4 col-md-4 col-sm-12 col-xs-12"> <?php
			dynamic_sidebar( 'sidebar-4'); 
		?> </div> <?php	
		}
			
		if ( is_active_sidebar( 'sidebar-5' ) ) { ?>
		<div class="footer-column col-lg-4 col-md-4 col-sm-12 col-xs-12"> <?php
			dynamic_sidebar( 'sidebar-5'); 
		?> </div> <?php	
		}

		if ( is_active_sidebar( 'sidebar-6' ) ) { ?>
		<div class="footer-column col-lg-4 col-md-4 col-sm-12 col-xs-12"> <?php
			dynamic_sidebar( 'sidebar-6'); 
		?> </div> <?php	
		}
		
		?>	 		
	</div>
		<div class="site-info">
			<div class="footer-text">
				<?php echo ( get_theme_mod('klean-footer-text') == '' ) ? ('&copy; '.date('Y').' '.get_bloginfo('name').'. All Rights Reserved. ') : get_theme_mod('klean-footer-text'); ?>
			</div>
			<div class="powered-by">
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'klean' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'klean' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'klean' ), 'klean', '<a href="https://www.inkhive.com" rel="designer">InkHive</a>' ); ?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
