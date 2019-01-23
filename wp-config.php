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
define('DB_NAME', 'rebrand');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         ',E!d2zOAe_Bq58kiiBxN3up3cp@(J(nwIuY!]~6e@90kJ$~hmai._#/S:|= 4[V2');
define('SECURE_AUTH_KEY',  'G?lB ~4+;pe+8TI  KLjwgsB:f?d@2En#ps5XJ>npAX!Oo;]%bIS?6&F6tGuJ-$a');
define('LOGGED_IN_KEY',    'W<3@?$V8a)Znsn~Z /2IJps|Fk,TT Y:~L@10^)?FMwKlgiK`v@{el$u%^IP6%gY');
define('NONCE_KEY',        'mni5D.L[|[v+zs>t(j^|3,oh7cc8><Y=#|QJ=1-,h6,NfMTDA64G965FW#R8{`}R');
define('AUTH_SALT',        'CTxWO.-)h7U&L:VHF~u_@bHpAv>f+c9`Ia0&R1Hpd>[q0vc;8OcEbAN/x7-kB>SP');
define('SECURE_AUTH_SALT', 'kVc2?NjQ>_3K)=23%#+Wq],>u[Nj>:n>Eu9W19+,i!6<-;<J-:I.d c:8;u&qXC3');
define('LOGGED_IN_SALT',   'tq|@XGjgTZ}+n@kt{29 B,Tepv18)EkSxbU*Aj&fkk:!mq@4*?,PypF;aLkIsy/P');
define('NONCE_SALT',       '7Z{&7A~I97e_yO0., Eb+<(R5FdDa>H#V`Nouu3o5mSEA,[5MPRUA1aYTJSEh%j=');

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
