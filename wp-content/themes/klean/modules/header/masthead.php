<header id="masthead" class="site-header" role="banner">
    <div class="header-image">
    </div><!-- .header-image -->

    <div class="site-branding container">
        <?php if ( function_exists('the_custom_logo') && has_custom_logo() ) : ?>
            <div id = "logo">
                <?php the_custom_logo(); ?>
            </div>
            <div id="text-title-desc">
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            </div>
        <?php else: ?>
            <div id="text-title-desc">
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            </div>
        <?php endif; ?>
    </div><!-- .site-branding -->
</header><!-- #masthead -->