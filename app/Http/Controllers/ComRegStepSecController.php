<?php

namespace App\Http\Controllers;

use App\Models\ComRegStepSec;
use Illuminate\Http\Request;

class ComRegStepSecController extends Controller
{
    public function indexF()
    {
        return view('user.pages.com_reg_step_secs');
    }

    public function index()
    {
        $items = ComRegStepSec::latest()->get();
  return view('admin.pages.com-reg-step-sec', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        'is_active' => 'required|boolean'
        ]);
        

        ComRegStepSec::create($data);
        return redirect()->route('admin-com-reg-step-sec.index')->with('success', 'ComRegStepSec created successfully.');
    }

    public function edit(string $id)
    {
        $item = ComRegStepSec::findOrFail($id);
   return view("admin.pages.com-reg-step-sec-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = ComRegStepSec::findOrFail($id);

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

                    $folder = 'upload/com_reg_step_secs';
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

        return redirect()->route('admin-com-reg-step-sec.index')->with('success', 'ComRegStepSec updated successfully.');
    }

   public function destroy(string $id)
{
    $item = ComRegStepSec::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-com-reg-step-sec.index')->with('success', 'ComRegStepSec deleted successfully.');
}

}