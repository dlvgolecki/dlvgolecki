<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package klean
 */

get_header(); ?>
    <div id="primary-home" class="content-home col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h2 id="page-title"><span><?php _e("Recent Posts", 'klean') ?></span></h2>
            <main id="main" class="site-main grid-home col-lg-12 col-md-12 col-sm-12 col-xs-12" role="main">

                <?php if ( have_posts() ) : ?>

                    <?php /* Start the Loop */ ?>
                      <?php while ( have_posts() ) : the_post(); ?>

                        <?php
                        /* Include the Post-Format-specific template for the content.
                         */
                        do_action('klean_blog_layout');

                        ?>

                    <?php endwhile; ?>

                <?php else : ?>

                    <?php get_template_part( 'modules/content/content', 'none' ); ?>

                <?php endif; ?>

            </main><!-- #main -->
        <?php klean_pagination(); ?>
    </div><!-- #primary-home-->
<?php get_template_part('sidebar','left'); ?>
<?php get_template_part('sidebar','right'); ?>
<?php get_footer(); ?>
