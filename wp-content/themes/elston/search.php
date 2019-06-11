<?php
/*
 * The template for displaying search results pages.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

get_header();

// Theme Options
$blog_style = cs_get_option('blog_listing_style');
if($blog_style == 'modern'){
	$blog_version = 'version2';
	$blog_container = 'clearfix';
	$blog_col = 'content_ajax';
	$load_more_class = '';
} else {
	$blog_version = 'version1';
	$blog_container = 'container';
	$blog_col = 'content_ajax elstn-masonry col-item-3';
	$load_more_class = 'space2';
}

$pagination_type = cs_get_option('pagination_type');
$more_text = cs_get_option('more_text');
$title = get_bloginfo( 'name', 'display' );
$description = get_bloginfo( 'description', 'display' );
?>

<?php if ( have_posts() ) : ?>
<div class="elstn-blogs <?php echo esc_attr($blog_version); ?>">
	<div class="container">

	    <div class="elstn-top-title">
	      <h4><?php elston_title_area();?></h4>
	    </div>
	</div>

	<div id="container" class="<?php echo esc_attr($blog_container); ?>">

		<div class="<?php echo esc_attr($blog_col); ?>">
			<?php
			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'layouts/post/content' );
				endwhile;
			else :
				get_template_part( 'layouts/post/content', 'none' );
			endif;
			?>
		</div>

		<?php
			if ($pagination_type == 'ajax') { ?>
				<div id="elston-load-posts" class="elstn-load-more <?php echo esc_attr($load_more_class); ?>"><a href="#0"><?php echo esc_attr($more_text); ?></a></div>
				<?php
			} else { ?>
				<div class="elstn-load-more <?php echo esc_attr($load_more_class); ?>">
					<?php elston_paging_nav();?>
				</div>
				<?php
			}
			wp_reset_postdata();  // avoid errors further down the page
		?>
	</div>

</div>

<?php else :
	get_template_part( 'layouts/post/content', 'none' );
endif; ?>

<?php
get_footer();