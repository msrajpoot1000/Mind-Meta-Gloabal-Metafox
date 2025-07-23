<?php

namespace App\Http\Controllers;

use App\Models\OurPartners;
use Illuminate\Http\Request;

class OurPartnersController extends Controller
{
    public function indexF()
    {
        return view('user.pages.our_partners');
    }

    public function index()
    {
        $items = OurPartners::latest()->get();
  return view('admin.pages.our-partners', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'partner_image' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
        'name' => 'required|string',
        'is_active' => 'required|boolean'
        ]);
        
        if ($request->hasFile('partner_image')) {
            $folder = 'upload/our_partners';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('partner_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['partner_image'] = $folder . '/' . $filename;
        }

        OurPartners::create($data);
        return redirect()->route('admin-our-partners.index')->with('success', 'OurPartners created successfully.');
    }

    public function edit(string $id)
    {
        $item = OurPartners::findOrFail($id);
   return view("admin.pages.our-partners-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = OurPartners::findOrFail($id);

        $request->validate([
            'status_partner_image' => 'nullable|in:0,1',
        'name' => 'required|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['name', 'is_active']);

                $photoFields = ['partner_image'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/our_partners';
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

        return redirect()->route('admin-our-partners.index')->with('success', 'OurPartners updated successfully.');
    }

   public function destroy(string $id)
{
    $item = OurPartners::findOrFail($id);

        if (!empty($item->partner_image) && file_exists(public_path($item->partner_image))) {
            unlink(public_path($item->partner_image));
        }

    $item->delete();

    return redirect()->route('admin-our-partners.index')->with('success', 'OurPartners deleted successfully.');
}

}