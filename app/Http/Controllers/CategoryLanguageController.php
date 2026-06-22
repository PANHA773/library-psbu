<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;

class CategoryLanguageController extends Controller
{
        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher'),
                new Middleware('permission:category_langauges-index', only: ['index']),
                new Middleware('permission:category_langauges-create', only: ['create','store']),
                new Middleware('permission:category_langauges-edit', only: ['edit','update']),
                new Middleware('permission:category_langauges-delete', only: ['destroy']),
                new Middleware('permission:category_langauges-view', only: ['show']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    public function index()
    {
        $cate_lang =  DB::table('category_langs')->orderBy('id', 'desc')->get();
        return $this->admin_construct('category-language.index', ['cate_lang' => $cate_lang]);
    }

    public function create()
    {

        return $this->admin_construct('category-language.add');
    }


    public function store(Request $request)
    {
        $valid = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data =  [
            'code' => $request->code,
            'name' => $request->name,
            'slug' => $request->slug,
            'created_by' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'description' => clear_tag($request->description),
        ];

        if (!empty($request->image)) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', (time() . '.' . $extension));
            $file->move(public_path('uploads/category_lang/'), $filename);
            $data['image'] = $filename;
        }

        DB::table('category_langs')->insert($data);

        return admin_redirect('settings/category_langauges')->with('success', __('message.category_language_added'));
    }


    public function show($id)
    {
        $cate_lang =  DB::table('category_langs')->where('id', $id)->first();
        return response()->json($cate_lang);
    }


    public function edit($id)
    {
        $data = DB::table('category_langs')->where(['id' => $id])->first();
        return $this->admin_construct('category-language.edit', ['category_lang' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $valid = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data =  [
            'code' => $request->code,
            'name' => $request->name,
            'slug' => $request->slug,
            'updated_at' => date('Y-m-d H:i:s'),
            'description' => clear_tag($request->description),
        ];

        if (!empty($request->image)) {
            $old_img = DB::table('category_langs')->first()->image;
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', (time() . '.' . $extension));
            $file->move(public_path('uploads/category_lang/'), $filename);
            $data['image'] = $filename;
            if ($old_img) {
                unlink(public_path('uploads/category_lang/' . $old_img));
            }
        }

        DB::table('category_langs')->where(['id' => $id])->update($data);

        return admin_redirect('settings/category_langauges')->with('success', __('message.category_language_updated'));
    }


    public function destroy($id)
    {
        $delete_image = DB::table('category_langs')->where(['id' => $id])->first();

        if ($delete_image->image != null) {
            unlink(public_path('uploads/category_lang/' . $delete_image->image));
        }

        DB::table('category_langs')->where(['id' => $id])->delete();
        return admin_redirect('settings/category_langauges')->with('success', __('message.category_language_deleted'));
    }
}
