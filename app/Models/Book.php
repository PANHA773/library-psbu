<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'code',
        'title',
        'image',
        'pdf',
        'pdf_downloadable',
        'details',
        'slug',
        'views',
        'author',
        'author_date',
        'category_lang_id',
        'category_id',
        'created_by',
        'created_at',
        'updated_at'
    ];
}
