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

/**
 * Include environment configuration.
 */
require ($root_dir . '/.env.php');

/**
 * Pulls the table-prefix from .env.php.
 */
if (defined('WP_TABLE_PREFIX')) {
    $table_prefix = WP_TABLE_PREFIX;
} else {
    $table_prefix = 'wp_';
}

/* WP-Core location */
if (!defined('WP_HOME')) {
    define('WP_HOME', 'http://' . $_SERVER['SERVER_NAME']);
}
if (!defined('WP_SITEURL')) {
    define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp-core');
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
