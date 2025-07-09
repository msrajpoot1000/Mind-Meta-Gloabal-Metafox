<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Homeslider;
use App\Models\Companyinfo;
use App\Models\Blog;

use App\Models\Testimonial;

class IndexController extends Controller
{
    public function index()
    {   
        $sliders = Homeslider::all();
        $testimonials = Testimonial::latest()->get();
        $companyinfos = Companyinfo::first();
        $blogs = Blog::all();
        return view('user.pages.index', compact('sliders', 'testimonials','companyinfos','blogs'));
    }
}
