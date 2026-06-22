<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller
{
        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher'),
                new Middleware('permission:categories-index', only: ['index']),
                new Middleware('permission:categories-create', only: ['create','store']),
                new Middleware('permission:categories-edit', only: ['edit','update']),
                new Middleware('permission:categories-delete', only: ['destroy']),
                new Middleware('permission:categories-view', only: ['show']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')
            ->select('categories.*', 'parent.name as parent_name')
            ->leftjoin('categories as parent', 'parent.id', '=', 'categories.parent_id')
            ->orderBy('id', 'desc')
            ->get();
        return $this->admin_construct('category.index', ['categories' => $categories]);
    }



    public function create()
    {
        $categories = DB::table('categories')->get();
        return $this->admin_construct('category.add', ['categories' => $categories]);
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
            'parent_id' => $request->parent,
            'created_by' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'description' => clear_tag($request->description),
        ];

        if (!empty($request->image)) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', (time() . '.' . $extension));
            $file->move(public_path('uploads/category/'), $filename);
            $data['image'] = $filename;
        }

        DB::table('categories')->insert($data);

        return admin_redirect('settings/categories')->with('success', __('message.category_added'));
    }


    public function show($id)
    {

        $data = DB::table('categories')->where(['id' => $id])->first();

        $decode = decode_html($data->description);
        unset($data->description);
        $data->description = $decode;

        return response()->json($data);
    }


    public function edit($id)
    {
        $category = DB::table('categories')->where(['id' => $id])->first();
        $categories = DB::table('categories')->get();
        return $this->admin_construct('category.edit', ['category' => $category, 'categories' => $categories]);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data =  [
            'code' => $request->code,
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent,
            'updated_at' => date('Y-m-d H:i:s'),
            'description' => htmlentities($request->description, ENT_QUOTES, 'UTF-8', false),
        ];

        if (!empty($request->image)) {
            $old_img = DB::table('categories')->first()->image;
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', (time() . '.' . $extension));
            $file->move(public_path('uploads/category/'), $filename);
            $data['image'] = $filename;
            if ($old_img) {
                unlink(public_path('uploads/category/' . $old_img));
            }
        }

        DB::table('categories')
            ->where('id', $id)
            ->update($data);

        return admin_redirect('settings/categories')->with('success', __('message.category_updated'));
    }


    public function destroy($id)
    {
        $has_parent = DB::table('categories')->where(['parent_id' => $id])->first();
        if ($has_parent) {
            return admin_redirect('categories')->with('error', __('message.can_not_delete_this_catetory'));
        }

        DB::table('categories')->where(['id' => $id])->delete();

        $delete_image = DB::table('categories')->where(['id' => $id])->first();

        if ($delete_image->image != null) {
            unlink(public_path('uploads/category/' . $delete_image->image));
        }
        return admin_redirect('settings/categories')->with('success', __('message.category_deleted'));
    }
}
