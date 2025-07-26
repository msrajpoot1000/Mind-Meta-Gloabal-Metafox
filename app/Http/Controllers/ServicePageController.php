<?php

namespace App\Http\Controllers;

use App\Models\ServicePage;
use Illuminate\Http\Request;
use App\Models\Service;


use App\Models\ServiceFaqSec;
use App\Models\ServiceStepSec;
use App\Models\ServiceWhySec;
use App\Models\ServiceLicenseSec;
use App\Models\ServiceBusinessLegalSec;
use App\Models\ServiceRequireDocSec;
use App\Models\ServiceBenefitSec;
use Illuminate\Support\Collection;

class ServicePageController extends Controller
{
    public function index()
    {
        $items1 = Service::get();
        $items2 = ServicePage::with('service')->latest()->get();

         $serviceLicenseSec = ServiceLicenseSec::latest()->get();
        $serviceBusinessLegalSec = ServiceBusinessLegalSec::latest()->get();
        $serviceRequireDocSec = ServiceRequireDocSec::latest()->get();
        $serviceStepSec = ServiceStepSec::latest()->get();
        $serviceWhySec = ServiceWhySec::latest()->get();
        $serviceFaqSec = ServiceFaqSec::latest()->get();
         $serviceBenefitSec = ServiceBenefitSec::latest()->get();

        return view('admin.pages.service-page', compact('items1', 'items2','serviceLicenseSec','serviceBusinessLegalSec','serviceRequireDocSec','serviceWhySec','serviceStepSec','serviceFaqSec','serviceBenefitSec'));
    }

   public function store(Request $request)
{
    // dd($request);
    $data = $request->validate([
        'name' => 'required|string',
            'description' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'banner_heading' => 'nullable|string',
            'banner_description' => 'nullable|string',
            'extra_section' => 'nullable|string',
            'license_section_heading' => 'nullable|string',
            'business_legal_heading' => 'nullable|string',
            'business_legal_description' => 'nullable|string',
            'why_section_heading' => 'nullable|string',
            'why_section_description' => 'nullable|string',
            'benefit_heading' => 'nullable|string',
            'benefits_description' => 'nullable|string',

            'license_ids' => 'nullable|array',
            'license_ids.*' => 'exists:service_license_secs,id',

            
            'business_legal_ids' => 'nullable|array',
            'business_legal_ids.*' => 'exists:service_business_legal_secs,id',

            'requrie_doc_ids' => 'nullable|array',
            'requrie_doc_ids.*' => 'exists:service_requrie_doc_secs,id',

            'step_ids' => 'nullable|array',
            'step_ids.*' => 'exists:service_step_secs,id',

            'why_ids' => 'nullable|array',
            'why_ids.*' => 'exists:service_why_secs,id',

            'faq_ids' => 'nullable|array',
            'faq_ids.*' => 'exists:service_faq_secs,id',

            'benefit_ids' => 'nullable|array',
            'benefit_ids.*' => 'exists:service_benefit_secs,id',



            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:services,id'
    ]);
    
        if ($request->hasFile('banner_image')) {
            $folder = 'upload/service_pages';
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
    
           // ✅ Convert `faq_ids` array to JSON string
    if (isset($data['benefit_ids'])) {
        $data['benefit_ids'] = json_encode($data['benefit_ids']);
    }

    ServicePage::create($data);
    return redirect()->route('admin-service-page.index')->with('success', 'ServicePage created successfully.');
}


    public function edit(string $id)
    {
        $items1 = Service::get();
        $item2 = ServicePage::findOrFail($id);

         // Decode selected IDs
    $selectedLicenseIds = json_decode($item2->license_ids ?? '[]', true);
    $selectedBusinessLegalIds = json_decode($item2->business_legal_ids ?? '[]', true);
    $selectedRequireDocIds = json_decode($item2->require_doc_ids ?? '[]', true);
    $selectedStepIds = json_decode($item2->step_ids ?? '[]', true);
    $selectedWhyIds = json_decode($item2->why_ids ?? '[]', true);
    $selectedFaqIds = json_decode($item2->faq_ids ?? '[]', true);
     $selectedBenefitIds = json_decode($item2->benefit_ids ?? '[]', true);


     // Function to sort by selected order
    $sortBySelectedOrder = function ($allItems, $selectedIds) {
        return $allItems->sortBy(function ($item) use ($selectedIds) {
            $index = array_search($item->id, $selectedIds);
            return $index !== false ? $index : PHP_INT_MAX;
        });
    };


       // Fetch all and sort by selected order
    $serviceLicenseSec = $sortBySelectedOrder(
        ServiceLicenseSec::latest()->get(),
        $selectedLicenseIds
    );

    $serviceBusinessLegalSec = $sortBySelectedOrder(
        ServiceBusinessLegalSec::latest()->get(),
        $selectedBusinessLegalIds
    );

    $serviceRequireDocSec = $sortBySelectedOrder(
        ServiceRequireDocSec::latest()->get(),
        $selectedRequireDocIds
    );

    $serviceStepSec = $sortBySelectedOrder(
        ServiceStepSec::latest()->get(),
        $selectedStepIds
    );

    $serviceWhySec = $sortBySelectedOrder(
        ServiceWhySec::latest()->get(),
        $selectedWhyIds
    );

    $serviceFaqSec = $sortBySelectedOrder(
        ServiceFaqSec::latest()->get(),
        $selectedFaqIds
    );


     $serviceBenefitSec = $sortBySelectedOrder(
        ServiceBenefitSec::latest()->get(),
        $selectedBenefitIds
    );




        return view('admin.pages.service-page-edit', compact(
        'items1',
        'item2',
        'serviceLicenseSec',
        'serviceBusinessLegalSec',
        'serviceRequireDocSec',
        'serviceWhySec',
        'serviceStepSec',
        'serviceFaqSec',
        'serviceBenefitSec'
        ));
    }


    










    public function update(Request $request, string $id)
{
    $item = ServicePage::findOrFail($id);
    $data = $request->validate([
        'name' => 'required|string',
            'description' => 'nullable|string',
            'status_banner_image' => 'nullable|in:0,1',
            'banner_heading' => 'nullable|string',
            'banner_description' => 'nullable|string',
            'extra_section' => 'nullable|string',
            'license_section_heading' => 'nullable|string',
            'business_legal_heading' => 'nullable|string',
            'business_legal_description' => 'nullable|string',
            'why_section_heading' => 'nullable|string',
            'why_section_description' => 'nullable|string',
            'benefit_heading' => 'nullable|string',
            'benefits_description' => 'nullable|string',
            'license_ids' => 'nullable|array',
            'license_ids.*' => 'exists:service_license_secs,id',

            
            'business_legal_ids' => 'nullable|array',
            'business_legal_ids.*' => 'exists:service_business_legal_secs,id',

            'require_doc_ids' => 'nullable|array',
            'require_doc_ids.*' => 'exists:service_require_doc_secs,id',

            'step_ids' => 'nullable|array',
            'step_ids.*' => 'exists:service_step_secs,id',

            'why_ids' => 'nullable|array',
            'why_ids.*' => 'exists:service_why_secs,id',

            'faq_ids' => 'nullable|array',
            'faq_ids.*' => 'exists:service_faq_secs,id',

             'benefit_ids' => 'nullable|array',
            'benefit_ids.*' => 'exists:service_benefit_secs,id',

            'is_active' => 'required|boolean',
            'ref_id' => 'required|exists:services,id'
    ]);

            $photoFields = ['banner_image'];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/service_pages';
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
$data['benefit_ids'] = json_encode($request->input('benefit_ids', []));


    $item->update($data);
    return redirect()->route('admin-service-page.index')->with('success', 'ServicePage updated successfully.');
}



    public function destroy(string $id)
    {
        $item = ServicePage::findOrFail($id);
                if (!empty($item->banner_image) && file_exists(public_path($item->banner_image))) {
            unlink(public_path($item->banner_image));
        }

        $item->delete();
        return redirect()->route('admin-service-page.index')->with('success', 'ServicePage deleted successfully.');
    }

    
    public function indexF()
    {
        return view('user.pages.service-page');
    }
}