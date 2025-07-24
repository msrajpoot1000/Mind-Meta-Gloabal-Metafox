<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function blogDetail($id){
   $blogs = Blog::latest()->take(10)->get();
     $blog = Blog::findOrFail($id);
     return view('user.pages.blog-detail',compact('blog','blogs'));

    }



    public function indexF()
    {
           $blogs = Blog::latest()->get();
        return view('user.pages.blog',compact('blogs'));
    }

    public function index()
    {
        $items = Blog::latest()->get();
  return view('admin.pages.blog', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'blog_image' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
        'blog_title' => 'required|string',
        'blog_description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        
        if ($request->hasFile('blog_image')) {
            $folder = 'upload/blogs';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('blog_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['blog_image'] = $folder . '/' . $filename;
        }

        Blog::create($data);
        return redirect()->route('admin-blog.index')->with('success', 'Blog created successfully.');
    }

    public function edit(string $id)
    {
        $item = Blog::findOrFail($id);
   return view("admin.pages.blog-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = Blog::findOrFail($id);

        $request->validate([
            'status_blog_image' => 'nullable|in:0,1',
        'blog_title' => 'required|string',
        'blog_description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['blog_title', 'blog_description', 'is_active']);

                $photoFields = ['blog_image'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/blogs';
                    $path = public_path($folder);
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }

                    $file = $request->file($field);
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($path, $filename);

                    $data[$field] = $folder . '/' . $filename;
                } else {
                    $data[$field] = $item->$field;
                }
            } else {
                if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                    unlink(public_path($item->$field));
                }

                $data[$field] = null;
            }
        }

        $item->update($data);

        return redirect()->route('admin-blog.index')->with('success', 'Blog updated successfully.');
    }

   public function destroy(string $id)
{
    $item = Blog::findOrFail($id);

        if (!empty($item->blog_image) && file_exists(public_path($item->blog_image))) {
            unlink(public_path($item->blog_image));
        }

    $item->delete();

    return redirect()->route('admin-blog.index')->with('success', 'Blog deleted successfully.');
}

}