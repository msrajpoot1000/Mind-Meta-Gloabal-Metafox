<?php

namespace App\Http\Controllers;

use App\Models\FinService;
use Illuminate\Http\Request;

class FinServiceController extends Controller
{
    public function indexF()
    {
        return view('user.pages.fin_services');
    }

    public function index()
    {
        $items = FinService::latest()->get();
  return view('admin.pages.fin-service', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        'is_active' => 'required|boolean'
        ]);
        

        FinService::create($data);
        return redirect()->route('admin-fin-service.index')->with('success', 'FinService created successfully.');
    }

    public function edit(string $id)
    {
        $item = FinService::findOrFail($id);
   return view("admin.pages.fin-service-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = FinService::findOrFail($id);

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

                    $folder = 'upload/fin_services';
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

        return redirect()->route('admin-fin-service.index')->with('success', 'FinService updated successfully.');
    }

   public function destroy(string $id)
{
    $item = FinService::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-fin-service.index')->with('success', 'FinService deleted successfully.');
}

}