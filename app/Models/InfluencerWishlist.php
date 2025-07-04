<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerWishlist extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id',
        'influencer_id'
    ];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
    public function influencer() {
        return $this->belongsTo(User::class,'influencer_id');
    }

}
