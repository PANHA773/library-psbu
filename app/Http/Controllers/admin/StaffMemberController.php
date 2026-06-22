<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StaffMemberController extends Controller
{
    public function index()
    {
        $staffMembers = StaffMember::ordered()->get();

        return $this->admin_construct('staff-members.index', [
            'staffMembers' => $staffMembers,
        ]);
    }

    public function create()
    {
        return $this->admin_construct('staff-members.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'member_type' => 'required|in:leader,librarian',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['description'] = $request->input('description');
        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['image'] = $this->uploadImage($request);

        StaffMember::create($validated);

        return admin_redirect('staff-members')->with('success', 'Staff member created successfully!');
    }

    public function edit($id)
    {
        $member = StaffMember::findOrFail($id);

        return $this->admin_construct('staff-members.edit', [
            'member' => $member,
        ]);
    }

    public function update(Request $request, $id)
    {
        $member = StaffMember::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'member_type' => 'required|in:leader,librarian',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['description'] = $request->input('description');
        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $this->deleteImage($member->image);
            $validated['image'] = $this->uploadImage($request);
        }

        $member->update($validated);

        return admin_redirect('staff-members')->with('success', 'Staff member updated successfully!');
    }

    public function destroy($id)
    {
        $member = StaffMember::findOrFail($id);
        $this->deleteImage($member->image);
        $member->delete();

        return admin_redirect('staff-members')->with('success', 'Staff member deleted successfully!');
    }

    private function uploadImage(Request $request): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = hash('gost', time() . '.' . $extension);
        $directory = public_path('uploads/staff-members');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $file->move($directory, $filename);

        return $filename;
    }

    private function deleteImage(?string $image): void
    {
        if (!$image || filter_var($image, FILTER_VALIDATE_URL)) {
            return;
        }

        $path = public_path('uploads/staff-members/' . $image);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
