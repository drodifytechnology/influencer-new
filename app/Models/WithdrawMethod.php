<?php

namespace App\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WithdrawMethod extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'currency_id', 'min_amount', 'max_amount', 'charge', 'charge_type', 'instructions', 'meta','status'];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    protected $casts = [
        'meta' => 'json',
        'min_amount' => 'double',
        'max_amount' => 'double',
        'charge' => 'double',
        'currency_id' => 'integer',
        'status' => 'integer',
    ];
}
