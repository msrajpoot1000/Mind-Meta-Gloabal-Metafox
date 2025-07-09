<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Productcategory;

class Contact extends Model
{
    protected $fillable = [
        'name', 
        'email', 
        'phone',
        'subject', 
        'message'
   ];
}
