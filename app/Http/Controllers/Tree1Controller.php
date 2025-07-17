<?php

namespace App\Http\Controllers;

use App\Models\Tree1;
use Illuminate\Http\Request;

class Tree1Controller extends Controller
{
    public function indexF()
    {
        return view('user.pages.tree1s');
    }

    public function index()
    {
        $items = Tree1::latest()->get();
        return view('admin.pages.tree1s', compact('items'));
    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'img1' => 'image|mimes:jpg,jpeg,png|max:2048|required',
        'img2' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
        'img3' => 'image|mimes:jpg,jpeg,png|max:2048|required',
        'description1' => 'required|string',
        'description2' => 'required|string',
        'description3' => 'nullable|string',
        'name' => 'required|string',
        'is_active' => 'required|boolean'
        ]);
        
        if ($request->hasFile('img1')) {
            $folder = 'upload/tree1s';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('img1');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['img1'] = $folder . '/' . $filename;
        }
        if ($request->hasFile('img2')) {
            $folder = 'upload/tree1s';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('img2');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['img2'] = $folder . '/' . $filename;
        }
        if ($request->hasFile('img3')) {
            $folder = 'upload/tree1s';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('img3');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['img3'] = $folder . '/' . $filename;
        }

        Tree1::create($data);
        return redirect()->route('admin-tree1s.index')->with('success', 'Tree1 created successfully.');
    }

    public function edit(string $id)
    {
        $item = Tree1::findOrFail($id);
        return view('admin.pages.tree1s-edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $item = Tree1::findOrFail($id);

        $request->validate([
            'status_img1' => 'required|in:1',
        'status_img2' => 'nullable|in:0,1',
        'status_img3' => 'required|in:1',
        'description1' => 'required|string',
        'description2' => 'required|string',
        'description3' => 'nullable|string',
        'name' => 'required|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['description1', 'description2', 'description3', 'name', 'is_active']);

                $photoFields = ['img1', 'img2', 'img3'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/tree1s';
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

        return redirect()->route('admin-tree1s.index')->with('success', 'Tree1 updated successfully.');
    }

   public function destroy(string $id)
{
    $item = Tree1::findOrFail($id);

        if (!empty($item->img1) && file_exists(public_path($item->img1))) {
            unlink(public_path($item->img1));
        }
        if (!empty($item->img2) && file_exists(public_path($item->img2))) {
            unlink(public_path($item->img2));
        }
        if (!empty($item->img3) && file_exists(public_path($item->img3))) {
            unlink(public_path($item->img3));
        }

    $item->delete();

    return redirect()->route('admin-tree1s.index')->with('success', 'Tree1 deleted successfully.');
}

}