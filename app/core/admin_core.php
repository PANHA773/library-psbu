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

if(!function_exists('current_local')) {
    function current_local() {
        $locale_current = request()->cookie("language");
        Session::put("locale",$locale_current);
        return '';
    }
}

