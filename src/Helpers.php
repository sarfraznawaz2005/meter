<?php

if (!function_exists('active_link')) {
    /**
     * Applies class/whatever class to links in navigation to mark them class.
     *
     * @param $path
     * @param string $class
     * @return string
     */
    function active_link($path, $class = 'active')
    {
        if (request()->is((array)$path) || request()->routeIs((array)$path)) {
            return $class;
        }

        return '';
    }
}
