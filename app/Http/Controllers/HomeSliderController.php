<?php
namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Testimonial;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\HomeSlider;

use App\Models\Productcategory;
class HomeSliderController extends Controller
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
        $homeSliders = HomeSlider::orderBy('created_at', 'desc')->get();
       return view('admin.pages.home-slider', compact('homeSliders'));

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
            'title'     => 'required|string|max:255',
            'description'     => 'required|string',
            'image'           => 'nullable|image|max:2048',
            'status'          => 'nullable|boolean',
        ]);
    
        $data = $request->only([
            'title',
            'description',
            'status',
        ]);
    
        if ($request->hasFile('image')) {
            $folder = 'upload/HomeSlider';
            $path = public_path($folder);
    
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
    
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
    
            $data['image'] = $folder . '/' . $filename;
        }
    
        HomeSlider::create($data);
    
        return redirect()->route('admin-home-slider.index')->with('success', 'Item added successfully!');
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
    $homeSliders = HomeSlider::findOrFail($id);
    // $blog = Blog::findOrFail($id);
    return view('admin.pages.home-slider-edit', compact('homeSliders'));
}


    /**
     * Update the specified resource in storage.
     */
    
     public function update(Request $request, $id)
     {
        $homeSlider = HomeSlider::findOrFail($id);

        $request->validate([
            'title'     => 'required|string|max:255',
            'description'     => 'required|string',
            'image'           => 'nullable|image|max:2048',
            'status'          => 'nullable|boolean',
        ]);
    
        $data = $request->only([
            'title',
            'description',
            'status',
        ]);
     
         // Handle new photo upload
         if ($request->hasFile('image')) {
             $folder = 'upload/HomeSlider';
             $path = public_path($folder);
     
             // Delete old photo if it exists
             if ($homeSlider->image && file_exists(public_path($homeSlider->photo))) {
                 unlink(public_path($homeSlider->image));
             }
     
             // Create folder if not exists
             if (!file_exists($path)) {
                 mkdir($path, 0777, true);
             }
     
             // Save new photo
             $file = $request->file('image');
             $filename = uniqid() . '.' . $file->getClientOriginalExtension();
             $file->move($path, $filename);
     
             $data['image'] = $folder . '/' . $filename;
         }
     
         // Update HomeSlider
         $homeSlider->update($data);
     
         return redirect()->route('admin-home-slider.index')->with('success', 'Item updated successfully!');
     }
     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $homeSlider = homeSlider::findOrFail($id);

        // Delete image file if it exists
        if ($homeSlider->photo && file_exists(public_path($homeSlider->photo))) {
            unlink(public_path($homeSlider->photo));
        }
    
        // Delete blog entry from the database
        $homeSlider->delete();
    
        return redirect()->route('admin-home-slider.index')->with('success', 'Blog deleted successfully!');
    }
}
