<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_no',
        'user_id',
        'amount',
        'type',
        'notes',
        'expense_id',
    ];

    public function expenseCategory () {
        return $this->belongsTo(ExpenseCategory::class,'category_id');
    }

    public function user () {
        return $this->belongsTo(User::class,'user_id');
    }

    protected $casts = ([
        'meta' => 'json',
        'amount' => 'double',
        'user_id' => 'integer',
        'expense_id' => 'integer',
    ]);
}
