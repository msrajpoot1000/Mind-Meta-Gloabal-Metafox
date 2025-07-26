<?php

namespace App\Http\Controllers;

use App\Models\FinServicePage;
use Illuminate\Http\Request;
use App\Models\FinService;
use App\Models\FinServiceBenefitSec;
use App\Models\FinServiceWhySec;
use App\Models\FinServiceFaqSec;
use Illuminate\Support\Collection;


class FinServicePageController extends Controller
{

    public function index()
    {
        $items1 = FinService::get();
        $items2 = FinServicePage::with('finService')->latest()->get();
        
        $finServiceBenefitSec = FinServiceBenefitSec::latest()->get();
        // dd($finServiceBenefitSec);
        $finServiceFaqSec = FinServiceFaqSec::latest()->get();
        $finServiceWhySec = FinServiceWhySec::latest()->get();
        

        return view('admin.pages.fin-service-page', compact('items1', 'items2','finServiceBenefitSec','finServiceWhySec','finServiceFaqSec'));
    }


   public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'banner_heading' => 'nullable|string',
            'banner_description' => 'nullable|string',
            'page_sec_heading' => 'nullable|string',
            'page_sec_description' => 'nullable|string',
            'extra_section' => 'nullable|string',
            'benifits_sec_heading' => 'nullable|string',
            'benefits_description' => 'nullable|string',
            'why_section_heading' => 'nullable|string',
            'why_section_description' => 'nullable|string',

             'benefit_ids' => 'nullable|array',
            'benefit_ids.*' => 'exists:fin_service_benefit_secs,id',


              'why_ids' => 'nullable|array',
            'why_ids.*' => 'exists:fin_service_why_secs,id',

            'faq_ids' => 'nullable|array',
            'faq_ids.*' => 'exists:fin_service_faq_secs,id',

            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:fin_services,id'
    ]);
    
        if ($request->hasFile('banner_image')) {
            $folder = 'upload/fin_service_pages';
            $path = public_path($folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('banner_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['banner_image'] = $folder . '/' . $filename;
        }


               // licesnse 
  if (isset($data['benefit_ids'])) {
        $data['benefit_ids'] = json_encode($data['benefit_ids']);
    }


    // why section 

     if (isset($data['why_ids'])) {
        $data['why_ids'] = json_encode($data['why_ids']);
    }


          // ✅ Convert `faq_ids` array to JSON string
    if (isset($data['faq_ids'])) {
        $data['faq_ids'] = json_encode($data['faq_ids']);
    }
    


    FinServicePage::create($data);
    return redirect()->route('admin-fin-service-page.index')->with('success', 'FinServicePage created successfully.');
}


    public function edit(string $id)
{
    $items1 = FinService::get();
    $item2 = FinServicePage::findOrFail($id);

    // Decode selected IDs
    $selectedBenefitIds = json_decode($item2->benefit_ids ?? '[]', true);
    $selectedWhyIds = json_decode($item2->why_ids ?? '[]', true);
    $selectedFaqIds = json_decode($item2->faq_ids ?? '[]', true);

    // Function to sort by selected order
    $sortBySelectedOrder = function ($allItems, $selectedIds) {
        return $allItems->sortBy(function ($item) use ($selectedIds) {
            $index = array_search($item->id, $selectedIds);
            return $index !== false ? $index : PHP_INT_MAX;
        });
    };

    // Fetch all and sort by selected order
    $finServiceBenefitSec = $sortBySelectedOrder(
        FinServiceBenefitSec::latest()->get(),
        $selectedBenefitIds
    );

    $finServiceWhySec = $sortBySelectedOrder(
        FinServiceWhySec::latest()->get(),
        $selectedWhyIds
    );

    $finServiceFaqSec = $sortBySelectedOrder(
        FinServiceFaqSec::latest()->get(),
        $selectedFaqIds
    );

    return view('admin.pages.fin-service-page-edit', compact(
        'items1',
        'item2',
        'finServiceBenefitSec',
        'finServiceWhySec',
        'finServiceFaqSec',
    ));
}




    public function update(Request $request, string $id)
{
    // dd($request);
    $item = FinServicePage::findOrFail($id);
    $data = $request->validate([
        'name' => 'required|string',
            'status_banner_image' => 'nullable|in:0,1',
            'banner_heading' => 'nullable|string',
            'banner_description' => 'nullable|string',
            'page_sec_heading' => 'nullable|string',
            'page_sec_description' => 'nullable|string',
            'extra_section' => 'nullable|string',
            'benifits_sec_heading' => 'nullable|string',
            'benefits_description' => 'nullable|string',
            'why_section_heading' => 'nullable|string',
            'why_section_description' => 'nullable|string',

             'benefit_ids' => 'nullable|array',
            'benefit_ids.*' => 'exists:fin_service_benefit_secs,id',


              'why_ids' => 'nullable|array',
            'why_ids.*' => 'exists:fin_service_why_secs,id',

            'faq_ids' => 'nullable|array',
            'faq_ids.*' => 'exists:fin_service_faq_secs,id',

            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:fin_services,id'
    ]);

            $photoFields = ['banner_image'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/fin_service_pages';
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

        // Always overwrite these fields to ensure old values are cleared
$data['benefit_ids'] = json_encode($request->input('benefit_ids', []));
$data['why_ids'] = json_encode($request->input('why_ids', []));
$data['faq_ids'] = json_encode($request->input('faq_ids', []));



    $item->update($data);
    return redirect()->route('admin-fin-service-page.index')->with('success', 'FinServicePage updated successfully.');
}




    public function destroy(string $id)
    {
        $item = FinServicePage::findOrFail($id);
                if (!empty($item->banner_image) && file_exists(public_path($item->banner_image))) {
            unlink(public_path($item->banner_image));
        }

        $item->delete();
        return redirect()->route('admin-fin-service-page.index')->with('success', 'FinServicePage deleted successfully.');
    }

    
    public function indexF()
    {
        return view('user.pages.fin-service-page');
    }
}