<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HomeSlider;
use App\Models\Companyinfo;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\ContentPagesContent;


class IndexController extends Controller
{
    public function index()
    {    $faqs = Faq::orderBy('created_at', 'desc')->get();
        $sliders = HomeSlider::all();
        $testimonials = Testimonial::latest()->get();
        $companyinfos = Companyinfo::first();
        $blogs = Blog::all();
        return view('user.pages.index', compact('sliders', 'faqs', 'testimonials','companyinfos','blogs'));
    }

    public function about()
    {   
        $testimonials = Testimonial::latest()->get();
       
        return view('user.pages.about' , compact('testimonials'));
    }

    

    public function dumy()
    {   
       
        return view('user.pages.dumy');
    }



  
}
