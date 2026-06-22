<?php 

// namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


// Get shop setting data for front end

if(!function_exists('shop_settings')) {
    function shop_settings() {
        return DB::table('shop_settings')->first();
    }
 }