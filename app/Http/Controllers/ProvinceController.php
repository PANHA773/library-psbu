<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;


class ProvinceController extends Controller
{
        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher'),
                new Middleware('permission:provinces-index', only: ['index']),
                new Middleware('permission:provinces-create', only: ['create','store']),
                new Middleware('permission:provinces-edit', only: ['edit','update']),
                new Middleware('permission:provinces-delete', only: ['destroy']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    public function index()
    {
        $provinces = DB::table('provinces')->get();
        return $this->admin_construct('province.index', ['provinces' => $provinces]);
    }

    public function create()
    {
        return $this->admin_construct('province.add');
    }


    public function store(Request $request)
    {
        $valid = $request->validate([
            'zip_code' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data =  [
            'zip_code' => $request->zip_code,
            'name' => $request->name,
            'details' => clear_tag($request->description),
            'created_by' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if (!empty($request->image)) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', (time() . '.' . $extension));
            $file->move(public_path('uploads/province/'), $filename);
            $data['image'] = $filename;
        }

        DB::table('provinces')->insert($data);

        return admin_redirect('settings/provinces')->with('success', __('message.province_added'));
    }


    public function show($id)
    {
        $province =  DB::table('provinces')->where('id', $id)->first();
        return response()->json($province);
    }


    public function edit($id)
    {
        $province = DB::table('provinces')->where('id', $id)->first();
        return $this->admin_construct('province.edit', ['province' => $province]);
    }


    public function update(Request $request, $id)
    {
        $valid = $request->validate([
            'zip_code' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data =  [
            'zip_code' => $request->zip_code,
            'name' => $request->name,
            'details' => clear_tag($request->description),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if (!empty($request->image)) {
            $old_img = DB::table('provinces')->where(['id' => $id])->first()->image;
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', (time() . '.' . $extension));
            $file->move(public_path('uploads/province/'), $filename);
            $data['image'] = $filename;
            if ($old_img) {
                unlink(public_path('uploads/prorvince/' . $old_img));
            }
        }

        DB::table('privinces')->insert($data);

        return admin_redirect('settings/provinces')->with('success', __('message.province_added'));
    }


    public function destroy($id)
    {
        $delete_image = DB::table('provinces')->where(['id' => $id])->first();

        if ($delete_image->image) {
            unlink(public_path('uploads/province/' . $delete_image->image));
        }
        DB::table('provinces')->where(['id' => $id])->delete();
        return admin_redirect('settings/provinces')->with('success', __('message.province_deleted'));
    }
}
