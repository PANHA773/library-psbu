<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\Middleware;

class StudentsController extends Controller
{
        public function middleware($middleware = null, array $options = [])
        {
            if (func_num_args() === 0) {
                return [
                    new Middleware('role:Owner|Admin'),
                    new Middleware('permission:students-index', only: ['index']),
                    new Middleware('permission:students-create', only: ['create','store']),
                    new Middleware('permission:students-edit', only: ['edit','update']),
                    new Middleware('permission:students-delete', only: ['destroy']),
                    new Middleware('permission:students-view', only: ['show']),
                ];
            }

            return parent::middleware($middleware, $options);
        }
    
    public function index()
    {
        $students =  DB::table('students')->get();
        return $this->admin_construct('students.index', ['students' => $students]);
    }


    public function create()
    {
        $provinces =  DB::table('provinces')->get();
        return $this->admin_construct('students.add', ['provinces' => $provinces]);
    }


    public function store(Request $request)
    {
        $valid = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'pob' => 'required',
        ]);

        // $reference_code = Str::random(10);
        $reference_code = reference_no('student', 10);
        
        $slug = Str::random(40);

        $data =  [
            'code'          => $reference_code,
            'slug'          => $slug,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'nick_name'     => $request->nick_name,
            'gender'        => $request->gender,
            'dob'           => $request->dob,
            'pob'           => $request->pob,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'father_phone'  => $request->father_phone,
            'mother_phone'  => $request->mother_phone,
            'shift'         => $request->shift,
            'batch'         => $request->batch,
            'skills'        => $request->skills,
            'province_id'   => $request->province_id,
            'description' => clear_tag($request->description),
        ];

        if($data['gender'] == 'male') {
            $filename = 'male.png';
            $data['image'] = $filename;
        } elseif($data['gender'] == 'female') {
            $filename = 'female.png';
            $data['image'] = $filename;
        }

        if (!empty($request->image)) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', (time() . '.' . $extension));
            $file->move(public_path('uploads/student/'), $filename);
            $data['image'] = $filename;
        }

        if(DB::table('students')->insert($data)) {
            return admin_redirect('peoples/students')->with('success', __('message.student_added'));
        } else {
            return admin_redirect('peoples/students')->with('error', __('message.student_add_fail'));
        }
    }

    public function show($id)
    {
        $student  = DB::table('students')->where('id', $id)->first();
        return response()->json($student);
    }

    public function edit($id)
    {
        $provinces = DB::table('provinces')->get();
        $student = DB::table('students')->where('id', $id)->first();
        return $this->admin_construct('students.edit', ['student' => $student, 'provinces' => $provinces]);
    }

    public function update(Request $request, $id)
    {
        $data =  [
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'nick_name'     => $request->nick_name,
            'dob'           => $request->dob,
            'pob'           => $request->pob,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'father_phone'  => $request->father_phone,
            'mother_phone'  => $request->mother_phone,
            'province_id'   => $request->province_id,
            'shift'         => $request->shift,
            'batch'         => $request->batch,
            'skills'        => $request->skills,
            'description'   => clear_tag($request->description),
        ];

        if (!empty($request->image)) {

            $old_image =  DB::table('students')->where('id', $id)->first()->image;
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', (time() . '.' . $extension));
            $file->move(public_path('uploads/student/'), $filename);
            $data['image'] = $filename;

            if ($old_image != '') {
                unlink(public_path('uploads/student/' . $old_image));
            }
        }

        DB::table('students')->where('id', $id)->update($data);

        return admin_redirect('peoples/students')->with('success', __('message.student_updated'));
    }

    public function destroy($id)
    {
        if(DB::table('attendances')->where('id',$id) || DB::table('borrowers')->where('id',$id)) {
            return admin_redirect('peoples/students')->with('error', __('message.student_has_been'));
        } else {

            $delete_image = DB::table('students')->where('id', $id)->first();

            DB::table('students')->where(['id' => $id])->delete();

            if ($delete_image->image !== 'female.png' || $delete_image->image !== 'male.png') {
                unlink(public_path('uploads/student/' . $delete_image->image));
            }
        }
        
        return admin_redirect('peoples/students')->with('success', __('message.student_deleted'));
    }
}
