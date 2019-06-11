<?php
/*
 * The template for displaying all single team.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
get_header();

get_header();

// Metabox
$elston_id    = ( isset( $post ) ) ? $post->ID : 0;
$elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
$elston_id    = ( elston_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elston_id;

?>

<div class="blog-single-page">
	<div class="blog-single-page-inner">

	<?php
	if ( have_posts() ) :
		/* Start the Loop */
		while ( have_posts() ) : the_post();
			get_template_part( 'layouts/post/content', 'single' );

		endwhile;
	else :
		get_template_part( 'layouts/post/content', 'none' );
	endif; ?>

	</div><!-- Blog Div -->
	<?php
		elston_paging_nav();
		wp_reset_postdata();  // avoid errors further down the page
	?>
</div><!-- Content Area -->

<?php
get_footer();