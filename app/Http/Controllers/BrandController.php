<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\Middleware;

class BrandController extends Controller
{
        public function middleware($middleware = null, array $options = [])
        {
            if (func_num_args() === 0) {
                return [
                    new Middleware('role:Owner|Admin'),
                    new Middleware('permission:brand-index', only: ['index']),
                    new Middleware('permission:brand-create', only: ['create','store']),
                    new Middleware('permission:brand-edit', only: ['edit','update']),
                    new Middleware('permission:brand-delete', only: ['destroy']),
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
        $brands = DB::table('brands')->order_by('id', 'desc')->get();
        return view('brand.index', ['brands', $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'description' => $request->description,
        ];

        if (!empty($request->image)) {
            $old_img = DB::table('brands')->first()->image;
            $file =$request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = hash('gost',(time().'.' . $extension));
            $file->move(public_path('uploads/category/'), $filename);
            $data['image']= $filename;
            if($old_img) {
                unlink(public_path('uploads/category/'. $old_img));
            }
        }
        
        DB::table('brands')->insert($data);

        return admin_redirect('bands')->with('success', 'brand added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand =  DB::table('brands')->where(['id' => $id])->first();
        return view('brand.edit',['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
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
            'description' => htmlentities($request->description , ENT_QUOTES, 'UTF-8', false),
        ];

        if (!empty($request->image)) {
            $old_img = DB::table('brands')->first()->image;
            $file =$request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = hash('gost',(time().'.' . $extension));
            $file->move(public_path('uploads/brands/'), $filename);
            $data['image']= $filename;
            if($old_img) {
                unlink(public_path('uploads/brands/'. $old_img));
            }
        }

         DB::table('brands')
            ->where('id', $id)
            ->update($data);

        return admin_redirect('brands')->with('success', 'Brand updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
