<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // This controller is for admin contacts management if needed
        // For now, redirect to messages which is the new system
        return redirect()->route('messages.index');
    }
}
