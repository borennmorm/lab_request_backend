<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $table = 'approvals';

    protected $fillable = [
        'request_id',
        'is_approve',
    ];

    /**
     * Get the request that owns the approval.
     */
    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id');
    }
}
