<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'status',
        'reason',
        'meta'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }

    protected $casts = [
        'meta' => 'json',
        'status' => 'integer',
        'order_id' => 'integer',
    ];
}
