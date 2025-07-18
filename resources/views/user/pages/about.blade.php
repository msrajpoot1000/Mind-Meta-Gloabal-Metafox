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


        .img-head {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease;
        }

        .img-head:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
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
    </style>
@endsection

@section('content')


    <!-- Start Breadcrumb
                                                                                                                                                                                                                                                                        ============================================= -->
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url(assets/img/about_banner.jpg);">
        <div class="breadcrum-shape">
            {{-- <img src="assets/img/shape/50.png" alt="Image Not Found"> --}}
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>About Us</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li>About</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->


    {{-- about content  --}}
    <div class="container ">

        <p class="mt-5" style="font-size: 1.2rem">
            The UAE market is infamous for acting as a driving force to bring out the best of your potential. Renowned for
            being one of the most diversified economies, UAE proves to be highly lucrative for upcoming businesses and
            entrepreneurs to make their space in the market. Despite the benefits that it offers, setting up a business in
            UAE comes with a set of complex challenges that require significant advisory and consultation.

            Avyanco is a certified business setup consultant and auditing firm in Dubai with a team of qualified and expert
            professionals. With our headquarters set in the UAE, we assist you at every step of way. We help with company
            registration in Dubai and providing all financial compliance services to upcoming entrepreneurs and foreign
            companies.
        </p>
        <a href="path/to/your-file.pdf" download class="btn btn-primary  mb-5" style="background-color:black">
            <i class="fas fa-download"></i> Download PDF
        </a>

    </div>







    {{-- what we offer  --}}
    <div class="services-details-area overflow-hidden default-padding">
        <div class="container">
            <div class="services-details-items">
                <div class="row">
                    <h2 class="title">What We Offer</h2>


                    <div class="features mt-40 mt-xs-30 mb-30 mb-xs-20">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="content">
                                    <ul class="feature-list-item">
                                        <li>Company Formation/Registration</li>
                                        <li>Company License Renewals</li>
                                        <li>UAE Local Sponsorship Services</li>
                                        <li>Visa Services</li>
                                        <li>Corporate PRO Services</li>
                                        <li>Document Clearing Services</li>
                                        <li>Accounting and Bookkeeping Services</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="content">

                                    <ul class="feature-list-item">
                                        <li>External Audit Services</li>
                                        <li>Internal Audit Services</li>
                                        <li>Trademark Registration Services</li>
                                        <li>Economic Substance Regulation Services</li>
                                        <li>Ultimate Beneficial Owner Disclosure Services</li>
                                        <li>VAT Registration and Consultation Services</li>
                                        <li>AML Regulations</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Services Details Area -->



    {{-- missoion vision and all  --}}
    {{-- <div class="services-style-one-area default-padding bg-gray">
        <div class="triangle-shape">
        </div>
        <div class="center-shape" style="background-image: url(assets/img/shape/5.png);"></div>
        <div class="container">
            <div class="row align-center">

                <div class="col-lg-12 pl-50 pl-md-15 pl-xs-15">
                    <div class="tab-content services-tab-content" id="nav-tabContent">

                        <!-- Tab Single Item -->
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="nav-id-1">
                            <div class="row">
                              
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30 wow fadeInUp">
                                    <div class="services-style-one">
                                        <i class="flaticon-personal"></i>
                                        <h4><a href="services-single.html">Our Mission</a></h4>
                                        <p>
                                            In the fast-developing business landscape, we strive to empower entrepreneurs
                                            and founders by delivering them with the most appropriate business and fiscal
                                            consultation.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30 wow fadeInUp" data-wow-delay="300ms">
                                    <div class="services-style-one">
                                        <i class="flaticon-career"></i>
                                        <h4><a href="services-single.html">Our Vision</a></h4>
                                        <p>
                                            We are committed to designing your business world through an unbeatable
                                            assistance plan, thus empowering you to acquaint yourself with emerging
                                            processes, regulations, and technologies.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30 wow fadeInUp" data-wow-delay="500ms">
                                    <div class="services-style-one">
                                        <i class="flaticon-group"></i>
                                        <h4><a href="services-single.html">Our Values</a></h4>
                                        <p>
                                            At Avyanco, we're committed to client success, integrity, expertise, efficiency,
                                            and global-local partnerships. Your journey to business setup is our priority.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30 wow fadeInUp" data-wow-delay="700ms">
                                    <div class="services-style-one">
                                        <i class="flaticon-solution-5"></i>
                                        <h4><a href="services-single.html">Company Culture</a></h4>
                                        <p>
                                            At Avyanco, we cultivate innovation, collaboration, and diversity. Our culture
                                            promotes growth, client dedication, and unwavering integrity.
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
                                        <h4><a href="services-single.html">Strategy & Planning</a></h4>
                                        <p>
                                            Prevailed always tolerably discourse and loser assurance creatively coin
                                            applauded more uncommonly. Him everything trouble
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-online-store"></i>
                                        <h4><a href="services-single.html">Online Business</a></h4>
                                        <p>
                                            Prevailed always tolerably discourse and loser assurance creatively coin
                                            applauded more uncommonly. Him everything trouble
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-funds"></i>
                                        <h4><a href="services-single.html">Saving & Investments</a></h4>
                                        <p>
                                            Prevailed always tolerably discourse and loser assurance creatively coin
                                            applauded more uncommonly. Him everything trouble
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-career"></i>
                                        <h4><a href="services-single.html">Markets Research</a></h4>
                                        <p>
                                            Prevailed always tolerably discourse and loser assurance creatively coin
                                            applauded more uncommonly. Him everything trouble
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
                                        <h4><a href="services-single.html">Investment Planning</a></h4>
                                        <p>
                                            Prevailed always tolerably discourse and loser assurance creatively coin
                                            applauded more uncommonly. Him everything trouble
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-money-1"></i>
                                        <h4><a href="services-single.html">Mutual Funds</a></h4>
                                        <p>
                                            Prevailed always tolerably discourse and loser assurance creatively coin
                                            applauded more uncommonly. Him everything trouble
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-funds"></i>
                                        <h4><a href="services-single.html">Saving & Investments</a></h4>
                                        <p>
                                            Prevailed always tolerably discourse and loser assurance creatively coin
                                            applauded more uncommonly. Him everything trouble
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30">
                                    <div class="services-style-one">
                                        <i class="flaticon-world-globe"></i>
                                        <h4><a href="services-single.html">Global Business</a></h4>
                                        <p>
                                            Prevailed always tolerably discourse and loser assurance creatively coin
                                            applauded more uncommonly. Him everything trouble
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
    </div> --}}

    {{-- testimonial  --}}

    <!-- Start Testimonials ============================================= -->
    {{-- @if ($testimonials->count())
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
    @endif --}}





    {{-- our partners  --}}

    <!-- Start Partner Area
                                                                                                                                                                            ============================================= -->

    <!-- Logo Section -->
    <section class="partner-logo-section bg-light " style="padding-top: 2rem;">
        <h2 class="title text-center" style="margin-top: 4rem;">Our Partners</h2>
        <div class="container " style="margin-top: 4rem; margin-bottom: 4rem;">


            <div class="row g-3">
                <!-- Logo 1 -->
                <div class="col-6 col-md-3 ">
                    <div class="img-head  d-flex justify-content-center p-3 ">
                        <img src="assets/img/logo/1.png" class="img-fluid" alt="Logo 1">
                    </div>
                </div>

                <!-- Logo 2 -->
                <div class="col-6 col-md-3 ">
                    <div class="img-head  d-flex justify-content-center p-3">
                        <img src="assets/img/logo/2.png" class="img-fluid" alt="Logo 2">
                    </div>
                </div>

                <!-- Logo 3 -->
                <div class="col-6 col-md-3 ">
                    <div class="img-head  d-flex justify-content-center p-3">
                        <img src="assets/img/logo/7.png" class="img-fluid" alt="Logo 3">
                    </div>
                </div>

                <!-- Logo 4 -->
                <div class="col-6 col-md-3 ">
                    <div class="img-head  d-flex justify-content-center p-3">
                        <img src="assets/img/logo/4.png" class="img-fluid" alt="Logo 4">
                    </div>
                </div>

                <!-- Logo 5 -->
                <div class="col-6 col-md-3 ">
                    <div class="img-head  d-flex justify-content-center p-3">
                        <img src="assets/img/logo/5.png" class="img-fluid" alt="Logo 5">
                    </div>
                </div>

                <!-- Logo 6 -->
                <div class="col-6 col-md-3 ">
                    <div class="img-head  d-flex justify-content-center p-3">
                        <img src="assets/img/logo/6.png" class="img-fluid" alt="Logo 6">
                    </div>
                </div>
            </div>

        </div>
    </section>



    <!-- End Partner Area -->




    @include('user.partials.register-for-corporate-tax-section')

@endsection
