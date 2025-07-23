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


Route::get('/', [IndexController::class, 'index'])->name('user.pages.index');
Route::get('/about', [IndexController::class, 'about'])->name('user.pages.aboutus');

Route::get('/dumy', [IndexController::class, 'dumy'])->name('user.pages.dumy');





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
Route::get('/contact', [ContactController::class, 'contactF'])->name('user.pages.contact');
Route::post('/contact-store', [ContactController::class, 'storeContact'])->name('contact.store');
// Admin Contact
Route::resource('admin-contact', ContactController::class)->middleware(['auth', 'verified']);





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
Route::get('/request-email-resend-otp', [MailVerificationController::class, 'send'])->name('email.request.send');

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
