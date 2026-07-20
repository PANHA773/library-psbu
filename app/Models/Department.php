<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = [
        'name',
        'code',
        'description',
        'email',
        'phone',
        'address',
        'is_active',
        'avatar',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the books uploaded by this department.
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'department_id');
    }

    /**
     * Get the users (accounts) belonging to this department.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'department_id');
    }
}
