<?php
 namespace App\Http\Controllers;
 use App\Models\Blog;
 use App\Models\Testimonial;
 
 use Illuminate\Http\Request;
 use App\Models\Product;
 
 use App\Models\Productcategory;
 use App\Models\ContentPagesContent;
 class CookiePolicyController extends Controller
 {
 
     public function indexF()
     {   
        $privacyPolicy=ContentPagesContent::where('type','privacy_policy')->first();
         return view('user.pages.privacy-policy',compact('privacyPolicy'));
     }
     /**
      * Display a listing of the resource.
      */
     public function index()
     {
        $contentPagesContents = ContentPagesContent::orderBy('created_at', 'desc')->get();
        return view('admin.pages.privacy-policy', compact('contentPagesContents'));
 
     }
 
    
     
     public function edit(string $id)
 {
    
     // Fetch the blog by ID or fail with 404 if not found
     $privacyPolicy = ContentPagesContent::findOrFail($id);
     // $blog = Blog::findOrFail($id);
     return view('admin.pages.privacy-policy-edit', compact('privacyPolicy'));
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
      
          return redirect()->route('admin-privacy-policy.index')->with('success', 'Testimonial updated successfully!');
      }
 }
 
