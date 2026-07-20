<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DepartmentUserController extends Controller
{
    private function syncDepartmentAccess(User $user): void
    {
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
        $user->syncRoles([$role->name]);
    }

    public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin'),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    /**
     * Display a listing of department users.
     */
    public function index($departmentId)
    {
        $department = Department::findOrFail($departmentId);
        $users = User::where('department_id', $departmentId)->get();
        return $this->admin_construct('department-users.index', ['department' => $department, 'users' => $users]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create($departmentId)
    {
        $department = Department::findOrFail($departmentId);
        return $this->admin_construct('department-users.add', ['department' => $department]);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request, $departmentId)
    {
        $department = Department::findOrFail($departmentId);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'department_id' => $departmentId,
            'activated' => true,
            'user_type' => 'department',
        ];

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = hash('gost', time()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/users'), $filename);
            $data['avatar'] = $filename;
        }

        $user = User::create($data);
        $this->syncDepartmentAccess($user);

        return admin_redirect('settings/departments/' . $departmentId . '/users')->with('success', 'Department user created successfully!');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($departmentId, $userId)
    {
        $department = Department::findOrFail($departmentId);
        $user = User::where('id', $userId)->where('department_id', $departmentId)->firstOrFail();
        return $this->admin_construct('department-users.edit', ['department' => $department, 'user' => $user]);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $departmentId, $userId)
    {
        $department = Department::findOrFail($departmentId);
        $user = User::where('id', $userId)->where('department_id', $departmentId)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar && file_exists(public_path('uploads/users/' . $user->avatar))) {
                unlink(public_path('uploads/users/' . $user->avatar));
            }
            $file = $request->file('avatar');
            $filename = hash('gost', time()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/users'), $filename);
            $data['avatar'] = $filename;
        }

        $user->update($data);
        $this->syncDepartmentAccess($user);

        return admin_redirect('settings/departments/' . $departmentId . '/users')->with('success', 'Department user updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($departmentId, $userId)
    {
        $department = Department::findOrFail($departmentId);
        $user = User::where('id', $userId)->where('department_id', $departmentId)->firstOrFail();

        // Delete avatar if exists
        if ($user->avatar && file_exists(public_path('uploads/users/' . $user->avatar))) {
            unlink(public_path('uploads/users/' . $user->avatar));
        }

        $user->delete();

        return admin_redirect('settings/departments/' . $departmentId . '/users')->with('success', 'Department user deleted successfully!');
    }
}
