<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tree1 extends Model {
    protected $fillable = ['img1', 'img2', 'img3', 'description1', 'description2', 'description3', 'name', 'is_active'];
    public function subTree2s()
    {
        return $this->hasMany(SubTree2::class);
    }

    //
}
