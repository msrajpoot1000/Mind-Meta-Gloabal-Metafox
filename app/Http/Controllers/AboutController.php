<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use App\Models\Product;

use App\Models\Allbanner;

use App\Models\Productcategory;

use App\Models\Companyinfo;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {   
        $banner = Allbanner::select('aboutimage')->first();
        $categories = Productcategory::all();
        $companyinfos = Companyinfo::first();
        return view('user.pages.aboutus', compact('banner', 'categories', 'companyinfos'));
    }
}
