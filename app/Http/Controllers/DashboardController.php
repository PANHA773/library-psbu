<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $locale_current = request()->cookie("language");
        Session::put("locale", $locale_current);
    }

    public function dashboard()
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'You are not allowed to access this page.');
        }

        if ($user->user_type === 'department') {
            // Department users are allowed to view the dashboard summary.
        } elseif ($user->user_type === 'admin') {
            // Admin users are allowed to view the dashboard summary.
        } elseif (!method_exists($user, 'hasAnyRole') || !$user->hasAnyRole(['Owner', 'Admin', 'Teacher'])) {
            abort(403, 'You are not allowed to access this page.');
        }

        $metrics = Cache::remember('dashboard.metrics', now()->addMinutes(10), function () {
            $books = DB::table('books')->count();
            $borrowers = DB::table('borrowers')->count();
            $attendances = DB::table('attendances')->count();
            $students = DB::table('students')->count();
            $users = DB::table('users')->count();

            $todayStart = Carbon::today()->startOfDay()->toDateTimeString();
            $todayEnd = Carbon::today()->endOfDay()->toDateTimeString();

            $todayBorrowers = DB::table('borrowers')->whereBetween('created_at', [$todayStart, $todayEnd])->count();
            $todayAttendances = DB::table('attendances')->whereBetween('created_at', [$todayStart, $todayEnd])->count();
            $todayBooks = DB::table('books')->whereBetween('created_at', [$todayStart, $todayEnd])->count();

            $monthlyLabels = [];
            $monthlyBorrowers = [];
            $monthlyAttendances = [];
            $monthlyBooks = [];

            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $monthStart = $month->copy()->startOfMonth()->toDateTimeString();
                $monthEnd = $month->copy()->endOfMonth()->toDateTimeString();

                $monthlyLabels[] = $month->format('M');
                $monthlyBorrowers[] = DB::table('borrowers')->whereBetween('created_at', [$monthStart, $monthEnd])->count();
                $monthlyAttendances[] = DB::table('attendances')->whereBetween('created_at', [$monthStart, $monthEnd])->count();
                $monthlyBooks[] = DB::table('books')->whereBetween('created_at', [$monthStart, $monthEnd])->count();
            }

            $topCategories = DB::table('books')
                ->join('categories', 'books.category_id', '=', 'categories.id')
                ->select('categories.id', 'categories.name', DB::raw('count(*) as total'))
                ->groupBy('categories.id', 'categories.name')
                ->orderByDesc('total')
                ->limit(5)
                ->get();

            $recentBorrowers = DB::table('borrowers')
                ->join('students', 'borrowers.student_id', '=', 'students.id')
                ->select('borrowers.*', 'students.first_name', 'students.last_name', 'students.image as student_image')
                ->orderByDesc('borrowers.created_at')
                ->limit(5)
                ->get();

            $borrowedCount = DB::table('borrowers')->where('status', 'borrowed')->count();
            $repayedCount = DB::table('borrowers')->where('status', 'repayed')->count();
            $pendingCount = DB::table('borrowers')->where('status', 'pending')->count();

            return [
                'books' => $books,
                'borrowers' => $borrowers,
                'attendances' => $attendances,
                'students' => $students,
                'users' => $users,
                'todayBorrowers' => $todayBorrowers,
                'todayAttendances' => $todayAttendances,
                'todayBooks' => $todayBooks,
                'monthlyLabels' => json_encode($monthlyLabels),
                'monthlyBorrowers' => json_encode($monthlyBorrowers),
                'monthlyAttendances' => json_encode($monthlyAttendances),
                'monthlyBooks' => json_encode($monthlyBooks),
                'topCategories' => $topCategories,
                'recentBorrowers' => $recentBorrowers,
                'borrowedCount' => $borrowedCount,
                'repayedCount' => $repayedCount,
                'pendingCount' => $pendingCount,
            ];
        });

        return $this->admin_construct('dashboard', $metrics);
    }
}
