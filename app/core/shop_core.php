<?php 

// namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


// Get shop setting data for front end

if(!function_exists('shop_settings')) {
    function shop_settings() {
        return DB::table('shop_settings')->first();
    }
 }

if (!function_exists('shop_settings_logo_url')) {
    function shop_settings_logo_url()
    {
        $settings = shop_settings();
        $logo = $settings->logo ?? null;
        $fallback = asset('uploads/settings/no_image.png');

        if (!$logo) {
            return $fallback;
        }

        $path = public_path('uploads/settings/' . $logo);
        return file_exists($path) ? asset('uploads/settings/' . $logo) : $fallback;
    }
}
