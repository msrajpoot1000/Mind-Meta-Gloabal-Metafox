<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTree3 extends Model
{
    protected $fillable = ['photo', 'photo322', 'description1', 'description2', 'name', 'is_active', 'ref_id'];
    public function tree1()
    {
        return $this->belongsTo(Tree1::class, 'ref_id');
    }

    public function subCategories()
    {
        return $this->hasMany(SubTree3::class, 'ref_id');
    }

}