<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id'
    ];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function service() {
        return $this->belongsTo(Service::class,'service_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'service_id' => 'integer',
    ];
}
