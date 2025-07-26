<?php

namespace App\Http\Controllers;

use App\Models\ServiceLicenseSec;
use Illuminate\Http\Request;

class ServiceLicenseSecController extends Controller
{
    public function indexF()
    {
        return view('user.pages.service_license_secs');
    }

    public function index()
    {
        $items = ServiceLicenseSec::latest()->get();
  return view('admin.pages.service-license-sec', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'license_image' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
        'license_name' => 'required|string',
        'license_description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        
        if ($request->hasFile('license_image')) {
            $folder = 'upload/service_license_secs';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('license_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['license_image'] = $folder . '/' . $filename;
        }

        ServiceLicenseSec::create($data);
        return redirect()->route('admin-service-license-sec.index')->with('success', 'ServiceLicenseSec created successfully.');
    }

    public function edit(string $id)
    {
        $item = ServiceLicenseSec::findOrFail($id);
   return view("admin.pages.service-license-sec-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = ServiceLicenseSec::findOrFail($id);

        $request->validate([
            'status_license_image' => 'nullable|in:0,1',
        'license_name' => 'required|string',
        'license_description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['license_name', 'license_description', 'is_active']);

                $photoFields = ['license_image'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/service_license_secs';
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

        return redirect()->route('admin-service-license-sec.index')->with('success', 'ServiceLicenseSec updated successfully.');
    }

   public function destroy(string $id)
{
    $item = ServiceLicenseSec::findOrFail($id);

        if (!empty($item->license_image) && file_exists(public_path($item->license_image))) {
            unlink(public_path($item->license_image));
        }

    $item->delete();

    return redirect()->route('admin-service-license-sec.index')->with('success', 'ServiceLicenseSec deleted successfully.');
}

}