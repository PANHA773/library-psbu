<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use App\Helpers\ApiKeyHelper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class ApiKeyController extends Controller
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
        $keys = ApiKey::all();
        return $this->admin_construct('apikeys.index', ['keys' => $keys]);
    }

    public function create()
    {
        return $this->admin_construct('apikeys.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'scopes' => 'required|array',
        ]);

        ApiKey::create([
            'name' => $request->name,
            'key' => ApiKeyHelper::generate(),
            'scopes' => json_encode($request->scopes),
        ]);

        return admin_redirect('shop_settings/apikeys')->with('success', 'API Key created!');
    }

    public function edit(ApiKey $apikey)
    {
        return $this->admin_construct('apikeys.edit', ['apikey' => $apikey]);
    }

    public function update(Request $request, ApiKey $apikey)
    {
        $request->validate([
            'name' => 'required',
            'scopes' => 'required|array',
            'status' => 'required|boolean',
        ]);

        $apikey->update([
            'name' => $request->name,
            'scopes' => json_encode($request->scopes),
            'active' => $request->status,
        ]);

        return admin_redirect('shop_settings/apikeys')->with('success', 'API Key UPDATED!');
    }

    public function destroy(ApiKey $apikey)
    {
        $apikey->delete();
        return redirect()->route('apikeys.index')->with('success', 'Deleted!');
    }
}
