@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', 'Financial Services | Meta Mind Global')

@section('style')

    <style>
        .fin-description-css {
            /* border:1px solid red; */
        }

        .fin-description-css h4 {
            color: #022b6d;
            /* text-decoration: underline */
        }
    </style>
@endsection
@section('content')


    {{-- hero section  --}}
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url({{ asset($item2->banner_image) }});">
        <div class="breadcrum-shape">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>
                        {{ $item2->banner_heading }}</h1>
                    <p class="hero-description">
                        {!! $item2->banner_description !!}
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
                                    <a href="#"><img src="{{ asset('assets/img/consultation.png') }}"
                                            alt="Consultation" class="img-fluid" /></a>
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

    @if ($item2->page_sec_heading || $item2->page_sec_description)
        <div class="mission-vision-style-one-area overflow-hidden default-padding" style="background-color:#e1e1e1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content mission-tab-content" id="nav-tabContent">
                            <!-- Tab Single Item -->
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                aria-labelledby="nav-id-1">
                                <h2> {{ $item2->page_sec_heading }}</h2>
                                <p>
                                    {!! $item2->page_sec_description !!} </p>

                            </div>
                            <!-- End Tab Single Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif



    {{-- extra section  --}}
    @if ($item2->extra_section)
        <div class="default-padding putTickBeforeLi container">
            {!! $item2->extra_section !!}
        </div>
    @endif



    <!-- benefit section
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ============================================= -->
    {{-- hello --}}
    @if ($finServiceBenefitSec->count())
        <div class="home-blog-area default-padding bottom-less bg-gray">
            <div class="container">
                <div class="row pb-4">
                    <h2 class="title text-center">{{ $item2->benefit_sec_heading }}</h2>
                    <p class="text-center">{!! $item2->benefit_sec_description !!}</p>
                    <div class="devider"></div>
                </div>

                <div class="row">
                    @foreach ($finServiceBenefitSec as $item)
                        <div class=" col-xl-4 col-md-6 mb-30 wow fadeInUp typeOfCol d-flex" data-wow-delay="300ms">
                            <div class="blog-style-one flex-column">
                                <div class="info mt-3">
                                    <h4 class="text-center fw-bold">
                                        {{ $item->name }}
                                    </h4>
                                    <div class="putTickBeforeLi">
                                        <p> {!! $item->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            {{-- @endif --}}
        </div>

    @endif




    <!-- about
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ============================================= -->
    @if ($item2->why_section_heading)
        <div class="putTickBeforeLi mission-vision-style-one-area overflow-hidden default-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="tab-content mission-tab-content" id="nav-tabContent">
                            <!-- Tab Single Item -->
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                aria-labelledby="nav-id-1">
                                <h2> {{ $item2->why_section_heading }}</h2>
                                <p>
                                    {!! $item2->why_section_description !!}
                                </p>

                            </div>
                        </div>


                    </div>

                    <div class="col-lg-5 offset-lg-1 mt-md-50 mt-xs-40">
                        <div class="faq-style-one">
                            <div class="accordion" id="faqAccordion">

                                <!-- Accordion Item 1 -->
                                @foreach ($finServiceWhySec as $index => $item)
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



    {{-- faq section  --}}
    @if ($finServiceFaqSec->count())
        <div class="faq-style-one-area relative"
            style="background-image: url('{{ asset('assets/img/shape/banner-4.png') }}');">
            <div class="container">
                <div class="row align-center">

                    <div class="col-lg-6">
                        <div class="faq-style-one default-padding">
                            <h4 class="sub-heading">Basic faq</h4>
                            <h2 class="title mb-30">Common Question </h2>
                            <div class="accordion" id="faqAccordion">
                                @foreach ($finServiceFaqSec as $item)
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
