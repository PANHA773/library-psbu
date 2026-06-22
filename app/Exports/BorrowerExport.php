<?php

namespace App\Exports;

use App\Models\Borrower;
use Maatwebsite\Excel\Concerns\FromCollection;

class BorrowerExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Borrower::all();
    }
}
