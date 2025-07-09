<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    use HasFactory;

    protected $table = 'forgot_passwords';

    protected $fillable = [
        'user_id',
        'otp',
    ];

    // Relation: Each forgot_password entry belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
