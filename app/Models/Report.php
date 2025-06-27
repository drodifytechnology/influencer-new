<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reported_id',
        'service_id',
        'reason_id',
        'notes'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reported_user() {
        return $this->belongsTo(User::class, 'reported_id');
    }

    public function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function reason() {
        return $this->belongsTo(Option::class, 'reason_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'reported_id' => 'integer',
        'service_id' => 'integer',
        'reason_id' => 'integer',
    ];
}
