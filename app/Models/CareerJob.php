<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerJob extends Model
{
    protected $fillable = ['job_name', 'job_description', 'is_active', 'ref_id'];
    public function career()
    {
        return $this->belongsTo(Career::class, 'ref_id');
    }

    public function subCategories()
    {
        return $this->hasMany(CareerJob::class, 'ref_id');
    }

}