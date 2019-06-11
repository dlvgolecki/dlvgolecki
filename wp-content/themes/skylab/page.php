<?php
/**
 * The template for displaying pages
 *
 */

get_header(); ?>

	<div id="main-wrapper" class="clearfix">
	<div class="vc_column-inner">
	<div id="main" class="clearfix">
	<div id="main-content" class="clearfix">
		
		<div id="primary">
			<div id="content" role="main">
				<div class="entry-header-wrapper">
					<header class="entry-header clearfix">
						<h1 class="entry-title"><?php echo the_title();?></h1>
					</header><!-- .entry-header -->
				</div>
				
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();
				?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content clearfix">
							<?php the_content(); ?>
							<?php wp_link_pages( array(
								'before' => '<div class="nav-pagination">',
								'after' => '</div>',
								'link_before' => '<span>',
								'link_after' => '</span>',
								) ); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->

					<?php
				// End the loop.
				endwhile;
				?>

			</div><!-- #content -->
		</div><!-- #primary -->
		
		</div><!-- #main-content -->
		
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>
		
		<?php
		$header_position = ot_get_option( 'header_position' );
		if ( empty( $header_position ) ) {
			$header_position = 'top';
		}
		if ( $header_position == 'left' || $header_position == 'right' ) {
		?>
		<?php get_footer(); ?>
		<?php } ?>
		
		</div><!-- #main -->
		</div><!-- .vc_column-inner -->
		</div><!-- #main-wrapper -->

<?php if ( $header_position == 'top' || $header_position == 'bottom' ) { ?>
<?php get_footer(); ?>
<?php } ?>