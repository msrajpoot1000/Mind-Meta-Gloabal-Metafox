<?php

namespace App\Http\Controllers;

use App\Models\ServiceStepSec;
use Illuminate\Http\Request;

class ServiceStepSecController extends Controller
{
    public function indexF()
    {
        return view('user.pages.service_step_secs');
    }

    public function index()
    {
        $items = ServiceStepSec::latest()->get();
  return view('admin.pages.service-step-sec', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        'step_description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        

        ServiceStepSec::create($data);
        return redirect()->route('admin-service-step-sec.index')->with('success', 'ServiceStepSec created successfully.');
    }

    public function edit(string $id)
    {
        $item = ServiceStepSec::findOrFail($id);
   return view("admin.pages.service-step-sec-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = ServiceStepSec::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
        'step_description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['name', 'step_description', 'is_active']);

                $photoFields = [''];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/service_step_secs';
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

        return redirect()->route('admin-service-step-sec.index')->with('success', 'ServiceStepSec updated successfully.');
    }

   public function destroy(string $id)
{
    $item = ServiceStepSec::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-service-step-sec.index')->with('success', 'ServiceStepSec deleted successfully.');
}

}