<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Exports\BookExport;
use App\Exports\BorrowerExport;
use App\Exports\AttendanceExport1;
use App\Exports\DailyAttendanceExport;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Routing\Controllers\Middleware;

class ReportController extends Controller
{
        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher'),
                new Middleware('permission:report-books', only: ['books']),
                new Middleware('permission:report-users', only: ['users']),
                new Middleware('permission:report-download-export', only: ['download_export']),
                new Middleware('permission:role-delete', only: ['destroy']),
                new Middleware('permission:report-daily_attendances', only: ['daily_attendances']),
                new Middleware('permission:report-daily_attendance_report_export', only: ['daily_attendance_report_export']),
                new Middleware('permission:report-daily_borrower_report_export', only: ['daily_borrower_report_export']),
                new Middleware('permission:report-book_report_export', only: ['book_report_export']),
                new Middleware('permission:report-daily_attendances', only: ['daily_attendances']),
                new Middleware('permission:report-daily_attendances', only: ['daily_borrower_report_export']),
                new Middleware('permission:report-borrowers', only: ['borrowers']),
                new Middleware('permission:report-user_report_export', only: ['user_report_export']),
                new Middleware('permission:report-categories', only: ['categories']),
                new Middleware('permission:report-daily_attendances', only: ['daily_attendances']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    public function books(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $books =  DB::table('books')
                ->join('categories', 'books.category_id', '=', 'categories.id')
                ->join('category_langs', 'books.category_lang_id', '=', 'category_langs.id')
                ->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$request->start_date, $request->end_date])
                ->select('books.*', 'categories.name as category_name', 'category_langs.name as cate_lang_name')
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $books =  DB::table('books')
                ->join('categories', 'books.category_id', '=', 'categories.id')
                ->join('category_langs', 'books.category_lang_id', '=', 'category_langs.id')
                ->select('books.*', 'categories.name as category_name', 'category_langs.name as cate_lang_name')
                ->orderBy('id', 'desc')
                ->get();
        }

        return $this->admin_construct('reports.books', ['books' => $books]);
    }


    public function users(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $users = DB::table('users')
                ->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$request->start_date, $request->end_date])
                ->get();
        } else {
            $users = DB::table('users')
                ->get();
        }
        return $this->admin_construct('reports.users', ['users' => $users]);
    }

    public function download_export()
    {
        return Excel::download(new UsersExport, 'users.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function daily_attendance_report_export()
    {
        return Excel::download(new AttendanceExport, 'daily_attendances.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function daily_borrower_report_export()
    {
        return Excel::download(new BorrowerExport, 'daily_borrowers.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function book_report_export()
    {
        return Excel::download(new BookExport, 'book.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function user_report_export()
    {
        return Excel::download(new UsersExport, 'daily_attendances.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }


    public function borrowers(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $borrowers = DB::table('borrowers')
                ->join('students', 'borrowers.student_id', '=', 'students.id')
                ->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$request->start_date, $request->end_date])
                ->select(
                    'borrowers.reference_no',
                    'borrowers.term',
                    DB::raw("concat(first_name,' ',last_name) as student_name"),
                    'students.gender as student_gender',
                    'students.phone as student_phone',
                    'students.image',
                    'borrowers.id',
                    'borrowers.status',
                    'borrowers.created_at'
                )
                ->get();
        } else {
            $borrowers = DB::table('borrowers')
                ->join('students', 'borrowers.student_id', '=', 'students.id')
                ->select(
                    'borrowers.reference_no',
                    'borrowers.term',
                    DB::raw("concat(first_name,' ',last_name) as student_name"),
                    'students.gender as student_gender',
                    'students.phone as student_phone',
                    'students.image',
                    'borrowers.id',
                    'borrowers.status',
                    'borrowers.created_at'
                )
                ->get();
        }

        return $this->admin_construct('reports.borrowers', ['borrowers' => $borrowers]);
    }


    public function categories(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $categories = DB::table('categories as c')
                ->leftJoin('categories as pc', 'pc.parent_id', '=', 'c.id')
                ->whereBetween(DB::raw('DATE_FORMAT("c.created_at", "%Y-%m-%d")'), [$request->start_date, $request->end_date])
                ->select('c.*', 'pc.name as parent_name')
                ->get();
        } else {
            $categories = DB::table('categories')
                ->leftJoin('categories as pc', 'categories.id', '=', 'pc.parent_id')
                ->select('categories.*', 'pc.name as parent_name')
                ->get();
        }

        return $this->admin_construct('reports.categories', ['categories' => $categories]);
    }


    public function category_languages(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $category_langs = DB::table('category_langs')
                ->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$request->start_date, $request->end_date])
                ->get();
        } else {
            $category_langs = DB::table('category_langs')
                ->get();
        }

        return $this->admin_construct('reports.category_languages', ['category_langs' => $category_langs]);
    }

    public function attendances(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $attendances = DB::table('attendances')
                ->join('students', 'attendances.student_id', '=', 'students.id')
                ->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$request->start_date, $request->end_date])
                ->select('students.*')
                ->get();
        } else {
            $attendances = DB::table('attendances')
                ->join('students', 'attendances.student_id', '=', 'students.id')
                ->select('students.image', 'students.code', DB::raw("concat(first_name ,' ',last_name) as student_name"), 'students.gender as student_gender', 'students.phone as student_phone', 'attendances.created_at')
                ->get();
        }

        return $this->admin_construct('reports.attendances', ['attendances' => $attendances]);
    }

    // daily attendance report 
    public function daily_attendances(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $daily_attendances = DB::table('attendances')
                ->join('students', 'attendances.student_id', '=', 'students.id')
                ->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$request->start_date, $request->end_date])
                ->select('students.image', 'students.code', DB::raw("concat(first_name,' ', last_name) as student_name"), 'attendances.created_at', 'students.gender as student_gender')
                ->get();
        } else {
            $daily_attendances = DB::table('attendances')
                ->join('students', 'attendances.student_id', '=', 'students.id')
                ->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'))
                ->select('students.image', 'students.code', DB::raw("concat(first_name,' ', last_name) as student_name"), 'attendances.created_at', 'students.gender as student_gender')
                ->get();
        }

        return $this->admin_construct('reports.daily_attendances', ['daily_attendances' => $daily_attendances]);
    }

    public function daily_borrowers(Request $request)
    {
        $created_by = DB::table('users')->get();

        if ($request->start_date && $request->end_date || $request->created_by) {



            $daily_borrower = DB::table('borrowers')
                ->join('book_borrowers', 'borrowers.id', '=', 'book_borrowers.borrower_id')
                ->join('students', 'borrowers.student_id', '=', 'students.id')
                ->orWhere('borrowers.created_by', $request->created_by)
                ->orWhereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$request->start_date, $request->end_date])
                ->select('borrowers.*', 'students.image', DB::raw('CONCAT(first_name, " ",last_name) as student_name'), 'students.gender as student_gender', 'students.phone as student_phone')
                ->get();
        } else {
            $daily_borrower = DB::table('attendances')
                ->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d'))
                ->get();
        }


        return $this->admin_construct('reports.daily_borrowers', ['daily_borrower' => $daily_borrower, 'created_by' => $created_by]);
    }

    public function export_daily_attendance_report()
    {
        return (new DailyAttendanceExport(date('Y-m-d')))->download('invoices.xlsx');
    }

    public function export_daily_attendance_from_view_report()
    {
        return Excel::download(new AttendanceExport1, 'invoices.xlsx');
    }


    public function get_project()
    {
	    echo "testing project with vim editor";
    }

}
