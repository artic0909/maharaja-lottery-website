<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Get a site setting with a fallback.
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}
