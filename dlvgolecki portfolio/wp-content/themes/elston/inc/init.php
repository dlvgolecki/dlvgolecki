<?php
/*
 * All Elston Theme Related Functions Files are Linked here
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

/* Theme All Basic Setup */
require_once( ELSTON_FRAMEWORK . '/theme-support.php' );
require_once( ELSTON_FRAMEWORK . '/backend-functions.php' );
require_once( ELSTON_FRAMEWORK . '/frontend-functions.php' );
require_once( ELSTON_FRAMEWORK . '/enqueue-files.php' );
require_once( ELSTON_CS_FRAMEWORK . '/custom-style.php' );
require_once( ELSTON_CS_FRAMEWORK . '/config.php' );

/* Bootstrap Menu Walker */
require_once( ELSTON_FRAMEWORK . '/core/vt-mmenu/wp_hover_navwalker.php' );
require_once( ELSTON_FRAMEWORK . '/core/vt-mmenu/wp_click_navwalker.php' );

/* Install Plugins */
require_once( ELSTON_FRAMEWORK . '/plugins/notify/activation.php' );

/* Aqua Resizer */
require_once( ELSTON_FRAMEWORK . '/plugins/aq_resizer.php' );

/* Sidebars */
require_once( ELSTON_FRAMEWORK . '/core/sidebars.php' );
