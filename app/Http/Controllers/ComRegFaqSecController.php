<?php

namespace App\Http\Controllers;

use App\Models\ComRegFaqSec;
use Illuminate\Http\Request;

class ComRegFaqSecController extends Controller
{
    public function indexF()
    {
        return view('user.pages.com_reg_faq_secs');
    }

    public function index()
    {
        $items = ComRegFaqSec::latest()->get();
  return view('admin.pages.com-reg-faq-sec', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'ques' => 'required|string',
        'ans' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        

        ComRegFaqSec::create($data);
        return redirect()->route('admin-com-reg-faq-sec.index')->with('success', 'ComRegFaqSec created successfully.');
    }

    public function edit(string $id)
    {
        $item = ComRegFaqSec::findOrFail($id);
   return view("admin.pages.com-reg-faq-sec-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = ComRegFaqSec::findOrFail($id);

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

                    $folder = 'upload/com_reg_faq_secs';
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

        return redirect()->route('admin-com-reg-faq-sec.index')->with('success', 'ComRegFaqSec updated successfully.');
    }

   public function destroy(string $id)
{
    $item = ComRegFaqSec::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-com-reg-faq-sec.index')->with('success', 'ComRegFaqSec deleted successfully.');
}

}