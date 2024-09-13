<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $table = 'labs';

    protected $fillable = [
        'name',
        'building',
        'lab_status',
    ];

    /**
     * Get the requests associated with the lab.
     */
    public function requests()
    {
        return $this->hasMany(Request::class, 'lab_id');
    }
}
