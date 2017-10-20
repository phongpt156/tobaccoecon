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
define('DB_NAME', 'tobacco');

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
define('AUTH_KEY',         'z+G5Ox}qvGce{@{)2Sd$ZK-4B33RB}E/,5qCd7z(lm)gwh`9f}P%<}SiF|>3rngM');
define('SECURE_AUTH_KEY',  'b*oX3&m=~VroiB>f0 w+s{G]{HfLr:En`jBBHe[[<qaXzGt}@FJQ*eHf[G9~v2R:');
define('LOGGED_IN_KEY',    'E{eJ4>Ky=s33TukC435#)l`gK~/pR,5dxYp/_?RLhFu3kJC1~(z]. {uW}<lrQ9J');
define('NONCE_KEY',        ',a8S70(C,cw4LBAUAfocWUOMuCqel7MN!wJ4Z|]`zS=;nVZEI!]/y,q!mRsi^v*W');
define('AUTH_SALT',        '.L#m=Lq`Y+BZ1Z8h|jK+.:j</P+_+PIK}+[lfWRk~`[>}pxL{6#:Z^#bMA:i*_L9');
define('SECURE_AUTH_SALT', 'ZW|;zaceTY`hM)~{U2~X83s0KpdM)tLg,a<ScjqSx&1S+$)-4U!moSTDBY8n?ekD');
define('LOGGED_IN_SALT',   'g=;FVf< >s1o:)E*Z`b;hf<v6U+Gy8e4 Y{&j!z4Jn/N@I~-?2hn=!D-3$g-B)QF');
define('NONCE_SALT',       'vB49FESq{p>m%B2Nac%cTCcz{j2RDs#0$Ge|&-$Mq^e#fJc6<r8)_zdx..Z+>kdn');

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
