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


        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .hero {
            background: linear-gradient(135deg, #022b6d, #363795);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .hero h1 {
            font-weight: 700;
            font-size: 2.5rem;
        }

        .section-title {
            color: #343a40;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .mantras li {
            margin-bottom: 15px;
        }


        .card-title {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .card-text {
            font-size: 0.95rem;
            line-height: 1.6;
        }


        .mantras .card {
            transition: transform 0.5s ease;
        }

        .mantras .card:hover {
            transform: scale(1.05);
            z-index: 1;
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
        <a href="{{ url($company->about_pdf) }}" type="black" download class="btn btn-primary  mb-5"
            style="background-color:black">
            <i class="fas fa-download"></i> Download PDF
        </a>

    </div>


    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 style="color:white">Unlocking the UAE's Potential</h1>
            <p class="lead">Navigating Business Success with Mind Meta Global</p>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="container py-5">
        <p>
            The United Arab Emirates (UAE) market is renowned globally as a dynamic force that truly brings out the best in
            entrepreneurial potential.
            Celebrated for its status as one of the world's most diversified and rapidly expanding economies, the UAE stands
            as a beacon for aspiring entrepreneurs
            and established foreign companies alike.
        </p>
        <p>
            However, the journey of establishing a business in this vibrant economy, despite its numerous benefits, comes
            with a unique set of complex challenges.
            This is precisely where Mind Meta Global steps in.
        </p>
    </section>

    <!-- About Company Section -->
    <section class="container py-4">
        <h2 class="section-title">Your Trusted Partner in the UAE Business Landscape</h2>
        <p>
            Mind Meta Global is a certified business setup consultant firm based in Dubai. With a team of highly qualified
            and expert professionals,
            we offer the essential guidance and expertise needed to transform complexity into clarity.
        </p>
        <p>
            Our core services include company registration in Dubai, robust financial compliance services, and customized
            support for entrepreneurs and
            foreign companies alike.
        </p>
    </section>

    <section class="py-5 bg-light" style="background-image: url('assets/img/mantras.avif');">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">The Five Mantras: Guiding Principles</h2>
            <div class="row g-4 mantras">

                <!-- Customer Focus -->
                <div class="col-lg-4 wow fadeInUp">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-center">1) Customer Focus</h5>
                            <p class="card-text">We make every customer feel valued by deeply understanding individual
                                requirements and tailoring precise, supportive solutions.</p>
                        </div>
                    </div>
                </div>

                <!-- Integrity -->
                <div class="col-lg-4 wow fadeInUp">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-center">2) Integrity</h5>
                            <p class="card-text">We uphold the highest standards of ethics, governance, and transparency,
                                building long-term relationships based on trust.</p>
                        </div>
                    </div>
                </div>

                <!-- Inclusivity -->
                <div class="col-lg-4 wow fadeInUp">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-center">3) Inclusivity</h5>
                            <p class="card-text">We champion diversity and equal opportunity—internally and externally—by
                                serving unserved and underserved populations.</p>
                        </div>
                    </div>
                </div>

                <!-- Innovation -->
                <div class="col-lg-6 wow fadeInUp">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-center">4) Innovation</h5>
                            <p class="card-text">We continuously improve our processes and services by embracing technology
                                and forward-thinking strategies that simplify business setup.</p>
                        </div>
                    </div>
                </div>

                <!-- Excellence -->
                <div class="col-lg-6 rounded-lg wow fadeInUp">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-center">5) Excellence</h5>
                            <p class="card-text">We deliver high-quality services with a strong focus on risk management,
                                continuous improvement, and adaptability to market changes.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- CTA Section -->
    <section class="container py-5 text-center">
        <p class="fs-5">
            For entrepreneurs and companies ready to harness the vast opportunities the UAE offers, partnering with a
            strategic consultant like Mind Meta Global
            is not just an advantage—it's a necessity for thriving in this dynamic economy.
        </p>
        <h4 class="mt-4 fw-bold">Mind Meta Global</h4>
        <p class="fst-italic">Elevate Your Vision, We Empower Your Business.</p>
        <p class="text-primary">#EmpowerYourBusiness</p>
    </section>






    {{-- what we offer  --}}
    <div class="services-details-area overflow-hidden default-padding"
        style="background-image: url('{{ asset('assets/img/shape/52.png') }}')">
        <div class="container">
            <div class="services-details-items">
                <div class="row">
                    <h2 class="title">What We Offer</h2>


                    <div class="features mt-xs-30 mb-30 mb-xs-20">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>Company Formation/Registration</h5>
                                    </div>
                                </div>

                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>Company License Renewals</h5>
                                    </div>
                                </div>

                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>UAE Local Sponsorship Services</h5>
                                    </div>
                                </div>

                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>Visa Services</h5>
                                    </div>
                                </div>

                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>Corporate PRO Services</h5>
                                    </div>
                                </div>

                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>Document Clearing Services</h5>
                                    </div>
                                </div>

                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>Accounting and Bookkeeping Services</h5>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>External Audit Services</h5>
                                    </div>
                                </div>

                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>Internal Audit Services</h5>
                                    </div>
                                </div>

                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>Trademark Registration Services</h5>
                                    </div>
                                </div>

                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>Economic Substance Regulation Services</h5>
                                    </div>
                                </div>

                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>Ultimate Beneficial Owner Disclosure Services</h5>
                                    </div>
                                </div>

                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>VAT Registration and Consultation Services</h5>
                                    </div>
                                </div>

                                <div class="list-item-style-two wow fadeInUp">
                                    <div class="number"><i class="fas fa-chevron-right mr-4"></i></div>
                                    <div class="info" style="margin-top: 0.55rem">
                                        <h5>AML Regulations</h5>
                                    </div>
                                </div>

                            </div>
                            {{-- <div class="col-lg-6 col-md-6">
                                <div class="content">
                                    <ul class="">
                                        <li>
                                            Company Formation/Registration
                                        </li>
                                        <li>Company License Renewals</li>
                                        <li>UAE Local Sponsorship Services</li>
                                        <li>Visa Services</li>
                                        <li>Corporate PRO Services</li>
                                        <li>Document Clearing Services</li>
                                        <li>Accounting and Bookkeeping Services</li>
                                    </ul>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-6 col-md-6">
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
                            </div> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Services Details Area -->





    {{-- our partners  --}}

    <!-- Start Partner Area
                                                                                                                                                                                                                                                                            ============================================= -->

    <!-- Logo Section -->
    {{-- <section class="partner-logo-section bg-light " style="padding-top: 2rem;">
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
    </section> --}}


    {{-- partners secrtion  --}}
    <div class="project-details-area default-padding"
        style="background-image: url('{{ asset('assets/img/shape/banner-1.png') }}');background-repeat:no-repeat;background-size:100% 100%;">
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


                        <div class="container " style="margin-top: 4rem; margin-bottom: 4rem;">


                            <div class="row g-3">
                                @foreach ($ourPartners as $item)
                                    <div class="col-6 col-md-3 ">
                                        <div class="img-head  d-flex justify-content-center p-3 ">
                                            <img src="{{ asset($item->partner_image) }}"
                                                style="width: 100%;height:100%;object-fit:contain;aspect-ratio:1/0.5"
                                                alt="Logo 1">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Partner Area -->




    {{-- @include('user.partials.register-for-corporate-tax-section') --}}

@endsection
