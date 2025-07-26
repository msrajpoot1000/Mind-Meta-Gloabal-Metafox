<?php

namespace App\Http\Controllers;

use App\Models\ComRegPage;
use Illuminate\Http\Request;
use App\Models\ComReg;
use App\Models\ComRegFaqSec;
use App\Models\ComRegStepSec;
use App\Models\ComRegWhySec;
use App\Models\ComRegLicenseSec;
use App\Models\ComRegBusinessLegalSec;
use App\Models\ComRegRequireDocSec;
use Illuminate\Support\Collection;



class ComRegPageController extends Controller
{
    
    public function index()
    {
        $items1 = ComReg::get();
        $items2 = ComRegPage::with('comReg')->latest()->get();
        $comRegLicenseSec = ComRegLicenseSec::latest()->get();
        $comRegBusinessLegalSec = ComRegBusinessLegalSec::latest()->get();
        $comRegRequireDocSec = ComRegRequireDocSec::latest()->get();
        $comRegStepSec = ComRegStepSec::latest()->get();
        $comRegWhySec = ComRegWhySec::latest()->get();
        $comRegFaqSec = ComRegFaqSec::latest()->get();
        

        $comRegBusinessLegalSec = ComRegBusinessLegalSec::latest()->get();
        return view('admin.pages.com-reg-page', compact('items1', 'items2','comRegLicenseSec','comRegBusinessLegalSec','comRegRequireDocSec','comRegWhySec','comRegStepSec','comRegFaqSec'));
    }

   public function store(Request $request)
{

    // dd($request);
    $data = $request->validate([
        'name' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'banner_heading' => 'nullable|string',
            'banner_description' => 'nullable|string',
            'benefits_description' => 'nullable|string',
            'features_description' => 'nullable|string',
            'overview_heading' => 'nullable|string',
            'overview_description' => 'nullable|string',
            'type_section_heading' => 'nullable|string',
            'business_legal_description' => 'nullable|string',
            'step_section_sub_heading' => 'nullable|string',
            'step_section_heading' => 'nullable|string',
            'step_section_description' => 'nullable|string',
            'why_section_heading' => 'nullable|string',
            'why_section_description' => 'nullable|string',
            'extra_section' => 'nullable|string',
            'is_active' => 'required|boolean',

            'license_ids' => 'nullable|array',
            'license_ids.*' => 'exists:com_reg_license_secs,id',

            
            'business_legal_ids' => 'nullable|array',
            'business_legal_ids.*' => 'exists:com_reg_business_legal_secs,id',

            'requrie_doc_ids' => 'nullable|array',
            'requrie_doc_ids.*' => 'exists:com_reg_requrie_doc_secs,id',

            'step_ids' => 'nullable|array',
            'step_ids.*' => 'exists:com_reg_step_secs,id',

            'why_ids' => 'nullable|array',
            'why_ids.*' => 'exists:com_reg_why_secs,id',

            'faq_ids' => 'nullable|array',
            'faq_ids.*' => 'exists:com_reg_faq_secs,id',
            
            'ref_id' => 'required|exists:com_regs,id'
    ]);
    
        if ($request->hasFile('banner_image')) {
            $folder = 'upload/com_reg_pages';
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
  if (isset($data['license_ids'])) {
        $data['license_ids'] = json_encode($data['license_ids']);
    }

    // business legal 
    if (isset($data['business_legal_ids'])) {
        $data['business_legal_ids'] = json_encode($data['business_legal_ids']);
    }

    //require doc
    if (isset($data['requrire_doc_ids'])) {
        $data['requrire_doc_ids'] = json_encode($data['requrire_doc_ids']);
    }

    // step section 
     if (isset($data['step_ids'])) {
        $data['step_ids'] = json_encode($data['step_ids']);
    }

    // why section 

     if (isset($data['why_ids'])) {
        $data['why_ids'] = json_encode($data['why_ids']);
    }


          // ✅ Convert `faq_ids` array to JSON string
    if (isset($data['faq_ids'])) {
        $data['faq_ids'] = json_encode($data['faq_ids']);
    }
    

    ComRegPage::create($data);
    return redirect()->route('admin-com-reg-page.index')->with('success', 'ComRegPage created successfully.');
}




public function edit(string $id)
{
    $items1 = ComReg::get();
    $item2 = ComRegPage::findOrFail($id);

    // Decode selected IDs
    $selectedLicenseIds = json_decode($item2->license_ids ?? '[]', true);
    $selectedBusinessLegalIds = json_decode($item2->business_legal_ids ?? '[]', true);
    $selectedRequireDocIds = json_decode($item2->require_doc_ids ?? '[]', true);
    $selectedStepIds = json_decode($item2->step_ids ?? '[]', true);
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
    $comRegLicenseSec = $sortBySelectedOrder(
        ComRegLicenseSec::latest()->get(),
        $selectedLicenseIds
    );

    $comRegBusinessLegalSec = $sortBySelectedOrder(
        ComRegBusinessLegalSec::latest()->get(),
        $selectedBusinessLegalIds
    );

    $comRegRequireDocSec = $sortBySelectedOrder(
        ComRegRequireDocSec::latest()->get(),
        $selectedRequireDocIds
    );

    $comRegStepSec = $sortBySelectedOrder(
        ComRegStepSec::latest()->get(),
        $selectedStepIds
    );

    $comRegWhySec = $sortBySelectedOrder(
        ComRegWhySec::latest()->get(),
        $selectedWhyIds
    );

    $comRegFaqSec = $sortBySelectedOrder(
        ComRegFaqSec::latest()->get(),
        $selectedFaqIds
    );

    return view('admin.pages.com-reg-page-edit', compact(
        'items1',
        'item2',
        'comRegLicenseSec',
        'comRegBusinessLegalSec',
        'comRegRequireDocSec',
        'comRegWhySec',
        'comRegStepSec',
        'comRegFaqSec'
    ));
}




    public function update(Request $request, string $id)
{
    // dd($request);
    $item = ComRegPage::findOrFail($id);
    $data = $request->validate([
        'name' => 'required|string',
            'status_banner_image' => 'nullable|in:0,1',
            'banner_heading' => 'nullable|string',
            'banner_description' => 'nullable|string',
            'benefits_description' => 'nullable|string',
            'features_description' => 'nullable|string',
            'overview_heading' => 'nullable|string',
            'overview_description' => 'nullable|string',
            'type_section_heading' => 'nullable|string',
            'business_legal_description' => 'nullable|string',
            'step_section_sub_heading' => 'nullable|string',
            'step_section_heading' => 'nullable|string',
            'step_section_description' => 'nullable|string',
            'why_section_heading' => 'nullable|string',
            'why_section_description' => 'nullable|string',
             'extra_section' => 'nullable|string',
           

            'license_ids' => 'nullable|array',
            'license_ids.*' => 'exists:com_reg_license_secs,id',

            
            'business_legal_ids' => 'nullable|array',
            'business_legal_ids.*' => 'exists:com_reg_business_legal_secs,id',

            'require_doc_ids' => 'nullable|array',
            'require_doc_ids.*' => 'exists:com_reg_require_doc_secs,id',

            'step_ids' => 'nullable|array',
            'step_ids.*' => 'exists:com_reg_step_secs,id',

            'why_ids' => 'nullable|array',
            'why_ids.*' => 'exists:com_reg_why_secs,id',

            'faq_ids' => 'nullable|array',
            'faq_ids.*' => 'exists:com_reg_faq_secs,id',

           
            
            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:com_regs,id'
    ]);

            $photoFields = ['banner_image'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/com_reg_pages';
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
$data['license_ids'] = json_encode($request->input('license_ids', []));
$data['business_legal_ids'] = json_encode($request->input('business_legal_ids', []));
$data['require_doc_ids'] = json_encode($request->input('require_doc_ids', []));
$data['step_ids'] = json_encode($request->input('step_ids', []));
$data['why_ids'] = json_encode($request->input('why_ids', []));
$data['faq_ids'] = json_encode($request->input('faq_ids', []));


    $item->update($data);
    return redirect()->route('admin-com-reg-page.index')->with('success', 'ComRegPage updated successfully.');
}



    public function destroy(string $id)
    {
        $item = ComRegPage::findOrFail($id);
                if (!empty($item->banner_image) && file_exists(public_path($item->banner_image))) {
            unlink(public_path($item->banner_image));
        }

        $item->delete();
        return redirect()->route('admin-com-reg-page.index')->with('success', 'ComRegPage deleted successfully.');
    }

    
    public function indexF()
    {
        return view('user.pages.com-reg-page');
    }
}