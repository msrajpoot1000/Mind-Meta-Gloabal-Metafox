<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinService extends Model {
    protected $fillable = ['name', 'is_active'];
    public function finServicePages()
{
    return $this->hasMany(FinServicePage::class, 'ref_id');
}


    //
}
