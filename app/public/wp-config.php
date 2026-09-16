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
define( 'AUTH_KEY',          ',G>(pp>vA8%_?:<8Odbm*:E`v: y?1S_Lc)&=^97:`{X1Jh5(7=?IKQ f$Cq%K/d' );
define( 'SECURE_AUTH_KEY',   '(MU1EGH!9XX-=OD(*fsQy+!;%Y>~>$7HtnyVTH;dC(3*f9*9xE54d%w^^7l*On_E' );
define( 'LOGGED_IN_KEY',     'l?ztY]dxg 8J]tPi@~$x]jk,<$dKT@v(0s??|&Z#1ig2jc5erE}zhb*nyhE]9&cQ' );
define( 'NONCE_KEY',         'k618rq|=:ss<S%SGb Tq <yDwD{lZD%oKS+_!8Aid8w9vv2Bbq`/5cU;LpP:LI98' );
define( 'AUTH_SALT',         '7lP_YY$q#Q[%?7?a%j.u% .^e8(;KeRFpIOAeCF2OvzCC<Bc-*41lW%Qu9oK%974' );
define( 'SECURE_AUTH_SALT',  'D{S*qI(?#w^uA<>z?Y]4,<L{xb#Flf:j:/P!e}}Y-l:e=yE6tXii]tH.cIK4o1&b' );
define( 'LOGGED_IN_SALT',    '1g&tj_6n~)H?Ga@,x`)R1XHR&Oiy:y_;,xMYxgeJ5,zvg1ZsxbH2>vRI[^?y%|x1' );
define( 'NONCE_SALT',        '7eO6;PFCCLLv5>pL/lKq>[CqY71@m!}D@jaa[T#gh9JM(xJ=*GX*9MBu]TWAQ&nU' );
define( 'WP_CACHE_KEY_SALT', 'UJgvKa(G& h*y(?@l?I|CbA?diPOp#{kQ=(nVf*-U>nM,]?b%hnbF%q@o}[Rp<?u' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */

define( 'WP_HOME', 'http://localhost:10004/' );
define( 'WP_SITEURL', 'http://localhost:10004/' );



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
