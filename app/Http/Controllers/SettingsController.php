<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controllers\Middleware;

class SettingsController extends Controller
{

        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher'),
                new Middleware('permission:settings-index', only: ['index']),
                new Middleware('permission:settings-create', only: ['create','store']),
                new Middleware('permission:settings-edit', only: ['edit','update']),
                new Middleware('permission:settings-delete', only: ['destroy']),
                new Middleware('permission:settings-view', only: ['show']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    public function findFile($filename) {
        $files = File::files(public_path('uploads'));

        foreach ($files as $file) {
            if (basename($file->getFilename()) === $filename) {
                return true;   // file found
            }
       }
        return false;
    }


    public function index()
    {
        $settings = DB::table('settings')->where('setting_id', 1)->first();
        // $currencies = DB::table('currencies')->get();
        // $warehouses = DB::table('warehouses')->get();
        return $this->admin_construct('settings.index', [
            'setting' => $settings
        ]);
    }

    public function store(Request $request)
    {

        $validation = $request->validate([
            'site_name' => 'required',
            'language' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'site_name'         => $request->input('site_name'),
            'language'          => $request->input('language'),
            'student_prefix'    => $request->input('student_prefix'),
            'book_prefix'       => $request->input('book_prefix'),
            'attendance_prefix' => $request->input('attendance_prefix'),
            'borrow_prefix'     => $request->input('borrow_prefix'),
            'theme'             => $request->input('theme'),
            'timezone'          => $request->input('timezone'),
            'iwidth'            => $request->input('iwidth'),
            'iheight'           => $request->input('iheight'),
            'watermark'         => $request->input('watermark'),
            'captcha'           => $request->input('captcha'),
            'is_demo'           => $request->input('is_demo'),
            'hidden_login_btn'  => $request->input('hidden_login_btn'),
            'ip_address_allow'  => $request->input('ip_address_allow'),
            'start_ip_address'  => $request->input('start_ip_address'),
            'end_ip_address'    => $request->input('end_ip_address'),
            'using_in_area'     => $request->input('using_in_area'),
            'avariable_register_page' => $request->input('avariable_register_page'),
            'site_prefix'       => $request->input('site_prefix')
        ];

        if (!empty($request->image)) {
            $old_img = DB::table('settings')->first()->logo;
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', (time() . '.' . $extension));
            $file->move(public_path('uploads/settings/'), $filename);
            $data['logo'] = $filename;
            if ($old_img) {
                if($this->findFile($old_img)) {
                    unlink(public_path('uploads/settings/' . $old_img));
                }
            }
        }

        if ($validation) {
            $updated = DB::table('settings')
                ->where('setting_id', 1)
                ->update($data);

            if ($updated) {
                return admin_redirect('settings')->with('success', __('message.setting_has_been_update_success'));
            } else {
                return admin_redirect('settings')->with('info', __('message.setting_has_been_update_exist'));
            }
        } else {
            return admin_redirect('settings')->with('error', __('message.setting_has_been_update_error'));
        }
    }
}
