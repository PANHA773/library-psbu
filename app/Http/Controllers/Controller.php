<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function admin_construct($view= null, $data= null) 
    {   
        
        $settings = $this->settings = DB::table('settings')->first();

        if($data) {
            return view('themes.admin.'.  $view, $data, ['settings' => $settings]);
        } else {
            return view('themes.admin.'. $view, ['settings' => $settings]);
        }
    }

    public function frontend_construct($view = null, $data = null)
    {
        $categories = DB::table('categories')->limit(4)->get();

        if($data) {
            return view('themes.shop.'.  $view, $data, ['foot_categories' => $categories]);
        } else {
            return view('themes.shop.'. $view,  ['foot_categories' => $categories]);
        }
    }
}


