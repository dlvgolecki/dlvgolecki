<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_dlvg' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'H6GZ*o>[,eV&r^as0#fd%@9abF}Bfv_7qJJ!8wv#F}d3n_K=d?A4&)X]_/$E]9WA' );
define( 'SECURE_AUTH_KEY',  '.QUnO}CwZmT-g%s:TiSSL4rhsV-r8aVDo.39TpkrH0nFqVb/>M@{0>NgEEhq^6;)' );
define( 'LOGGED_IN_KEY',    '@?}[L^n+|8lF:V`Sqa)vk7$h`EQ$pJ%C8p3v2mzZ ![t@(nyCFIY?c~_ePfZBVA*' );
define( 'NONCE_KEY',        '6s{_; >d@bO3Vsz13wE(kckDQ iWeg8.yDb4@yG>crg39~<s>qeeA-*K|sLy[v#;' );
define( 'AUTH_SALT',        ';.,k;;wnkIk|f-DMl7,LIAjqEpY^.m&H,#+O!:3@4Fsm<pt4m1 QQ*K`9xg.-D[f' );
define( 'SECURE_AUTH_SALT', '.+Me+@wENzp_Nw&HZB^Qcx{bv`fh*2R5?)y88r},1SM<+y2Pe,I[QkUp2Mj*aD$m' );
define( 'LOGGED_IN_SALT',   '5{yd>/i[-{[H(wpYleN97)T,ZdpM8g.I2u/[2PYA}mr_ =o=mPUhWDud |i~Of};' );
define( 'NONCE_SALT',       '!+VE:e|(/+!)_:My)V>6fzjv gzmU|(x(Y_=m%[>9z^sqHta2`1tVD*Z2hwpV8VM' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
