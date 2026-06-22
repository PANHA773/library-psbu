<?php

namespace App\Exports;

use App\Models\CategoryLanguage;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoryLanguageExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CategoryLanguage::all();
    }
}
