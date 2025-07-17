<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTree2 extends Model
{
    protected $fillable = ['photo', 'photo2', 'photo3', 'description1', 'description2', 'name', 'is_active', 'ref_id'];
    public function tree1()
    {
        return $this->belongsTo(Tree1::class, 'ref_id');
    }

    public function subCategories()
    {
        return $this->hasMany(SubTree2::class, 'ref_id');
    }

}