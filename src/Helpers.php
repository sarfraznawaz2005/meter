<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

if (!function_exists('meterActiveLink')) {
    function meterActiveLink($path, $class = 'active')
    {
        if (request()->is((array)$path) || request()->routeIs((array)$path)) {
            return $class;
        }

        return '';
    }
}

if (!function_exists('meterWithHtmlTitle')) {
    function meterWithHtmlTitle($text, $title)
    {
        return "<span data-toggle='tooltip' title='$title'>$text</span>";
    }
}

if (!function_exists('meterBadge')) {
    function meterBadge($text)
    {
        return "<span class='badge font-weight-light badge-secondary'>$text</span>";
    }
}

if (!function_exists('meterAutoBadge')) {
    function meterAutoBadge($text, $colorMap)
    {
        $color = array_keys(array_filter($colorMap))[0] ?? 'badge-secondary';

        return "<span class='badge font-weight-light badge-$color'>$text</span>";
    }
}

if (!function_exists('meterCenter')) {
    function meterCenter($text)
    {
        return "<div class='text-center'>$text</div>";
    }
}

if (!function_exists('meterDetailsButton')) {
    function meterDetailsButton($details)
    {
        $details = htmlspecialchars(json_encode($details), ENT_QUOTES, 'UTF-8');

        return <<< HTML
        <a class="btnDetails" data-details="$details" href="#">
            <i class="icon fa fa-bullseye"></i>
        </a>
HTML;
    }
}

if (!function_exists('meterGetSql')) {
    function meterGetSql(Builder $builder)
    {
        $addSlashes = str_replace('?', "'?'", $builder->toSql());

        return vsprintf(str_replace('?', '%s', $addSlashes), $builder->getBindings());
    }
}

if (!function_exists('meterFormatModel')) {
    function meterFormatModel(Model $model)
    {
        return get_class($model) . ':' . implode('_', Arr::wrap($model->getKey()));
    }
}

if (!function_exists('meterIgnoreEntry')) {
    function meterIgnoreEntry($key, $content)
    {
        return str_contains($content, $key);
    }
}
