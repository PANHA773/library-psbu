<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\Middleware;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher'),
                new Middleware('permission:dashboard-index', only: ['dashboard']),
            ];
        }
        return parent::middleware($middleware, $options);
    }

    public function __construct()
    {
        $locale_current = request()->cookie("language");
        Session::put("locale", $locale_current);
    }

    public function dashboard()
    {
        // ── Summary counts ──
        $books       = DB::table('books')->count();
        $borrowers   = DB::table('borrowers')->count();
        $attendances = DB::table('attendances')->count();
        $students    = DB::table('students')->count();
        $users       = DB::table('users')->count();

        // ── Today counts ──
        $today = Carbon::today()->toDateString();
        $todayBorrowers   = DB::table('borrowers')->whereDate('created_at', $today)->count();
        $todayAttendances = DB::table('attendances')->whereDate('created_at', $today)->count();
        $todayBooks       = DB::table('books')->whereDate('created_at', $today)->count();

        // ── Monthly borrowers (last 6 months) ──
        $monthlyBorrowers = [];
        $monthlyLabels    = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyLabels[]    = $month->format('M');
            $monthlyBorrowers[] = DB::table('borrowers')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        // ── Monthly attendances (last 6 months) ──
        $monthlyAttendances = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyAttendances[] = DB::table('attendances')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        // ── Monthly new books (last 6 months) ──
        $monthlyBooks = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyBooks[] = DB::table('books')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        // ── Top categories by book count ──
        $topCategories = DB::table('books')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('count(*) as total'))
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // ── Recent borrowers ──
        $recentBorrowers = DB::table('borrowers')
            ->join('students', 'borrowers.student_id', '=', 'students.id')
            ->select('borrowers.*', 'students.first_name', 'students.last_name', 'students.image as student_image')
            ->orderByDesc('borrowers.created_at')
            ->limit(5)
            ->get();

        // ── Borrower status breakdown ──
        $borrowedCount = DB::table('borrowers')->where('status', 'borrowed')->count();
        $repayedCount  = DB::table('borrowers')->where('status', 'repayed')->count();
        $pendingCount  = DB::table('borrowers')->where('status', 'pending')->count();

        return $this->admin_construct('dashboard', [
            'books'               => $books,
            'borrowers'           => $borrowers,
            'attendances'         => $attendances,
            'students'            => $students,
            'users'               => $users,
            'todayBorrowers'      => $todayBorrowers,
            'todayAttendances'    => $todayAttendances,
            'todayBooks'          => $todayBooks,
            'monthlyLabels'       => json_encode($monthlyLabels),
            'monthlyBorrowers'    => json_encode($monthlyBorrowers),
            'monthlyAttendances'  => json_encode($monthlyAttendances),
            'monthlyBooks'        => json_encode($monthlyBooks),
            'topCategories'       => $topCategories,
            'recentBorrowers'     => $recentBorrowers,
            'borrowedCount'       => $borrowedCount,
            'repayedCount'        => $repayedCount,
            'pendingCount'        => $pendingCount,
        ]);
    }
}
