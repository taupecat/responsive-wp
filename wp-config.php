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
define('DB_NAME', 'responsivewp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'CBev`MB-`YLVa4@=mO6^0(@Gi(dEoMhAc tE~`/lS%MNB_|($LPPeX/d,-e`T)2H');
define('SECURE_AUTH_KEY',  '/<1>ger.bZD7ll|<>0@-vdicm/cb[Jfq{y<T{tkP5Qo[KZ+#*^Efe2|25V3Jkg!F');
define('LOGGED_IN_KEY',    'Pxv5)<]X>+;c+h}%+AKw2N33|y1*J3K+Q*Z`4]UA|6#bG~jWmeSUN f0I183ZW V');
define('NONCE_KEY',        'LX,Jybc#%v0?aLQOoP[|MyPt,~j<U[9IDaCdVLi|?&,#Q&-#|Hgojy*:5PcB$FiZ');
define('AUTH_SALT',        'adP+;^C yxHLSkXbi2|o42YP)!7U2m5~6a^]HH@y=uZ,XOAC=R+1jaBCVve$ojB/');
define('SECURE_AUTH_SALT', '`kRJn83rv8&+zEdY0i(4:J1 tAPHIIl`]d2^gK<}f?(zQc+vX?0f| JJ.sAzd:,I');
define('LOGGED_IN_SALT',   'A@<E@ngG-1u2.4W.QDMu`5h@^+pk|pNtj1qkO/fR*{/uYbgQDFr2FUe B{h@k/XN');
define('NONCE_SALT',       ' 63:[4=sywCy8JE4.UpPY!kok|IjhZ-a@96hPsW^LqXFW}Bh/8#8/ !&,KS#-1w-');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'resp_wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
