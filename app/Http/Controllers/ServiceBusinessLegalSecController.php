<?php

namespace App\Http\Controllers;

use App\Models\ServiceBusinessLegalSec;
use Illuminate\Http\Request;

class ServiceBusinessLegalSecController extends Controller
{
    public function indexF()
    {
        return view('user.pages.service_business_legal_secs');
    }

    public function index()
    {
        $items = ServiceBusinessLegalSec::latest()->get();
  return view('admin.pages.service-business-legal-sec', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        

        ServiceBusinessLegalSec::create($data);
        return redirect()->route('admin-service-business-legal-sec.index')->with('success', 'ServiceBusinessLegalSec created successfully.');
    }

    public function edit(string $id)
    {
        $item = ServiceBusinessLegalSec::findOrFail($id);
   return view("admin.pages.service-business-legal-sec-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = ServiceBusinessLegalSec::findOrFail($id);

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

                    $folder = 'upload/service_business_legal_secs';
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

        return redirect()->route('admin-service-business-legal-sec.index')->with('success', 'ServiceBusinessLegalSec updated successfully.');
    }

   public function destroy(string $id)
{
    $item = ServiceBusinessLegalSec::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-service-business-legal-sec.index')->with('success', 'ServiceBusinessLegalSec deleted successfully.');
}

}