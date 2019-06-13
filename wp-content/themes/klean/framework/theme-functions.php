<?php
/*
 * @package oxane, Copyright Rohit Tripathi, rohitink.com
 * This file contains Custom Theme Related Functions.
 */

//Import Admin Modules
require get_template_directory() . '/framework/admin_modules/register_styles.php';
require get_template_directory() . '/framework/admin_modules/register_widgets.php';
require get_template_directory() . '/framework/admin_modules/theme_setup.php';
//require get_template_directory() . '/framework/admin_modules/nav_walkers.php';
require get_template_directory() . '/framework/admin_modules/admin_styles.php';
//require get_template_directory() . '/framework/admin_modules/logo_compatibility.php';

/*
** Function to Get Theme Layout 
*/
function klean_get_blog_layout(){
    $ldir = 'framework/layouts/content';
    if (get_theme_mod('klean_blog_layout') ) :
        get_template_part( $ldir , get_theme_mod('klean_blog_layout') );
    else :
        get_template_part( $ldir ,'grid');
    endif;
}
add_action('klean_blog_layout', 'klean_get_blog_layout');
