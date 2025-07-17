<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Testimonial;

use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Productcategory;
class TestimonialContoller extends Controller
{

    public function blogDetails($id)
    {
        // dd($id);
           // Find blog by ID
           $blog = Blog::findOrFail($id); // Will throw 404 if not found

           // Return the view with blog data
           return view('user.pages.blog-details', compact('blog'));
    }

    public function indexF()
    {   
        return view('user.pages.testimonial');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
       return view('admin.pages.testimonial', compact('blogs','testimonials'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_name'     => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'description'     => 'required|string',
            'photo1'           => 'nullable|image|max:2048',
            'rating'          => 'nullable|integer|min:1|max:5',
            'status'          => 'nullable|boolean',
        ]);
    
        $data = $request->only([
            'client_name',
            'client_position',
            'description',
            'rating',
            'status',
        ]);
    
        if ($request->hasFile('photo1')) {
            $folder = 'upload/testimonials';
            $path = public_path($folder);
    
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
    
            $file = $request->file('photo1');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
    
            $data['photo1'] = $folder . '/' . $filename;
        }
    
        Testimonial::create($data);
    
        return redirect()->route('admin-testimonial.index')->with('success', 'Testimonial added successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
   
    // Fetch the blog by ID or fail with 404 if not found
    $testimonial = Testimonial::findOrFail($id);
    // $blog = Blog::findOrFail($id);
    return view('admin.pages.testimonial-edit', compact('testimonial'));
}


    /**
     * Update the specified resource in storage.
     */
    
     public function update(Request $request, $id)
     {

        // dd($request);
         $testimonial = Testimonial::findOrFail($id);
     
         $request->validate([
             'client_name'     => 'required|string|max:255',
             'client_position' => 'nullable|string|max:255',
             'description'     => 'required|string',
             'photo1'           => 'nullable|image|max:2048', // Max 2MB
             'rating'          => 'nullable|integer|min:1|max:5',
             'status'          => 'nullable|boolean',
         ]);
     
         $data = $request->only([
             'client_name',
             'client_position',
             'description',
             'rating',
             'status',
         ]);
     

       if ($request->status_photo1) {
            if ($request->hasFile('photo1')) {
            $folder = 'upload/testimonials';
            $path = public_path($folder);

        // Delete old photo if it exists
            if ($testimonial->photo1 && file_exists(public_path($testimonial->photo1))) {
                unlink(public_path($testimonial->photo1));
            }

        // Create folder if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

        // Save new photo
            $file = $request->file('photo1');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);

            $data['photo1'] = $folder . '/' . $filename;
            } else {
        // No new file uploaded, keep old one
                $data['photo1'] = $testimonial->photo1;
            }

        } 
        else {
    // If user clicked delete, remove the old image
            if ($testimonial->photo1 && file_exists(public_path($testimonial->photo1))) {
                unlink(public_path($testimonial->photo1));
            }

            // Set photo to null or empty
            $data['photo1'] = null;
        }

        
         // Update testimonial
         $testimonial->update($data);
     
         return redirect()->route('admin-testimonial.index')->with('success', 'Testimonial updated successfully!');
     }
     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Delete image file if it exists
        if ($testimonial->photo1 && file_exists(public_path($testimonial->photo1))) {
            unlink(public_path($testimonial->photo1));
        }
    
        // Delete blog entry from the database
        $testimonial->delete();
    
        return redirect()->route('admin-testimonial.index')->with('success', 'Blog deleted successfully!');
    }
}
