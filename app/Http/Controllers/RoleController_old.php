<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller
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
        $roles = Role::all();
        return $this->admin_construct('roles.index', ['roles' => $roles]);
    }

    public function store(Request $request)
    {

        // dd($request);
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::Create(
            ['name' => $request->name,
            'guard_name' => 'web']
        );

        $role->syncPermissions($request->permissions ?? []);

        return admin_redirect('roles')->with('success', __('admin.role_added'));
    }

    public function edit(Role $role)
    {
        return response()->json([
            'id' => $role->id,
            'name' => $role->name,
            'permissions' => $role->permissions
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return admin_redirect('roles')->with('success', __('admin.role_deleted'));
    }

}
