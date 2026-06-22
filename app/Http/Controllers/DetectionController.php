<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\Middleware;

class DetectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('permission:detections-index', only: ['index']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    public function index()
    {
        $detections = DB::table('login_devices')->orderBy('id', 'desc')->get();
        return $this->admin_construct('detection.index', ['devices' => $detections]);
    }
}
