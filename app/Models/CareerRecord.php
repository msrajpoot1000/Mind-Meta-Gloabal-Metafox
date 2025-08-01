<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerRecord extends Model
{
     protected $fillable = [
        'name',
        'email',
        'country_code',
        'phone',
        'resume_path',
        'job_type',
        'message',
    ];
}
