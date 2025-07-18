<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companyinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'companyname',
        'client_name',
        'title',
        'description',
        'logo',
        'favicon',
        'email',
        'phone',
        'phone2',
        'phone3',
        'address',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'linkedin',
        'pinterest',
    ];
}

