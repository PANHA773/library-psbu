<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Routing\Controllers\Middleware;

class ProfileController extends Controller
{

        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher'),
                new Middleware('permission:product-index', only: ['index']),
                new Middleware('permission:product-create', only: ['create','store']),
                new Middleware('permission:product-edit', only: ['edit','update']),
                new Middleware('permission:product-delete', only: ['destroy']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    public function __construct()
    {
        
        // 
        // 
        // 
        // 
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return $this->admin_construct('auth.view-profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->is_agree = $request->is_agree ? $request->is_agree : 0;
        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', __('message.profile_updated'));
    }

    public function update_avatar(Request $request) 
    {
        
        $validation = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (!empty($request->profile)) {
            $old_img = DB::table('users')->first()->avatar;
            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension(); 
            $filename = hash('gost',(time().'.' . $extension));
            $file->move(public_path('uploads/profile/'), $filename);
            $data['avatar'] = $filename;

            // if($old_img) {
            //     unlink(public_path('uploads/profile/'. $old_img));   
            // } 
        }

        if($data) {
            DB::table('users')
           ->where('id' , Auth::user()->id)
           ->update($data);
       }
        return admin_redirect('profile/#avatar')->with('success', __('message.your_profile_has_been_updated'));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
