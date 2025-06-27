<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected  $fillable = [
        'invoice_no',
        'paid_by',
        'paid_to',
        'type_id',
        'category_id',
        'date',
        'amount',
        'notes',
    ];

    public function expense_category() {

        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

    public function payment_type() {

        return $this->belongsTo(Option::class, 'type_id');
    }


    public function user() {

        return $this->belongsTo(User::class, 'paid_to');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'double',
        'paid_by' => 'integer',
        'paid_to' => 'integer',
        'type_id' => 'integer',
        'category_id' => 'integer',
    ];
}
