<?php

namespace App\Http\Controllers;

use App\Models\FinServiceFaqSec;
use Illuminate\Http\Request;

class FinServiceFaqSecController extends Controller
{
    public function indexF()
    {
        return view('user.pages.fin_service_faq_secs');
    }

    public function index()
    {
        $items = FinServiceFaqSec::latest()->get();
  return view('admin.pages.fin-service-faq-sec', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'ques' => 'required|string',
        'ans' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        

        FinServiceFaqSec::create($data);
        return redirect()->route('admin-fin-service-faq-sec.index')->with('success', 'FinServiceFaqSec created successfully.');
    }

    public function edit(string $id)
    {
        $item = FinServiceFaqSec::findOrFail($id);
   return view("admin.pages.fin-service-faq-sec-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = FinServiceFaqSec::findOrFail($id);

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

                    $folder = 'upload/fin_service_faq_secs';
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

        return redirect()->route('admin-fin-service-faq-sec.index')->with('success', 'FinServiceFaqSec updated successfully.');
    }

   public function destroy(string $id)
{
    $item = FinServiceFaqSec::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-fin-service-faq-sec.index')->with('success', 'FinServiceFaqSec deleted successfully.');
}

}