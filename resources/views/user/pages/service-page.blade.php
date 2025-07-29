@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', $servicePage->name . '| Meta Mind Global')

@section('style')
    <style>
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



    {{-- extra section  --}}
    @if ($servicePage->extra_section)
        <div class="default-padding putTickBeforeLi container">
            {!! $servicePage->extra_section !!}
        </div>
    @endif


    {{-- step section  --}}

    @if ($serviceStepSec->count())
        <div class="about-style-two-area overflow-hidden bg-contain bg-gray default-padding"
            style="background-image: url(assets/img/shape/29.png);">
            <div class="container">
                <div class="row align-center">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="site-heading text-center">
                            <h4 class="sub-heading">Key Steps</h4>
                            <h2 class="title">Find the 7 Key Steps to Register a Company in Dubai</h2>
                            <p>Business registration is Dubai is not difficult. Government authorities provide detailed
                                steps on
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
                                            <li class="step-item active" data-step="{{ $item->id }}">
                                                {{ $loop->iteration }}
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
    @endif




    {{-- license section  --}}
    @if ($servicePage->license_section_heading && $serviceLicenseSec->count())
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


    {{-- <!-- Business Legal --}}

    @if ($serviceBusinessLegalSec->count())
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
    @endif


    {{-- <!-- Start requrie doc --}}

    @if ($serviceRequireDocSec->count())
        <div class="services-style-one-area default-padding bg-gray">
            <div class="center-shape" style="background-image: url('{{ asset('assets/img/shape/5.png') }}');"></div>
            <div class="container">
                <div class="row align-center">
                    <div class="col-lg-12 mb-md-12">
                        <div class="service-nav-info">
                            <h4 class="sub-title">Latest</h4>
                            <h2>
                                Required Documents</h2>
                            <p>Find below the list of documents required for Mainland Company Formation in Dubai and the
                                UAE.
                            </p>
                            <div class="nav nav-tabs service-tab-navs" id="nav-tab" role="tablist">
                                @foreach ($serviceRequireDocSec as $item)
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="nav-id-3"
                                        data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab"
                                        aria-controls="tab3" aria-selected="false">
                                        <i class="fas fa-file-alt"></i>

                                        {{ $item->name }}
                                    </button>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- End Services Style One -->





    {{-- benifits section  --}}
    @if ($servicePage->benefit_heading)
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
    @endif


    {{-- why section  --}}
    @if ($servicePage->why_section_heading)
        <div class="putTickBeforeLi mission-vision-style-one-area overflow-hidden default-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="tab-content mission-tab-content" id="nav-tabContent">
                            <!-- Tab Single Item -->
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                aria-labelledby="nav-id-1">
                                <h2> {{ $servicePage->why_section_heading }}</h2>
                                <p>
                                    {!! $servicePage->why_section_description !!}
                                </p>

                            </div>
                        </div>


                    </div>

                    <div class="col-lg-5 offset-lg-1 mt-md-50 mt-xs-40">
                        <div class="faq-style-one">
                            <div class="accordion" id="faqAccordion">

                                <!-- Accordion Item 1 -->
                                @foreach ($serviceWhySec as $index => $item)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $index }}">
                                            <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $index }}"
                                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $index }}">
                                                {{ $item->name }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $index }}"
                                            class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                {!! $item->description !!}
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

    @endif



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
