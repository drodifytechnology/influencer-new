<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'support_id',
        'priority',
        'attachment',
        'message',
        'ticket_no',
        'status',
        'user_id',
        'has_new',
    ];

    public function messages()
    {
        return $this->hasMany(Support::class, 'support_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'has_new' => 'boolean',
        'user_id' => 'integer',
        'support_id' => 'integer',
    ];
}
