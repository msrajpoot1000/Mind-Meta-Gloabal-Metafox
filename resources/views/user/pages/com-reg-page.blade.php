@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', $comRegPage->name . ' | Meta Mind Global')


@section('style')
    <style>
        .navbar.validnavs.navbar-default .navbar-nav li a {
            color: black;
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
    </style>
@endsection

@section('content')





    {{-- hero section  --}}
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url('{{ asset($comRegPage->banner_image ?? '') }}');">
        <div class="breadcrum-shape">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>{{ $comRegPage->banner_heading }}</h1>
                    <p class="hero-description">
                        {!! $comRegPage->banner_description !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- @endif --}}




    {{-- benifits && features --}}
    @if ($comRegPage->benefits_description && $comRegPage->features_description)
        <div class="mission-vision-style-one-area overflow-hidden default-padding"
            style="background-image: url('{{ asset('assets/img/shape/banner.jpg') }}');">

            <div class="shape-top-left">
            </div>
            <div class="container">
                <div class="row">
                    @if ($comRegPage->benefits_description)
                        <div class="col-lg-6">
                            <div class="tab-content mission-tab-content" id="nav-tabContent">
                                <!-- Tab Single Item -->
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                    aria-labelledby="nav-id-1">
                                    <h2>Benefits</h2>


                                    <div class="putTickBeforeLi">
                                        {!! $comRegPage->benefits_description !!}

                                    </div>
                                </div>
                                <!-- End Tab Single Item -->
                            </div>
                        </div>
                    @endif
                    @if ($comRegPage->features_description)
                        <div class="col-lg-6">
                            <div class="tab-content mission-tab-content" id="nav-tabContent">
                                <!-- Tab Single Item -->
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                    aria-labelledby="nav-id-1">
                                    <h2>Features</h2>

                                    <div class="putTickBeforeLi">
                                        {!! $comRegPage->features_description !!}
                                    </div>
                                    <!-- End Tab Single Item -->
                                </div>
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif


    {{-- overview  --}}
    @if ($comRegPage->overview_heading)
        <div class="about-style-five-area default-padding overflow-hidden bg-cover"
            style="background: url('{{ asset('assets/img/shape/banner-3.jpg') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-style-five-thumb">
                            <h2 style="margin-left:-7rem">Overview</h2>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                        <div class="about-style-five-info">
                            <h4 class="sub-heading">Overview</h4>
                            <h2> {{ $comRegPage->overview_heading }}</h2>
                            {!! $comRegPage->overview_description !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- License ============================================= -->
    @if ($comRegPage->type_section_heading)
        <div class="home-blog-area default-padding bottom-less bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="site-heading text-center">
                            {{-- <h4 class="sub-heading">Latest Blog</h4> --}}
                            <h2 class="title">{{ $comRegPage->type_section_heading ?? '' }}</h2>
                            <div class="devider"></div>
                        </div>
                    </div>
                </div>
            </div>


            @if ($comRegLicenseSec->count())
                <div class="container">
                    <div class="row">
                        <!-- Single Item -->
                        @foreach ($comRegLicenseSec as $item)
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
    @if ($comRegPage->business_legal_description)
        <div class="about-style-two-area overflow-hidden bg-contain bg-gray default-padding">
            <div class="container">
                <div class="row align-center">
                    <div class="about-style-two col-lg-12 ">
                        <h2 class="title text-center">Business Legal Structures for {{ $comRegPage->name }}</h2>
                        <p>
                            {!! $comRegPage->business_legal_description !!}

                        </p>
                    </div>


                    <div class="col-lg-12 mt-5">
                        <div class="faq-style-one">
                            <div class="accordion" id="faqAccordion">

                                @foreach ($comRegBusinessLegalSec as $item)
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
    <!-- End About -->




    {{-- <!-- Start requrie doc --}}

    @if ($comRegRequireDocSec->count())
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
                                @foreach ($comRegRequireDocSec as $item)
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






    {{-- <!-- Business Legal    --}}
    @if ($comRegPage->step_section_heading)
        <div class="about-style-two-area overflow-hidden bg-contain bg-gray default-padding">
            <div class="container">
                <div class="row offset-lg-1">
                    <div class="about-style-two text-center">
                        <h4 style="color:#2C3F7E;text-transform:uppercase;font-weight:bold">
                            {{ $comRegPage->step_section_sub_heading }}
                        </h4>
                        <h2 class="title">{{ $comRegPage->step_section_heading }}</h2>
                        <p>
                            {!! $comRegPage->step_section_description !!}
                        </p>
                    </div>

                    <div class="about-style-three">

                        <div class="row">
                            @foreach ($comRegStepSec as $item)
                                <div class="col-md-6">
                                    <div class="list-item-style-two wow fadeInUp">
                                        <div class="number">{{ $loop->iteration }}</div>
                                        <div class="info" style="margin-top: 0.55rem">
                                            <h4>{{ $item->name }}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>



                    </div>
                </div>
            </div>

        </div>
    @endif
    <!-- End About -->



    <!-- about
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ============================================= -->

    @if ($comRegPage->why_section_heading && $comRegWhySec->count())
        <div class="mission-vision-style-one-area overflow-hidden default-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="tab-content mission-tab-content" id="nav-tabContent">
                            <!-- Tab Single Item -->
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                aria-labelledby="nav-id-1">
                                <h2> {{ $comRegPage->why_section_heading }}</h2>
                                <p>
                                    {!! $comRegPage->why_section_description !!}
                                </p>

                            </div>
                            <!-- End Tab Single Item -->

                            <!-- Tab Single Item -->
                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="nav-id-2">
                                <h2>Offer our customers <br> the lowest possible prices</h2>
                                <p>
                                    A Promise of: Financial security and protection for our clients Commitment and fairness
                                    to
                                    our agents Respect and opportunity for our employees Increasing value and reward for
                                    teams.
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
                        </div>
                    </div>


                </div>
            </div>
        </div>

    @endif








    {{-- updated faq  --}}
    {{-- <!-- Start Faq --}}

    @if ($comRegFaqSec->count())
        <div class="faq-style-one-area relative"
            style="background-image: url('{{ asset('assets/img/shape/banner-4.png') }}');">
            <div class="container">
                <div class="row align-center">

                    <div class="col-lg-6">
                        <div class="faq-style-one default-padding">
                            <h4 class="sub-heading">Basic faq</h4>
                            <h2 class="title mb-30">Common Question </h2>
                            <div class="accordion" id="faqAccordion">
                                @foreach ($comRegFaqSec as $item)
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
    <!-- End Faq -->



    @if ($comRegPage->extra_section)
        <div class="putTickBeforeLi container {{ empty($comRegPage->banner_image) ? 'mt-5' : '' }}">

            {!! $comRegPage->extra_section !!}
        </div>
    @endif







    @include('user.partials.register-for-corporate-tax-section')

@endsection
