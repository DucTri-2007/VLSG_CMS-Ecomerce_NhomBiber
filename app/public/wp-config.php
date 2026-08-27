<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          ']MO1UWHN#:m%s{|13(VKm[{TPO8~dd7]^At 5i%,d0N/f-UU{dc(HF~M&wy{J|vC' );
define( 'SECURE_AUTH_KEY',   'p_ 2DBTn[$tFz0w~s`abUyZ@5kt}Y=LWnk`5N||9)du[Z-i8XhU<*F@d+;;r={$}' );
define( 'LOGGED_IN_KEY',     ':K+h@enqNtLlwL|ADkugD[,c&7HL&p;f7Js.VxSUJ ~S#Kq*{O6X+bEHE4_i.!n2' );
define( 'NONCE_KEY',         'oRM2wJBtb6lLmv<x3>~35LoHB1m*x=qdhOE&fZTQZ}HfC2TH8CC/cj[q;j.s7f.i' );
define( 'AUTH_SALT',         '&`oT+:PVs5Eiq|vv [A-tWgsEc/VmQ5?_Fja|^<`aPGcEFMvin_4FW1U8d$$:Bfc' );
define( 'SECURE_AUTH_SALT',  '6f8kGQqtr2H)ew8iQUm1k?e-&Pud`}Q1;+}PG?A~4-Z!A!%=pjD~J3SCG7qRwb*S' );
define( 'LOGGED_IN_SALT',    'Wh0ynV]}P3)/r3LB dHV]qzm-m0cV%-9E8.qmYXN5l,]E`scQ*a-riRum[H<,gs^' );
define( 'NONCE_SALT',        'iKFbsGdkr hK5LGv.$uru6dHn0zgvy!GHP>G0xP}Pi3]q~aC-%^_B#OWrvxCQ]Mi' );
define( 'WP_CACHE_KEY_SALT', 'BM vx+r<FfI6!)E_q>^[7yma$`39PRX1-<oFZ!FqE,uYG!t3tIY>*g8r5/n$.eIl' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
