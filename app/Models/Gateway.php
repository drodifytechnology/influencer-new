<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mode',
        'data',
        'image',
        'status',
        'charge',
        'is_manual',
        'namespace',
        'accept_img',
        'manual_data',
        'currency_id',
        'instructions',
        'phone_required',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    protected $casts = [
        'data' => 'json',
        'manual_data' => 'json',
    ];
}
