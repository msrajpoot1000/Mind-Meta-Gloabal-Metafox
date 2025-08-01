<?php

namespace App\Http\Controllers;

use App\Models\CareerJob;
use Illuminate\Http\Request;
use App\Models\Career;

class CareerJobController extends Controller
{
    public function index()
    {
        $items1 = Career::get();
        $items2 = CareerJob::with('career')->latest()->get();
        return view('admin.pages.career-job', compact('items1', 'items2'));
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'job_name' => 'required|string',
            'job_description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:careers,id'
    ]);
    

    CareerJob::create($data);
    return redirect()->route('admin-career-job.index')->with('success', 'CareerJob created successfully.');
}


    public function edit(string $id)
    {
        $items1 = Career::get();
        $item2 = CareerJob::findOrFail($id);
        return view('admin.pages.career-job-edit', compact('items1', 'item2'));
    }

    public function update(Request $request, string $id)
{
    $item = CareerJob::findOrFail($id);
    $data = $request->validate([
        'job_name' => 'required|string',
            'job_description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:careers,id'
    ]);

            $photoFields = [''];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/career_jobs';
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
    return redirect()->route('admin-career-job.index')->with('success', 'CareerJob updated successfully.');
}



    public function destroy(string $id)
    {
        $item = CareerJob::findOrFail($id);
        
        $item->delete();
        return redirect()->route('admin-career-job.index')->with('success', 'CareerJob deleted successfully.');
    }

    
    public function indexF()
    {
        return view('user.pages.career-job');
    }
}