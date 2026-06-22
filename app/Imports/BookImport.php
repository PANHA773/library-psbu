<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;


class BookImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $id = Auth::id();

        return new Book([
            'code'              => $row[0],
            'title'             => $row[1],
            'slug'              => $row[2],
            'author'            => $row[3],
            'author_date'       => $row[4],
            'category_lang_id'  => $row[5],
            'category_id'       => $row[6],
            'created_by'        => $id,
        ]);
    }
}
