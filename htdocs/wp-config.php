<?php
/**
 * The base configurations of the WordPress.
 *
 * This file uses the external ../.env.php for the actual configurations. Please don't make sensitive changes here.
 *
 * REMEMBER: PASSWORDS, APPLICATION-CREDENTIALS OR OTHER SENSITIVE DATA SHOULD NEVER BE CHECKED INTO YOU VCS!
 * Customize the .env.php-file for each target environment separately.
 *
 * @package WordPress
 */

$docroot_dir = realpath(__DIR__);
$root_dir    = realpath(__DIR__ . '/..');
$server_url  = 'http://' . $_SERVER['SERVER_NAME'];

/**
 * Include environment configuration.
 */
require ($root_dir . '/.env.php');

/**
 * Pulls the table-prefix from .env.php.
 */
if (defined('WPC_TABLE_PREFIX')) {
    $table_prefix = WPC_TABLE_PREFIX;
} else {
    $table_prefix = 'wp_';
}

/* WP-Core location */
if (!defined('WP_HOME')) {
    define('WP_HOME', $server_url);
}
if (!defined('WP_SITEURL')) {
    define('WP_SITEURL', WP_HOME . '/wp-core');
}

/* Content Dir */
if (!defined('WP_CONTENT_DIR')) {
    define('WP_CONTENT_DIR',  $docroot_dir . '/wp-content');
}
if (!defined('WP_CONTENT_URL')) {
    define('WP_CONTENT_URL',  WP_HOME . '/wp-content');
}

/* Uploads-folder location, relative to ABSPATH */
if (!defined('UPLOADS')) {
    define('UPLOADS',  'uploads');
}

/**
 * Require Composer Autoloads.
 */
require $docroot_dir . '/wp-content/vendor/autoload.php';

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
  define('ABSPATH', $docroot_dir . '/wp-core/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/* Custom Themes directory, public URL */
if (!defined('WPC_CUSTOM_THEME_DIR')) {
    register_theme_directory($docroot_dir . '/themes');
}
