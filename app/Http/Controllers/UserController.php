<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use Illuminate\Routing\Controllers\Middleware;


class UserController extends Controller
{

        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner||Admin'),
                new Middleware('permission:user-index', only: ['index']),
                new Middleware('permission:user-create', only: ['create','store']),
                new Middleware('permission:user-edit', only: ['edit','update']),
                new Middleware('permission:user-delete', only: ['destroy']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    public function index()
    {
        $users = User::with('roles')->get();
        return $this->admin_construct('user.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        return $this->admin_construct('user.add', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'roles' => 'required'
        ]);

        $data =  [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'experience' => $request->experience,
            'skills'  => $request->skills,
            'password' => Hash::make($request->password),
            // 'student_id' => $request->student_id,
            'activated' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'user_type' => 'admin',
            'description' => clear_tag($request->description),
        ];

        if ($request->hasFile('avatar')) {
            $file      = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename  = hash('sha256', (time() . '.' . $extension));
            $file->move(public_path('uploads/profile/'), $filename);
            $data['avatar'] = $filename;
        }


       $user = User::create($data);

       // Assign role
        $role = Role::findByName($request->roles);
        $user->assignRole($role);

        // Assign role's permissions to user directly (optional)
        $permissions = $role->permissions; // get all permissions of the role
        if ($permissions->count()) {
            $user->givePermissionTo($permissions);
        }  

        if ($user) {
        return admin_redirect('peoples/users')->with('success', 'users added');
        } else {
            return admin_redirect('peoples/users')->with('errorr', 'add user has been error!');
        }
    }


    public function show($id)
    {
        $user =  DB::table('users')->where('id', $id)->first();


        return response()->json($user);
    }

    public function edit($id)
    {
        $user     = User::findOrFail($id);
        $roles    = Role::all();
        $userRole = $user->roles->first()?->name ?? '';
        return $this->admin_construct('user.edit', [
            'user'     => $user,
            'roles'    => $roles,
            'userRole' => $userRole,
        ]);
    }

    public function update(Request $request, $id)
    {
        $valid = $request->validate([
            'name'   => 'required',
            'email'  => 'required',
            'avatar' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'roles'  => 'required|string',
        ]);

        $data = [
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'gender'      => $request->gender,
            'experience'  => $request->experience,
            'skills'      => $request->skills,
            'address'     => $request->address,
            'description' => clear_tag($request->description),
        ];

        if ($request->hasFile('avatar')) {
            $file      = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename  = hash('sha256', (time() . '.' . $extension));
            $file->move(public_path('uploads/profile/'), $filename);

            // Delete old avatar
            $old = DB::table('users')->where('id', $id)->value('avatar');
            if ($old && file_exists(public_path('uploads/profile/' . $old))) {
                unlink(public_path('uploads/profile/' . $old));
            }
            $data['avatar'] = $filename;
        }

        DB::table('users')->where('id', $id)->update($data);

        $user = User::findOrFail($id);

        // Sync role
        $user->syncRoles([$request->roles]);

        // Sync role's permissions directly onto the user
        $role = Role::findByName($request->roles);
        if ($role) {
            $user->syncPermissions($role->permissions);
        }

        return admin_redirect('peoples/users')->with('success', __('message.users_updated'));
    }

    public function status_ban($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $value_ban = 0;

        if ($user->is_ban == 1) {
            $value_ban = 0;
        } else {
            $value_ban = 1;
        }

        DB::table('users')->where('id', $id)->update(['is_ban' => $value_ban]);

        if ($value_ban) {
            return admin_redirect('peoples/users')->with('success', __('message.user_has_blocked'));
        } else {
            return admin_redirect('peoples/users')->with('success', __('message.user_unblocked'));
        }
    }


    public function destroy($id)
    {
        $delete_image = DB::table('users')->where(['id' => $id])->first();
        if ($delete_image->avatar != '' ||  $delete_image->avatar != null) {
            // unlink(public_path('uploads/profile/' . $delete_image->avatar));
        }
        DB::table('users')->where(['id' => $id])->delete();
        return admin_redirect('peoples/users')->with('success', __('message.user_deleted'));
    }
} 
