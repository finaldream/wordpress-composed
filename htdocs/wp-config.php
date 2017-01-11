<?php
/**
 * The base configuration of WordPress.
 *
 * This file is customized by Wordpress-Composed.
 * For more information, see https://github.com/finaldream/wordpress-composed
 *
 * REMEMBER: PASSWORDS, APPLICATION-CREDENTIALS OR OTHER SENSITIVE DATA SHOULD NEVER BE CHECKED INTO YOUR VCS!
 * Please consider using environment variables.
 *
 * Constants starting with "WPC_" are meant to be read like "WP Composed", indicating that they are not part of the
 * original wordpress distribution, but introduced by the Wordpress-Composed project.
 */

/* Prepare root-locations */
define('WPC_DOCROOT_DIR', realpath(__DIR__));
define('WPC_ROOT_DIR', realpath(__DIR__ . '/..'));
define('WPC_DOCROOT_URL', 'http://' . $_SERVER['SERVER_NAME']);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', getenv('DB_NAME'));

/** MySQL database username */
define('DB_USER', getenv('DB_USER'));

/** MySQL database password */
define('DB_PASSWORD', getenv('DB_PASSWORD'));

/** MySQL hostname */
define('DB_HOST', sprintf('%s:%s', getenv('DB_HOST') ?: 'localhost', getenv('DB_PORT') ?: '3306'));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', getenv('DB_CHARSET') ?: 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 *
 * This simply configures the $table_prefix-variable in wp-config.
 *
 * Override:
 */
define('WPC_TABLE_PREFIX', 'wp_');


/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY'));
define('NONCE_KEY',        getenv('NONCE_KEY'));
define('AUTH_SALT',        getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv('NONCE_SALT'));


/* Override: WP-Core locations */
/*
define('WP_HOME', WPC_DOCROOT_URL);
define('WP_SITEURL', WPC_DOCROOT_URL . '/wp-core');
*/

/* Override: Content-Dir */
/*
define('WP_CONTENT_DIR',  WPC_DOCROOT_DIR . '/wp-content');
define('WP_CONTENT_URL',  WPC_DOCROOT_URL . '/wp-content');
*/

/* Override: Custom Uploads-folder */
/*
define('UPLOADS',  'uploads');
*/

/* Override: Custom Themes directory (Registered by the mu-plugin "custom-theme-dir") */
/*
define('WPC_CUSTOM_THEME_DIR',  WPC_DOCROOT_DIR . '/themes');
*/

/* Custom Settings */
/*
define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISABLE_WP_CRON', true);
define('DISALLOW_FILE_EDIT', true);
*/

/* Multi-site */
/*
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('PATH_CURRENT_SITE', '/wp-core');
*/

/**
 * For developers: WordPress debugging mode.
 *
 * Change WP_DEBUG to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */

/* Server Environment: 'develop', 'stage' or 'production' */
define('WP_ENV', getenv('ENV', 'develop'));

switch (WP_ENV) {
    case 'develop':
        /*
        define('SAVEQUERIES', true);
        define('WP_DEBUG', true);
        define('SCRIPT_DEBUG', true);
        */
        break;

    case 'stage':
        /*
        ini_set('display_errors', 0);
        define('WP_DEBUG_DISPLAY', false);
        define('SCRIPT_DEBUG', false);
        define('DISALLOW_FILE_MODS', true);
        */

        break;

    case 'production':
        /*
        ini_set('display_errors', 0);
        define('WP_DEBUG_DISPLAY', false);
        define('SCRIPT_DEBUG', false);
        define('DISALLOW_FILE_MODS', true);
        */
        break;
}

/* Pulls the table-prefix from .env.php. */
if (defined('WPC_TABLE_PREFIX')) {
    $table_prefix = WPC_TABLE_PREFIX;
} else {
    $table_prefix = 'wp_';
}

/* WP-Core location */
if (!defined('WP_HOME')) {
    define('WP_HOME', WPC_DOCROOT_URL);
}
if (!defined('WP_SITEURL')) {
    define('WP_SITEURL', WP_HOME . '/wp-core');
}

/* Content Dir */
if (!defined('WP_CONTENT_DIR')) {
    define('WP_CONTENT_DIR',  WPC_DOCROOT_DIR . '/wp-content');
}
if (!defined('WP_CONTENT_URL')) {
    define('WP_CONTENT_URL',  WP_HOME . '/wp-content');
}

/* MU-Plugins Dir */
if (!defined('WPMU_PLUGIN_DIR')) {
    define('WPMU_PLUGIN_DIR', WPC_DOCROOT_DIR . '/mu-plugins');
}
if (!defined('WPMU_PLUGIN_URL')) {
    define('WPMU_PLUGIN_URL', WP_HOME . '/mu-plugins');
}

/* Uploads-folder location, relative to ABSPATH */
if (!defined('UPLOADS')) {
    define('UPLOADS',  '../uploads');
}

/* That's all, stop editing! Happy blogging. */

/* Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
  define('ABSPATH', WPC_DOCROOT_DIR . '/wp-core/');
}

/* Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
