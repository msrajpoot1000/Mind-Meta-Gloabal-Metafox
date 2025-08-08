@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', 'Home | Mind Meta Global')

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
            /* color: var(--white) !important; */
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

        .para {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            -webkit-line-clamp: 3;
            transition: all 0.3s ease;
        }

        .para.expanded {
            -webkit-line-clamp: unset;
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

        .f-item {
            color: black !important;
        }


        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }

        .step-item {
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .step-item:hover,
        .step-item.active {
            background-color: #f0f0f0;
            font-weight: 600;
        }

        .serviceJi {
            background-color: white !important;
        }

        .para {
            transition: all 0.3s ease;
        }

        .para.expanded {
            display: block;
        }
    </style>


    </style>
@endsection

@section('script')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stepItems = document.querySelectorAll(".step-item");
            const stepContents = document.querySelectorAll(".step-content");

            stepItems.forEach(item => {
                item.addEventListener("mouseover", function() {
                    const step = this.dataset.step;

                    // Remove 'active' from all
                    stepItems.forEach(el => el.classList.remove("active"));
                    stepContents.forEach(el => el.classList.remove("active"));

                    // Add 'active' to hovered item
                    this.classList.add("active");
                    document.querySelector(`.step-content[data-step='${step}']`)?.classList.add(
                        "active");
                });
            });
        });
    </script>




@endsection



@section('content')




    <!-- Start Banner Area
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ============================================= -->
    <div class="banner-area banner-style-one shadow navigation-custom-large zoom-effect overflow-hidden text-light">
        <!-- Slider main container -->
        <div class="banner-fade">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Single Item -->

                @foreach ($homeSliders as $item)
                    @if ($item->banner_heading)
                        <div class="swiper-slide banner-style-one">
                            <div class="banner-thumb bg-cover shadow dark"
                                style="background: url('{{ asset($item->banner_image) }}');"></div>
                            <div class="container">
                                <div class="row align-center">
                                    <div class="col-xl-7 offset-xl-5">
                                        <div class="content">
                                            <h3> {!! $item->banner_heading !!}</h3>
                                            <h4>{!! $item->banner_sub_heading !!}</h4>
                                            <p>{!! $item->banner_description !!}</p>

                                            <div class="button mt-40">
                                                <a class="btn-animation" href="#"><i class="fas fa-arrow-right"></i>
                                                    <span>Our
                                                        Services</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Shape -->

                            <!-- End Shape -->
                        </div>
                    @endif
                @endforeach
                <!-- End Single Item -->

            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>

        </div>
    </div>







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
                            Choose a unique name and bring your company to life with Mind Meta Global.
                        </p>

                    </div>
                </div>
                <!-- End Single Itme -->
                <div class="col-lg-6 offset-lg-1 pl-60 pl-md-15 pl-xs-10 mt-md-50 mt-xs-50">

                    <div class="f-item company">
                        <form method="POST" action="{{ route('user.pages.subscribe') }}">
                            @csrf
                            <input type="text" placeholder="Type your desired company name here" class="form-control"
                                name="email">
                            <button type="submit">Subscribe</button>
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
                        <p>Mind Meta Global, your partner for business setup in Dubai, the UAE, not only makes the
                            process
                            hassle-free, straightforward, and budget-friendly but also ensures that you are choosing the
                            right legal structure and jurisdiction for your company objective to run your business in
                            the
                            long run. Find here 5 steps for setting up a business in Dubai and the UAE</p>
                        <div class="devider"></div>
                    </div>
                </div>
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-5 about-style-two">
                        <div class="thumb">
                            <div class="list-container">
                                <ol class="custom-list">
                                    @foreach ($inCorporationServices as $item)
                                        <li class="step-item {{ $loop->first ? 'active' : '' }}"
                                            data-step="{{ $item->id }}" style="color:#022b6d">
                                            {{ $loop->iteration }} {{ $item->name }}
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="about-style-two col-lg-6 offset-lg-1 shadow-sm"
                        style="background-color: white;border-radius:10px;border:1px solid rgb(182, 180, 180)">
                        <div class="default-features mt-30">
                            @foreach ($inCorporationServices as $item)
                                <div class="default-feature-item step-content {{ $loop->first ? 'active' : '' }}"
                                    data-step="{{ $item->id }}">
                                    <i class="flaticon-investment-3"></i>
                                    <h4>{{ $item->name }}</h4>
                                    <p class="mt-2">{!! $item->description !!}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End About -->




    {{-- Start Services --}}
    {{-- #046ace                 --}}
    {{-- style="background-image: url(assets/img/shape/27.png);" --}}
    {{-- style="background-color: #046ace" --}}


    <div class="services-style-two-area default-padding bottom-less bg-cover bg-gray"
        style="background: linear-gradient(to right, #046ace, #94bae0);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <!--<h4 class="sub-heading">What we do</h4>-->
                        <h2 class="title" style="color:white">Choose the Right Jurisdiction for your UAE Business Setup
                        </h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                @foreach ($firstThreeComRegPage as $item)
                    <!-- Single Item -->

                    <div class="col-xl-4 col-md-6 mb-30">
                        <a href="{{ route('user.pages.comRegPage', $item->id) }}">
                            <div class="services-style-two active h-100">
                                <div class="thumb">
                                    <img src="{{ asset($item->banner_image) }}" alt="Thumb">
                                    <div class="title">
                                        <a href="{{ route('user.pages.comRegPage', $item->id) }}">
                                            <i class="flaticon-budget"></i>
                                            <h4>{{ $item->name }} Company Setup</h4>
                                        </a>
                                    </div>
                                </div>
                                <div class="info">
                                    <p class="para para{{ $item->id }}" data-lines="3">
                                        {{ strip_tags($item->banner_description) }}
                                    </p>
                                    <div class="button">
                                        <a href="{{ route('user.pages.comRegPage', $item->id) }}"
                                            class="toggle-btn-read-more" data-target="para{{ $item->id }}"
                                            role="button">Read More</a>
                                        <div class="devider"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- End Single Item -->
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Services -->







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
                    <h2 class="title mb-25">Why Choose Mind Meta Global for Your Business Setup Needs?​</h2>
                    <p>
                        Mind Meta Global provides tailored business setup services to help entrepreneurs start and grow
                        their businesses in the Dubai Mainland and Free zones. Our team will guide you through every
                        step,
                        from advising you on choosing the right jurisdiction and your company’s legal structure to
                        getting a
                        business license within the required documents and with no hassle for paperwork, i.e. from the
                        comfort of your home. We make it stress-free by informing you about upcoming yearly compliances,
                        which every company needs to follow if they are operating in the UAE. We also offer a wide range
                        of
                        support services to help you keep your company running smoothly by providing A-Z business
                        solutions
                        under one roof.
                    </p>

                </div>
                <div class="about-style-one col-xl-5 offset-xl-1 col-lg-6 offset-lg-1">
                    <div class="about-thumb">
                        <img class="wow fadeInRight" src="assets/img/why_choose2.jpg" alt="Image Not Found">

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
                   
                  bg-gray                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ============================================= -->
    <div class="services-style-one-area default-padding "
        style="background: linear-gradient(to right, #046ace, #94bae0);">
        {{-- <div class="triangle-shape">
            <img src="assets/img/shape/10.png" alt="Shape">
        </div> --}}
        <div class="center-shape" style="background-image: url(assets/img/shape/5.png);"></div>
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-5 mb-md-60">
                    <div class="service-nav-info">
                        <h4 class="sub-title"> <span style="color:#2C3F7E">Mind Meta Global Will Help You With</span>
                        </h4>
                        <h2>All In One Business Setup Services</h2>
                        <p>We offer you the all-in-one company services needed for Dubai mainland company formation and
                            free
                            zones in one place. With everything you need to get your company up and running, you won’t
                            have
                            to deal with multiple business setup companies.</p>
                        <div class="nav nav-tabs service-tab-navs" id="nav-tab" role="tablist">

                            @foreach ($services as $service)
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="nav-id-{{ $loop->iteration }}" data-bs-toggle="tab"
                                    data-bs-target="#tab{{ $loop->iteration }}" type="button" role="tab"
                                    aria-controls="tab{{ $loop->iteration }}" aria-selected="false">
                                    <i class="flaticon-megaphone"></i>
                                    {{ $service->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 pl-50 pl-md-15 pl-xs-15">
                    <div class="tab-content services-tab-content" id="nav-tabContent">
                        @foreach ($services as $service)
                            <!-- Tab Single Item -->
                            <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}"
                                id="tab{{ $loop->iteration }}" role="tabpanel"
                                aria-labelledby="nav-id-{{ $loop->iteration }}">
                                <div class="row ">
                                    @foreach ($service->servicePages as $page)
                                        <!-- Single Item -->
                                        {{-- wow fadeInUp --}}
                                        <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30 pb-4 d-flex">
                                            <div class="shadow-sm flex-column"
                                                style="background-color:white;border-radius:10px;padding:2rem;margin-right:0rem">
                                                <a href="{{ route('user.pages.servicePage', $page->id) }}"
                                                    class="serviceJi services-style-one ">
                                                    <i class="flaticon-personal"></i>
                                                    <h4 class="text-bold">{{ $page->name }}</h4>
                                                    <p>
                                                        {!! $page->description !!}
                                                    </p>
                                                </a>
                                            </div>

                                        </div>
                                        <!-- End Single Item -->
                                    @endforeach

                                </div>
                            </div>
                            <!-- End Tab Single Item -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services Style One -->






    {{-- partners secrtion  --}}
    {{-- style="background-image: url('{{ asset('assets/img/shape/banner-1.png') }}');background-repeat:no-repeat;background-size:100% 100%;" --}}
    <div class="project-details-area default-padding"
        style="background-image: url('{{ asset('assets/img/shape/our_affi.jpeg') }}');background-repeat:no-repeat;background-size:100% 100%;">
        <div class="container">
            <div class="row align-center">
                <div class="about-style-one col-xl-12 col-lg-11">
                    <!--<div class="h4 sub-heading">Feel Valued & Rewarded</div>-->
                    <h2 class="title mb-25">Our Affiliations With Government Bodies​</h2>
                    <p>
                        Our recognized association with government authorities helps us access resources and support
                        from
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

    <!-- Start Testimonials ============================================= -->
    @if ($testimonials->count())
        <div class="testimonials-style-two-area bg-dark default-padding-top half-shape-light-bottom"
            style="background-image: url(assets/img/shape/34.png);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="site-heading text-light text-center">
                            <h4 class="sub-heading">Success Stories</h4>
                            <h2 class="title">Join 100+ Happy Customers</h2>
                            <p>Don't just take our word for it. Hear from entrepreneurs who have successfully
                                established
                                their
                                businesses in Dubai. Learn from their experiences and gain insights into the
                                possibilities
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
                                                id="readMoreBtn {{ $testimonial->id }}" class="readBtn">Read
                                                More</button>
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
                                                <img src="{{ $testimonial->photo1 ?? 'assets/img/logo/01.png' }}"
                                                    style="width:2.5rem;border-radius:50%" alt="Logo">
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
                <p class="mt-4">With company setup in Dubai, run your business freely. Repatriate your profits and
                    tap
                    into both local and global markets.</p>

            </div>
        </div>
    </div>

    <!-- End Testimonials  -->


    @if ($blogs->count())
        <div class="blog-area blog-grid default-padding">
            <div class="container">
                <div class="blog-item-box">
                    <div class="row">
                        <h2 class="title" style="text-align:center;margin-bottom:2rem">Our Recents Blogs</h2>
                        <!-- Single Item -->
                        @foreach ($blogs as $blog)
                            <div class="col-xl-4 col-md-6 single-item">
                                <div class="blog-style-one">
                                    <div class="thumb">
                                        <a href="{{ route('user.pages.blogDetail', $blog->id) }}"><img
                                                src="{{ asset($blog->blog_image) }}" alt="Thumb"></a>
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
                                            <a
                                                href="{{ route('user.pages.blogDetail', $blog->id) }}">{{ $blog->blog_title }}</a>
                                        </h3>
                                        <a href="{{ route('user.pages.blogDetail', $blog->id) }}" class="btn-simple"><i
                                                class="fas fa-angle-right"></i> Read
                                            more</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    @endif









    <!-- Start Faq Area
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ============================================= -->

    @if ($faqs->count())
        <div class="faq-area bg-gray default-padding">
            <!-- End Shape -->
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 faq-style-one dark pl-50 pl-md-15 pl-xs-15">

                        <h2 class="title mb-40">FAQ </h2>

                        <div class="accordion" id="faqAccordion">

                            @foreach ($faqs as $index => $item)
                                @php
                                    $headingId = 'heading' . $index;
                                    $collapseId = 'collapse' . $index;
                                    $isFirst = $loop->first;
                                @endphp

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="{{ $headingId }}">
                                        <button class="accordion-button {{ $isFirst ? '' : 'collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}"
                                            aria-expanded="{{ $isFirst ? 'true' : 'false' }}"
                                            aria-controls="{{ $collapseId }}">
                                            {{ $item->ques }}
                                        </button>
                                    </h2>
                                    <div id="{{ $collapseId }}"
                                        class="accordion-collapse collapse {{ $isFirst ? 'show' : '' }}"
                                        aria-labelledby="{{ $headingId }}" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p>{{ strip_tags($item->ans ?? $item->faq) }}</p>
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
                @foreach ($keyCorServices as $item)
                    <div class="col-lg-4">
                        <div class="">
                            <div class="thumb">
                                <img src="{{ asset($item->photo) }}" class="cImageServices" alt="Thumb">

                            </div>
                            <h4>{{ $item->name }}</h4>
                            <p>
                                {!! $item->description !!}
                            </p>
                        </div>
                    </div>
                @endforeach
                <!-- End Single Item -->

            </div>
        </div>
    </div>

    @include('user.partials.register-for-corporate-tax-section')






@endsection
