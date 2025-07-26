<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model {
    protected $fillable = ['name', 'is_active'];
    public function servicePages()
    {
        return $this->hasMany(ServicePage::class,'ref_id');
    }

    //
}
