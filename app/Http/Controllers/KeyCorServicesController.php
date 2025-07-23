<?php

namespace App\Http\Controllers;

use App\Models\KeyCorServices;
use Illuminate\Http\Request;

class KeyCorServicesController extends Controller
{
    public function indexF()
    {
        return view('user.pages.key_cor_services');
    }

    public function index()
    {
        $items = KeyCorServices::latest()->get();
  return view('admin.pages.key-cor-services', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'photo' => 'mimes:jpg,jpeg,png,svg|max:2048|nullable',
        'name' => 'required|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        
        if ($request->hasFile('photo')) {
            $folder = 'upload/key_cor_services';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['photo'] = $folder . '/' . $filename;
        }

        KeyCorServices::create($data);
        return redirect()->route('admin-key-cor-services.index')->with('success', 'KeyCorServices created successfully.');
    }

    public function edit(string $id)
    {
        $item = KeyCorServices::findOrFail($id);
   return view("admin.pages.key-cor-services-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = KeyCorServices::findOrFail($id);

        $request->validate([
            'status_photo' => 'nullable|in:0,1',
        'name' => 'required|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['name', 'description', 'is_active']);

                $photoFields = ['photo'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/key_cor_services';
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

        return redirect()->route('admin-key-cor-services.index')->with('success', 'KeyCorServices updated successfully.');
    }

   public function destroy(string $id)
{
    $item = KeyCorServices::findOrFail($id);

        if (!empty($item->photo) && file_exists(public_path($item->photo))) {
            unlink(public_path($item->photo));
        }

    $item->delete();

    return redirect()->route('admin-key-cor-services.index')->with('success', 'KeyCorServices deleted successfully.');
}

}