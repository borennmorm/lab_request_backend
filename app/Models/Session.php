<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions';
    protected $primaryKey = 'session_id'; // Only keep this if you are not using the default 'id' column

    protected $fillable = [
        'name',
        'number',
    ];

    /**
     * Get the requests associated with the session.
     */
    public function requests()
    {
        return $this->belongsToMany(Request::class, 'request_session');
    }
}
