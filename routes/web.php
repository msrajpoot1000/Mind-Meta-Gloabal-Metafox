<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CompanyinfoController;
use App\Http\Controllers\TestimonialContoller;
use App\Http\Controllers\MailVerificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ContentPagesController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeSliderController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\SubIndustryController;


Route::get('/', [IndexController::class, 'index'])->name('user.pages.index');
Route::get('/about', [IndexController::class, 'about'])->name('user.pages.aboutus');

Route::get('/dumy', [IndexController::class, 'dumy'])->name('user.pages.dumy');




Route::get('/blog', [BlogController::class, 'blog'])->name('user.pages.blog');
Route::get('/blog-details/{id}', [BlogController::class, 'blogDetails'])->name('user.pages.blog-details');


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


// User Blog 
Route::get('/blog', [BlogController::class, 'indexF'])->name('user.pages.blog');
// Admin Blog 
Route::resource('admin-blog', BlogController::class)->middleware(['auth', 'verified']);



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



// Home Slider section
Route::get('/homeslider', [HomesliderController::class, 'homeslider'])->middleware(['auth', 'verified'])->name('admin.pages.home-slider');
Route::post('/homeslider/store', [HomesliderController::class, 'store'])->middleware(['auth', 'verified'])->name('homeslider.store');
Route::delete('/homeslider/delete/{id}', [HomesliderController::class, 'destroy'])->middleware(['auth', 'verified'])->name('homeslider.destroy');




// Admin Home Slider 
Route::resource('admin-home-slider', HomeSliderController::class)->middleware(['auth', 'verified']);


// Admin Industries
Route::resource('admin-industries', IndustryController::class)->middleware(['auth', 'verified']);


// Admin Sub Industries
Route::resource('admin-sub-industries', SubIndustryController::class)->middleware(['auth', 'verified']);




// Tree1Controller
use App\Http\Controllers\Tree1Controller;
Route::get('/tree1', [Tree1Controller::class, 'indexF'])->name('user.pages.tree1');
Route::resource('admin-tree1s', Tree1Controller::class)->middleware(['auth', 'verified']);


// SubTree2Controller
use App\Http\Controllers\SubTree2Controller;
Route::get('/sub-tree2s', [SubTree2Controller::class, 'indexF'])->name('user.pages.sub-tree2s');
Route::resource('admin-sub-tree2s', SubTree2Controller::class)->middleware(['auth', 'verified']);

// SubTree3Controller
use App\Http\Controllers\SubTree3Controller;
Route::get('/sub-tree3s', [SubTree3Controller::class, 'indexF'])->name('user.pages.sub-tree3s');
Route::resource('admin-sub-tree3s', SubTree3Controller::class)->middleware(['auth', 'verified']);

// SubSubTree4Controller
use App\Http\Controllers\SubSubTree4Controller;
Route::get('/sub-sub-tree4s', [SubSubTree4Controller::class, 'indexF'])->name('user.pages.sub-sub-tree4s');
Route::resource('admin-sub-sub-tree4s', SubSubTree4Controller::class)->middleware(['auth', 'verified']);

// Dynamic dependent dropdown route
Route::get('/get-sub-tree2s/{tree1sId}', function ($tree1sId) {
    return \App\Models\SubTree2::where('ref_id', $tree1sId)->get(['id', 'name']);
});
