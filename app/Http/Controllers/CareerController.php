<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
   

    public function index()
    {
        $items = Career::latest()->get();
  return view('admin.pages.career', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'job_type' => 'required|string',
        'is_active' => 'required|boolean'
        ]);
        

        Career::create($data);
        return redirect()->route('admin-career.index')->with('success', 'Career created successfully.');
    }

    public function edit(string $id)
    {
        $item = Career::findOrFail($id);
   return view("admin.pages.career-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = Career::findOrFail($id);

        $request->validate([
            'job_type' => 'required|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['job_type', 'is_active']);

                $photoFields = [''];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/careers';
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

        return redirect()->route('admin-career.index')->with('success', 'Career updated successfully.');
    }

   public function destroy(string $id)
{
    $item = Career::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-career.index')->with('success', 'Career deleted successfully.');
}

}