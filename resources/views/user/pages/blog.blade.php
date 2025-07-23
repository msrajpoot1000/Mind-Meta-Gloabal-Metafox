@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', 'Blog Page | Meta Mind Global')



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
    </style>
@endsection
@section('content')
    <!-- banner                                                                                                                                                                                                                                                                                  ============================================= -->
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url(assets/img/shape/contact.jpg);">
        <div class="breadcrum-shape">
            {{-- <img src="assets/img/shape/cont.jpg" alt="Image Not Found" style="width: 100%;opacity:0.5"> --}}
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Blogs</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('user.pages.index') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li>Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Start Blog
                                        ============================================= -->
    <div class="blog-area blog-grid default-padding">
        <div class="container">
            <div class="blog-item-box">
                <div class="row">
                    <!-- Single Item -->
                    @foreach ($blogs as $blog)
                        <div class="col-xl-4 col-md-6 single-item">
                            <div class="blog-style-one">
                                <div class="thumb">
                                    <a href="#"><img src="{{ asset($blog->blog_image) }}" alt="Thumb"></a>
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
                                        <a href="blog-single-with-sidebar.html">{{ $blog->blog_title }}</a>
                                    </h3>
                                    <a href="{{ route('user.pages.blogDetail', $blog->id) }}" class="btn-simple"><i
                                            class="fas fa-angle-right"></i> Read more</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Single Item -->


                </div>
            </div>
        </div>
    </div>
    <!-- End Blog -->





    @include('user.partials.register-for-corporate-tax-section')

@endsection
