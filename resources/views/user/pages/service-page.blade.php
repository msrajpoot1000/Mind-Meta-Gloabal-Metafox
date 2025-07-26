@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', $servicePage->name . '| Meta Mind Global')

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

        .step-content {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .step-content.active {
            display: block;
            opacity: 1;
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


        .step-item {
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .step-content h1 {}

        .step-item.active {
            font-weight: bold;
            color: #007bff;
        }
    </style>
@endsection





@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stepItems = document.querySelectorAll(".step-item");
            const stepContents = document.querySelectorAll(".step-content");

            // Function to activate an item by step number
            function activateStep(step) {
                stepItems.forEach(i => i.classList.remove("active"));
                stepContents.forEach(c => c.classList.remove("active"));

                const activeItem = document.querySelector(`.step-item[data-step="${step}"]`);
                const activeContent = document.querySelector(`.step-content[data-step="${step}"]`);

                if (activeItem && activeContent) {
                    activeItem.classList.add("active");
                    activeContent.classList.add("active");
                }
            }

            // Click event instead of hover
            stepItems.forEach(item => {
                item.addEventListener("click", () => {
                    const step = item.getAttribute("data-step");
                    activateStep(step);
                });
            });

            // Automatically activate first item on load
            activateStep("1");
        });
    </script>

@endsection


@section('content')


    {{-- hero section  --}}
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url({{ asset($servicePage->banner_image) }});">
        <div class="breadcrum-shape">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>
                        {{ $servicePage->banner_heading }}</h1>
                    <p class="hero-description">
                        {!! $servicePage->banner_description !!}
                    </p>
                </div>
            </div>
        </div>
    </div>


    {{-- why you set up the comopany  --}}
    <div class="pricing-style-one-area secondary default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading secondary text-center">

                        <h2 class="title">Why should you Register a Company in Dubai, UAE?</h2>

                        <div class="devider"></div>
                    </div>
                </div>
                <p>UAE being the center point of world commerce offers a host of advantages like low or no taxes, technology
                    advanced community, free trade zones, strict levels of confidentiality, and rapid development making it
                    the best choice for doing business.</p>
                <p>There is no doubt that Dubai is one of the biggest ever-growing economic hubs of the Middle East.
                    Business owners will get a highly lucrative environment to experience the valuable benefits of 100%
                    foreign ownership, up-scaled business infrastructure, a high-class lifestyle, and greater business
                    opportunities.</p>
                <p>
                    BHowever, starting a company in Dubai could be a time-consuming and complex process, especially for
                    beginners, who don’t have proper knowledge and planning of their business activities. The government of
                    Dubai has instilled strict measures to qualify for company registration in Dubai. But with proper
                    guidance and understanding of legal terms and facts, your company gets legal within 24 hours.
                </p>
            </div>
        </div>

    </div>


    {{-- how to register  --}}
    <div class="pricing-style-one-area secondary default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading secondary text-center">

                        <h2 class="title">How to Register a Company in Dubai?</h2>

                        <div class="devider"></div>
                    </div>
                </div>
                <p>Registering a company in Dubai, the United Arab Emirates allows you to experience the profitable business
                    environment by taking advantage of the great benefits of the United Arab Emirates.</p>
                <p>It is a popular choice amongst international investors establishing a company with 100% foreign
                    ownership, ease of doing business, e-governance system, top-class lifestyle, tax savings, up-scaled
                    business infrastructure, and growing business timeliness.</p>
                <p>
                    Investors can choose from a variety of corporate registration options in the region. In this guide, we
                    will cover every aspect of Company registration in Dubai so that you can smoothly head into a business
                    acquisition in Dubai.
                </p>
            </div>
        </div>

    </div>


    {{-- step section  --}}

    <div class="about-style-two-area overflow-hidden bg-contain bg-gray default-padding"
        style="background-image: url(assets/img/shape/29.png);">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4 class="sub-heading">Key Steps</h4>
                        <h2 class="title">Find the 7 Key Steps to Register a Company in Dubai</h2>
                        <p>Business registration is Dubai is not difficult. Government authorities provide detailed steps on
                            how to register a company in Dubai, UAE. Here are all the major steps for new company
                            registration in Dubai and the UAE are listed below:</p>
                        <div class="devider"></div>
                    </div>
                </div>
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-5 about-style-two">
                        <div class="thumb">
                            <div class="list-container">
                                <ol class="custom-list">
                                    @foreach ($serviceStepSec as $item)
                                        <li class="step-item active" data-step="{{ $item->id }}">{{ $loop->iteration }}
                                            {{ $item->name }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="about-style-two col-lg-6 offset-lg-1 shadow-sm"
                        style="background-color: white;border-radius:10px;border:1px solid rgb(182, 180, 180)">
                        <div class="default-features mt-30">
                            @foreach ($serviceStepSec as $item)
                                <div class="default-feature-item step-content {{ $loop->iteration == 1 ? 'active' : '' }}"
                                    data-step="{{ $item->id }}">
                                    <i class="flaticon-investment-3"></i>
                                    <h4>{{ $item->name }}</h4>
                                    <p class="mt-2">{!! $item->step_description !!}
                                    </p>
                                </div>
                            @endforeach



                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




    {{-- license section  --}}
    @if ($servicePage->license_section_heading)
        <div class="home-blog-area default-padding bottom-less bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="site-heading text-center">
                            {{-- <h4 class="sub-heading">Latest Blog</h4> --}}
                            <h2 class="title">{{ $servicePage->license_section_heading ?? '' }}</h2>
                            <div class="devider"></div>
                        </div>
                    </div>
                </div>
            </div>


            @if ($serviceLicenseSec->count())
                <div class="container">
                    <div class="row">
                        <!-- Single Item -->
                        @foreach ($serviceLicenseSec as $item)
                            <div class="col-xl-3 col-md-6 mb-30 wow fadeInUp typeOfCol d-flex" data-wow-delay="300ms">
                                <div class="blog-style-one flex-column">
                                    <div class="thumb">
                                        <a href="#"><img src="{{ asset($item->license_image) }}" alt="Thumb" /></a>
                                    </div>
                                    <div class="info">
                                        <h4>
                                            <a>{{ $item->license_name }}</a>
                                        </h4>
                                        <p> {!! $item->license_description !!}</p>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- End Single Item -->
                    </div>
                </div>
            @endif
        </div>
    @endif


    <!-- Business Legal
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ============================================= -->
    {{-- @if ($servicePage->business_legal_description)
        <div class="about-style-two-area overflow-hidden bg-contain bg-gray default-padding">
            <div class="container">
                <div class="row align-center">
                    <div class="about-style-two col-lg-12 ">
                        <h2 class="title text-center">Business Legal Structures for {{ $servicePage->name }}</h2>
                        <p>
                            {!! $servicePage->business_legal_description !!}

                        </p>
                    </div>


                    <div class="col-lg-12 mt-5">
                        <div class="faq-style-one">
                            <div class="accordion" id="faqAccordion">

                                @foreach ($serviceBusinessLegalSec as $item)
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
                        </div>
                    </div>


                </div>

            </div>
        </div>
    @endif --}}


    {{-- requried section  --}}

    <div class="services-style-one-area default-padding bg-gray">
        <div class="center-shape" style="background-image: url('{{ asset('assets/img/shape/5.png') }}');"></div>
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-12 mb-md-12">
                    <div class="service-nav-info">
                        <h4 class="sub-title">Latest</h4>
                        <h2>Required Documents</h2>
                        <p>Find below the list of documents required for Mainland Company Formation in Dubai and the UAE.
                        </p>
                        <div class="nav nav-tabs service-tab-navs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-id-1" data-bs-toggle="tab" data-bs-target="#tab1"
                                type="button" role="tab" aria-controls="tab1" aria-selected="true">
                                <i class="fas fa-file-alt"></i> Passport Copy
                            </button>
                            <button class="nav-link" id="nav-id-2" data-bs-toggle="tab" data-bs-target="#tab2"
                                type="button" role="tab" aria-controls="tab2" aria-selected="false">
                                <i class="fas fa-file-alt"></i> Visa Page Copy
                            </button>
                            <button class="nav-link" id="nav-id-3" data-bs-toggle="tab" data-bs-target="#tab3"
                                type="button" role="tab" aria-controls="tab3" aria-selected="false">
                                <i class="fas fa-file-alt"></i> Emirates ID Copy
                            </button>
                            <button class="nav-link" id="nav-id-4" data-bs-toggle="tab" data-bs-target="#tab4"
                                type="button" role="tab" aria-controls="tab4" aria-selected="false">
                                <i class="fas fa-file-alt"></i> Utility Bill
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    {{-- benifits section  --}}


    <div class="home-blog-area default-padding bottom-less bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="site-heading text-center">
                        {{-- <h4 class="sub-heading">Latest Blog</h4> --}}
                        <h2 class="title">{{ $servicePage->benefit_heading }}​</h2>
                        <p>{!! $servicePage->benefits_description !!}</p>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container ">
            <div class="row">
                <!-- Single Item -->
                @foreach ($serviceBenefitSec as $item)
                    <div class="col-xl-3 col-md-6 mb-30 wow fadeInUp typeOfCol d-flex" data-wow-delay="300ms">
                        <div class="blog-style-one flex-column pt-4">
                            <div class="info">
                                <h4>
                                    <a>{{ $item->name }}</a>
                                </h4>
                                <p> {!! $item->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <!-- End Single Item --> --}}
            </div>
        </div>
    </div>



    {{-- faq  --}}
    @if ($serviceFaqSec->count())
        <div class="faq-style-one-area relative"
            style="background-image: url('{{ asset('assets/img/shape/banner-4.png') }}');">
            <div class="container">
                <div class="row align-center">

                    <div class="col-lg-6">
                        <div class="faq-style-one default-padding">
                            <h4 class="sub-heading">Basic faq</h4>
                            <h2 class="title mb-30">Common Question </h2>
                            <div class="accordion" id="faqAccordion">
                                @foreach ($serviceFaqSec as $item)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFaq{{ $loop->index }}">
                                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseFaq{{ $loop->index }}"
                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                aria-controls="collapseFaq{{ $loop->index }}">
                                                {{ $item->ques }}
                                            </button>
                                        </h2>
                                        <div id="collapseFaq{{ $loop->index }}"
                                            class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                            aria-labelledby="headingFaq{{ $loop->index }}"
                                            data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <p>{!! $item->ans !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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

    @endif


    @include('user.partials.register-for-corporate-tax-section')

@endsection
