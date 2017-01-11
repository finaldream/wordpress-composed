<?php
/*
Plugin Name: WP-Composed Support
Plugin URI: http://finaldream.de
Description: This must-use plugin manages different aspects of the wp-composed setup.
Version: 1.0
Author: Oliver Erdmann, Finaldream Productions
Author URI: http://finaldream.de
License: ISC
*/

use WordpressComposed\Utils;

/**
 * Registers theme directories for:
 * - the original stock-themes under "/wp-core/wp-content/themes", in case other themes rely on them.
 * - an optional theme-directory, defined by the WPC_CUSTOM_THEME_DIR-constant (e.g. "/themes").
 *
 * @return void
 */
function wpc_register_theme_directories()
{

    // Register the bundled themes back from wp-core.
    register_theme_directory(ABSPATH . 'wp-content/themes/');

    /* Register possible custom themes directory */
    if (defined('WPC_CUSTOM_THEME_DIR')) {
        register_theme_directory(WPC_CUSTOM_THEME_DIR);
    }

}

/**
 * This filter creates valid URIs for theme-roots relative to the doc-root, when located outside of ter usual
 * wordpress structure.
 * The calculation of the doc-root relies on the constant WPC_DOCROOT_DIR, set in wp-config or .env.php.
 *
 * @param string $theme_root_uri Absolute server-path.
 * @return string Absolute URI.
 */
function wpc_filter_theme_root_uri($theme_root_uri)
{

    if (!defined('WPC_DOCROOT_DIR')) {
        return $theme_root_uri;
    }

    if (0 === strpos($theme_root_uri, WPC_DOCROOT_DIR)) {
        $theme_root_uri = site_url(str_replace(WPC_DOCROOT_DIR, '', $theme_root_uri));
    }

    return $theme_root_uri;

}

/**
 * Adds a meta-tag for reflecting the current server-environment.
 *
 * @return void
 */
function wpc_wp_head()
{
    if (defined('WP_ENV') || WP_ENV != 'prod') {
        echo '<meta name="env" content="'.WP_ENV.'">';
    }

}

/**
 * Adds body-classes for reflecting the current server-environment.
 *
 * @param $classes
 * @return array
 */
function wpc_body_class($classes)
{

    if (defined('WP_ENV') || WP_ENV != 'prod') {
        $classes[] = 'env-'.WP_ENV;
    }

    return $classes;

}

function wpc_upload_dir($uploads)
{

    if ($uploads['error'] === true) {
        return $uploads;
    }

    $uploads['url']     = Utils::resolveURL($uploads['url']);
    $uploads['baseurl'] = Utils::resolveURL($uploads['baseurl']);
    $uploads['path']    = Utils::resolvePath($uploads['path']);
    $uploads['basedir'] = Utils::resolvePath($uploads['basedir']);

    return $uploads;

}

wpc_register_theme_directories();

add_action( 'wp_head', 'wpc_wp_head');

add_filter( 'theme_root_uri', 'wpc_filter_theme_root_uri');
add_filter( 'body_class', 'wpc_body_class');

// Correct relative fragments in UPLOADS-path
if (defined('UPLOADS') && strpos(UPLOADS, '..') !== false) {
    add_filter( 'upload_dir', 'wpc_upload_dir', 9999);
}
