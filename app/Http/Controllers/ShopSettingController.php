<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\Middleware;

class ShopSettingController extends Controller
{

        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin'),
                new Middleware('permission:role-index', only: ['index']),
                new Middleware('permission:role-create', only: ['create','store']),
                new Middleware('permission:role-edit', only: ['edit','update']),
                new Middleware('permission:role-delete', only: ['destroy']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    public function index()
    {
        $shop_setting = DB::table('shop_settings')->where('shop_id', 1)->first();
        // $warehouses = DB::table('warehouses')->get();
        // $billers  = DB::table('companies')->where('group_name' , 'biller')->get(); 

        return $this->admin_construct('shop_settings.index', [
            'shop_setting' => $shop_setting
            // 'warehouses' => $warehouses,
            // 'billers' => $billers,
        ]);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd('hello');
        $valid = $request->validate([
            'shop_name' => 'required',
            'shop_description' => 'required',
            // 'product_page' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);



        $data =  [
            'shop_name' => $request->shop_name,
            'description' => $request->shop_description,
            // 'warehouse' => $request->warhouse_name,
            // 'biller' => $request->biller,
            'payment_text' => $request->payment_text,
            'follow_text' => $request->follow_text,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'google_plus' => $request->google_plus,
            'instagram' => $request->instagram,
            'phone' => $request->phone,
            'email' => $request->email,
            'cookie_message' => $request->message_cookie,
            'cookie_link' => $request->cookie_link,
            'products_page' => $request->product_page,
            'bank_details' => clear_tag($request->bank_details),
            'keyword' => $request->key_word,
            'address' => $request->address,
            'private' => $request->private_shop,
        ];


        if (!empty($request->logo)) {
            $old_img = DB::table('shop_settings')->first()->logo;
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', (time() . '.' . $extension));
            $file->move(public_path('uploads/settings/'), $filename);
            $data['logo'] = $filename;
            if ($old_img) {
                unlink(public_path('uploads/settings/' . $old_img));
            }
        }

        DB::table('shop_settings')->where('shop_id', 1)->update($data);

        return admin_redirect('shop_settings')->with('success', __('message.shop_setting_updated'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
