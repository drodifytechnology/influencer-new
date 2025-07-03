<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'business_type',
        'name',
        'gst',
        'cin',
        'pan',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

