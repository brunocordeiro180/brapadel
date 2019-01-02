<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'brapa492_bp2018');

/** MySQL database username */
define('DB_USER', 'brapa492_bp2018');

/** MySQL database password */
define('DB_PASSWORD', 'pNS]985c-T');

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
define('AUTH_KEY',         'oltpgvfgpyiiadcqvbbl1qtxa5fbxroxaocqqti9ttxenkc7yrongcoz2hw5w0ap');
define('SECURE_AUTH_KEY',  'uci3lz0h76iamxad2zv0xbjcx4xcfyjzgyjz1wkeej0dciqzug926lwubio0jdkv');
define('LOGGED_IN_KEY',    'myukihbjfsmesxfguvkfvpczqmdtn4a0lbncym5ssmldmwqs4acrdcyywozlqztb');
define('NONCE_KEY',        'wpob563t7mmprxlddpobbdcgllfzj1bakshihlc0ngwioib2ht6if3ospn1ehxnr');
define('AUTH_SALT',        'addhgb5gnfmnrn1zbp9vps4sqiiggawjchqwdg2q8h3xrighs9vs33btm9a9ir8f');
define('SECURE_AUTH_SALT', '3tmisxod4tdyiv7svggn1mffw4k93grcfknbfd0j0cpq6s4ed1t9zcwyknoijeua');
define('LOGGED_IN_SALT',   '5wyze8zscl8kuldomu4taiuoc7rkfyypnkvthu4skwt8ekbhoo9cwgiov7k7sjo0');
define('NONCE_SALT',       'evzu9wv7r4b7lc7ml8mmv5mbys9faiarumayvbm5ictg5ehwhgobzo1muomujdpe');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp7v_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
