<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model {
    protected $fillable = ['job_type', 'is_active'];
    public function careerJobs()
    {
        return $this->hasMany(CareerJob::class);
    }

    //
}
