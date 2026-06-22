<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller
{
        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher'),
                new Middleware('permission:permissions-index', only: ['index']),
                new Middleware('permission:permissions-create', only: ['create','store']),
                new Middleware('permission:permissions-edit', only: ['edit','update']),
                new Middleware('permission:permissions-delete', only: ['destroy']),
                new Middleware('permission:permissions-view', only: ['show']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    public function __construct()
    {
        
        
        // 
        // 
        // 
    }

    public function index()
    {
        $permissions = Permission::all();
        return $this->admin_construct('permissions.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return $this->admin_construct('permissions.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'group_name' => 'required',
        ]);

        foreach ($request->name as $index => $item) {
             Permission::create(['name' => $item, 'group_name' => $request->group_name[$index], 'guard_name' => 'web']);
        }
        // Permission::create(['name' => $request->name, 'group_name' => $request->group_name, 'guard_name' => 'web']);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return $this->admin_construct('permissions.edit', ['permission' => $permission]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required|unique:permissions,name,$id",
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update([
            'name' => $request->name,
        ]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}
