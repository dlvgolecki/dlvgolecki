<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package VT_Framework
 */

?>

<div class="container text-center no-results not-found">

	<div class="row content-inner">
		<div class="col-md-8 col-md-offset-2">

		    <div class="elstn-top-title">
		      <h1><?php esc_html_e( 'Nothing Found', 'elston' ); ?></h1>
		    </div>
			<?php
			if ( is_search() ) : ?>

				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'elston' ); ?></p>
				<div class="widget_search">
					<?php
						get_search_form();
					?>
				</div>
				<?php else : ?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'elston' ); ?></p>
				<div class="widget_search">
				<?php
					get_search_form();
				?>
				</div>
				<?php endif; ?>
		</div>
	</div><!-- .page-content -->
</div><!-- .no-results --><?php
