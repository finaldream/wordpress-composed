<?php
/**
 * The base configuration of WordPress.
 *
 * This file is customized by Wordpress-Composed.
 * For more information, see https://github.com/finaldream/wordpress-composed
 *
 * The external ../.env.php is used for actual configurations. Please don't make sensitive changes here.
 *
 * REMEMBER: PASSWORDS, APPLICATION-CREDENTIALS OR OTHER SENSITIVE DATA SHOULD NEVER BE CHECKED INTO YOUR VCS!
 * Customize the .env.php-file for each target environment separately.
 *
 * Constants starting with "WPC_" are meant to be read like "WP Custom" or "WP Composed",
 * indicating that they are not part of the original wordpress distribution, but introduced by the Wordpress-Composed
 * project.
 *
 * @package WordPress
 */

/* Access the docroot / root-locations in env.php by variables, in case you want to override them. */
$wpc_docroot_dir = realpath(__DIR__);
$wpc_root_dir = realpath(__DIR__ . '/..');
$wpc_docroot_url = 'http://' . $_SERVER['SERVER_NAME'];

/* Include environment configuration. */
require ($wpc_root_dir . '/.env.php');

/* Define the root-locations. */
define('WPC_DOCROOT_DIR', $wpc_docroot_dir);
define('WPC_ROOT_DIR', $wpc_root_dir);
define('WPC_DOCROOT_URL', $wpc_docroot_url);

unset($wpc_docroot_dir);
unset($wpc_root_dir);
unset($wpc_docroot_url);

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

/* Uploads-folder location, relative to ABSPATH */
if (!defined('UPLOADS')) {
    define('UPLOADS',  '../uploads');
}

/* Require Composer Autoloads. */
require WPC_DOCROOT_DIR . '/wp-content/vendor/autoload.php';

/* Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
  define('ABSPATH', WPC_DOCROOT_DIR . '/wp-core/');
}

/* Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
