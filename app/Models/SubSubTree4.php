<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubTree4 extends Model
{
    protected $fillable = [
        'photo', 'photo2', 'photo33', 'description1', 'description2', 'name', 'is_active', 'ref_id', 'ref_id'
    ];
    public function tree1()
    {
        return $this->belongsTo(Tree1::class, 'ref_id');
    }
    public function subTree2()
    {
        return $this->belongsTo(SubTree2::class, 'ref_id');
    }
}