<?php
 namespace App\Http\Controllers;
 use App\Models\Blog;
 use App\Models\Testimonial;
 
 use Illuminate\Http\Request;
 use App\Models\Product;
 
 use App\Models\Productcategory;
 use App\Models\ContentPagesContent;
 class ContentPagesController extends Controller
 {
 
     public function privacyPolicy()
     {   
        $item=ContentPagesContent::where('type','privacy_policy')->first();
         return view('user.pages.default-page.privacy-policy',compact('item'));
     }

     public function cookiePolicy()
     {   
        $item=ContentPagesContent::where('type','cookie_policy')->first();
         return view('user.pages.default-page.cookie-policy',compact('item'));
     }

     public function termsConditions()
     {   
        $item=ContentPagesContent::where('type','terms_conditions')->first();
         return view('user.pages.default-page.terms-conditions',compact('item'));
     }

    
     public function index()
     {
        $contentPagesContents = ContentPagesContent::orderBy('created_at', 'desc')->get();
        return view('admin.pages.content-pages', compact('contentPagesContents'));
 
     }
 
    
     
     public function edit(string $id)
 {
    
     // Fetch the blog by ID or fail with 404 if not found
     $contentPage = ContentPagesContent::findOrFail($id);
     $pageName="";
     if($contentPage->type==='privacy_policy'){
        $pageName="Privacy Policy";
     }else if($contentPage->type==='cookie_policy'){
        $pageName="Privacy Policy";
     }else{
        $pageName="Terms & Conditions";
     }
     return view('admin.pages.content-pages-edit', compact('contentPage','pageName'));
 }
 
 
     /**
      * Update the specified resource in storage.
      */
     
      public function update(Request $request, $id)
      {
          $content = ContentPagesContent::findOrFail($id);
      
          $request->validate([
              'type'     => 'required|string|max:255',
              'heading' => 'required|string|max:255',
              'description'     => 'required|string',
          ]);
      
          $data = $request->only([
              'type',
              'heading',
              'description'
          ]);
      
         
      
          // Update testimonial
          $content->update($data);
      
          return redirect()->route('admin-content-pages.index')->with('success', 'Testimonial updated successfully!');
      }
 }
 