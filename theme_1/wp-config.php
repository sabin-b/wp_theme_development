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
define( 'DB_NAME', 'theme_1' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '`JU?38y6,97E)^jU|vl6}rhkj*Wt+**35XWrUK:5=c_r>we32(Jm/0jNT)rS=+Ke' );
define( 'SECURE_AUTH_KEY',  'U^NY-2kz[+XUpN)mNBlj*+-d+-24 !*]LxZNw?w5TIp:-A>X/IrIDv~85@SlOL%7' );
define( 'LOGGED_IN_KEY',    'GI+hXEZ/*EzKmGuMqJzD{>JdFYn3wvSbQv2B37]+r3w@IeS1V1`>^[.eh9#Q-KoG' );
define( 'NONCE_KEY',        '@WO$wx;)VO mP6yH}M7o0HB#E[C8RR@$!C(%}h.?.3x i+;W97,Q$lTwiFriP3y/' );
define( 'AUTH_SALT',        '8w)&<93V)i!E,1VcgvqqCQ<RyK#hD4.K>jid T@-~))6KI5M+7l$K8=AaxV?#)Mm' );
define( 'SECURE_AUTH_SALT', 'Obx_Rbjs[?.gr7TgOBPX<%E``zf**00!7)EC?C?F;VsZGf3N6SI.N[h=U+zJ=pag' );
define( 'LOGGED_IN_SALT',   '}T#q,=&4W2^8`eA-K5)#;V;N3n{K*:4k}(a+o~UM:iV/(7NM-GD9Ma-vBOtYbm<)' );
define( 'NONCE_SALT',       '516Va6V:x8T8PayOfK7uP:7}Sb^|5Z<VPS[??nMQGo}G?5T_3^&[[`W+!~4VtbPD' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'dev_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
