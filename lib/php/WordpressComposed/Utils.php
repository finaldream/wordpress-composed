<?php
/**
 * General Utilities provided by WordpressComposed
 *
 * @author Oliver Erdmann, <o.erdmann@finaldream.de>
 * @since  10.01.2017
 */

namespace WordpressComposed;


class Utils
{

    /**
     * Like `getenv`, but allows to specify a default value
     *
     * @param string $env     Environment variable to get
     * @param string $default Default value, in case the variable is not defined.
     * @return string
     */
    static function getEnv($env, $default = '')
    {

        $result = getenv($env);

        if ($result !== false) {
            return $result;
        }

        return $default;

    }


    /**
     * Resolves relative directory-parts, but does not check for the result's existence (like `realpath` would)
     *
     * @param string $path
     * @return string
     */
    static function resolvePath($path)
    {

        $path = str_replace('//', '/', $path);
        $parts = explode('/', $path);
        $out = array();
        foreach ($parts as $part){
            if ($part == '.') continue;
            if ($part == '..') {
                array_pop($out);
                continue;
            }
            $out[] = $part;
        }
        return implode('/', $out);

    }


    /**
     * Takes an address and resolves '..' or '.', without removing the domain, in case "..' is top-level.
     *
     * @param string $address
     * @return string
     */
    static function resolveURL($address)
    {
        $urlParts = parse_url($address);

        if (!isset($urlParts['path'])) {
            return $address;
        }

        $filename = $urlParts['path'];

        $filename = str_replace('//', '/', $filename);
        $filename = ltrim($filename, '/');
        $parts = explode('/', $filename);
        $out = array();
        foreach ($parts as $part){
            if ($part == '.') continue;
            if ($part == '..') {
                array_pop($out);
                continue;
            }
            $out[] = $part;
        }
        $filename = implode('/', $out);

        $result = '';

        if (isset($urlParts['scheme'])) {
            $result .= $urlParts['scheme'] . '://';
        }

        if (isset($urlParts['host'])) {
            $result .= $urlParts['host'] . '/';
        }

        $result .= $filename;

        return $result;
    }

}
