<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class   User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'provider',
        'provider_id',
        'role',
        'username',
        'social_username',
        'city',
        'location',
        'primary_platform',
        'engagement_rate',
        'follower_count',
        'content_category',
        'email',
        'phone',
        'country',
        'image',
        'is_setupped',
        'status',
        'address',
        'bio',
        'balance',
        'reason',
        'lang_expertise',
        'socials',
        'password',
        'notify_allow',
        'device_token',
        'remember_token',
        'email_verified_at',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_user');
    }

    public function services()
    {                   
        return $this->hasMany(Service::class);
    }

    public function reviews()
    {
        return $this->hasManyThrough(Review::class, Service::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_setupped' => 'boolean',
        'balance' => 'double',
        'notify_allow' => 'boolean',
        'lang_expertise' => 'json',
        'password' => 'hashed',
        'socials' => 'json',
    ];
}
