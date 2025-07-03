<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'service_id',
        'rating',
        'description',
        'image',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    protected $casts = [
        'rating' => 'double',
        'order_id' => 'integer',
        'service_id' => 'integer',
        'user_id' => 'integer',
    ];
}
