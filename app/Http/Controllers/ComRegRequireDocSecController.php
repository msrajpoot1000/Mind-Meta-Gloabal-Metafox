<?php

namespace App\Http\Controllers;

use App\Models\ComRegRequireDocSec;
use Illuminate\Http\Request;

class ComRegRequireDocSecController extends Controller
{
    public function indexF()
    {
        return view('user.pages.com_reg_require_doc_secs');
    }

    public function index()
    {
        $items = ComRegRequireDocSec::latest()->get();
  return view('admin.pages.com-reg-require-doc-sec', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        'is_active' => 'required|boolean'
        ]);
        

        ComRegRequireDocSec::create($data);
        return redirect()->route('admin-com-reg-require-doc-sec.index')->with('success', 'ComRegRequireDocSec created successfully.');
    }

    public function edit(string $id)
    {
        $item = ComRegRequireDocSec::findOrFail($id);
   return view("admin.pages.com-reg-require-doc-sec-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = ComRegRequireDocSec::findOrFail($id);

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

                    $folder = 'upload/com_reg_require_doc_secs';
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

        return redirect()->route('admin-com-reg-require-doc-sec.index')->with('success', 'ComRegRequireDocSec updated successfully.');
    }

   public function destroy(string $id)
{
    $item = ComRegRequireDocSec::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-com-reg-require-doc-sec.index')->with('success', 'ComRegRequireDocSec deleted successfully.');
}

}