<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 

class BookControllerApi extends Controller
{
    
    public function __construct() {
        $this->base_url = url('uploads/books');
    }

    public function index()
    {
        $books = DB::table('books')
        ->select('code','title',DB::Raw("CONCAT('{$this->base_url}', '/', image) AS image"), 'details','slug', 'views','author','author_date', 'category_lang_id','category_id', 'created_by','updated_at')
        ->orderBy('id','desc')
        ->get();
        return response()->json(['data' => $books]);
    }
}
