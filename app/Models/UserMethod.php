<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMethod extends Model
{
    protected $fillable = [
        'method_id',
        'user_id',
        'infos',
        'notes',
        'account_no'
    ];

    use HasFactory;

    function withdraw_method()
    {
        return $this->belongsTo(WithdrawMethod::class, 'method_id');
    }

    protected $casts = [
        'infos' => 'json',
        'method_id' => 'integer',
        'user_id' => 'integer',
    ];
}
