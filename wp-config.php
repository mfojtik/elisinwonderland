<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', getenv('MYSQL_DATABASE'));

/** MySQL database username */
define('DB_USER', getenv('MYSQL_USER'));

/** MySQL database password */
define('DB_PASSWORD', getenv('MYSQL_PASSWORD'));

/** MySQL hostname */
define('DB_HOST', getenv('MYSQL_SERVICE_HOST'));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '10}nw<UTcuTv2%|fq~8dzHAqQEe!KKfaqxMe!n7Ct+n#Tfh!}2PwZtEip!D{tjG*');
define('SECURE_AUTH_KEY',  'UB!Om@H^3IS}^APhz7$>v4}Wz|7-QGR{V!?5vM)AM]H O`(J<)$2K|QM/W#o$,Vq');
define('LOGGED_IN_KEY',    'Mz_L?AHEqR:Q#Fc@FUc9O-g+Y.uh`!3nl8Uk+uviW!v)T%--QpWg==JD41ng;4$D');
define('NONCE_KEY',        '{Fx5AqX4^3<|*h5(omTHsUvUu=Y-L-+uuvj+wL-sK@XlZ<M9nC/JLe(R,u,u|gV2');
define('AUTH_SALT',        'TA:[xH4 VwUrcELGZg+kGMQj1_q!G>o+2/A@__/Rs$X*.zQ|Lltl&BtI>QDpQ3i/');
define('SECURE_AUTH_SALT', ';Qs~?(p+Xi{Z[?KYG8v-<ZsASw7-]N)<znN.LPCsW&u$4F&M<Uu_Nw8jz85[6s*d');
define('LOGGED_IN_SALT',   'iDQoUrmx&adEV5zWq=#ZY= F>En6W#!^CUL:i)J{g^7]WF[2*_{:4:XO&5hGcMLv');
define('NONCE_SALT',       '&[PA9/h Y-Ua+:W[u4at&GJh9G~7l (Ay?$c-~#(mbYne.XVm|.JTvmHCUk3&[&1');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
