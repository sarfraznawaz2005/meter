<?php

if (!function_exists('activeLink')) {
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

if (!function_exists('detailsButton')) {
    function detailsButton($details)
    {
        $details = htmlspecialchars(json_encode($details), ENT_QUOTES, 'UTF-8');

        return <<< HTML
        <a class="btnDetails" data-details="$details" data-toggle="tooltip" title="Details" href="#">
            <i class="icon fa fa-bullseye"></i>
        </a>
HTML;
    }
}
