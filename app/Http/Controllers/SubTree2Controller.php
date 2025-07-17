<?php

namespace App\Http\Controllers;

use App\Models\SubTree2;
use Illuminate\Http\Request;
use App\Models\Tree1;

class SubTree2Controller extends Controller
{
    public function index()
    {
        $items1 = Tree1::get();
        $items2 = SubTree2::with('tree1')->latest()->get();
        return view('admin.pages.sub-tree2s', compact('items1', 'items2'));
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'photo' => 'required|image|mimes:jpg,jpeg,png',
            'photo2' => 'nullable|image|mimes:jpg,jpeg,png',
            'photo3' => 'required|image|mimes:jpg,jpeg,png',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'name' => 'required|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:tree1s,id'
    ]);
    
        if ($request->hasFile('photo')) {
            $folder = 'upload/sub_tree2s';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['photo'] = $folder . '/' . $filename;
        }
        if ($request->hasFile('photo2')) {
            $folder = 'upload/sub_tree2s';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('photo2');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['photo2'] = $folder . '/' . $filename;
        }
        if ($request->hasFile('photo3')) {
            $folder = 'upload/sub_tree2s';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('photo3');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['photo3'] = $folder . '/' . $filename;
        }

    SubTree2::create($data);
    return redirect()->route('admin-sub-tree2s.index')->with('success', 'SubTree2 created successfully.');
}


    public function edit(string $id)
    {
        $items1 = Tree1::get();
        $item2 = SubTree2::findOrFail($id);
        return view('admin.pages.sub-tree2s-edit', compact('items1', 'item2'));
    }

    public function update(Request $request, string $id)
{
    $item = SubTree2::findOrFail($id);
    $data = $request->validate([
        'status_photo' => 'required|in:1',
            'status_photo2' => 'nullable|in:0,1',
            'status_photo3' => 'required|in:1',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'name' => 'required|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:tree1s,id'
    ]);

            $photoFields = ['photo', 'photo2', 'photo3'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/sub_tree2s';
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
    return redirect()->route('admin-sub-tree2s.index')->with('success', 'SubTree2 updated successfully.');
}



    public function destroy(string $id)
    {
        $item = SubTree2::findOrFail($id);
                if (!empty($item->photo) && file_exists(public_path($item->photo))) {
            unlink(public_path($item->photo));
        }
        if (!empty($item->photo2) && file_exists(public_path($item->photo2))) {
            unlink(public_path($item->photo2));
        }
        if (!empty($item->photo3) && file_exists(public_path($item->photo3))) {
            unlink(public_path($item->photo3));
        }

        $item->delete();
        return redirect()->route('admin-sub-tree2s.index')->with('success', 'SubTree2 deleted successfully.');
    }

    
    public function indexF()
    {
        return view('user.pages.sub-tree2s');
    }
}