<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

if (!function_exists('isRoute')) {
    function isRoute(string ...$patterns): string
    {
        return Route::currentRouteNamed(...$patterns) ? 'active' : '';
    }
}

if (!function_exists('format_date')) {
    function format_date(Carbon $date, bool $fullTime = false, string $locale = 'fr_FR'): string
    {
        $date->locale($locale);
        return $date->translatedFormat(($fullTime ? 'j F Y \à G:i' : 'j F Y'));
    }
}

if (!function_exists('format_date_compact')) {
    function format_date_compact(Carbon $date): string
    {
        return $date->format('d/m/Y \à G:i');
    }
}
