<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package klean
 */
get_template_part('modules/header/head'); ?>


<body <?php body_class(); ?>>
	<?php get_template_part('modules/navigation/primary', 'menu'); ?>

	<div id="header-wrapper">
        <?php get_template_part('modules/header/masthead'); ?>
        <div id = "search-top">
	        <form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	            <div><input type="text" size="18" value="" name="s" id="s" />
	                <button type="submit" class="search-submit">
	                    <img src = "<?php echo get_template_directory_uri() . '/assets/images/search.png'?>" width="17px" height="17px">
	                </button>
	            </div>
            </form>
	    </div>
	    <?php get_template_part('modules/social/social', 'fa'); ?>
	</div>
	
	<?php if (is_home() ): ?>
	<div id="scroll-arrow">
		<i class="fa fa-chevron-down"></i>
	</div>
	<?php endif; ?>

<div id="page" class="hfeed site container">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'klean' ); ?></a>

	<div id="content" class="site-content container">
