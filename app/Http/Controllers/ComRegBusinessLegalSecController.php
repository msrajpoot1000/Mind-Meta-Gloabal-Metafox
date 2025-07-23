<?php

namespace App\Http\Controllers;

use App\Models\ComRegBusinessLegalSec;
use Illuminate\Http\Request;

class ComRegBusinessLegalSecController extends Controller
{
    public function indexF()
    {
        return view('user.pages.com_reg_business_legal_secs');
    }

    public function index()
    {
        $items = ComRegBusinessLegalSec::latest()->get();
  return view('admin.pages.com-reg-business-legal-sec', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        

        ComRegBusinessLegalSec::create($data);
        return redirect()->route('admin-com-reg-business-legal-sec.index')->with('success', 'ComRegBusinessLegalSec created successfully.');
    }

    public function edit(string $id)
    {
        $item = ComRegBusinessLegalSec::findOrFail($id);
   return view("admin.pages.com-reg-business-legal-sec-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = ComRegBusinessLegalSec::findOrFail($id);

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

                    $folder = 'upload/com_reg_business_legal_secs';
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

        return redirect()->route('admin-com-reg-business-legal-sec.index')->with('success', 'ComRegBusinessLegalSec updated successfully.');
    }

   public function destroy(string $id)
{
    $item = ComRegBusinessLegalSec::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-com-reg-business-legal-sec.index')->with('success', 'ComRegBusinessLegalSec deleted successfully.');
}

}