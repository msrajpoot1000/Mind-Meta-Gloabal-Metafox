<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Industry::orderBy('created_at', 'desc')->get();
        return view('admin.pages.industries', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Industry::create($request->only('name'));

        return redirect()->route('admin-industries.index')->with('success', 'Item created successfully.');
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

        $item = Industry::findOrFail($id);
        
        return view('admin.pages.industries-edit', compact('item'));
    }
        

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request);
        $industry = Industry::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean', // ✅ Add validation for status if it's a checkbox or dropdown
        ]);
    
        $industry->update($request->only('name', 'status'));
    
        return redirect()->route('admin-industries.index')->with('success', 'Item updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $industry = Industry::findOrFail($id);
        $industry->delete();
        return redirect()->route('admin-industries.index')->with('success', 'Item deleted successfully.');
    }
}

