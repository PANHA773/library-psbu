<?php

namespace App\Exports;

use App\Models\Attendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Cell;

class AttendanceExport1 implements FromView
{
    public function view(): View
    {
        return view('export.attendance', [
            'invoices' => Attendance::all()
        ]);
    }
}
