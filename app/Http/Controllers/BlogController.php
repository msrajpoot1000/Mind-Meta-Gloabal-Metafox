<?php

namespace App\Http\Controllers;
use App\Models\Blog;

use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Productcategory;
class BlogController extends Controller
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
        return view('user.pages.blog');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
       return view('admin.pages.blog', compact('blogs'));
        
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
        'title' => 'required',
        'blog_date' => 'required|date',
        'description' => 'required',
        'blog_image' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['title', 'blog_date', 'description']);

    if ($request->hasFile('blog_image')) {
        $folder = 'upload/blog';
        $path = public_path($folder);

        // Create folder if not exists
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('blog_image');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        // Move file to public/upload/blog
        $file->move($path, $filename);

        // Store relative path in DB
        $data['blog_image'] = $folder . '/' . $filename;
    }

    Blog::create($data);

    return redirect()->route('admin-blog.index')->with('success', 'Blog created successfully!');
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
    // dd($id);
    // Fetch the blog by ID or fail with 404 if not found
    $blog = Blog::findOrFail($id);

    // Pass the blog to the edit view
    return view('admin.pages.blog-edit', compact('blog'));
}


    /**
     * Update the specified resource in storage.
     */
    
public function update(Request $request, $id)
{
    $blog = Blog::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'blog_date' => 'required|date',
        'description' => 'required|string',
        'blog_image' => 'nullable|image|max:2048', // 2MB max
    ]);

    $data = $request->only(['title', 'blog_date', 'description']);

    // Handle new image upload
    if ($request->hasFile('blog_image')) {
        $folder = 'upload/blog';
        $path = public_path($folder);

        // Delete old image if exists
        if ($blog->blog_image && file_exists(public_path($blog->blog_image))) {
            unlink(public_path($blog->blog_image));
        }

        // Create folder if not exists
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // Save new image
        $file = $request->file('blog_image');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $filename);

        $data['blog_image'] = $folder . '/' . $filename;
    }

    // Update blog
    $blog->update($data);

    return redirect()->route('admin-blog.index')->with('success', 'Blog updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);

        // Delete image file if it exists
        if ($blog->blog_image && file_exists(public_path($blog->blog_image))) {
            unlink(public_path($blog->blog_image));
        }
    
        // Delete blog entry from the database
        $blog->delete();
    
        return redirect()->route('admin-blog.index')->with('success', 'Blog deleted successfully!');
    }
}
