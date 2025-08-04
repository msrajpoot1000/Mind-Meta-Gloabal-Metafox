<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companyinfo;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\ContentPagesContent;

use App\Models\ComReg;
use App\Models\ComRegPage;
use App\Models\ComRegLicenseSec;
use App\Models\ComRegBusinessLegalSec;
use App\Models\ComRegRequireDocSec;
use App\Models\ComRegStepSec;
use App\Models\ComRegWhySec;
use App\Models\ComRegFaqSec;


use App\Models\ComService;
use App\Models\FinServicePage;
use App\Models\FinServiceBenefitSec;
use App\Models\FinServiceWhySec;
use App\Models\FinServiceFaqSec;


use App\Models\Service;
use App\Models\ServicePage;
use App\Models\ServiceLicenseSec;
use App\Models\ServiceBusinessLegalSec;
use App\Models\ServiceRequireDocSec;
use App\Models\ServiceStepSec;
use App\Models\ServiceWhySec;
use App\Models\ServiceFaqSec;
use App\Models\ServiceBenefitSec;

use App\Models\HomeSlider;
use App\Models\OurPartners;
use App\Models\KeyCorServices;
use App\Models\InCorporationServices;



use App\Models\Career;
use App\Models\CareerJob;

class IndexController extends Controller
{
    public function index()
    {  
        $homeSliders = HomeSlider::where('is_active', 1)->latest()->get();
$inCorporationServices = InCorporationServices::where('is_active', 1)->latest()->get();
$ourPartners = OurPartners::where('is_active', 1)->latest()->get();
$keyCorServices = KeyCorServices::where('is_active', 1)->latest()->get();
$testimonials = Testimonial::where('status', 1)->latest()->get();
$companyinfos = Companyinfo::first();
$blogs = Blog::where('is_active', 1)->latest()->take(3)->get();


        $services = Service::with('servicePages')->get();





        // to find the first comReg of first of comRegPage of all faq 
        
   // Step 1: Get the first ComReg
$firstComReg = ComReg::where('is_active', 1)->first();

if (!$firstComReg) {
    return response()->json(['message' => 'No comReg found'], 404);
}

// Step 2: Get the first 3 related ComRegPages
$firstThreeComRegPage = ComRegPage::where('is_active', 1)->where('ref_id', $firstComReg->id)->take(3)->get();

if ($firstThreeComRegPage->isEmpty()) {
    return response()->json(['message' => 'No related ComRegPages found'], 404);
}

$allFaqs = collect(); // To store all the FAQs from each page

// Step 3: Loop through each page and fetch its FAQs
foreach ($firstThreeComRegPage as $comRegPage) {
    $faqIds = json_decode($comRegPage->faq_ids, true);

    if (!empty($faqIds) && is_array($faqIds)) {
        $faqs = ComRegFaqSec::where('is_active', 1)->whereIn('id', $faqIds)->get()->sortBy(function ($faq) use ($faqIds) {
            return array_search($faq->id, $faqIds);
        });

        $allFaqs = $allFaqs->merge($faqs);

         // Stop if we've collected 10 or more
        if ($allFaqs->count() >= 10) {
            $allFaqs = $allFaqs->take(10);
            break;
        }
    }
}

// Optional: reset keys
$faqs = $allFaqs->values();


        return view('user.pages.index', compact('homeSliders', 'faqs', 'testimonials','companyinfos','blogs','ourPartners','keyCorServices','firstThreeComRegPage','inCorporationServices','services'));
    }


    


  
    public function about()
    {   
          $ourPartners = OurPartners::where('is_active', 1)->latest()->get();
        $testimonials = Testimonial::where('is_active', 1)->latest()->get();
         $company = Companyinfo::first();
        
       
        return view('user.pages.about' , compact('testimonials','company','ourPartners'));
    }

    
public function comRegPage($id)
{
    $comRegPage = ComRegPage::findOrFail($id);

    // Decode all ID arrays from JSON (fallback to empty arrays)
    $faqIds = json_decode($comRegPage->faq_ids ?? '[]', true);
    $whyIds = json_decode($comRegPage->why_ids ?? '[]', true);
    $stepIds = json_decode($comRegPage->step_ids ?? '[]', true);
    $requireDocIds = json_decode($comRegPage->require_doc_ids ?? '[]', true);
    $businessLegalIds = json_decode($comRegPage->business_legal_ids ?? '[]', true);
    $licenseIds = json_decode($comRegPage->license_ids ?? '[]', true);

    // Ensure arrays are valid
    $faqIds = is_array($faqIds) ? $faqIds : [];
    $whyIds = is_array($whyIds) ? $whyIds : [];
    $stepIds = is_array($stepIds) ? $stepIds : [];
    $requireDocIds = is_array($requireDocIds) ? $requireDocIds : [];
    $businessLegalIds = is_array($businessLegalIds) ? $businessLegalIds : [];
    $licenseIds = is_array($licenseIds) ? $licenseIds : [];

    // Function to fetch records in given ID order
    // $orderedFetch = function ($model, $ids) {
    //     $items = $model::whereIn('id', $ids)->get()->keyBy('id');
    //     return collect($ids)->map(fn($id) => $items[$id] ?? null)->filter();
    // };


      // Function to fetch records in given ID order, filtering by is_active = 1
    $orderedFetch = function ($model, $ids) {
        $items = $model::whereIn('id', $ids)
                        ->where('is_active', 1)
                        ->get()
                        ->keyBy('id');
        return collect($ids)->map(fn($id) => $items[$id] ?? null)->filter();
    };

    $comRegFaqSec = $orderedFetch(ComRegFaqSec::class, $faqIds);
    $comRegWhySec = $orderedFetch(ComRegWhySec::class, $whyIds);
    $comRegStepSec = $orderedFetch(ComRegStepSec::class, $stepIds);
    $comRegRequireDocSec = $orderedFetch(ComRegRequireDocSec::class, $requireDocIds);
    $comRegBusinessLegalSec = $orderedFetch(ComRegBusinessLegalSec::class, $businessLegalIds);
    $comRegLicenseSec = $orderedFetch(ComRegLicenseSec::class, $licenseIds);

    return view('user.pages.com-reg-page', compact(
        'comRegPage',
        'comRegFaqSec',
        'comRegWhySec',
        'comRegStepSec',
        'comRegRequireDocSec',
        'comRegBusinessLegalSec',
        'comRegLicenseSec'
    ));
}






public function finServicePage($id)
{
    $item2 = finServicePage::findOrFail($id);
    // dd($item2);
    $ourPartners = OurPartners::where('is_active', 1)->latest()->get();

    // Decode all ID arrays from JSON
    $faqIds = json_decode($item2->faq_ids ?? '[]', true);
    $whyIds = json_decode($item2->why_ids ?? '[]', true);
    $benefitIds = json_decode($item2->benefit_ids ?? '[]', true);

    // Ensure arrays are valid
    $faqIds = is_array($faqIds) ? $faqIds : [];
    $whyIds = is_array($whyIds) ? $whyIds : [];
    $benefitIds = is_array($benefitIds) ? $benefitIds : [];

    // Fetch records in given ID order
    // $orderedFetch = function ($model, $ids) {
    //     $items = $model::whereIn('id', $ids)->get()->keyBy('id');
    //     return collect($ids)->map(fn($id) => $items[$id] ?? null)->filter();
    // };


    // Function to fetch records in given ID order with is_active filter
    $orderedFetch = function ($model, $ids) {
        $items = $model::whereIn('id', $ids)
                        ->where('is_active', 1) // <-- is_active applied here
                        ->get()
                        ->keyBy('id');
        return collect($ids)->map(fn($id) => $items[$id] ?? null)->filter();
    };

    $finServiceBenefitSec = $orderedFetch(FinServiceBenefitSec::class, $benefitIds);
    $finServiceFaqSec = $orderedFetch(FinServiceFaqSec::class, $faqIds);
    $finServiceWhySec = $orderedFetch(FinServiceWhySec::class, $whyIds);

    return view('user.pages.fin-service', compact(
        'ourPartners',
        'item2',
        'finServiceBenefitSec',
        'finServiceFaqSec',
        'finServiceWhySec'
    ));
}






public function servicePage($id)
{
    $servicePage = ServicePage::findOrFail($id);

    // Decode all ID arrays from JSON (fallback to empty arrays)
    $faqIds = json_decode($servicePage->faq_ids ?? '[]', true);
    $whyIds = json_decode($servicePage->why_ids ?? '[]', true);
    $stepIds = json_decode($servicePage->step_ids ?? '[]', true);
    $requireDocIds = json_decode($servicePage->require_doc_ids ?? '[]', true);
    $businessLegalIds = json_decode($servicePage->business_legal_ids ?? '[]', true);
    $licenseIds = json_decode($servicePage->license_ids ?? '[]', true);
     $benefitIds = json_decode($servicePage->benefit_ids ?? '[]', true);


    // Ensure arrays are valid
    $faqIds = is_array($faqIds) ? $faqIds : [];
    $whyIds = is_array($whyIds) ? $whyIds : [];
    $stepIds = is_array($stepIds) ? $stepIds : [];
    $requireDocIds = is_array($requireDocIds) ? $requireDocIds : [];
    $businessLegalIds = is_array($businessLegalIds) ? $businessLegalIds : [];
    $licenseIds = is_array($licenseIds) ? $licenseIds : [];
     $benefitIds = is_array($benefitIds) ? $benefitIds : [];

    // Function to fetch records in given ID order
    // $orderedFetch = function ($model, $ids) {
    //     $items = $model::whereIn('id', $ids)->get()->keyBy('id');
    //     return collect($ids)->map(fn($id) => $items[$id] ?? null)->filter();
    // };


    // Function to fetch records in given ID order and filter by is_active = 1
    $orderedFetch = function ($model, $ids) {
        $items = $model::whereIn('id', $ids)
                        ->where('is_active', 1)  // <-- Filtering active records
                        ->get()
                        ->keyBy('id');
        return collect($ids)->map(fn($id) => $items[$id] ?? null)->filter();
    };

    $serviceFaqSec = $orderedFetch(ServiceFaqSec::class, $faqIds);
    $serviceWhySec = $orderedFetch(ServiceWhySec::class, $whyIds);
    $serviceStepSec = $orderedFetch(ServiceStepSec::class, $stepIds);
    $serviceRequireDocSec = $orderedFetch(ServiceRequireDocSec::class, $requireDocIds);
    $serviceBusinessLegalSec = $orderedFetch(ServiceBusinessLegalSec::class, $businessLegalIds);
    $serviceLicenseSec = $orderedFetch(ServiceLicenseSec::class, $licenseIds);
    $serviceBenefitSec = $orderedFetch(ServiceBenefitSec::class, $benefitIds);

    // dd($serviceBusinessLegalSec);
    return view('user.pages.service-page', compact(
        'servicePage',
        'serviceFaqSec',
        'serviceWhySec',
        'serviceStepSec',
        'serviceRequireDocSec',
        'serviceBusinessLegalSec',
        'serviceLicenseSec',
        'serviceBenefitSec'
    ));
}


public function career(){
    // dd("mais");
    $jobType = Career::where('is_active', 1)->latest()->get();
   $jobs = CareerJob::where('is_active', 1)
    ->whereHas('career', function ($query) {
        $query->where('is_active', 1);
    })
    ->latest()
    ->get();


    return view("user.pages.career" ,compact('jobType','jobs'));;
}



}
