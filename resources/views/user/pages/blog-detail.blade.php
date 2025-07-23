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
                <img src="{{ asset($blog->blog_image) }}" />
                <h1>{{ $blog->blog_title }}</h1>
                <div class="putTickBeforeLi">
                    {!! $blog->blog_description !!}

                </div>
            </div>
            <!-- End Blog -->

        </div>

    </div>





    @include('user.partials.register-for-corporate-tax-section')

@endsection
