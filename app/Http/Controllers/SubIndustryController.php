<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubIndustry;
use App\Models\Industry;

class SubIndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industries = Industry::all();
        $subIndustries = SubIndustry::with('industry')->get();
        return view('admin.pages.sub-industries', compact('subIndustries','industries'));
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
            'industry_id' => 'required|exists:industries,id',
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        SubIndustry::create($request->only('industry_id', 'name', 'status'));

        return redirect()->route('admin-sub-industries.index')->with('success', 'Sub-Industry created successfully.');
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
        
        $industries = Industry::all();
        $subIndustry = SubIndustry::findOrFail($id);
       
        return view('admin.pages.sub-industries-edit', compact('subIndustry','industries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);
        
        $request->validate([
            'industry_id' => 'required|exists:industries,id',
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        $subIndustry = SubIndustry::findOrFail($id);

        $subIndustry->update($request->only('industry_id', 'name', 'status'));

        return redirect()->route('admin-sub-industries.index')->with('success', 'Sub-Industry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subIndustry = SubIndustry::findOrFail($id);
        $subIndustry->delete();
        return redirect()->route('admin-sub-industries.index')->with('success', 'Sub-Industry deleted successfully.');

        
    }
}
