@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', 'Home | Meta Mind Global')

@section('style')
<style>
    .clampx {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .readBtn {
        border: none;
        color: black;
        background-color: white;
    }

    .readBtn:hover {
        color: blue
    }
</style>
@endsection
<script>
    function toggleFlexReadMore(id) {
        const container = document.getElementById("testimonialText" + id);
        const shortPara = container.querySelector(".short");
        const fullPara = container.querySelector(".full");
        const btn = document.getElementById("readMoreBtn" + id);

        if (fullPara.style.display === "none") {
            shortPara.style.display = "none";
            fullPara.style.display = "block";
            container.style.display = "flex";
            btn.innerText = "Read Less";
        } else {
            shortPara.style.display = "block";
            fullPara.style.display = "none";
            container.style.display = "flex";
            btn.innerText = "Read More";
        }
    }
</script>



@section('content')
    <style>
        .company form button {
            position: absolute;
            right: 5px;
            top: 5px;
            padding: 9px 20px;
            text-transform: uppercase;
            background: var(--color-primary);
            border: none;
            color: var(--white);
            font-weight: 600;
        }

        .company form input {
            background: transparent !important;
            border: none;
            box-shadow: inherit !important;
            color: var(--white) !important;
            min-height: 56px;
            padding: 15px;
        }

        .company form {
            border: 2px solid black;
            position: relative;
        }

        ol.custom-list {
            list-style-position: inside;
            font-size: 25px;
            color: #4997CF;
            padding: 0;
            margin: 20px auto;
            width: fit-content;
            font-family: Arial, sans-serif;
        }

        ol.custom-list li {
            margin-bottom: 10px;
        }

        ol.custom-list li:not(:last-child)::after {
            content: "";
            display: block;
            height: 1px;
            background-color: #ccc;
            margin: 10px 0;
        }


        .blog-style-one {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .blog-style-one .info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-style-one .btn-simple {
            margin-top: auto;
            /* pushes button to bottom */
        }


        .cImageServices {
            max-height: 10rem;
        }

        .get-started-btn:hover {

            color: black;
            background-color: #0b57e3 !important;
        }
    </style>
    <!-- Start Banner Area
                                                                                        ============================================= -->
    <div class="banner-area banner-style-one shadow navigation-custom-large zoom-effect overflow-hidden text-light">
        <!-- Slider main container -->
        <div class="banner-fade">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">

                <!-- Single Item -->
                <div class="swiper-slide banner-style-one">
                    <div class="banner-thumb bg-cover shadow dark" style="background: url(assets/img/banner/home.png);"></div>
                    <div class="container">
                        <div class="row align-center">
                            <div class="col-xl-7 offset-xl-5">
                                <div class="content">
                                    <h3>Simplify Your Start<br>
                                        <strong>Business Setup in Dubai</strong>
                                    </h3>
                                    <h4><strong>From Beginning to Your Personalized Needs</strong></h4>
                                    <p>Your personalized advisor, who answers all your new business setup queries, helps you
                                        grow your business hassle-free by providing all-in-one company setup solutions under
                                        one roof.</p>
                                    <p><strong>Idea Concept | Business Plan | Company Registration | Corporate Bank
                                            Account</strong></p>
                                    <div class="button mt-40">
                                        <a class="btn-animation" href="#"><i class="fas fa-arrow-right"></i> <span>Our
                                                Services</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shape -->

                    <!-- End Shape -->
                </div>
                <!-- End Single Item -->

                <!-- Single Item -->
                <div class="swiper-slide banner-style-one">
                    <div class="banner-thumb bg-cover shadow dark" style="background: url(assets/img/banner/home2.png);">
                    </div>
                    <div class="container">
                        <div class="row align-center">
                            <div class="col-xl-7 offset-xl-5">
                                <div class="content">
                                    <h3>Simplify Your Start<br>
                                        <strong>Business Setup in Dubai</strong>
                                    </h3>
                                    <h4><strong>From Beginning to Your Personalized Needs</strong></h4>
                                    <p>Your personalized advisor, who answers all your new business setup queries, helps you
                                        grow your business hassle-free by providing all-in-one company setup solutions under
                                        one roof.</p>
                                    <p><strong>Idea Concept | Business Plan | Company Registration | Corporate Bank
                                            Account</strong></p>
                                    <div class="button mt-40">
                                        <a class="btn-animation" href="#"><i class="fas fa-arrow-right"></i> <span>Our
                                                Services</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shape -->

                    <!-- End Shape -->
                </div>
                <!-- End Single Item -->

            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>

        </div>
    </div>
    <!-- End Main -->
    <!-- Start Our Features
                                                                                        ============================================= -->
    <div class="feature-style-one-area half-angle-shape overflow-hidden default-padding">
        <div class="container">
            <div class="row align-center">
                <!-- Single Itme -->
                <div class="col-lg-5">
                    <div class="feature-style-one-heading text-light">
                        <div class="arrow-shape">
                            <img src="assets/img/shape/21.png" alt="Image not found">
                        </div>
                        <h2 class="title mb-25">Have a business vision in mind? Let's turn it into reality!</h2>
                        <p>
                            Choose a unique name and bring your company to life with Meta Mind Global.
                        </p>

                    </div>
                </div>
                <!-- End Single Itme -->
                <div class="col-lg-6 offset-lg-1 pl-60 pl-md-15 pl-xs-10 mt-md-50 mt-xs-50">

                    <div class="f-item company">
                        <form action="#">
                            <input type="text" placeholder="Type your desired company name here" class="form-control"
                                name="your_company">
                            <button type="submit"> Subscribe</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Our Features -->

    <!-- Start Aobut
                                                                                        ============================================= -->
    <div class="about-style-two-area overflow-hidden bg-contain bg-gray default-padding"
        style="background-image: url(assets/img/shape/29.png);">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4 class="sub-heading">Incorporation Services</h4>
                        <h2 class="title">Streamline your Business Setup in Dubai with Our Expert Guidance</h2>
                        <p>Meta Mind Global, your partner for business setup in Dubai, the UAE, not only makes the process
                            hassle-free, straightforward, and budget-friendly but also ensures that you are choosing the
                            right legal structure and jurisdiction for your company objective to run your business in the
                            long run. Find here 5 steps for setting up a business in Dubai and the UAE</p>
                        <div class="devider"></div>
                    </div>
                </div>

                <div class="col-lg-5 about-style-two">
                    <div class="thumb">
                        <div class="list-container">
                            <ol class="custom-list">
                                <li>1. Select The Right Jurisdiction</li>
                                <li>2. Prepare Your Documents</li>
                                <li>3. Get Your Business License</li>
                                <li>4. Process Your Visa</li>
                                <li>5. Opening A Bank Account</li>
                            </ol>

                        </div>
                    </div>
                </div>

                <div class="about-style-two col-lg-6 offset-lg-1">

                    <div class="default-features mt-30">
                        <div class="default-feature-item">
                            <a href="#">
                                <i class="flaticon-investment-3"></i>
                                <h4>Select The Right Jurisdiction</h4>
                                <p>Choosing the right jurisdiction for registering a company is the most important step of
                                    the whole business setup process. There are 3 main jurisdictions: Mainland, Free zone
                                    and Offshore. Let Meta Mind Global help you choose the right authority for your business
                                    setup in Dubai based on your business’s requirements.</p>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End About -->

    <!-- Start Services
                                                                                        ============================================= -->
    <div class="services-style-two-area default-padding bottom-less bg-cover bg-gray"
        style="background-image: url(assets/img/shape/27.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <!--<h4 class="sub-heading">What we do</h4>-->
                        <h2 class="title">Choose the Right Jurisdiction for your Dubai Business Setup</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <!-- Single Item -->
                <div class="col-xl-4 col-md-6 mb-30">
                    <div class="services-style-two active h-100">
                        <div class="thumb">
                            <img src="assets/img/service/mainland.png" alt="Thumb">
                            <div class="title">
                                <a href="#">
                                    <i class="flaticon-budget"></i>
                                    <h4> Mainland Company Setup</h4>
                                </a>
                            </div>
                        </div>
                        <div class="info">
                            <p>
                                Mainland Company Setup
                                Setting up your company in the UAE Mainland provides the flexibility to operate anywhere in
                                the Emirates and ensures direct engagement with the government for smoother operations.
                                Start your business in Dubai Mainland for restriction-free access to local markets and
                                International trade or Services. One significant benefit is the flexibility to operate
                                anywhere within the emirate, allowing companies to establish offices in prime locations
                                without the restrictions imposed by free zone regulations. Additionally, mainland companies
                                have the freedom to conduct business across the entire UAE, acquisition of more employee
                                visas, engage in wide range of business activities including those not permitted in free
                                zones, very important benefit of mainland companies is the absence of a mandatory
                                requirement for a UAE national as a partner, a recent change that enhances ease of setup.
                            </p>
                            <div class="button">
                                <a href="#">Read More</a>
                                <div class="devider"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Item -->

                <!-- Single Item -->
                <div class="col-xl-4 col-md-6 mb-30">
                    <div class="services-style-two h-100">
                        <div class="thumb">
                            <img src="assets/img/service/freezone.png" alt="Thumb">
                            <div class="title">
                                <a href="#">
                                    <i class="flaticon-bar-chart"></i>
                                    <h4> Free Zone Company Setup</h4>
                                </a>
                            </div>
                        </div>
                        <div class="info">
                            <p>

                                Registering a company in any UAE Free Zones qualifies you for 100% ownership without
                                partnering with a UAE national. Free Zones offers multiple benefits to investors looking to
                                start a business in Dubai, UAE, such as 0% corporate tax(on qualifying activities) and
                                business-friendly policies, ideal for those engaged in B2B transactions, international
                                trade, or businesses operating within the confines of the free zone itself. Another key
                                advantage is the flexibility regarding office space; free zone companies are not obligated
                                to rent office premises, resulting in considerable cost savings.
                            </p>
                            <div class="button">
                                <a href="#">Read More</a>
                                <div class="devider"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Item -->

                <!-- Single Item -->
                <div class="col-xl-4 col-md-6 mb-30">
                    <div class="services-style-two h-100">
                        <div class="thumb">
                            <img src="assets/img/service/offshore.png" alt="Thumb">
                            <div class="title">
                                <a href="#">
                                    <i class="flaticon-credit-cards"></i>
                                    <h4>Offshore Company Setup</h4>
                                </a>
                            </div>
                        </div>
                        <div class="info">
                            <p>

                                You can register your offshore company and operate it anywhere from overseas. It provides
                                financial perks, international market access, and a clear regulatory framework to foreign
                                companies. Note that you can carry out your business activities only outside the UAE. Expand
                                your business at the global level with an offshore company setup.
                            </p>
                            <div class="button">
                                <a href="#">Read More</a>
                                <div class="devider"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Item -->

            </div>
        </div>
    </div>
    <!-- End Services -->
    <!-- Start Pricing
                                                                                        ============================================= -->
    <div class="pricing-style-one-area secondary default-padding bottom-less">

        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading secondary text-center">

                        <h2 class="title">How Much Does Business Setup in Dubai Cost?</h2>

                        <div class="devider"></div>
                    </div>
                </div>
                <p>The cost of business setup in Dubai starts from AED 12,000*, but it is flexible and depends on multiple
                    factors. Some of the major reasons for a significant difference in costs include the jurisdiction
                    selected for company registration, type of business activity, shareholders involved, visas, and office
                    space.</p>
                <p>Both Mainland and Free Zone have their own requirements and fee structures that affect the overall
                    expenses in the beginning stage. Furthermore, complex business activities requiring a specialized
                    license or permit will also increase the costs. The total number of shareholders can also affect the
                    overall expenditure due to associated administrative fees and capital requirements during incorporation.
                    New office space and employee visas will add more expenses to the list.</p>
                <p>
                    Basically, the cost of business setup in Dubai can be quite different for different investors based on
                    these factors. Therefore, investors must research adequately and budget accordingly before starting the
                    incorporation process
                </p>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <!-- Single Itme -->
                <div class="col-xl-3 col-md-6 mb-30">
                    <div class="pricing-style-one" style="background-image: url(assets/img/shape/15.webp);">
                        <div class="pricing-header">
                            <h4>Sharjah Freezone</h4>
                            <h2>
                                AED 5,750*
                            </h2>
                        </div>
                        <div class="pricing-content">
                            <div class="price">
                                <p><strong>0 Visa</strong></p>
                            </div>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Business Consultation</li>
                                <li><i class="fas fa-check-circle"></i>0 Visa</li>
                                <li><i class="fas fa-check-circle"></i>100% Foreign Ownership</li>
                                <li><i class="fas fa-check-circle"></i>Business License</li>
                                <li><i class="fas fa-check-circle"></i>MOA and AOA</li>
                                <li><i class="fas fa-check-circle"></i>Free 1 session of Tax and VAT consultation</li>
                                <li><i class="fas fa-check-circle"></i>0% withhold tax</li>
                                <li><i class="fas fa-check-circle"></i>100% profit repatriation</li>
                                <li><i class="fas fa-check-circle"></i>Flexi desk</li>
                                <li><i class="fas fa-check-circle"></i>Dedicated relationship manager</li>

                            </ul>
                            <a class="btn mt-25 btn-sm btn-dark animation get-started-btn" href="#">Get Started</a>
                        </div>
                    </div>
                </div>
                <!-- End Single Itme -->

                <!-- Single Itme -->
                <div class="col-xl-3 col-md-6 mb-30">
                    <div class="pricing-style-one" style="background-image: url(assets/img/shape/15.webp);">
                        <div class="pricing-header">
                            <h4>Dubai Freezone</h4>
                            <h2>
                                AED 12,500*
                            </h2>
                        </div>
                        <div class="pricing-content">
                            <div class="price">
                                <p><strong>0 Visa</strong></p>
                            </div>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Business Consultation</li>
                                <li><i class="fas fa-check-circle"></i>0 Visa</li>
                                <li><i class="fas fa-check-circle"></i>100% Foreign Ownership</li>
                                <li><i class="fas fa-check-circle"></i>Business License</li>
                                <li><i class="fas fa-check-circle"></i>MOA and AOA</li>
                                <li><i class="fas fa-check-circle"></i>Free 1 session of Tax and VAT consultation</li>
                                <li><i class="fas fa-check-circle"></i>0% withhold tax</li>
                                <li><i class="fas fa-check-circle"></i>100% profit repatriation</li>
                                <li><i class="fas fa-check-circle"></i>Flexi desk</li>
                                <li><i class="fas fa-check-circle"></i>Dedicated relationship manager</li>
                            </ul>
                            <a class="btn mt-25 btn-sm btn-dark animation get-started-btn" href="#">Get Started</a>
                        </div>
                    </div>
                </div>
                <!-- End Single Itme -->

                <!-- Single Itme -->
                <div class="col-xl-3 col-md-6 mb-30">
                    <div class="pricing-style-one" style="background-image: url(assets/img/shape/15.webp);">
                        <div class="pricing-header">
                            <h4>Rakez Freezone</h4>
                            <h2>
                                AED 11,990*
                            </h2>
                        </div>
                        <div class="pricing-content">
                            <div class="price">
                                <p><strong>1 Free Lifetime Visa</strong></p>
                            </div>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Business Consultation </li>
                                <li><i class="fas fa-check-circle"></i>0 Visa</li>
                                <li><i class="fas fa-check-circle"></i>1 Visa(Lifetime)</li>
                                <li><i class="fas fa-check-circle"></i>100% Foreign Ownership</li>
                                <li><i class="fas fa-check-circle"></i>Business License</li>
                                <li><i class="fas fa-check-circle"></i>MOA and AOA</li>
                                <li><i class="fas fa-check-circle"></i>Free 1 session of Tax and VAT consultation</li>
                                <li><i class="fas fa-check-circle"></i>0% withhold tax</li>
                                <li><i class="fas fa-check-circle"></i>100% profit repatriation</li>
                                <!--<li><i class="fas fa-check-circle"></i>Flexi desk</li>-->
                                <li><i class="fas fa-check-circle"></i> Dedicated relationship manager</li>
                            </ul>
                            <a class="btn mt-25 btn-sm btn-dark animation get-started-btn" href="#">Get Started</a>
                        </div>
                    </div>
                </div>
                <!-- End Single Itme -->

                <!-- Single Itme -->
                <div class="col-xl-3 col-md-6 mb-30">
                    <div class="pricing-style-one" style="background-image: url(assets/img/shape/15.webp);">
                        <div class="pricing-header">
                            <h4>Dubai Mainland</h4>
                            <h2>
                                AED 19,999*
                            </h2>
                        </div>
                        <div class="pricing-content">
                            <div class="price">
                                <p><strong>1 Visa</strong></p>
                            </div>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Business Consultation</li>
                                <li><i class="fas fa-check-circle"></i>1 Visa</li>
                                <li><i class="fas fa-check-circle"></i>100% Foreign Ownership</li>
                                <li><i class="fas fa-check-circle"></i>Business License</li>
                                <li><i class="fas fa-check-circle"></i>MOA and AOA</li>
                                <li><i class="fas fa-check-circle"></i>Free 1 session of Tax and VAT consultation</li>
                                <li><i class="fas fa-check-circle"></i>0% withhold tax</li>
                                <li><i class="fas fa-check-circle"></i>100% profit repatriation</li>
                                <li><i class="fas fa-check-circle"></i>Flexi desk</li>
                                <li><i class="fas fa-check-circle"></i>Dedicated relationship manager</li>
                            </ul>
                            <a class="btn mt-25 btn-sm btn-dark animation get-started-btn" href="#">Get Started</a>
                        </div>
                    </div>
                </div>
                <!-- End Single Itme -->

            </div>
        </div>
    </div>
    <!-- End Pricng -->

    <!-- Start About
                                                                                        ============================================= -->
    <div class="about-style-one-area default-padding">
        <div class="shape-animated-left">
            <img src="assets/img/shape/anim-1.png" alt="Image Not Found">
            <img src="assets/img/shape/anim-2.png" alt="Image Not Found">
        </div>
        <div class="container">
            <div class="row align-center">
                <div class="about-style-one col-xl-6 col-lg-5">
                    <!--<div class="h4 sub-heading">Feel Valued & Rewarded</div>-->
                    <h2 class="title mb-25">Why Choose Meta Mind Global for Your Business Setup Needs?​</h2>
                    <p>
                        Meta Mind Global provides tailored business setup services to help entrepreneurs start and grow
                        their businesses in the Dubai Mainland and Free zones. Our team will guide you through every step,
                        from advising you on choosing the right jurisdiction and your company’s legal structure to getting a
                        business license within the required documents and with no hassle for paperwork, i.e. from the
                        comfort of your home. We make it stress-free by informing you about upcoming yearly compliances,
                        which every company needs to follow if they are operating in the UAE. We also offer a wide range of
                        support services to help you keep your company running smoothly by providing A-Z business solutions
                        under one roof.
                    </p>
                    <div class="owner-info">
                        <div class="left-info">
                            <ul>
                                <li><i class="fas fa-check-circle"></i>Diverse Industry Experience</li>
                                <li><i class="fas fa-check-circle"></i>Personalized Attention</li>
                                <li><i class="fas fa-check-circle"></i>Transparent fee and Pricing</li>

                            </ul>
                            <h4>Still confused about taking your decision.</h4>
                        </div>
                        <div class="right-info">

                        </div>
                    </div>
                </div>
                <div class="about-style-one col-xl-5 offset-xl-1 col-lg-6 offset-lg-1">
                    <div class="about-thumb">
                        <img class="wow fadeInRight" src="assets/img/why_choose.png" alt="Image Not Found">

                        <div class="thumb-shape-bottom wow fadeInDown" data-wow-delay="300ms">
                            <!--<img src="assets/img/shape/anim-3.png" alt="Image Not Found">-->
                            <!--<img src="assets/img/shape/anim-4.png" alt="Image Not Found">-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About -->

    <!-- Start Servics Style One
                                                                                        ============================================= -->
    <div class="services-style-one-area default-padding bg-gray">
        <div class="triangle-shape">
            <img src="assets/img/shape/10.png" alt="Shape">
        </div>
        <div class="center-shape" style="background-image: url(assets/img/shape/5.png);"></div>
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-5 mb-md-60">
                    <div class="service-nav-info">
                        <h4 class="sub-title"> <span style="color:#2C3F7E">Meta Mind Global Will Help You With</span></h4>
                        <h2>All In One Business Setup Services</h2>
                        <p>We offer you the all-in-one company services needed for Dubai mainland company formation and free
                            zones in one place. With everything you need to get your company up and running, you won’t have
                            to deal with multiple business setup companies.</p>
                        <div class="nav nav-tabs service-tab-navs" id="nav-tab" role="tablist">

                            <button class="nav-link active" id="nav-id-1" data-bs-toggle="tab" data-bs-target="#tab1"
                                type="button" role="tab" aria-controls="tab1" aria-selected="true">
                                <i class="flaticon-portfolio"></i>
                                Business Setup
                            </button>
                            <button class="nav-link" id="nav-id-2" data-bs-toggle="tab" data-bs-target="#tab2"
                                type="button" role="tab" aria-controls="tab2" aria-selected="false">
                                <i class="flaticon-megaphone"></i>
                                Corporate Services
                            </button>
                            <button class="nav-link" id="nav-id-3" data-bs-toggle="tab" data-bs-target="#tab3"
                                type="button" role="tab" aria-controls="tab3" aria-selected="false">
                                <i class="flaticon-save-money"></i>
                                Accounting & Auditing
                            </button>
                            <button class="nav-link" id="nav-id-4" data-bs-toggle="tab" data-bs-target="#tab4"
                                type="button" role="tab" aria-controls="tab4" aria-selected="false">
                                <i class="flaticon-save-money"></i>
                                Compliance
                            </button>
                            <button class="nav-link" id="nav-id-5" data-bs-toggle="tab" data-bs-target="#tab5"
                                type="button" role="tab" aria-controls="tab5" aria-selected="false">
                                <i class="flaticon-save-money"></i>
                                Coworking Space
                            </button>

                        </div>
                    </div>
                </div>
                <div class="col-lg-7 pl-50 pl-md-15 pl-xs-15">
                    <div class="tab-content services-tab-content" id="nav-tabContent">

                        <!-- Tab Single Item -->
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                            aria-labelledby="nav-id-1">
                            <div class="row">
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30 wow fadeInUp">
                                    <div class="services-style-one">
                                        <i class="flaticon-personal"></i>
                                        <h4><a href="services-single.html">Company Registration</a></h4>
                                        <p>
                                            Our business setup consultants help you with tailored company registration
                                            solutions in Dubai that are hassle-free, more affordable, and suitable for your
                                            startup.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30 wow fadeInUp"
                                    data-wow-delay="300ms">
                                    <div class="services-style-one">
                                        <i class="flaticon-career"></i>
                                        <h4><a href="services-single.html">Trade License Renewals</a></h4>
                                        <p>
                                            Acquiring licenses depending on your business activity and getting them renewed
                                            is no small task. It involves time, attention to detail and a whole lot of
                                            tedious documentation.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->

                            </div>
                        </div>
                        <!-- End Tab Single Item -->

                        <!-- Tab Single Item -->
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="nav-id-2">
                            <div class="row">
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-business-trip"></i>
                                        <h4><a href="services-single.html">Visa Services</a></h4>
                                        <p>
                                            We assist entrepreneurs who want to apply their residence visas so that they can
                                            legally stay in the UAE. Our visa service packages include investor, golden and
                                            employment visas. Our holistic approach to business setup in UAE can deliver
                                            determined visa services that ensures the entire process is smooth and hassle
                                            free.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-online-store"></i>
                                        <h4><a href="services-single.html">Bank Account Opening Assistance</a></h4>
                                        <p>
                                            We have built a strong relation with various banks which help us opening a
                                            business bank account for our clients with our in-house financial/banking
                                            experts. To ensure that the bank account opening is convenient and relaxed for
                                            our clients, we work closely with multiple bank partners.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-funds"></i>
                                        <h4><a href="services-single.html">PRO Services</a></h4>
                                        <p>
                                            Great things in business are never done by one person. A flourishing startup is
                                            the contribution of many hands expert at their skill, and PRO is one of them.
                                            Our Public Relation Officers (PRO) will work with you closely in implementing
                                            all your documentation and government-related procedures before and after
                                            registering your business in Dubai.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-career"></i>
                                        <h4><a href="services-single.html">Document Clearing</a></h4>
                                        <p>
                                            Document clearing forms the catalyst of any business, whether old or new. Every
                                            document needs to be authenticated in various formats depending on the type of
                                            company registration in Dubai.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                            </div>
                        </div>
                        <!-- End Tab Single Item -->

                        <!-- Tab Single Item -->
                        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="nav-id-3">
                            <div class="row">
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-budget"></i>
                                        <h4><a href="services-single.html">Accounting Services</a></h4>
                                        <p>
                                            Would you want to take relief from the huge administrative burden and constant
                                            worry about being compliant with the accounting rules as well as regulations?
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-money-1"></i>
                                        <h4><a href="services-single.html">Internal Audit Services</a></h4>
                                        <p>
                                            Meta Mind Global offers turnkey internal audit services in Dubai for different
                                            companies that aim to improve corporate operations and provide the best
                                            consultancy services.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-funds"></i>
                                        <h4><a href="services-single.html">External Audit Services</a></h4>
                                        <p>
                                            Meta Mind Global offers turnkey external audit services in Dubai for different
                                            companies that aim to improve corporate operations and provide the best
                                            consultancy services.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->

                            </div>
                        </div>
                        <!-- End Tab Single Item -->

                        <!--<h1>hellog</h1>-->
                        <!-- Tab Single Item -->
                        <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="nav-id-4">
                            <div class="row">
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-business-trip"></i>
                                        <h4><a href="services-single.html">Corporate Tax</a></h4>
                                        <p>
                                            Qualified businesses must register for corporate tax and engage in tax planning,
                                            which can be complex. Our corporate tax professionals help you with proper
                                            corporate tax strategy and stay compliant with the UAE’s volatile tax landscape.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-online-store"></i>
                                        <h4><a href="services-single.html">UBO Disclosure Services</a></h4>
                                        <p>
                                            New UBO regulations is required for registered and licensed companies in the
                                            UAE. We can help you assess the structure of ownership essential to comply.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-funds"></i>
                                        <h4><a href="services-single.html">AML Services</a></h4>
                                        <p>
                                            Meta Mind Global provides a breadth of Anti Money Laundering compliance services
                                            in Dubai under the domain of AML and CFT compliance. Our AML solutions,
                                            expertise, risk advisory services, AML checks, aml audits, knowledge, and
                                            industry experience bring a splash of value to every AML advisory service that
                                            we render to our clients.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-career"></i>
                                        <h4><a href="services-single.html">VAT Registration Services</a></h4>
                                        <p>
                                            VAT ( Value added TAX), an indirect tax levied on consumption of goods and
                                            services has been adopted as a system by majority countries globally to create
                                            one more gateway.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                            </div>
                        </div>
                        <!-- End Tab Single Item -->

                        <!-- Tab Single Item -->
                        <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="nav-id-5">
                            <div class="row">
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-business-trip"></i>
                                        <h4><a href="services-single.html">Hot Desk</a></h4>
                                        <p>
                                            The most affordable option out of all and perfectly suitable for freelancers and
                                            self-employed professionals. A hot desk allows you to enjoy the working
                                            environment without feeling attached to an office.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-online-store"></i>
                                        <h4><a href="services-single.html">Event Spaces</a></h4>
                                        <p>
                                            Host a corporate event without any stress. We offer event spaces and provide the
                                            facilities required to host a successful event in Dubai. We ensure that your
                                            guests receive the best treatment and service.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-funds"></i>
                                        <h4><a href="services-single.html">Private Office</a></h4>
                                        <p>
                                            Choose from our innovative range of private offices if you work with a team.
                                            Rent from us today and enjoy all the benefits and amenities of having your own
                                            office space in Dubai with Meta Mind Global as per your needs.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-career"></i>
                                        <h4><a href="services-single.html">Meeting & Board Rooms</a></h4>
                                        <p>
                                            Need a space to hold meetings, conferences, or presentations with your clients
                                            and team? Invite them to our meeting and board rooms that offer all the
                                            amenities and facilities of an office meeting or board room.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                            </div>
                        </div>
                        <!-- End Tab Single Item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services Style One -->


    <div class="project-details-area default-padding">
        <div class="container">
            <div class="row align-center">
                <div class="about-style-one col-xl-12 col-lg-11">
                    <!--<div class="h4 sub-heading">Feel Valued & Rewarded</div>-->
                    <h2 class="title mb-25">Our Affiliations With Government Bodies​</h2>
                    <p>
                        Our recognized association with government authorities helps us access resources and support from
                        them. You can trust us to be adhering to government rules and standards. We’ll be your credible
                        partners as you set up your firm in Dubai.
                    </p>
                    <div class="project-details-items">
                        <div class="thumb">
                            <img src="assets/img/affilations.jpg" alt="Thumb">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Testimonials ============================================= -->
    @if ($testimonials->count())
        <div class="testimonials-style-two-area bg-dark default-padding-top half-shape-light-bottom"
            style="background-image: url(assets/img/shape/34.png);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="site-heading text-light text-center">
                            <h4 class="sub-heading">Success Stories</h4>
                            <h2 class="title">Join 10,000 Happy Customers</h2>
                            <p>Don't just take our word for it. Hear from entrepreneurs who have successfully established
                                their
                                businesses in Dubai. Learn from their experiences and gain insights into the possibilities
                                that
                                await you.</p>
                            <div class="devider"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fill">
                <div class="row">
                    <div class="testimonial-style-two-carousel swiper">
                        <div class="swiper-wrapper">


                            @foreach ($testimonials as $testimonial)
                                <div class="swiper-slide">
                                    <div class="testimonial-style-two" style="padding:1.5rem">
                                        <img src="assets/img/shape/quote.png" alt="Quote">


                                        <div class="info">
                                            <div id="testimonialText{{ $testimonial->id }}"
                                                style="display: flex; flex-direction: column;">
                                                <p class="short">
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($testimonial->description), 100, '...') }}
                                                </p>
                                                <p class="full" style="display: none;">
                                                    {{ strip_tags($testimonial->description) }}
                                                </p>
                                            </div>

                                            <button onclick="toggleFlexReadMore({{ $testimonial->id }})"
                                                id="readMoreBtn {{ $testimonial->id }}" class="readBtn">Read More</button>
                                        </div>




                                        <div class="top-info">
                                            <div class="testimonial-rating">
                                                @for ($i = 1; $i <= $testimonial->rating; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor

                                            </div>
                                        </div>
                                        <div class="provider">
                                            <div class="content">
                                                <h4>{{ $testimonial->client_name }}</h4>
                                            </div>
                                            <div class="thumb">
                                                <img src="{{ $testimonial->photo ?? 'assets/img/logo/01.png' }}"
                                                    alt="Logo">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="swiper-pagination mb-4"></div>

                    </div>
                </div>
            </div>

        </div>
    @endif



    <div class="request-call-back-area text-light default-padding"style="background-image: url(assets/img/opp.jpg);">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-12">
                    <h2 class="title">Tap on a Wide Range of Opportunities </h2>
                    <a class="btn circle btn-light mt-30 mt-md-15 mt-xs-10 btn-md radius animation" target="_blank"
                        href="#">Innovate</a>
                    <a class="btn circle btn-light mt-30 mt-md-15 mt-xs-10 btn-md radius animation" target="_blank"
                        href="#">Learn</a>
                    <a class="btn circle btn-light mt-30 mt-md-15 mt-xs-10 btn-md radius animation" target="_blank"
                        href="#">Grow</a>
                </div>
                <p class="mt-4">With company setup in Dubai, run your business freely. Repatriate your profits and tap
                    into both local and global markets.</p>

            </div>
        </div>
    </div>

    <!-- End Testimonials  -->


    <div class="blog-area blog-grid default-padding">
        <div class="container">
            <div class="blog-item-box">
                <div class="row">
                    <h2 class="title" style="text-align:center;margin-bottom:2rem">Our Recents Blogs</h2>
                    <!-- Single Item -->
                    <div class="col-xl-4 col-md-6 single-item">
                        <div class="blog-style-one">
                            <div class="thumb">
                                <a href="#"><img src="assets/img/img3.jpg" alt="Thumb"></a>
                            </div>
                            <div class="info">
                                <div class="blog-meta">
                                    <ul>
                                        <li>
                                            <i class="fas fa-user"></i>
                                            <a href="#">John Baus</a>
                                        </li>
                                        <li>
                                            12 August, 2023
                                        </li>
                                    </ul>
                                </div>
                                <h3>
                                    <a href="blog-single-with-sidebar.html">Why Invest in Dubai? Not in Other Countries</a>
                                </h3>
                                <a href="#" class="btn-simple"><i class="fas fa-angle-right"></i> Read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Item -->
                    <!-- Single Item -->
                    <div class="col-xl-4 col-md-6 single-item">
                        <div class="blog-style-one">
                            <div class="thumb">
                                <a href="#"><img src="assets/img/img2.jpg" alt="Thumb"></a>
                            </div>
                            <div class="info">
                                <div class="blog-meta">
                                    <ul>
                                        <li>
                                            <span>By </span>
                                            <a href="#">Mohon</a>
                                        </li>
                                        <li>
                                            12 July, 2023
                                        </li>
                                    </ul>
                                </div>
                                <h4>
                                    <a href="blog-single-with-sidebar.html">Setting up a business in Dubai, UAE – Your
                                        Complete Step by Step Guide 2025</a>
                                </h4>
                                <a href="#" class="btn-simple"><i class="fas fa-angle-right"></i> Read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Item -->
                    <!-- Single Item -->
                    <div class="col-xl-4 col-md-6 single-item">
                        <div class="blog-style-one">
                            <div class="thumb">
                                <a href="#"><img src="assets/img/img3.jpg" alt="Thumb"></a>
                            </div>
                            <div class="info">
                                <div class="blog-meta">
                                    <ul>
                                        <li>
                                            <i class="fas fa-user"></i>
                                            <a href="#">John Baus</a>
                                        </li>
                                        <li>
                                            12 August, 2023
                                        </li>
                                    </ul>
                                </div>
                                <h3>
                                    <a href="blog-single-with-sidebar.html">Set Up a Company in Dubai as a UK Citizen – How
                                        to Guide 2025</a>
                                </h3>
                                <a href="#" class="btn-simple"><i class="fas fa-angle-right"></i> Read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Item -->

                </div>
            </div>

        </div>
    </div>









    <!-- Start Faq Area
                                                                                        ============================================= -->
    <div class="faq-area bg-gray default-padding">
        <!-- End Shape -->
        <div class="container">
            <div class="row">

                <div class="col-lg-12 faq-style-one dark pl-50 pl-md-15 pl-xs-15">

                    <h2 class="title mb-40">FAQ </h2>

                    <div class="accordion" id="faqAccordion">

                        @foreach ($faqs as $faq)
                            @if ($loop->first)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p>
                                                {{ strip_tags($faq->answer) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p>
                                                {{ strip_tags($faq->answer) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Faq Area -->








    
    <div class="process-style-one-area text-center default-padding">
        <div class="large-shape">
            <!--<img src="assets/img/shape/11.png" alt="Shape">-->
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <!--<h4 class="sub-heading">Our Process</h4>-->
                        <h2 class="title">Key Corporate Services</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <!-- Single Item -->
                <div class="col-lg-4">
                    <div class="">
                        <div class="thumb">
                            <img src="assets/img/cServices1.svg" class="cImageServices" alt="Thumb">

                        </div>
                        <h4>Business Advisory</h4>
                        <p>
                            Our knowledgeable consultants offer forward-looking advice to help you overcome challenging
                            business decisions and promise the expansion and success of your business.
                        </p>
                    </div>
                </div>
                <!-- End Single Item -->
                <!-- Single Item -->
                <div class="col-lg-4">
                    <div class="">
                        <div class="thumb">
                            <img src="assets/img/cServices2.png"c class="cImageServices" alt="Thumb">

                        </div>
                        <h4>Financial Consulting</h4>
                        <p>
                            Our financial professionals provide specialized solutions that maximize your financial
                            well-being. We’ll support you to reach your financial goals with everything, from budgeting to
                            investing strategies.
                        </p>
                    </div>
                </div>
                <!-- End Single Item -->
                <!-- Single Item -->
                <div class="col-lg-4">
                    <div class="">
                        <div class="thumb">
                            <img src="assets/img/cServices3.jpeg" class="cImageServices" alt="Thumb">

                        </div>
                        <h4>Coworking-Space</h4>
                        <p>
                            Get the best modern workspaces with our expert guidance. We help you select and get an ideal
                            coworking space with state-of-the-art facilities, easing lease contracts.
                        </p>
                    </div>
                </div>
                <!-- End Single Item -->
            </div>
        </div>
    </div>

    @include('user.partials.register-for-corporate-tax-section')






@endsection
