<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    
    protected $fillable = ['name','status'];

    public function subIndustries()
    {
        return $this->hasMany(SubIndustry::class);
    }

}


