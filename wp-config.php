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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'ivan');

/** MySQL database password */
define('DB_PASSWORD', 'ivan');

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
define('AUTH_KEY',         '|wE3_b3hHo8^3UW7w,KU>W3O`3tRfi|f,Bs?qZwrWT3-+@-_F0813Ia am[`Hv_6');
define('SECURE_AUTH_KEY',  'rBoZW& !v|9E!6c8aOfC@;$q[nuC(FFt|r,h~KH_<y826A%b6dkawWZM]r`-dCQ?');
define('LOGGED_IN_KEY',    '^[I~1lK%3J@#^%{/G&vV)tVPzEj;~1]6X(_y%gNnNIu6MzW:jYexFd=^2yI}^?< ');
define('NONCE_KEY',        'N,HsmL,~IJ@Y6S~hPk,LGU0i:a$97`2P3k|L7<mp)}9RsDrXb}:Uq7P$x&`t9[To');
define('AUTH_SALT',        ']72c)Sn2fBct>7pb+q(630>;:zDZ!`{)k(.~^< !%-7;~Ci}}MN~>w2n|7c{WXel');
define('SECURE_AUTH_SALT', '1Z^t3z6fCgX[<35?g(Ar1~T!@RNm}jkl#3rkGd;h^C:d>u42l](U*-.y-QsGu#nr');
define('LOGGED_IN_SALT',   '7%>,!BLYk9%hl&lh*-+IJ0X+E{1u5a=+<K}0rm7k&?V8D nfgZ#)q[fDOe0A%Jn/');
define('NONCE_SALT',       'L1yMlV,q*%}L]eKSX+rW;U<GD,M%=Dd:aox%gKQZbrx+xJJ`KIK+y$4NG!hvWL:H');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
