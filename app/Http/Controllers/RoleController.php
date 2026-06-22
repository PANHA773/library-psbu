<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller
{

        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher'),
                new Middleware('permission:roles-index', only: ['index']),
                new Middleware('permission:roles-create', only: ['create','store']),
                new Middleware('permission:roles-edit', only: ['edit','update']),
                new Middleware('permission:roles-delete', only: ['destroy']),
                new Middleware('permission:roles-view', only: ['show']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    public function index()
    {
        $roles = Role::with('permissions')->get();
        return $this->admin_construct('roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        $permissions = Permission::all()
        ->groupBy(function ($permission) {
            return explode('-', $permission->name)[0]; 
        });

        return $this->admin_construct('roles.add', ['permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);
       

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all()
        ->groupBy(function ($permission) {
            return explode('-', $permission->name)[0];   // user-list → user
        });

         $rolePermissions = $role->permissions->pluck('id')->toArray();
        
        return $this->admin_construct('roles.edit', ['role' => $role, 'permissions' => $permissions, 'rolePermissions' => $rolePermissions]);
    }

    public function update(Request $request, $id)
    {
        

        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array'
        ]);

        $role = Role::findOrFail($id);

        $role->update([
            'name' => $request->name
        ]);

        // dd($request->permissions);

        // $role->syncPermissions($request->permissions ?? []);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted.');
    }
}
