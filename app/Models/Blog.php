<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {
    protected $fillable = ['blog_image', 'blog_title', 'blog_description', 'is_active'];
    //
}
