<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionGroupSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'Dashboard' => ['dashboard-view'],
            'Users' => ['user-list','user-create','user-edit','user-delete'],
            'Roles' => ['role-list','role-create','role-edit','role-delete'],
            'Products' => ['product-list','product-create','product-edit','product-delete'],
        ];

        foreach ($permissions as $group => $perms) {
            foreach ($perms as $permission) {
                Permission::firstOrCreate([
                    'name' => $permission,
                    'group_name' => $group,
                    'guard_name' => 'web', // FIX HERE
                ]);
            }
        }

        // Create Admin Role
        $adminRole = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web', // FIX HERE
        ]);

        // Assign all permissions to Admin Role
        $adminRole->syncPermissions(Permission::all());
    }
}
