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
        <a href="{{ url($company->about_pdf) }}" type="black" download class="btn btn-primary  mb-5"
            style="background-color:black">
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
