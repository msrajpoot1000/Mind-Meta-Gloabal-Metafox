<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubIndustry extends Model
{
    protected $fillable = ['name', 'industry_id','status'];

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
}
