<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'admin_price',
        'category_id',
        'story',
        'reels',
        'post',
        'price',
        'final_price',
        'discount_type',
        'discount',
        'duration',
        'status',
        'description',
        'reason',
        'images',
        'features'
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected $casts = [
        'features' => 'json',
        'images' => 'json',
        'price' => 'double',
        'discount' => 'double',
        'final_price' => 'double',
        'user_id' => 'integer',
        'category_id' => 'integer',
    ];
}
