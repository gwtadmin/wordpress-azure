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
define('DB_NAME', 'acsm_65bc0e088bccb40');

/** MySQL database username */
define('DB_USER', 'b0b5ecff8a7649');

/** MySQL database password */
define('DB_PASSWORD', 'e07e943c');

/** MySQL hostname */
define('DB_HOST', '137.116.185.53:42471');

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
define('AUTH_KEY',         '>UX$f_K9[6@p|><0]dkR|rI/`5}xH  }b.(O8+yX}ViBgp@>C-ik`T(<0.[j=eFZ');
define('SECURE_AUTH_KEY',  'R5~5LHjp731X$}HEOA1#{$@uCW7M;{,c5B9=KiX2Woi5OPpRtiW=Tfw&.7_<z:<{');
define('LOGGED_IN_KEY',    'lq~??g?mrFzck%>5*UhH%7!P58cf}znTTY=u#mrDqD((P;QCCEQ!+HQ5#UPtn^,#');
define('NONCE_KEY',        '.|f}dmaRoG<Ib*FxFUN`MCK,kDDIaZxy=kA;r@j7PMfJK7@aa6bUyD+7sPhFJ]dL');
define('AUTH_SALT',        'WXld5DX<{8kev@ydNF`_/gwe@IF#jgEf4_f]]Ri*}C3E7aF@QxJ<k:NFi}KEPJoW');
define('SECURE_AUTH_SALT', '|/zPpS}ae+&xW{j}(~)(ET=><)bm4*Tql2naXtyvir9--Gzu|}_X[]O#%-Nrt7M!');
define('LOGGED_IN_SALT',   '@9N;s1qCRfM|J nB)^`V&SajY9;R1R]w|z5_3  t;w][+fs|1p4Tt`5ZoB:u~3W[');
define('NONCE_SALT',       'hhVNc,bMIcM&t4}c bW-hZQ{Od0S(eh8q@0gN=p(Nxuz5gk^g*wmd0`AhA1(m9qU');

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
