<?php

if (!function_exists('activeLink')) {
    /**
     * Applies class/whatever class to links in navigation to mark them class.
     *
     * @param $path
     * @param string $class
     * @return string
     */
    function activeLink($path, $class = 'active')
    {
        if (request()->is((array)$path) || request()->routeIs((array)$path)) {
            return $class;
        }

        return '';
    }
}

if (!function_exists('withHtmlTitle')) {
    function withHtmlTitle($text, $title)
    {
        return "<span data-toggle='tooltip' title='$title'>$text</span>";
    }
}

if (!function_exists('badge')) {
    function badge($text)
    {
        return "<span class='badge font-weight-light badge-secondary'>$text</span>";
    }
}

if (!function_exists('autoBadge')) {
    function autoBadge($text, $colorMap)
    {
        $color = array_keys(array_filter($colorMap))[0] ?? 'badge-secondary';

        return "<span class='badge font-weight-light badge-$color'>$text</span>";
    }
}

if (!function_exists('center')) {
    function center($text)
    {
        return "<div class='text-center'>$text</div>";
    }
}

