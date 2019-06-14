<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Neptune WP
 */

?>

	</div><!-- #content -->
</div> <!--#page-->
	<footer id="colophon" class="site-footer">
		<div class="footer-overlay"></div>
		<div class="grid-wide">
		<div class="col-3-12">
			<?php dynamic_sidebar('footer-1');?>
		</div>

		<div class="col-3-12">
			<?php dynamic_sidebar('footer-2');?>
		</div>

		<div class="col-3-12">
			<?php dynamic_sidebar('footer-3');?>
		</div>

		<div class="col-3-12">
			<?php dynamic_sidebar('footer-4');?>
		</div>
		<div class="site-info col-1-1">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'neptune-portfolio' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'neptune-portfolio' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'neptune-portfolio' ), 'Neptune Portfolio', '<a href="https://https://neptunewp.com/">Neptune WP</a>' );
			?>
		</div><!-- .site-info -->
	</div>
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>
