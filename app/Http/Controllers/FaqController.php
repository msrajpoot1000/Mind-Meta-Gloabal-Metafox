<?php
namespace App\Http\Controllers;
use App\Models\Blog;

use Illuminate\Http\Request;
use App\Models\Faq;
class FaqController extends Controller
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
        
        $faqs = Faq::orderBy('created_at', 'desc')->get();
       return view('admin.pages.faq', compact('faqs'));

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
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'nullable|boolean',
        ]);
    
        $data = $request->only([
            'question',
            'answer',
            'status',
        ]);
    
      
        Faq::create($data);
    
        return redirect()->route('admin-faq.index')->with('success', 'Item added successfully!');
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
    $faq =Faq::findOrFail($id);
    // $blog = Blog::findOrFail($id);
    return view('admin.pages.faq-edit', compact('faq'));
}


    /**
     * Update the specified resource in storage.
     */
    
     public function update(Request $request, $id)
     {
        // dd($id);
         $faq = Faq::findOrFail($id);
     
         $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'nullable|boolean',
        ]);
    
        $data = $request->only([
            'question',
            'answer',
            'status',
        ]);
     
        
         // Update faq
         $faq->update($data);
     
         return redirect()->route('admin-faq.index')->with('success', 'Faq updated successfully!');
     }
     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = faq::findOrFail($id);

       
        // Delete blog entry from the database
        $faq->delete();
    
        return redirect()->route('admin-faq.index')->with('success', 'Faq deleted successfully!');
    }
}
