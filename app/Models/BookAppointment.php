<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookAppointment extends Model
{
     protected $fillable = [
        'name', 'email', 'country_code', 'phone', 'user_date_time', 'timezone', 'message','admin_date_time'
    ];
}
