@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', 'Financial Services | Meta Mind Global')

@section('style')
    <style>
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

        .country-code {
            border: 1px solid rgb(214, 214, 214);
            padding: 0.5rem;
            border-radius: 10px;
        }

        .country-code option {
            padding: 0.5rem;
        }
        .fin-description-css{
            /* border:1px solid red; */
        }

        .fin-description-css h4{
           color:#022b6d;
           /* text-decoration: underline */
        }
    </style>
@endsection
@section('content')


    {{-- hero section  --}}
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url('assets/img/fin-service.jpg');">
        <div class="breadcrum-shape">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>
                        Accounting Services in Dubai, UAE</h1>
                    <p class="hero-description">
                        Looking for the top accounting company in Dubai? Avyanco is here to provide professional accounting
                        services to fulfill the accounting needs of your business.
                    </p>
                </div>
            </div>
        </div>
    </div>


    {{-- experience section  --}}
    <div class="mission-vision-style-one-area overflow-hidden default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="tab-content mission-tab-content" id="nav-tabContent">
                        <!-- Tab Single Item -->
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="nav-id-1">
                            <div class="col-lg-4 col-md-4 item">
                                <div class="fun-fact">
                                    <div class="counter">
                                        <div class="timer" data-to="10" data-speed="1000">10</div>
                                        <div class="operator">+</div>

                                    </div>
                                    <h3>Years Of Experience</h3>
                                </div>
                            </div>
                            <p>
                                Avyanco offers the best accounting services in Dubai. We have a team of skilled experts who
                                are dedicated to helping your business succeed. With our top-notch accounting service in
                                Dubai, we ensure you realize your corporate goals.

                                Register From Anywhere
                                Best In knowledge & Support
                                Transparent fee and Pricing
                                Still Confused about taking your decision?
                            </p>
                        </div>
                    </div>


                </div>

                <div class="col-lg-8  mt-md-50 mt-xs-40" style="z-index: -1">
                    <div class="row">
                        <!-- Audit Completed -->
                        <div class="col-xl-4 col-md-6 mb-4 d-flex align-items-stretch wow fadeInUp" data-wow-delay="300ms">
                            <div class="blog-style-one d-flex flex-column text-center w-100">
                                <div class="thumb mb-3">
                                    <a href="#"><img src="{{ asset('assets/img/audit.png') }}" alt="Audit Completed"
                                            class="img-fluid" /></a>
                                </div>
                                <div class="info">
                                    <h4><a>1500+</a></h4>
                                    <p>Audit Completed</p>
                                </div>
                            </div>
                        </div>

                        <!-- Financial Experts -->
                        <div class="col-xl-4 col-md-6 mb-4 d-flex align-items-stretch wow fadeInUp" data-wow-delay="300ms">
                            <div class="blog-style-one d-flex flex-column text-center w-100">
                                <div class="thumb mb-3">
                                    <a href="#"><img src="{{ asset('assets/img/fin_expert.png') }}"
                                            alt="Financial Experts" class="img-fluid" /></a>
                                </div>
                                <div class="info">
                                    <h4><a>Financial Experts</a></h4>
                                    {{-- <p>description</p> --}}
                                </div>
                            </div>
                        </div>

                        <!-- Consultation -->
                        <div class="col-xl-4 col-md-6 mb-4 d-flex align-items-stretch wow fadeInUp" data-wow-delay="300ms">
                            <div class="blog-style-one d-flex flex-column text-center w-100">
                                <div class="thumb mb-3">
                                    <a href="#"><img src="{{ asset('assets/img/consultation.png') }}" alt="Consultation"
                                            class="img-fluid" /></a>
                                </div>
                                <div class="info">
                                    <h4><a>2500+</a></h4>
                                    <p>Consultation</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="testimonial-style-two-carousel2 swiper">
                            <p>Government Agencies We Are Affiliated With</p>
                            <div class="swiper-wrapper">
                                @foreach ($ourPartners as $item)
                                    <div class="swiper-slide">
                                        <div class="testimonial-style-two" style="padding:0px">
                                            <div class="info">
                                                <div id="testimonialText1" style="display: flex; flex-direction: column;">
                                                    <img src="{{ asset($item->partner_image) }}" style="object-fit:cover">
                                                    <h4 class="short text-center mt-2 fw-bold">
                                                        {{ $item->name }}
                                                    </h4>

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
        </div>
    </div>


    {{-- descibe sevice page  --}}

    <div class="mission-vision-style-one-area overflow-hidden default-padding" style="background-color:#e1e1e1">

        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="tab-content mission-tab-content" id="nav-tabContent">
                        <!-- Tab Single Item -->
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="nav-id-1">
                            <h2> Professional Accounting
                                Services in UAE</h2>
                            <p>
                                Avyanco offers professional accounting services in Dubai to all types of businesses. Whether
                                you are a startup or an established business, you need accounting service providers to run
                                the business smoothly.

                                As a proficient accounting services provider, we have a team of experienced chartered
                                accountants. They record and maintain daily transactions, which can be instantly presented
                                for discrepancies or other issues.

                                Our team is intent on providing quality service to its clients by delivering reliable,
                                accurate, and timely advice to its customers. Our team consists of CA veterans who are
                                knowledgeable in various accounting services.

                                By connecting with us, you enjoy

                                Hassle-free account management
                                Reduced stress to focus on your business
                                Increased profitability
                                Minimize business risks by enhancing internal controls
                            </p>

                        </div>
                        <!-- End Tab Single Item -->
                    </div>
                    {{-- 
                        <div class="col-lg-5 offset-lg-1 mt-md-50 mt-xs-40">
                        <div class="faq-style-one">
                        <div class="accordion" id="faqAccordion">

                            @foreach ($comRegWhySec as $item)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $loop->index }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $loop->index }}">
                                            {{ $item->name }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $loop->index }}"
                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p>{!! $item->description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div> --}}
                </div>


            </div>
        </div>
    </div>


    <section class="container py-5 fin-description-css" >
        <h2 class="mb-4 fw-bold">Scale Your Business Operations Globally with Dubai Customs Registration</h2>
        <p>
            UAE is one of the largest hubs for importing and exporting commodities globally. Being the centre of
            international trade in the Middle East, UAE has strict Customs procedures to ensure a seamless movement of
            commodities in and out of the country.
        </p>
        <p>
            Businesses must obtain a valid trade licence and Clearance Code from the Customs Department to start an import
            export business in the UAE. This guide explains the eligibility criteria, application processes, and shipment
            protocols to equip businesses for compliance as they expand into international trade through the UAE.
        </p>

        <h4 class="mt-5 fw-bold">Obtaining Customs Code</h4>
        <p>
            A valid trade or business licence issued in the UAE is legally required for participating in cross-border trade.
            Dubai’s Customs officials provide businesses with a Client Code that pairs with the specific licence on file.
        </p>
        <p>
            The Customs Client Code authorises the movement of goods through customs. During shipment inspection, this code
            helps identify the shipments of a business to avoid any confusion with others. Businesses must renew their
            client codes annually to avoid any interruption in business operations.
        </p>
        <p>
            Getting a Customs Code is an online process:
        </p>
        <ul>
            <li>You must access the Dubai Trade Portal.</li>
            <li>Fill out the application.</li>
            <li>Submit copies of required documents, such as:
                <ul>
                    <li>Founding trade licence</li>
                    <li>Passports attached to ownership/management</li>
                    <li>Dubai Chamber of Commerce certificate</li>
                    <li>Undertaking letter</li>
                </ul>
            </li>
            <li>After receiving the application fee, officials review the application and all documents. If approved, a
                Customs Code is granted.</li>
        </ul>

        <h4 class="mt-5 fw-bold">Linking TRN</h4>
        <p>
            One of the important parts of new clearance procedures is to integrate tax registration numbers (TRNs) into a
            company’s customs code access and documentation. This allows cargo shipments to automatically generate a bill of
            value-added tax or VAT in the right category.
        </p>
        <p>To link the TRN number:</p>
        <ul>
            <li>Visit the Dubai Trade Portal.</li>
            <li>In the ‘User Management’ menu, click on “DP World VAT Profile.”</li>
            <li>Fill in the relevant details.</li>
            <li>Submit your application.</li>
            <li>Wait for a confirmation message from the Customs department.</li>
        </ul>
        <p>
            Once the TRN is integrated into your Client Code, the Customs department can check your tax status and the
            payable amount as your business performs import and export activities.
        </p>

        <h4 class="mt-5 fw-bold">Custom Clearance Charges in Dubai</h4>
        <p>The Customs Clearance charges may vary based on the type of shipment and several other factors:</p>
        <ul>
            <li>Import fee – 15–100 AED</li>
            <li>Export fee – 15–100 AED</li>
            <li>Transit fee – 15–80 AED</li>
            <li>Transfer fee – 80 AED</li>
            <li>Admission fee for a brief period – 100 AED</li>
            <li>Knowledge fee – 10 AED</li>
            <li>Innovation fee – 10 AED</li>
        </ul>

        <h4 class="mt-5 fw-bold">Restricted/Banned Goods</h4>
        <p>The following goods are restricted and banned in the UAE and require a permit:</p>
        <ul>
            <li>Pets (pre-approval with a medical test of the pet is mandatory)</li>
            <li>Food items</li>
            <li>Medicines (doctor’s prescription is necessary)</li>
            <li>Electronic or physical artwork</li>
            <li>Technical equipment (requires pre-approval in specific scenarios)</li>
            <li>Alcohol and cigarettes (must be over 18)</li>
        </ul>

        <h4 class="mt-5 fw-bold">Hire Avyanco’s Professional Services for All Your Customs-Related Requirements</h4>
        <p>
            If you are looking to start an import or export business in the UAE, you may have to go through lengthy
            procedures for every import or export activity you conduct. Hence, having an experienced partner like Avyanco
            can help streamline the processes and save you a lot of time.
        </p>
        <p>Avyanco’s team of experts assist you with:</p>
        <ul>
            <li>Company registration in the Chamber of Commerce</li>
            <li>Obtain Code of Clearance for Import/Export</li>
            <li>Integrating TRN with Code</li>
            <li>Import and export Client Code Renewal</li>
            <li>Obtaining Import/Export Permits</li>
            <li>Item registration in Dubai Municipality</li>
        </ul>

        <p>
            Starting a business in the UAE already involves many processes and compliances. We ensure that we take care of
            all your Customs-related requirements while you focus on your import/export business. <strong>Contact
                us</strong> to connect with an expert today.
        </p>
    </section>





    <!-- License
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ============================================= -->
    <div class="home-blog-area default-padding bottom-less bg-gray">
        <div class="container">
            <div class="row pb-4">
                <h2 class="title text-center">Benefits of Outsourcing Accounting <br> for Startups in Dubai</h2>
                <p class="text-center">There are multiple advantages of outsourcing your business’s accounting
                    requirements.
                    You
                    must
                    engage with a reputable firm providing tax accounting services in Dubai. Here are some of the
                    significant benefits of partnering with an accounting company –</p>
                <div class="devider"></div>
            </div>

            <div class="row">
                <div class=" col-xl-4 col-md-6 mb-30 wow fadeInUp typeOfCol d-flex" data-wow-delay="300ms">
                    <div class="blog-style-one flex-column">
                        <div class="info mt-3">
                            <h4 class="text-center fw-bold">
                                Time-Saving
                            </h4>
                            <p> Outsourcing your accounting requirements saves you a lot of time. As the business expands,
                                you have to focus on finances. A professional accounting firm caring for those needs helps
                                you focus your energy on the most crucial activity – scaling.</p>
                        </div>
                    </div>
                </div>
                <div class=" col-xl-4 col-md-6 mb-30 wow fadeInUp typeOfCol d-flex" data-wow-delay="300ms">
                    <div class="blog-style-one flex-column">
                        <div class="info mt-3">
                            <h4 class="text-center fw-bold">
                                Helps You Plan for Growth
                            </h4>
                            <p> Without reliable financial reporting, understanding your business’s finances might be
                                challenging. Engaging a reputable accounting services firm like Avyanco gives you a better
                                view of your current financial status. We help you assess key factors, such as margins, cost
                                of goods sold, and your growth goals. This critical analysis allows you to make future
                                business decisions.</p>
                        </div>
                    </div>
                </div>
                <div class=" col-xl-4 col-md-6 mb-30 wow fadeInUp typeOfCol d-flex" data-wow-delay="300ms">
                    <div class="blog-style-one flex-column">
                        <div class="info mt-3">
                            <h4 class="text-center fw-bold">
                                Helps You Draw in Investors
                            </h4>
                            <p> Investors and potential buyers would like to audit your company’s financial statements. They
                                want to ensure the business is profitable and growing as expected. You must engage a
                                reputable accounting solutions company to establish a sound accounting system to attract
                                them.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- @endif --}}
    </div>




    <!-- about
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ============================================= -->
    <div class="mission-vision-style-one-area overflow-hidden ">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="tab-content mission-tab-content" id="nav-tabContent">
                        <!-- Tab Single Item -->
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                            aria-labelledby="nav-id-1">
                            <h2> Why Avyanco for Professional Accounting Services in UAE?</h2>
                            <p>
                                Avyanco offers the best accounting services in Dubai. We have a team of skilled experts who
                                are dedicated to helping your business succeed. With our top-notch accounting service in
                                Dubai, we ensure you realize your corporate goals.

                                Register From Anywhere
                                Best In knowledge & Support
                                Transparent fee and Pricing
                                Still Confused about taking your decision?
                            </p>
                        </div>
                    </div>


                </div>

                <div class="col-lg-5 offset-lg-1 mt-md-50 mt-xs-40">
                    <div class="faq-style-one">
                        <div class="accordion" id="faqAccordion">

                            <!-- Accordion Item 1 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        Expertise
                                    </button>
                                </h2>
                                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        We have experienced chartered accountants (CAs) to manage your finances and ensure
                                        compliance at each step of your business journey.
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item 2 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        Ease
                                    </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        We are committed to providing you with the best accounting services by delivering
                                        excellent customer service and focusing on constant innovation.
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item 3 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        Clarity
                                    </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Our client-first approach and continuous innovation provide clarity
                                        to our clients and help drive their business growth.
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>








    {{-- faq section  --}}
    <div class="faq-style-one-area relative"
        style="background-image: url('{{ asset('assets/img/shape/banner-4.png') }}');">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-6">
                    <div class="faq-style-one default-padding">
                        <h4 class="sub-heading">Basic faq</h4>
                        <h2 class="title mb-30">Common Question </h2>
                        <div class="accordion" id="faqAccordion">
                            <!-- First item (open) -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFaq0">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFaq0" aria-expanded="true" aria-controls="collapseFaq0">
                                        What is the process of company registration?
                                    </button>
                                </h2>
                                <div id="collapseFaq0" class="accordion-collapse collapse show"
                                    aria-labelledby="headingFaq0" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>The company registration process involves choosing a structure, submitting
                                            required documents, and getting government approvals.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Second item (collapsed) -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFaq1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFaq1" aria-expanded="false"
                                        aria-controls="collapseFaq1">
                                        How long does it take to register a company?
                                    </button>
                                </h2>
                                <div id="collapseFaq1" class="accordion-collapse collapse" aria-labelledby="headingFaq1"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>Depending on the jurisdiction, it can take from a few days to a couple of weeks.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Third item (collapsed) -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFaq2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFaq2" aria-expanded="false"
                                        aria-controls="collapseFaq2">
                                        Do I need a local partner for company setup?
                                    </button>
                                </h2>
                                <div id="collapseFaq2" class="accordion-collapse collapse" aria-labelledby="headingFaq2"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>In certain jurisdictions, having a local sponsor or partner is mandatory,
                                            especially for mainland setups.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 offset-lg-1 mt-120 mt-md-50 mt-xs-30">
                    <div class="faq-thumb">
                        <img src="{{ asset('assets/img/illustration/6.png') }}" alt="Image Not Found">
                    </div>
                </div>
            </div>
        </div>
    </div>




    @include('user.partials.register-for-corporate-tax-section')

@endsection
