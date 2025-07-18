@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', 'Mainland | Meta Mind Global')

@section('style')
    <style>
        .navbar.validnavs.navbar-default .navbar-nav li a {
            color: black;
        }

        .round-tick-icon {
            color: white;
            font-size: 0.8rem;
            background-color: #022b6d;
            padding: 0.2rem;
            border-radius: 50%;
            margin-right: 0.5rem;
        }

        .navbar.validnavs.navbar-default .navbar-nav li a {
            color: white;
        }

        .navbar.validnavs.navbar-default.scrolled .navbar-nav li a {
            color: black !important;
        }

        .headerContact p,
        .headerContact h5 a {
            color: white !important;
        }

        .headerContact .icon i {
            color: #022b6d !important;
        }

        .navbar.validnavs.navbar-default.scrolled .headerContact p,
        .navbar.validnavs.navbar-default.scrolled .headerContact h5 a {
            color: #022b6d !important;
        }

        .navbar.validnavs.navbar-default.scrolled .headerContact .icon i {
            color: black !important;
        }

        .hero-heading,
        .hero-description {
            color: white;
        }

        .typeOfCol {
            display: flex;
            flex-direction: column;
        }

        .typeOfCol .info {
            flex-grow: 1;
        }
    </style>
@endsection

@section('content')





    {{-- hero section  --}}
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url(assets/img/shape/contact.jpg);">
        <div class="breadcrum-shape">
            {{-- <img src="assets/img/shape/cont.jpg" alt="Image Not Found" style="width: 100%;opacity:0.5"> --}}
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Mainland Company Formation in Dubai, UAE</h1>
                    <p class="hero-description">
                        Are you thinking about establishing your business in Dubai? Dubai mainland company
                        formation is the answer. It's your path to expansive business success. Ready for a
                        smooth setup? Let's turn your business vision into reality.​
                    </p>
                </div>
            </div>
        </div>
    </div>




    {{-- benifits && features --}}
    <div class="mission-vision-style-one-area overflow-hidden default-padding"
        style="background-image: url(assets/img/shape/banner-4.png);">

        <div class="shape-top-left">
            {{-- <img src="assets/img/shape/47.png" alt="Shape"> --}}
        </div>


        <div class="container">
            <div class="row">

                <div class="col-lg-6">

                    <div class="tab-content mission-tab-content" id="nav-tabContent">
                        <!-- Tab Single Item -->
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="nav-id-1">
                            <h2>Benefits</h2>
                            <p>
                                Setting up a business in Dubai’s mainland offers a number of advantages, making it an
                                attractive location for entrepreneurs and investors.
                                Here are some of the key benefits of mainland company formation in Dubai:
                            </p>
                            <ul>
                                <li><i class="fas fa-check round-tick-icon"></i> Unrestricted Market Access</li>
                                <li><i class="fas fa-check round-tick-icon"></i> Enhanced Brand Reputation</li>
                                <li><i class="fas fa-check round-tick-icon"></i> Direct Access to the Government Contracts
                                </li>
                                <li><i class="fas fa-check round-tick-icon"></i> Greater Business Flexibility</li>
                                <li><i class="fas fa-check round-tick-icon"></i> Easily hire and sponsor skilled
                                    professionals.</li>
                                <li><i class="fas fa-check round-tick-icon"></i> Corporate Tax-Friendly Structure</li>
                                <li><i class="fas fa-check round-tick-icon"></i> Simplified Banking</li>
                            </ul>

                        </div>
                        <!-- End Tab Single Item -->

                        <!-- Tab Single Item -->
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="nav-id-2">
                            <h2>Offer our customers <br> the lowest possible prices</h2>
                            <p>
                                A Promise of: Financial security and protection for our clients Commitment and fairness to
                                our agents Respect and opportunity for our employees Increasing value and reward for teams.
                            </p>
                            <ul>
                                <li><span class="icon-circle">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    Business document</li>
                                <li><span class="icon-circle">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    Strategic planning</li>
                                <li>
                                    <span class="icon-circle">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    Financial security and protection
                                </li>
                            </ul>
                        </div>
                        <!-- End Tab Single Item -->
                    </div>


                </div>
                <div class="col-lg-6">

                    <div class="tab-content mission-tab-content" id="nav-tabContent">
                        <!-- Tab Single Item -->
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="nav-id-1">
                            <h2>Features</h2>
                            <p>
                                Setting up a business in Dubai’s mainland provides entrepreneurs and investors with access
                                to a strategic market hub, enabling trade both locally and internationally. Businesses
                                benefit from full operational freedom across the UAE, eligibility to bid on lucrative
                                government contracts, and the option to fully own their companies in various sectors.
                            </p>
                            <ul>
                                <li><i class="fas fa-check round-tick-icon"></i> Dubai Mainland Company Formation</li>
                                <li><i class="fas fa-check round-tick-icon"></i> Company formation in-1-2 business</li>
                                <li><i class="fas fa-check round-tick-icon"></i>Minimal Paper work </li>
                                <li><i class="fas fa-check round-tick-icon"></i> 100% Foreign Ownership</li>
                                <li><i class="fas fa-check round-tick-icon"></i> Dubai Investor Visa</li>
                            </ul>

                        </div>
                        <!-- End Tab Single Item -->

                        <!-- Tab Single Item -->
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="nav-id-2">
                            <h2>Offer our customers <br> the lowest possible prices</h2>
                            <p>
                                A Promise of: Financial security and protection for our clients Commitment and fairness to
                                our agents Respect and opportunity for our employees Increasing value and reward for teams.
                            </p>
                            <ul>
                                <li><span class="icon-circle">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    Business document</li>
                                <li><span class="icon-circle">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    Strategic planning</li>
                                <li>
                                    <span class="icon-circle">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    Financial security and protection
                                </li>
                            </ul>
                        </div>
                        <!-- End Tab Single Item -->
                    </div>


                </div>

            </div>
        </div>
    </div>


    {{-- overview  --}}
    <div class="about-style-five-area default-padding overflow-hidden bg-cover"
        style="background: url(assets/img/shape/banner-3.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-style-five-thumb">
                        {{-- <img src="assets/img/overview.png" alt="Image Not Found"> --}}
                        {{-- <img src="assets/img/800x800.png" alt="Image Not Found"> --}}
                        <h2 style="margin-left:-7rem">Overview</h2>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="about-style-five-info">
                        <h4 class="sub-heading">Overview</h4>
                        <h2> Dubai Mainland Company Formation</h2>
                        <p>
                            Dubai Mainland companies enjoy extensive flexibility with minimal restrictions. They can conduct
                            business within and outside the UAE. Specific business activities do not even need local
                            sponsors. You get access to government contracts and a favorable environment. With over 2000+
                            activities and 100% ownership, seize the chance!

                            The cost of Mainland company formation in Dubai varies from AED 15,000 to AED 35,000. This range
                            depends on license type, business size, visas, office space, nature of operations, and other
                            variables.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Type of
                                    ============================================= -->
    <div class="home-blog-area default-padding bottom-less bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        {{-- <h4 class="sub-heading">Latest Blog</h4> --}}
                        <h2 class="title">Types of Dubai Mainland License</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <!-- Single Item -->
                <div class="col-xl-3 col-md-6 mb-30 wow fadeInUp typeOfCol" data-wow-delay="300ms">
                    <div class="blog-style-one">
                        <div class="thumb">
                            <a href="#"><img src="assets/img/800x600.png" alt="Thumb" /></a>
                        </div>
                        <div class="info">
                            <h4>
                                <a href="blog-single-with-sidebar.html"> Professional License</a>
                            </h4>
                            <p> Professional licensing confirms expertise for specific services. To get this license, you
                                need to have the necessary skills or training required for those services.</p>

                        </div>
                    </div>
                </div>
                <!-- End Single Item -->
                <!-- Single Item -->
                <div class="col-xl-3 col-md-6 mb-30 wow fadeInUp  typeOfCol" data-wow-delay="300ms">
                    <div class="blog-style-one">
                        <div class="thumb">
                            <a href="#"><img src="assets/img/800x600.png" alt="Thumb" /></a>
                        </div>
                        <div class="info">
                            <h4>
                                <a href="blog-single-with-sidebar.html"> Commercial License</a>
                            </h4>
                            <p>Mainland companies in the UAE must get a commercial trade license to do business, like buying
                                and selling goods. This license is vital for them to trade legally in the country.

                            </p>

                        </div>
                    </div>
                </div>
                <!-- End Single Item -->
                <!-- Single Item -->
                <div class="col-xl-3 col-md-6 mb-30 wow fadeInUp  typeOfCol" data-wow-delay="300ms">
                    <div class="blog-style-one">
                        <div class="thumb">
                            <a href="#"><img src="assets/img/800x600.png" alt="Thumb" /></a>
                        </div>
                        <div class="info">
                            <h4>
                                <a href="blog-single-with-sidebar.html"> Industrial License</a>
                            </h4>
                            <p>If businesses want to do industrial or manufacturing activities in the UAE, they must have an
                                industrial trade license.</p>

                        </div>
                    </div>
                </div>
                <!-- End Single Item -->
                <!-- Single Item -->
                <div class="col-xl-3 col-md-6 mb-30 wow fadeInUp  typeOfCol" data-wow-delay="300ms">
                    <div class="blog-style-one">
                        <div class="thumb">
                            <a href="#"><img src="assets/img/800x600.png" alt="Thumb" /></a>
                        </div>
                        <div class="info">
                            <h4>
                                <a href="blog-single-with-sidebar.html"> Tourism License</a>
                            </h4>
                            <p> Your business must have this license if it offers tourism-related services, such as hotels,
                                restaurants, and travel agencies..</p>

                        </div>
                    </div>
                </div>
                <!-- End Single Item -->


            </div>
        </div>
    </div>


    <!-- Business Legal
                                                                                                                                                                                                                                                                                                                                                                                                        ============================================= -->
    <div class="about-style-two-area overflow-hidden bg-contain bg-gray default-padding">
        <div class="container">
            <div class="row align-center">
                <div class="about-style-two col-lg-12 ">
                    <h2 class="title text-center">Business Legal Structures for Mainland</h2>
                    <p>
                        Have you aligned the structure of the company to your goal yet? A mainland business setup in Dubai
                        can choose from many types of legal entities. This variety allows entrepreneurs to determine the
                        structure that best suits their needs and circumstances.
                    </p>
                </div>


                <div class="col-lg-12  mt-5">
                    <div class="faq-style-one">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Civil Company
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            A Civil Company is owned by two or more partners. This type of company is
                                            engaged in professional activity, like consultancy, beauty salon, and coaching,
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Limited Liability Company (LLC)
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            A business structure with a single person or up to 50 partners where liability
                                            is only limited to the number of shares owned by the shareholders.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Sole Proprietorship
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            A business structure where a single person is the owner. The owner is completely
                                            liable for all liabilities and financial obligations.
                                        </p>
                                    </div>
                                </div>
                            </div>
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
            <img src="assets/img/shape/10.png" alt="Shape" />
        </div>
        <div class="center-shape" style="background-image: url(assets/img/shape/5.png);"></div>
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-12 mb-md-12">
                    <div class="service-nav-info">
                        <h4 class="sub-title">Latest</h4>
                        <h2>
                            Required Documents</h2>
                        <p>Find below the list of documents required for Mainland Company Formation in Dubai and the UAE.
                        </p>
                        <div class="nav nav-tabs service-tab-navs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-id-1" data-bs-toggle="tab" data-bs-target="#tab1"
                                type="button" role="tab" aria-controls="tab1" aria-selected="true">
                                <i class="fas fa-file-alt"></i>
                                Passport Copy (Valid for at least 6 months)
                            </button>

                            <button class="nav-link" id="nav-id-3" data-bs-toggle="tab" data-bs-target="#tab3"
                                type="button" role="tab" aria-controls="tab3" aria-selected="false">
                                <i class="fas fa-file-alt"></i>

                                Visa Page Copy (if applicable)
                            </button>
                            <button class="nav-link" id="nav-id-3" data-bs-toggle="tab" data-bs-target="#tab3"
                                type="button" role="tab" aria-controls="tab3" aria-selected="false">
                                <i class="fas fa-file-alt"></i>

                                Emirates ID (if applicable)
                            </button>
                            <button class="nav-link" id="nav-id-3" data-bs-toggle="tab" data-bs-target="#tab3"
                                type="button" role="tab" aria-controls="tab3" aria-selected="false">
                                <i class="fas fa-file-alt"></i>

                                Passport-sized Photos
                            </button>
                            <button class="nav-link" id="nav-id-3" data-bs-toggle="tab" data-bs-target="#tab3"
                                type="button" role="tab" aria-controls="tab3" aria-selected="false">
                                <i class="fas fa-file-alt"></i>

                                Personal Information Sheet or Application Form
                            </button>
                            <button class="nav-link" id="nav-id-3" data-bs-toggle="tab" data-bs-target="#tab3"
                                type="button" role="tab" aria-controls="tab3" aria-selected="false">
                                <i class="fas fa-file-alt"></i>

                                3 Name Choices
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services Style One -->






    <!-- Business Legal                                                        ============================================= -->
    <div class="about-style-two-area overflow-hidden bg-contain bg-gray default-padding">
        <div class="container">
            <div class="row offset-lg-1">
                <div class="about-style-two text-center">
                    <h4 style="color:#2C3F7E;text-transform:uppercase;font-weight:bold">
                        Dubai Mainland Business Setup Process
                    </h4>
                    <h2 class="title">Steps to start a business on the Mainland</h2>
                    <p>
                        Setting up a company in Dubai may seem daunting, but we’re here to guide you through the process
                        step by step. Here is your checklist for Mainland Company Formation in Dubai.
                    </p>
                </div>

                <div class="about-style-three">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="list-item-style-two wow fadeInUp">
                                <div class="number">01</div>
                                <div class="info" style="margin-top: 0.55rem">
                                    <h4>Choose your business activity</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-item-style-two wow fadeInUp">
                                <div class="number">02</div>
                                <div class="info" tyle="margin-top: 0.55rem">
                                    <h4>Take Initial Approvals from DED</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="list-item-style-two wow fadeInUp">
                                <div class="number">03</div>
                                <div class="info" tyle="margin-top: 0.55rem">
                                    <h4>Apply for External Approvals if required</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-item-style-two wow fadeInUp">
                                <div class="number">04</div>
                                <div class="info" tyle="margin-top: 0.55rem">
                                    <h4>Trade Name Reservation</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="list-item-style-two wow fadeInUp">
                                <div class="number">05</div>
                                <div class="info" tyle="margin-top: 0.55rem">
                                    <h4>Signing of MOA</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-item-style-two wow fadeInUp">
                                <div class="number">06</div>
                                <div class="info" tyle="margin-top: 0.55rem">
                                    <h4>Office space selection</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="list-item-style-two wow fadeInUp">
                                <div class="number">07</div>
                                <div class="info" tyle="margin-top: 0.55rem">
                                    <h4>Mainland license issuance</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-item-style-two wow fadeInUp">
                                <div class="number">08</div>
                                <div class="info" tyle="margin-top: 0.55rem">
                                    <h4>Apply for relevant visa</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- End About -->



    <!-- about
                                                                                                                                                                                                                                                                                                                                        ============================================= -->
    <div class="mission-vision-style-one-area overflow-hidden default-padding"
        style="background-image: url(assets/img/shape/banner-4.png);">

        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="tab-content mission-tab-content" id="nav-tabContent">
                        <!-- Tab Single Item -->
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                            aria-labelledby="nav-id-1">
                            <h2>Why Mind Meta Global for Mainland Company Formation in Dubai?</h2>
                            <p>
                                Mind Meta Global is a prominent consulting firm in Dubai. We focus on free zone and mainland
                                company
                                formation in Dubai. Our experts also help with financial and legal support. We handle
                                everything, from registering your business setup in Dubai mainland to helping it grow.
                                Mind Meta Global makes sure your business succeeds so you can have peace of mind.
                            </p>
                            {{-- <ul>
                                <li>Commitment and fairness</li>
                                <li>Respect and opportunity for our employees</li>
                                <li>Financial security and protection</li>
                            </ul> --}}
                        </div>
                        <!-- End Tab Single Item -->

                        <!-- Tab Single Item -->
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="nav-id-2">
                            <h2>Offer our customers <br> the lowest possible prices</h2>
                            <p>
                                A Promise of: Financial security and protection for our clients Commitment and fairness to
                                our agents Respect and opportunity for our employees Increasing value and reward for teams.
                            </p>
                            <ul>
                                <li>Business document</li>
                                <li>Strategic planning</li>
                                <li>Financial security and protection</li>
                            </ul>
                        </div>
                        <!-- End Tab Single Item -->
                    </div>


                </div>

                <div class="col-lg-5 offset-lg-1 mt-md-50 mt-xs-40">
                    <div class="faq-style-one">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Wide-Ranging Expertise
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            We have plenty of experience helping businesses, no matter their size, to start
                                            up, get legal guidance, and handle their finances. We put this knowledge to work
                                            by customizing solutions for you. We make sure our solutions fit exactly what
                                            your firm needs.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                                        Full-Scope Support
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            We help you with every step of mainland company formation in Dubai. This
                                            includes helping you set up your business and making sure you follow all
                                            financial rules and regulations. We guide you through the whole process to make
                                            sure you succeed.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">

                                        Your Vision Matters
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            For us, your goals are important. We work with you to create top-notch solutions
                                            for mainland company formation in Dubai, ones that will boost your success.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>





    {{-- updated faq  --}}
    <!-- Start Faq
                                                                                                                                                                                                                                                                                                ============================================= -->
    <div class="faq-style-one-area relative" style="background-image: url(assets/img/shape/banner-4.png);">
        <div class="container">
            <div class="row align-center">

                <div class="col-lg-6">
                    <div class="faq-style-one default-padding">
                        <h4 class="sub-heading">Basic faq</h4>
                        <h2 class="title mb-30">Common Question </h2>
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Where can I get analytics help?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            Bennings appetite disposed me an at subjects an. To no indulgence diminution so
                                            discovered mr apartments. Are off under folly death wrote cause her way spite.
                                            Plan upon yet way get cold spot its week. Almost do am or limits hearts. Resolve
                                            parties but why she shewing. She sang know now minute exact dear open to
                                            reaching out.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        How much does data analytics costs?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            Cennings appetite disposed me an at subjects an. To no indulgence diminution so
                                            discovered mr apartments. Are off under folly death wrote cause her way spite.
                                            Plan upon yet way get cold spot its week. Almost do am or limits hearts. Resolve
                                            parties but why she shewing. She sang know now minute exact dear open to
                                            reaching out.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        What kind of data is needed for analysis?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            Tennings appetite disposed me an at subjects an. To no indulgence diminution so
                                            discovered mr apartments. Are off under folly death wrote cause her way spite.
                                            Plan upon yet way get cold spot its week. Almost do am or limits hearts. Resolve
                                            parties but why she shewing. She sang know now minute exact dear open to
                                            reaching out.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 offset-lg-1 mt-120 mt-md-50 mt-xs-30">
                    <div class="faq-thumb">
                        <img src="assets/img/illustration/6.png" alt="Image Not Found">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Faq -->







    @include('user.partials.register-for-corporate-tax-section')

@endsection
