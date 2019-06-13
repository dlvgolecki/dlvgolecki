<?php
/**
 * @package klean
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header container">
		<?php the_title( '<h1 class="entry-title col-lg-9 col-md-9 col-sm-9 col-xs-9">', '</h1>' ); ?>
		<div class="entry-meta col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<?php klean_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( get_theme_mod('klean-featured-image', 'klean') && has_post_thumbnail() ) { ?>
		<div class="single-thumb">
			<?php 
				the_post_thumbnail();
			?>
		</div>
		<?php } ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'klean' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php klean_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
