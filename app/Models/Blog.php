<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'heading', 'title', 'blog_date', 'description', 'blog_image'
    ];
    
}
