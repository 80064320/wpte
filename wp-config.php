<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wpte' );

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
define( 'AUTH_KEY',         'ExGMy `w[u1@t@{=m;3(9.Z[@I9$wIOvZ8Ufi1~ep0j[zRIaM=kZ<A1`RR`tVIKo' );
define( 'SECURE_AUTH_KEY',  'qz3W-nBH[~OYU<@4Ib%W_eOo.V-$PAti*8HND74pp++TAN,Aa9}T x~/m{F%,)hb' );
define( 'LOGGED_IN_KEY',    'AQ4N_!;z~liir)OF`liI0k%:79 r7dm$CG=eRz4j!a`a/HSZzPc@56h=TNLQ:F20' );
define( 'NONCE_KEY',        '=v#{ae2av3b}gJc?wZ%BN5oI#h9I)m(]#/4MmFEb{~yZqmKM^@ht@B!uaSx9Y7$8' );
define( 'AUTH_SALT',        ',@~e&Ka<$/0KLJtyK0.ma-y<`3t!!+;)Yf+om_e@M?BJ$Xb4Amt=<Ft?-(ec%mlb' );
define( 'SECURE_AUTH_SALT', 'E*-!d%(n[v&fk$P]qG[01&F3$]U5]X-pIAN@K)!}W<!Q0y9j+FP~7n|[K},S@Dj}' );
define( 'LOGGED_IN_SALT',   'lx/!>p+F-Uw%Z~>S9|x^[}B)9T.?1+5zj(atE|}O..a#C?m=Uo~uBv;$$O6rzdq/' );
define( 'NONCE_SALT',       '7`(,D;6Tu#gU*d}Ovw?Q;K?(k_H>l`Y-g,K3?7,#OMzU!wme!!0TEc)$Xv,w!9H,' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'umejapan_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define('FS_METHOD', 'direct');


/* 尝试解决 Mac api 不稳定的问题 （只在XAMPP环境下使用）

define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST']);
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
define('WP_HTTP_BLOCK_EXTERNAL', false); // 确保允许外部连接
define('WP_PROXY_HOST', '');
define('WP_PROXY_PORT', '');
// 强制使用 IP 连接 WordPress.org API
define('WPCOM_API_HOST', 'api.wordpress.org');
define('WORDPRESS_UPDATE_SERVICE_API_URL', 'http://api.wordpress.org/');

*/