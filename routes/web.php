<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyinfoController;
use App\Http\Controllers\TestimonialContoller;
use App\Http\Controllers\MailVerificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ContentPagesController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\SubIndustryController;
use App\Http\Controllers\CkController;



Route::get('/', [IndexController::class, 'index'])->name('user.pages.index');
Route::get('/about', [IndexController::class, 'about'])->name('user.pages.aboutus');

Route::get('/career', [IndexController::class, 'career'])->name('user.pages.career');

Route::fallback(function () {
    return response()->view('user.pages.errors.404', [], 404);
});




require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('admin.pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// edit user profile 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Company Information
 Route::get('/edit-companyinformation', [CompanyinfoController::class, 'edit_companyinfo'])->middleware(['auth', 'verified'])->name('companyinfo');
 Route::post('/companyinfo/store', [CompanyinfoController::class, 'store'])->middleware(['auth', 'verified'])->name('edit.companyinfo');
 Route::delete('/companyinfo/{id}', [CompanyinfoController::class, 'destroy'])->middleware(['auth', 'verified'])->name('companyinfo.destroy');
 

// User Contact
Route::post('/contact-us', [ContactController::class, 'subscribe'])->name('user.pages.subscribe');

Route::get('/contact', [ContactController::class, 'contactF'])->name('user.pages.contact');
Route::post('/contact-store', [ContactController::class, 'storeContact'])->name('contact.store');
// Admin Contact
Route::resource('admin-contact', ContactController::class)->middleware(['auth', 'verified']);
// For both GET and POST
Route::match(['get', 'post'], '/contact-export', [ContactController::class, 'exportContact'])->name('user.pages.contact-export');




// User Testimonial
Route::get('/testimonial', [TestimonialContoller::class, 'indexF'])->name('user.pages.testimonial');
// Admin Testimonial
Route::resource('admin-testimonial', TestimonialContoller::class)->middleware(['auth', 'verified']);


// login forgot password 
Route::get('/forgot-password-otp-index', [ForgotPasswordController::class, 'sendOtpIndex'])->name('send.otp.index');
Route::post('/forgot-password-otp-send', [ForgotPasswordController::class, 'sendOtp'])->name('send.otp.store'); 
Route::get('/forgot-password-otp-verify/{email}', [ForgotPasswordController::class, 'verifyOtpIndex'])->name('verify.otp.index'); 
Route::post('/forgot-password-otp-store', [ForgotPasswordController::class, 'verifyOtpStore'])->name('verify.otp.store'); 


// Show the form
Route::get('/request-email', [MailVerificationController::class, 'showForm'])->name('email.request.page');

// Handle form submission and send verification email
Route::get('/request-email', [MailVerificationController::class, 'send'])->name('email.request.send');
// Route::get('/request-email-resend-otp', [MailVerificationController::class, 'send'])->name('email.request.send');



// Handle the email verification (with signed URL)
Route::get('/verify-email/{user}', [MailVerificationController::class, 'verifyMail'])
    ->name('email.verify')
    ->middleware('signed');
    

// user content pages 
Route::get('/privacy-policy', [ContentPagesController::class, 'privacyPolicy'])->name('user.pages.privacy-policy');
Route::get('/cookie-policy', [ContentPagesController::class, 'CookiePolicy'])->name('user.pages.cookie-policy');
Route::get('/terms-conditions', [ContentPagesController::class, 'TermsConditions'])->name('user.pages.terms-conditions');
// admin content pages 
Route::resource('/admin-content-pages', ContentPagesController::class)->middleware(['auth', 'verified']);


// Admin Faq
Route::resource('admin-faq', FaqController::class)->middleware(['auth', 'verified']);


// Admin Industries
Route::resource('admin-industries', IndustryController::class)->middleware(['auth', 'verified']);


// Admin Sub Industries
Route::resource('admin-sub-industries', SubIndustryController::class)->middleware(['auth', 'verified']);




// ComRegController
use App\Http\Controllers\ComRegController;
Route::get('/com-reg', [ComRegController::class, 'indexF'])->name('user.pages.com_reg');
Route::resource('admin-com-reg', ComRegController::class)->middleware(['auth', 'verified']);



// ComRegPageController
use App\Http\Controllers\ComRegPageController;
Route::get('/com-reg-page', [ComRegPageController::class, 'indexF'])->name('user.pages.com-reg-page');
Route::resource('/admin-com-reg-page', ComRegPageController::class)->middleware(['auth', 'verified']);





// for copany reg page 
Route::get('/com-reg-page/{id}', [IndexController::class, 'comRegPage'])->name('user.pages.comRegPage');





// ComRegFaqSecController
use App\Http\Controllers\ComRegFaqSecController;
Route::get('/com-reg-faq-sec', [ComRegFaqSecController::class, 'indexF'])->name('user.pages.com_reg_faq_sec');
Route::resource('admin-com-reg-faq-sec', ComRegFaqSecController::class)->middleware(['auth', 'verified']);

// ComRegWhySecController
use App\Http\Controllers\ComRegWhySecController;
Route::get('/com-reg-why-sec', [ComRegWhySecController::class, 'indexF'])->name('user.pages.com_reg_why_sec');
Route::resource('admin-com-reg-why-sec', ComRegWhySecController::class)->middleware(['auth', 'verified']);

// ComRegStepSecController
use App\Http\Controllers\ComRegStepSecController;
Route::get('/com-reg-step-sec', [ComRegStepSecController::class, 'indexF'])->name('user.pages.com_reg_step_sec');
Route::resource('admin-com-reg-step-sec', ComRegStepSecController::class)->middleware(['auth', 'verified']);

// ComRegRequireDocSecController
use App\Http\Controllers\ComRegRequireDocSecController;
Route::get('/com-reg-require-doc-sec', [ComRegRequireDocSecController::class, 'indexF'])->name('user.pages.com_reg_require_doc_sec');
Route::resource('admin-com-reg-require-doc-sec', ComRegRequireDocSecController::class)->middleware(['auth', 'verified']);

// ComRegBusinessLegalSecController
use App\Http\Controllers\ComRegBusinessLegalSecController;
Route::get('/com-reg-business-legal-sec', [ComRegBusinessLegalSecController::class, 'indexF'])->name('user.pages.com_reg_business_legal_sec');
Route::resource('admin-com-reg-business-legal-sec', ComRegBusinessLegalSecController::class)->middleware(['auth', 'verified']);

// ComRegLicenseSecController
use App\Http\Controllers\ComRegLicenseSecController;
Route::get('/com-reg-license-sec', [ComRegLicenseSecController::class, 'indexF'])->name('user.pages.com_reg_license_sec');
Route::resource('admin-com-reg-license-sec', ComRegLicenseSecController::class)->middleware(['auth', 'verified']);



// HomeSliderController
use App\Http\Controllers\HomeSliderController;
Route::get('/home-slider', [HomeSliderController::class, 'indexF'])->name('user.pages.home_slider');
Route::resource('admin-home-slider', HomeSliderController::class)->middleware(['auth', 'verified']);

// OurPartnersController
use App\Http\Controllers\OurPartnersController;
Route::get('/our-partners', [OurPartnersController::class, 'indexF'])->name('user.pages.our_partners');
Route::resource('admin-our-partners', OurPartnersController::class)->middleware(['auth', 'verified']);

// KeyCorServicesController
use App\Http\Controllers\KeyCorServicesController;
Route::get('/key-cor-services', [KeyCorServicesController::class, 'indexF'])->name('user.pages.key_cor_services');
Route::resource('admin-key-cor-services', KeyCorServicesController::class)->middleware(['auth', 'verified']);

// BlogController
use App\Http\Controllers\BlogController;
Route::get('/blog', [BlogController::class, 'indexF'])->name('user.pages.blog');
Route::get('/blog-detail/{id}', [BlogController::class, 'blogDetail'])->name('user.pages.blogDetail');
Route::resource('admin-blog', BlogController::class)->middleware(['auth', 'verified']);




// InCorporationServicesController
use App\Http\Controllers\InCorporationServicesController;
Route::get('/in-corporation-services', [InCorporationServicesController::class, 'indexF'])->name('user.pages.in_corporation_services');
Route::resource('admin-in-corporation-services', InCorporationServicesController::class)->middleware(['auth', 'verified']);

// FinServiceController
use App\Http\Controllers\FinServiceController;
Route::get('/fin-service/{id}', [IndexController::class, 'finServicePage'])->name('user.pages.finService');

// Route::get('/fin-service', [FinServiceController::class, 'indexF'])->name('user.pages.fin_service');
Route::resource('admin-fin-service', FinServiceController::class)->middleware(['auth', 'verified']);

// FinServicePageController
use App\Http\Controllers\FinServicePageController;
Route::get('/fin-service-page', [FinServicePageController::class, 'indexF'])->name('user.pages.fin-service-page');
Route::resource('/admin-fin-service-page', FinServicePageController::class)->middleware(['auth', 'verified']);

// FinServiceBenefitSecController
use App\Http\Controllers\FinServiceBenefitSecController;
Route::get('/fin-service-benefit-sec', [FinServiceBenefitSecController::class, 'indexF'])->name('user.pages.fin_service_benefit_sec');
Route::resource('admin-fin-service-benefit-sec', FinServiceBenefitSecController::class)->middleware(['auth', 'verified']);

// FinServiceWhySecController
use App\Http\Controllers\FinServiceWhySecController;
Route::get('/fin-service-why-sec', [FinServiceWhySecController::class, 'indexF'])->name('user.pages.fin_service_why_sec');
Route::resource('admin-fin-service-why-sec', FinServiceWhySecController::class)->middleware(['auth', 'verified']);

// FinServiceFaqSecController
use App\Http\Controllers\FinServiceFaqSecController;
Route::get('/fin-service-faq-sec', [FinServiceFaqSecController::class, 'indexF'])->name('user.pages.fin_service_faq_sec');
Route::resource('admin-fin-service-faq-sec', FinServiceFaqSecController::class)->middleware(['auth', 'verified']);







// ServiceController
use App\Http\Controllers\ServiceController;
Route::get('/service', [ServiceController::class, 'indexF'])->name('user.pages.service');
Route::resource('admin-service', ServiceController::class)->middleware(['auth', 'verified']);



// ServiceWhySecController
use App\Http\Controllers\ServiceWhySecController;
Route::get('/service-why-sec', [ServiceWhySecController::class, 'indexF'])->name('user.pages.service_why_sec');
Route::resource('admin-service-why-sec', ServiceWhySecController::class)->middleware(['auth', 'verified']);

// ServiceBenefitSecController
use App\Http\Controllers\ServiceBenefitSecController;
Route::get('/service-benefit-sec', [ServiceBenefitSecController::class, 'indexF'])->name('user.pages.service_benefit_sec');
Route::resource('admin-service-benefit-sec', ServiceBenefitSecController::class)->middleware(['auth', 'verified']);

// ServiceFaqSecController
use App\Http\Controllers\ServiceFaqSecController;
Route::get('/service-faq-sec', [ServiceFaqSecController::class, 'indexF'])->name('user.pages.service_faq_sec');
Route::resource('admin-service-faq-sec', ServiceFaqSecController::class)->middleware(['auth', 'verified']);

// ServiceRequireDocSecController
use App\Http\Controllers\ServiceRequireDocSecController;
Route::get('/service-require-doc-sec', [ServiceRequireDocSecController::class, 'indexF'])->name('user.pages.service_require_doc_sec');
Route::resource('admin-service-require-doc-sec', ServiceRequireDocSecController::class)->middleware(['auth', 'verified']);

// ServicePageController
use App\Http\Controllers\ServicePageController;
Route::get('/service-page/{id}', [IndexController::class, 'servicePage'])->name('user.pages.servicePage');
Route::resource('/admin-service-page', ServicePageController::class)->middleware(['auth', 'verified']);


// ServiceLicenseSecController
use App\Http\Controllers\ServiceLicenseSecController;
Route::get('/service-license-sec', [ServiceLicenseSecController::class, 'indexF'])->name('user.pages.service_license_sec');
Route::resource('admin-service-license-sec', ServiceLicenseSecController::class)->middleware(['auth', 'verified']);

// ServiceStepSecController
use App\Http\Controllers\ServiceStepSecController;
Route::get('/service-step-sec', [ServiceStepSecController::class, 'indexF'])->name('user.pages.service_step_sec');
Route::resource('admin-service-step-sec', ServiceStepSecController::class)->middleware(['auth', 'verified']);

// ServiceBusinessLegalSecController
use App\Http\Controllers\ServiceBusinessLegalSecController;
Route::get('/service-business-legal-sec', [ServiceBusinessLegalSecController::class, 'indexF'])->name('user.pages.service_business_legal_sec');
Route::resource('admin-service-business-legal-sec', ServiceBusinessLegalSecController::class)->middleware(['auth', 'verified']);



Route::post('/upload-image-endpoint', [CkController::class, 'uploadCKEditorImage'])->name('uploadCKEditorImage');
Route::post('/ckeditor/delete-image', [CkController::class, 'deleteCKEditorImage']);


// CareerController
use App\Http\Controllers\CareerController;
Route::resource('admin-career', CareerController::class)->middleware(['auth', 'verified']);

// CareerJobController
use App\Http\Controllers\CareerJobController;
Route::get('/career-job', [CareerJobController::class, 'indexF'])->name('user.pages.career-job');
Route::resource('/admin-career-job', CareerJobController::class)->middleware(['auth', 'verified']);



use App\Http\Controllers\CareerRecordController;

Route::post('/career-record', [CareerRecordController::class, 'store'])->name('user.pages.career-record');
Route::get('/career-record', [CareerRecordController::class, 'index'])->name('user.pages.career-record-index')->middleware(['auth', 'verified']);

Route::delete('/career-record/{id}', [CareerRecordController::class, 'destroy'])->name('career-record.destroy');
Route::get('/admin/career-records/{id}', [CareerRecordController::class, 'show'])->name('admin-career-record.show');
