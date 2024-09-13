<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'lab_id',
        'session_id',
        'user_id',
        'request_date',
        'major',
        'subject',
        'generation',
        'software_need',
        'number_of_student',
        'additional',
    ];

    /**
     * Get the lab that owns the request.
     */
    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }

    /**
     * Get the session that owns the request.
     */
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id', 'session_id');
    }

    /**
     * Get the user that made the request.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the approvals for the request.
     */
    public function approvals()
    {
        return $this->hasMany(Approval::class, 'request_id');
    }

    /**
     * Get the notifications for the request.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'request_id');
    }
}
