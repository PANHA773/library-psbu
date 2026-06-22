<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable =  ['code', 'student_id', 'checkin_at', 'note', 'created_by', 'created_at', 'updated_at'];
}
