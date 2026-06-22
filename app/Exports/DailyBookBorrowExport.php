<?php

namespace App\Exports;

use App\Models\Borrower;
use Maatwebsite\Excel\Concerns\FromCollection;

class DailyBookBorrowExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Borrower::all();
    }
}
