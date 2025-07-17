<?php

namespace App\Http\Controllers;

use App\Models\SubTree3;
use Illuminate\Http\Request;
use App\Models\Tree1;

class SubTree3Controller extends Controller
{
    public function index()
    {
        $items1 = Tree1::get();
        $items2 = SubTree3::with('tree1')->latest()->get();
        return view('admin.pages.sub-tree3s', compact('items1', 'items2'));
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'photo' => 'required|image|mimes:jpg,jpeg,png',
            'photo322' => 'required|image|mimes:jpg,jpeg,png',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'name' => 'required|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:tree1s,id'
    ]);
    
        if ($request->hasFile('photo')) {
            $folder = 'upload/sub_tree3s';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['photo'] = $folder . '/' . $filename;
        }
        if ($request->hasFile('photo322')) {
            $folder = 'upload/sub_tree3s';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('photo322');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['photo322'] = $folder . '/' . $filename;
        }

    SubTree3::create($data);
    return redirect()->route('admin-sub-tree3s.index')->with('success', 'SubTree3 created successfully.');
}


    public function edit(string $id)
    {
        $items1 = Tree1::get();
        $item2 = SubTree3::findOrFail($id);
        return view('admin.pages.sub-tree3s-edit', compact('items1', 'item2'));
    }

    public function update(Request $request, string $id)
{
    $item = SubTree3::findOrFail($id);
    $data = $request->validate([
        'status_photo' => 'required|in:1',
            'status_photo322' => 'required|in:1',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'name' => 'required|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:tree1s,id'
    ]);

            $photoFields = ['photo', 'photo322'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/sub_tree3s';
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
    return redirect()->route('admin-sub-tree3s.index')->with('success', 'SubTree3 updated successfully.');
}



    public function destroy(string $id)
    {
        $item = SubTree3::findOrFail($id);
                if (!empty($item->photo) && file_exists(public_path($item->photo))) {
            unlink(public_path($item->photo));
        }
        if (!empty($item->photo322) && file_exists(public_path($item->photo322))) {
            unlink(public_path($item->photo322));
        }

        $item->delete();
        return redirect()->route('admin-sub-tree3s.index')->with('success', 'SubTree3 deleted successfully.');
    }

    
    public function indexF()
    {
        return view('user.pages.sub-tree3s');
    }
}