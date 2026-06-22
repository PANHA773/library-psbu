<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{

    
    
    public function index($locale) {

        if($locale) {
            Session::put("app_lang",$locale);
        } else {
            $locale_current = request()->cookie("language");
            Session::put("app_lang",$locale_current);
        }

        if($locale == 'km') {
            cookie()->queue(cookie()->forever("language", "kh"));
        }

        if($locale == 'en') {
            cookie()->queue(cookie()->forever("language", "us"));
        }
        
        return redirect($_SERVER['HTTP_REFERER']);
     }
}
