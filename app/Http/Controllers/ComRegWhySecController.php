<?php

namespace App\Http\Controllers;

use App\Models\ComRegWhySec;
use Illuminate\Http\Request;

class ComRegWhySecController extends Controller
{
    public function indexF()
    {
        return view('user.pages.com_reg_why_secs');
    }

    public function index()
    {
        $items = ComRegWhySec::latest()->get();
  return view('admin.pages.com-reg-why-sec', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        

        ComRegWhySec::create($data);
        return redirect()->route('admin-com-reg-why-sec.index')->with('success', 'ComRegWhySec created successfully.');
    }

    public function edit(string $id)
    {
        $item = ComRegWhySec::findOrFail($id);
   return view("admin.pages.com-reg-why-sec-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = ComRegWhySec::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['name', 'description', 'is_active']);

                $photoFields = [''];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/com_reg_why_secs';
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

        return redirect()->route('admin-com-reg-why-sec.index')->with('success', 'ComRegWhySec updated successfully.');
    }

   public function destroy(string $id)
{
    $item = ComRegWhySec::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-com-reg-why-sec.index')->with('success', 'ComRegWhySec deleted successfully.');
}

}