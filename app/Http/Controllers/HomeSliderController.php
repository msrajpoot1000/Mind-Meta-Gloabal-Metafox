<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    public function indexF()
    {
        return view('user.pages.home_sliders');
    }

    public function index()
    {
        $items = HomeSlider::latest()->get();
  return view('admin.pages.home-slider', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
        'banner_image' => 'image|mimes:jpg,jpeg,png|max:10240|nullable',
        'banner_heading' => 'required|string',
        'banner_sub_heading' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        
        if ($request->hasFile('banner_image')) {
            $folder = 'upload/home_sliders';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('banner_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['banner_image'] = $folder . '/' . $filename;
        }

        HomeSlider::create($data);
        return redirect()->route('admin-home-slider.index')->with('success', 'HomeSlider created successfully.');
    }

    public function edit(string $id)
    {
        $item = HomeSlider::findOrFail($id);
   return view("admin.pages.home-slider-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = HomeSlider::findOrFail($id);

        $request->validate([
            'status_banner_image' => 'nullable|in:0,1',
        'banner_heading' => 'required|string',
        'banner_sub_heading' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['banner_heading', 'banner_sub_heading', 'is_active']);

                $photoFields = ['banner_image'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/home_sliders';
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

        return redirect()->route('admin-home-slider.index')->with('success', 'HomeSlider updated successfully.');
    }

   public function destroy(string $id)
{
    $item = HomeSlider::findOrFail($id);

        if (!empty($item->banner_image) && file_exists(public_path($item->banner_image))) {
            unlink(public_path($item->banner_image));
        }

    $item->delete();

    return redirect()->route('admin-home-slider.index')->with('success', 'HomeSlider deleted successfully.');
}

}