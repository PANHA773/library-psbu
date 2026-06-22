<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller
{
        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher'),
                new Middleware('permission:products-index', only: ['index']),
                new Middleware('permission:products-create', only: ['create','store']),
                new Middleware('permission:products-edit', only: ['edit','update']),
                new Middleware('permission:products-delete', only: ['destroy']),
                new Middleware('permission:products-view', only: ['show']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

   
    public function index()
    {
        $products = DB::table('products')
                        ->join('units','products.unit','=','units.id')
                        ->join('brands', 'products.brand', '=','brands.id')
                        ->join('categories', 'products.category_id','=','categories.id')
                        ->select('products.*',
                        'units.name as unit',
                        'categories.name as category',
                        'brands.name as brand',

                        )
                        ->get();
        return $this->admin_construct('products.index', ['products' => $products]);
    }

    
    public function create()
    {
        return $this->admin_construct('products.add');
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username,NULL,id,deleted_at,NULL',
            'email' => 'nullable|email|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required',
        ]);

        if($validator) {
            DB::table('students')->insert([
                'email' =>  $request->email,
                'password' =>  Hash::make($request->password),
                'address' =>  $request->address,
                'address2' =>  $request->address2,
                'city' =>  $request->city,
                'country' =>  $request->country,
                'zip' =>  $request->zip,
            ]);
            return redirect('/products')->with('success', 'Please Select All Input before submit!');
        } else {
            return redirect('/products')->with('error', '*Please Select All Input before submit!');
        }
        
    }

    
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
