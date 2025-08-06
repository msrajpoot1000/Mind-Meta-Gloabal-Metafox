<?php

namespace App\Http\Controllers;

use App\Models\PromotionPage;
use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionPageController extends Controller
{
    public function index()
    {
        $items1 = Promotion::get();
        $items2 = PromotionPage::with('promotion')->latest()->get();
        return view('admin.pages.promotion-page', compact('items1', 'items2'));
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string',
            'description' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'banner_heading' => 'nullable|string',
            'banner_description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:promotions,id'
    ]);
    
        if ($request->hasFile('banner_image')) {
            $folder = 'upload/promotion_pages';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('banner_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['banner_image'] = $folder . '/' . $filename;
        }

    PromotionPage::create($data);
    return redirect()->route('admin-promotion-page.index')->with('success', 'PromotionPage created successfully.');
}


    public function edit(string $id)
    {
        $items1 = Promotion::get();
        $item2 = PromotionPage::findOrFail($id);
        return view('admin.pages.promotion-page-edit', compact('items1', 'item2'));
    }

    public function update(Request $request, string $id)
{
    $item = PromotionPage::findOrFail($id);
    $data = $request->validate([
        'name' => 'required|string',
            'description' => 'nullable|string',
            'status_banner_image' => 'nullable|in:0,1',
            'banner_heading' => 'nullable|string',
            'banner_description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:promotions,id'
    ]);

            $photoFields = ['banner_image'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/promotion_pages';
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
    return redirect()->route('admin-promotion-page.index')->with('success', 'PromotionPage updated successfully.');
}



    public function destroy(string $id)
    {
        $item = PromotionPage::findOrFail($id);
                if (!empty($item->banner_image) && file_exists(public_path($item->banner_image))) {
            unlink(public_path($item->banner_image));
        }

        $item->delete();
        return redirect()->route('admin-promotion-page.index')->with('success', 'PromotionPage deleted successfully.');
    }

    
    public function indexF()
    {
        return view('user.pages.promotion-page');
    }
}