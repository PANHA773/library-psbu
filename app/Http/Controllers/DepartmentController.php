<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\Middleware;

class DepartmentController extends Controller
{
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return $this->admin_construct('departments.index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->admin_construct('departments.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:departments,code',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => $request->has('is_active') ? true : false,
        ];

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = hash('gost', time()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/departments'), $filename);
            $data['avatar'] = $filename;
        }

        Department::create($data);

        return admin_redirect('settings/departments')->with('success', 'Department created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return response()->json($department);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return $this->admin_construct('departments.edit', ['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:departments,code,' . $department->id,
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => $request->has('is_active') ? true : false,
        ];

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($department->avatar && file_exists(public_path('uploads/departments/' . $department->avatar))) {
                unlink(public_path('uploads/departments/' . $department->avatar));
            }
            $file = $request->file('avatar');
            $filename = hash('gost', time()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/departments'), $filename);
            $data['avatar'] = $filename;
        }

        $department->update($data);

        return admin_redirect('settings/departments')->with('success', 'Department updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        // Check if department has books
        $bookCount = DB::table('books')->where('department_id', $department->id)->count();
        
        if ($bookCount > 0) {
            return admin_redirect('settings/departments')->with('error', 'Cannot delete department with associated books. Please reassign or delete those books first.');
        }

        $department->delete();
        return admin_redirect('settings/departments')->with('success', 'Department deleted successfully!');
    }
}
