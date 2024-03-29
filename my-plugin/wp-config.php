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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'my-plugin' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define( 'AUTH_KEY', 'S]leu`!m~`0.t] =c${r8pZ);,?roh^{W]VHD%^+MOY(a=9O8ud-1YFhtR/U_uFt' );
define( 'SECURE_AUTH_KEY', 'm6bOB e2~%9{biQkNi[eqV[^-1euxnU:o4<(J$uA19$)Mdb`o2O,We^`-uxw-6j&' );
define( 'LOGGED_IN_KEY', 'zmU3Ws6SfGSV)fA,i1^jp#V{i)d4MLTW)xD}m4ur~ox}G$#Nc{K`hpSl6h#$#PO/' );
define( 'NONCE_KEY', 'nfdd&F7s<=?t@9?[g1zup:+{odl:|;.]AU_2a;[,lqUll:em[w7.C59DLc;B9X$f' );
define( 'AUTH_SALT', 'S C)X(i/}ekzV}GM]/%5kiR3Ce1%j*4H9@P1[|Cf<Y2ZY008nZ]&{DkJ2%(;:l7/' );
define( 'SECURE_AUTH_SALT', '?~x XdRpWo~tt`y(5%t*Ufm8JmOt5%3&pAO`Tg[H`=Kt/L!G}v.3R6xeXrk6fyOq' );
define( 'LOGGED_IN_SALT', '>*A<CMQM(Wg|o:J5oGD+f*Sd9`I.}q#]a``[Y-SXMD4ziBG2JMjP<QyIUr@L0^*<' );
define( 'NONCE_SALT', '=7]z3hnFY-%%5FMCip`~rVp;?LPeW1`nbjwm aY(f5|lWy^A[&o1Y,0LsRD?M1Gj' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
