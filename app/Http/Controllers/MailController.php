<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MySendEmail;
use Illuminate\Routing\Controllers\Middleware;

class MailController extends Controller
{
        public function middleware($middleware = null, array $options = [])
        {
            if (func_num_args() === 0) {
                return [
                    new Middleware('role:Owner|Admin|Teacher'),
                    new Middleware('permission:mail-index', only: ['index']),
                    new Middleware('permission:mail-create', only: ['create','store']),
                    new Middleware('permission:mail-edit', only: ['edit','update']),
                    new Middleware('permission:mail-delete', only: ['destroy']),
                ];
            }

            return parent::middleware($middleware, $options);
        }
    public function __construct()
    {
        
        // 
        // 
        // 
        // 
    }

    
    public function index()
    {
        $name = 'testing';
        $subject =  'Send OTP Code';
        $description = 'This is coding for you';
        $mail_to = 'chou.chamnan.kh@gmail.com';
        Mail::to($mail_to)->send(new MySendEmail($name, $subject, $description));
        dd("Email is sent successfully.");
    }
}
