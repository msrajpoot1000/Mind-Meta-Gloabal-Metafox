<?php

namespace App\Http\Controllers;

use App\Models\SubSubTree4;
use Illuminate\Http\Request;
use App\Models\Tree1;
use App\Models\SubTree2;

class SubSubTree4Controller extends Controller
{
    public function index()
    {
        $items1 = Tree1::all();
        $items3 = SubSubTree4::with('subTree2.tree1')->get();

        return view('admin.pages.sub-sub-tree4s', compact('items1', 'items3'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'photo2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'photo33' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'name' => 'required|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required',
            'ref_id' => 'required|exists:sub_tree2s,id'
        ]);
        
        if ($request->hasFile('photo')) {
            $folder = 'upload/sub_sub_tree4s';
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
            $folder = 'upload/sub_sub_tree4s';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('photo2');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['photo2'] = $folder . '/' . $filename;
        }
        if ($request->hasFile('photo33')) {
            $folder = 'upload/sub_sub_tree4s';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('photo33');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['photo33'] = $folder . '/' . $filename;
        }

        SubSubTree4::create($data);
        return redirect()->route('admin-sub-sub-tree4s.index')->with('success', 'SubSubTree4 created successfully.');
    }

    public function edit(string $id)
    {
        $items1 = Tree1::all();
        $item3 = SubSubTree4::findOrFail($id);
        $subModel = SubTree2::find($item3->ref_id);
        $mainModel = $subModel ? Tree1::find($subModel->ref_id) : null;
        $item2Id = $subModel?->id;
        $item1Id = $mainModel?->id;

        return view('admin.pages.sub-sub-tree4s-edit', compact('items1', 'item3', 'item2Id', 'item1Id'));
    }

    public function update(Request $request, string $id)
    {
        $item = SubSubTree4::findOrFail($id);
        $data = $request->validate([
            'status_photo' => 'required|in:1',
            'status_photo2' => 'nullable|in:0,1',
            'status_photo33' => 'required|in:1',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'name' => 'required|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required',
            'ref_id' => 'required|exists:sub_tree2s,id'
        ]);
        $photoFields = ['photo', 'photo2', 'photo33'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/sub_sub_tree4s';
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
        return redirect()->route('admin-sub-sub-tree4s.index')->with('success', 'SubSubTree4 updated successfully.');
    }

    public function destroy(string $id)
    {
        $item = SubSubTree4::findOrFail($id);
                 if (!empty($item->photo) && file_exists(public_path($item->photo))) {
            unlink(public_path($item->photo));
        }
        if (!empty($item->photo2) && file_exists(public_path($item->photo2))) {
            unlink(public_path($item->photo2));
        }
        if (!empty($item->photo33) && file_exists(public_path($item->photo33))) {
            unlink(public_path($item->photo33));
        }

        $item->delete();
        return redirect()->route('admin-sub-sub-tree4s.index')->with('success', 'SubSubTree4 deleted successfully.');
    }

    public function indexF()
    {
        return view('user.pages.sub-sub-tree4s');
    }
}