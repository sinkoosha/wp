<?php

/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the installation.

 * You don't have to use the web site, you can copy this file to "wp-config.php"

 * and fill in the values.

 *

 * This file contains the following configurations:

 *

 * * MySQL settings

 * * Secret keys

 * * Database table prefix

 * * ABSPATH

 *

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', "realhome" );


/** MySQL database username */

define( 'DB_USER', "root" );


/** MySQL database password */

define( 'DB_PASSWORD', "" );


/** MySQL hostname */

define( 'DB_HOST', "localhost" );


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

define( 'AUTH_KEY',         'GXosMn <Il-QsA96: ~a:R*UtP,9!Z-*@3(Bb&>/dwNY7h7O9pENr+YVDFz2=W#C' );

define( 'SECURE_AUTH_KEY',  'wxgPGgRJ4Z`WXh|EMf8t_:7ueM&b95h*FS~vLM;=^JnN+^r?mfT8=z:[lc9kHr0H' );

define( 'LOGGED_IN_KEY',    'H~W3-p?.`s>Xw6S3=|<@0:Wya_TvI^SM*4ba[?CrmF$-c=CrT.zA6!r:_.u%+2!.' );

define( 'NONCE_KEY',        '9NskCKdam/@1=akw^h/uInuPXs!9ihMG5x]U[qMUo.^Kn`B:5YbJFWw]Iz!;1(qE' );

define( 'AUTH_SALT',        '1_`wy|K`gFdv4n)!&C r_P$r;`B;ia`Ogl%X;x_Xfu_ORum%l`)ZNr_]pLyI?Noq' );

define( 'SECURE_AUTH_SALT', '0|+7s]7fEK]gV?78gf#unaadt[|)xP!DCLC{zHsf|$?^+u)6~:b7sEQICT[X{]DH' );

define( 'LOGGED_IN_SALT',   'XviZZ cksH</e[ZPWWhd]p~LV|{G@(-[CZ9GL[7V[NK>>Gl9$9@<US?OD4|i?h>=' );

define( 'NONCE_SALT',       '*/<#CaH}DOPX3vZd;]2VO6ZK879Ml&>Ss0``5q%&l`6YAcm-M@]!e~vuq`- }*ir' );


/**#@-*/


/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'wp_';


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

 * @link https://wordpress.org/support/article/debugging-in-wordpress/

 */

define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */




/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

