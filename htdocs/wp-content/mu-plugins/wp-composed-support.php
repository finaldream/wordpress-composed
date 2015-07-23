<?php
/**
 * This must-use plugin manages different aspects of the wp-composed setup.
 *
 * @author Oliver Erdmann, <o.erdmann@finaldream.de>
 * @since 22.07.2015
 */


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

wpc_register_theme_directories();

add_filter( 'theme_root_uri', 'wpc_filter_theme_root_uri');