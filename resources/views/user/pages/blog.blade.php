@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', 'Blog Page | Meta Mind Global')



@section('style')

@endsection
@section('content')
    <!-- banner                                                                                                                                                                                                                                                                                  ============================================= -->
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url('{{ asset('assets/img/blog_banner1.jpg') }}')">
        <div class="breadcrum-shape">
            {{-- <img src="{{ asset('assets/img/blog_banner1.jpg') }}" alt="Image Not Found" style="width: 100%;opacity:0.5"> --}}
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


    {{-- <!-- Start Blog --}}

    <div class="blog-area blog-grid default-padding">
        <div class="container">
            <div class="blog-item-box">
                <div class="row">
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
                                                <a href="{{ route('user.pages.blogDetail', $blog->id) }}">Admin</a>
                                            </li>
                                            <li>
                                                {{ $blog->created_at->format('d/m/Y') }}

                                            </li>
                                        </ul>
                                    </div>
                                    <h3>
                                        <a href="{{ route('user.pages.blogDetail', $blog->id) }}">{{ $blog->blog_title }}</a>
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
