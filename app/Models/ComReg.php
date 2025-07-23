<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComReg extends Model {
    protected $fillable = ['name', 'is_active'];
    public function comRegPages()
    {
        return $this->hasMany(ComRegPage::class, 'ref_id');
    }

    //
}
