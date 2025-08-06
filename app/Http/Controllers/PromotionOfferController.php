<?php

namespace App\Http\Controllers;

use App\Models\PromotionOffer;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\PromotionPage;

class PromotionOfferController extends Controller
{
    public function index()
    {
        $items1 = Promotion::all();
        $items3 = PromotionOffer::with('promotionPage.promotion')->get();

        return view('admin.pages.promotion-offer', compact('items1', 'items3'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'offer_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'offer_title' => 'required|string',
            'offer_price' => 'nullable|string',
            'offer_description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required',
            'ref_id' => 'required|exists:promotion_pages,id'
        ]);
        
        if ($request->hasFile('offer_image')) {
            $folder = 'upload/promotion_offers';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('offer_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['offer_image'] = $folder . '/' . $filename;
        }

        PromotionOffer::create($data);
        return redirect()->route('admin-promotion-offer.index')->with('success', 'PromotionOffer created successfully.');
    }

    public function edit(string $id)
    {
        $items1 = Promotion::all();
        $item3 = PromotionOffer::findOrFail($id);
        $subModel = PromotionPage::find($item3->ref_id);
        $mainModel = $subModel ? Promotion::find($subModel->ref_id) : null;
        $item2Id = $subModel?->id;
        $item1Id = $mainModel?->id;

        return view('admin.pages.promotion-offer-edit', compact('items1', 'item3', 'item2Id', 'item1Id'));
    }

    public function update(Request $request, string $id)
    {
        $item = PromotionOffer::findOrFail($id);
        $data = $request->validate([
            'status_offer_image' => 'nullable|in:0,1',
            'offer_title' => 'required|string',
            'offer_price' => 'nullable|string',
            'offer_description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'ref_id' => 'required',
            'ref_id' => 'required|exists:promotion_pages,id'
        ]);
        $photoFields = ['offer_image'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/promotion_offers';
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
        return redirect()->route('admin-promotion-offer.index')->with('success', 'PromotionOffer updated successfully.');
    }

    public function destroy(string $id)
    {
        $item = PromotionOffer::findOrFail($id);
                 if (!empty($item->offer_image) && file_exists(public_path($item->offer_image))) {
            unlink(public_path($item->offer_image));
        }

        $item->delete();
        return redirect()->route('admin-promotion-offer.index')->with('success', 'PromotionOffer deleted successfully.');
    }

    public function indexF()
    {
        return view('user.pages.promotion-offer');
    }
}