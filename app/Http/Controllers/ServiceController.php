<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function indexF()
    {
        return view('user.pages.services');
    }

    public function index()
    {
        $items = Service::latest()->get();
  return view('admin.pages.service', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        'is_active' => 'required|boolean'
        ]);
        

        Service::create($data);
        return redirect()->route('admin-service.index')->with('success', 'Service created successfully.');
    }

    public function edit(string $id)
    {
        $item = Service::findOrFail($id);
   return view("admin.pages.service-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = Service::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['name', 'is_active']);

                $photoFields = [''];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/services';
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

        return redirect()->route('admin-service.index')->with('success', 'Service updated successfully.');
    }

   public function destroy(string $id)
{
    $item = Service::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-service.index')->with('success', 'Service deleted successfully.');
}

}