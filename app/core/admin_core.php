<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

if(!function_exists('settings')) {
    function settings() {
        try {
            return DB::table('settings')->first();
        } catch (\Throwable $e) {
            return null;
        }
    }
}

if (!function_exists('settings_logo_url')) {
    function settings_logo_url()
    {
        $settings = settings();
        $logo = $settings->logo ?? null;
        $fallback = asset('uploads/settings/no_image.png');

        if (!$logo) {
            return $fallback;
        }

        $path = public_path('uploads/settings/' . $logo);
        return file_exists($path) ? asset('uploads/settings/' . $logo) : $fallback;
    }
}

if(!function_exists('current_local')) {
    function current_local() {
        $locale_current = request()->cookie("language");
        Session::put("locale",$locale_current);
        return '';
    }
}
