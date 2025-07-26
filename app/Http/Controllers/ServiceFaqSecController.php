<?php

namespace App\Http\Controllers;

use App\Models\ServiceFaqSec;
use Illuminate\Http\Request;

class ServiceFaqSecController extends Controller
{
    public function indexF()
    {
        return view('user.pages.service_faq_secs');
    }

    public function index()
    {
        $items = ServiceFaqSec::latest()->get();
  return view('admin.pages.service-faq-sec', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'ques' => 'required|string',
        'ans' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        

        ServiceFaqSec::create($data);
        return redirect()->route('admin-service-faq-sec.index')->with('success', 'ServiceFaqSec created successfully.');
    }

    public function edit(string $id)
    {
        $item = ServiceFaqSec::findOrFail($id);
   return view("admin.pages.service-faq-sec-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = ServiceFaqSec::findOrFail($id);

        $request->validate([
            'ques' => 'required|string',
        'ans' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['ques', 'ans', 'is_active']);

                $photoFields = [''];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/service_faq_secs';
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

        return redirect()->route('admin-service-faq-sec.index')->with('success', 'ServiceFaqSec updated successfully.');
    }

   public function destroy(string $id)
{
    $item = ServiceFaqSec::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-service-faq-sec.index')->with('success', 'ServiceFaqSec deleted successfully.');
}

}