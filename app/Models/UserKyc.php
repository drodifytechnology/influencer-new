<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKyc extends Model
{
    use HasFactory;
      
    protected $fillable = [
        'user_id',
        'document_type',
        'document_number',
        'otp',
        'file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
