<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions';
    protected $primaryKey = 'session_id';

    protected $fillable = [
        'name',
        'number',
    ];

    /**
     * Get the requests associated with the session.
     */
    public function requests()
    {
        return $this->hasMany(Request::class, 'session_id', 'session_id');
    }
}
