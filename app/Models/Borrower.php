<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_no',
        'student_id',
        'note',
        'status',
        'start_date',
        'end_date',
        'created_by',
        'created_at',
        'term'
    ];
}
