<?php
/*
 * The template for portfolio category pages.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
get_header();

if (elston_is_post_type('portfolio')) {
	// Theme Options
	$portfolio_hover_style = cs_get_option('portfolio_hover_style');
	$portfolio_pagination = cs_get_option('portfolio_pagination');
	$pagination_type = cs_get_option('pagination_type');
	$more_text = cs_get_option('more_text');
	$portfolio_col = cs_get_option('portfolio_col');
}
?>

<?php if (elston_is_post_type('portfolio')) { ?>
	<!-- Portfolio Start -->
    <div class="elstn-portfolios content_ajax elstn-masonry <?php echo esc_attr($portfolio_col); ?> <?php echo esc_attr($portfolio_hover_style); ?>">
      <?php
		/* Start the Loop */
		if (have_posts()) : while (have_posts()) : the_post();
				/* Template */
				get_template_part( 'layouts/portfolio/portfolio', 'core' );
			endwhile;
		else :
			get_template_part( 'layouts/post/content', 'none' );
		endif;
		wp_reset_postdata(); ?>

	</div><!-- Portfolios End -->

	<?php
		if ($pagination_type == 'ajax') { ?>
			<div id="elston-load-portfolio-posts" class="elstn-load-more"><a href="#0"><?php echo esc_attr($more_text); ?></a></div>
			<?php
		} else { ?>
			<div class="elstn-load-more">
				<?php wp_pagenavi(); ?>
			</div>
			<?php

		}
		wp_reset_postdata();  // avoid errors further down the page
	?>

<?php } // Post Type Portfolio?>

<?php
get_footer();