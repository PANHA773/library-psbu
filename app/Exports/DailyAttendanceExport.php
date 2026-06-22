<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class DailyAttendanceExport implements FromQuery
{
    use Exportable;
    public $daily;

    public function __construct($daily)
    {
        $this->daily = $daily;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Attendance::all();
    // }

    public function query()
    {
        return Attendance::query()->whereYear('created_at', $this->daily);
    }
}
