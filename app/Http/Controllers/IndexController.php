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
use App\Models\HomeSlider;
use App\Models\OurPartners;
use App\Models\KeyCorServices;


class IndexController extends Controller
{
    public function index()
    {  
        $homeSliders = HomeSlider::latest()->get();
        $ourPartners = OurPartners::latest()->get();
        $keyCorServices = KeyCorServices::latest()->get();
        $testimonials = Testimonial::latest()->get();
        $companyinfos = Companyinfo::first();
      $blogs = Blog::latest()->take(3)->get();





        // to find the first comReg of first of comRegPage of all faq 
        
    // Step 1: Get the first ComReg
    $firstComReg = ComReg::first();

    if (!$firstComReg) {
        return response()->json(['message' => 'No comReg found'], 404);
    }

    // Step 2: Get the first related ComRegPage
    $firstComRegPage = ComRegPage::where('ref_id', $firstComReg->id)->first();

    if (!$firstComRegPage) {
        return response()->json(['message' => 'No related comRegPage found'], 404);
    }

    // Step 3: Decode faq_ids
    $faqIds = json_decode($firstComRegPage->faq_ids, true);

    if (empty($faqIds) || !is_array($faqIds)) {
        return response()->json(['message' => 'No FAQ IDs found'], 404);
    }

    // ✅ Step 4: Get all FAQs
    $faqs = ComRegFaqSec::whereIn('id', $faqIds)->get();
        return view('user.pages.index', compact('homeSliders', 'faqs', 'testimonials','companyinfos','blogs','ourPartners','keyCorServices'));
    }

  
    public function about()
    {   
        $testimonials = Testimonial::latest()->get();
         $company = Companyinfo::first();
        
       
        return view('user.pages.about' , compact('testimonials','company'));
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
    $orderedFetch = function ($model, $ids) {
        $items = $model::whereIn('id', $ids)->get()->keyBy('id');
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

}
