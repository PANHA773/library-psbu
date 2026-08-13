<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SyncAdminPermissions
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user) {
            if ($user->user_type === 'admin') {
                $role = Role::firstOrCreate([
                    'name' => 'Admin',
                    'guard_name' => 'web',
                ]);

                $role->syncPermissions(Permission::all());

                if (!$user->hasRole($role->name)) {
                    $user->syncRoles([$role->name]);
                }

                $user->syncPermissions($role->permissions);
            }

            if ($user->user_type === 'department') {
                $role = Role::firstOrCreate([
                    'name' => 'Department',
                    'guard_name' => 'web',
                ]);

                $permissions = Permission::whereIn('name', [
                    'dashboard-index',
                    'book-index',
                    'book-create',
                    'book-edit',
                    'book-delete',
                    'book-view',
                    'book-print_barcodes',
                ])->where('guard_name', 'web')->get();

                $role->syncPermissions($permissions);

                if (!$user->hasRole($role->name)) {
                    $user->syncRoles([$role->name]);
                }

                $user->syncPermissions($role->permissions);
            }
        }

        return $next($request);
    }
}
