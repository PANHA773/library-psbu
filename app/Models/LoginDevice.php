<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address',
        'device',
        'platform',
        'browser',
        'browser_version',
        'logged_in_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
