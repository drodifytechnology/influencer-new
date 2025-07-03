<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_method_id',
        'user_id',
        'amount',
        'charge',
        'status',
        'notes',
        'reason',
    ];

    function withdraw_method()
    {
        return $this->belongsTo(WithdrawMethod::class, 'user_method_id');
    }

    function account_info()
    {
        return $this->belongsTo(UserMethod::class, 'user_method_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'amount' => 'double',
        'charge' => 'double',
        'user_method_id' => 'integer',
        'user_id' => 'integer',
    ];
}
