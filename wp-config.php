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
define('DB_NAME', ( getenv('ProjectNami.DBName') ? getenv('ProjectNami.DBName') : 'wpNamiTest'));

/** MySQL database username */
define('DB_USER', ( getenv('ProjectNami.DBUser') ? getenv('ProjectNami.DBUser') : 'sa'));

/** MySQL database password */
define('DB_PASSWORD', ( getenv('ProjectNami.DBPass') ? getenv('ProjectNami.DBPass') : 'adminadmin'));

/** MySQL hostname */
define('DB_HOST', ( getenv('ProjectNami.DBHost') ? getenv('ProjectNami.DBHost') : 'PHUTT-PC\\MSSQLSERVER3'));

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
define('AUTH_KEY',         '>rWLVv]o||cm&1:g]Fzc|tDTrr^-R&C54xAC8#%A%RUL))TfB2}c-Z{%<v!R{;ps');
define('SECURE_AUTH_KEY',  '-t{/.>bZNhF*B36{VH?*j@dU,_}(~N/i$) t $<MDwFb()yr4B!U:EnR=N)mh&uR');
define('LOGGED_IN_KEY',    'Xw+Ef%`vj0v_T2:l_.wEC!!-(xO+tn/[#V(mx2V{cWDY$CsKZPo?n*|j,*w)[841');
define('NONCE_KEY',        ':cU0Ral$Q5uOq`aW8v;G,)5~E${CTJhi#<5_(NypR ET.2|jf^/bD-a=md=2PuqC');
define('AUTH_SALT',        'Dx/wPo+SrB*1Luh-(DfKGS]njl~qV(r;|W&Zu;<095#,ddfPso/4&0Z3z/Cb/!Vw');
define('SECURE_AUTH_SALT', ')Y3a4ub( 0niLB0l>+%8#XT=w;,o:5cfd=EfCp|$N!VD8_LlYlL!-/8N>x;??K3G');
define('LOGGED_IN_SALT',   'T)7jBV1aYDgtmEVLY0G%11gM%Q^k&f.1{ChI#Jww%}V4k+eHLGEG?f;Gf=hY/c9e');
define('NONCE_SALT',       'MV7IPoOG012 1AXDQ0=(0)`%f/<E0a4TwG9X!ukkeNJ|@IbZ|Id[CPK1}jCj ZM[');

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
