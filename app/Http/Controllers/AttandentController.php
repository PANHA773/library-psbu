<?php

namespace App\Http\Controllers;

use App\Models\Attandent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;

class AttandentController extends Controller
{
    public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher'),
                new Middleware('permission:attendance-index', only: ['index']),
                new Middleware('permission:attendance-create', only: ['create','store']),
                new Middleware('permission:attendance-edit', only: ['edit','update']),
                new Middleware('permission:attendance-delete', only: ['destroy']),
            ];
        }
        return parent::middleware($middleware, $options);
    }


    public function index()
    {
        $attendances = DB::table('attendances')
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->select(
                'attendances.*',
                DB::Raw("CONCAT(nan_students.first_name, ' ',nan_students.last_name) AS student_name"),
                'students.gender as student_gender',
                'students.skills as student_skills',
                'students.batch as student_batch',
                'students.shift as student_shift'
            )
            ->orderBy('id', 'desc')
            ->get();

        return $this->admin_construct('attendance.index', ['attendances' => $attendances]);
    }


    public function create()
    {
        return $this->admin_construct('attendance.add');
    }


    public function store(Request $request)
    {
        $valid = $request->validate([
            'student_id' => 'required',
        ]);

        $i = 0;

        foreach ($request->student_id as $student) {
            $code =  reference_no('attendance', 8);

            $data =  [
                'code' => $code,
                'student_id' => $request->student_id[$i],
                'checkin_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            DB::table('attendances')->insert($data);

            $i++;
        }
        session(['remove_br' => 1]);
        return admin_redirect('attendances')->with('success', __('admin.attendance_added'));
    }

    public function get_students($code)
    {
        $pr = [];
        $rows = DB::table('students')
            ->where('code', 'LIKE', "%{$code}%")
            ->get();

        if (!empty($rows)) {
            $r = 0;
            foreach ($rows as $row) {
                // unset($row->created_by, $row->created_at, $row->updated_at, $row->details, $row->slug, $row->views, $row->author, $row->author_date,$row->category_lang_id,$row->category_id);
                $c = uniqid(mt_rand(), true);
                $pr[] = ['mt_rand' => mt_rand(), 'id' => sha1($c . $r), 'student_id' => $row->id, 'label' => $row->first_name . ' (' . $row->code . ')', 'row' => $row];
                $r++;
            }
        }

        if ($pr) {
            return response()->json($pr);
        } else {
            return response()->json([['id' => 0, 'label' => __('no_match_found')]]);
        }
    }


    public function show($id)
    {
        $attendance = DB::table('attendances')
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->where('attendances.id', $id)
            ->select('students.*', 'attendances.code', 'attendances.created_at')
            ->first();

        return response()->json($attendance);
    }

    // public function edit(Attandent $attandent, $id)
    // {
    //     $attendance = DB::table('attendances')->where('id', $id)->first();
    //     return view('attendance.edit', ['attendance' => $attendance]);
    // }

    public function update(Request $request, Attandent $attandent, $id)
    {
        $valid = $request->validate([
            'student_id' => 'required',
        ]);

        $i = 0;

        foreach ($request->student_id as $student) {

            $data =  [

                'student_id' => $request->student_id[$i],
                'checkin_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            DB::table('attendances')->where('id', $id)->update($data);

            $i++;
        }

        session(['remove_br' => 1]);

        return admin_redirect('settings/provinces')->with('success', __('admin.province_added'));
    }

    public function destroy($id)
    {
        DB::table('attendances')->where(['id' => $id])->delete();
        return admin_redirect('attendances')->with('success', __('attendance_deleted!'));
    }
}
