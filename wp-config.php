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
define('DB_NAME', 'wp_intoposts');

/** MySQL database username */
define('DB_USER', 'wpxwizenewspaper');

/** MySQL database password */
define('DB_PASSWORD', 'wpxwizenewspaper');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '9sPGbby5LWM?U%srIL)MkCF!g{kxb1zomtw>9xEJ$0).R}t9`wysz ;JbZk8D:Z?');
define('SECURE_AUTH_KEY',  ',I<5n)>#~QCsYP4yY02p;wqd0`[,3;6H!B>|dT0BwxR0]!bZFd#H-eCk~F@iS_0r');
define('LOGGED_IN_KEY',    '-cNc99/$T4#|~g6?1gF<o/vKtEPOOZ$_S53</AD+m${8~l:8FAT9X1d6|*.Z7z/H');
define('NONCE_KEY',        'oxllcrU,AQsej:Fvl.&#@N<Zff!XM]i_>4P;fkOcfUG_7M|Bj*L@QP)ip5V4Ki-Y');
define('AUTH_SALT',        'T*i=%r9[/xVv/Y21``sjyBr ca}T)o]$.IAEVO2L6+JRi5^{^#RhXU[v|9/u9 lX');
define('SECURE_AUTH_SALT', 'O3*{a<A|A~M%S*6hQ j0(>][2#gg1:i^R+_0VNEC4%ti}&ZQ[O.vS?FdI}E3Q?2[');
define('LOGGED_IN_SALT',   '5J,I<yLn|~n}6L@aqEH|yNKM&xevtG#ayrr7xr^/%Lfkm93USYV,YYDWb<a0R<EA');
define('NONCE_SALT',       'M*HPn-MS`xE+tupbtrHD#f*E8N|WKj%Dd i2pBsM7#9:ib#sDDa-C%lTBi(c`,_^');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', FALSE);
define( 'WP_MEMORY_LIMIT', '96M' );

define('WP_HOME','http://localhost/intoposts/');
define('WP_SITEURL','http://localhost/intoposts/');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

define( 'WP_AUTO_UPDATE_CORE', true );

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
