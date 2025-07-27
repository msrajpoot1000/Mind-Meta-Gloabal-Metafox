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


    {{-- <!-- Start Blog --}}

    <div class="container default-padding">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-area blog-grid ">
                    <div class="container">
                        <div class="blog-item-box">
                            <img src="{{ asset($blog->blog_image) }}" style="margin-bottom:2rem" />
                            <h1>{{ $blog->blog_title }}</h1>
                            <div class="putTickBeforeLi">
                                {!! $blog->blog_description !!}
                            </div>
                        </div>
                        <!-- End Blog -->
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-item recent-post">
                    <h4 class="title">Recent Post</h4>
                    <ul>
                        @foreach ($blogs as $item)
                            <div class="row">
                                <div class="col-lg-4">
                                    <a href="{{ route('user.pages.blogDetail', $item->id) }}">
                                        <img src="{{ asset($item->blog_image) }}" alt="thumb" style="width: 100px">
                                    </a>
                                </div>
                                <div class="col-lg-8">
                                    <a href="{{ route('user.pages.blogDetail', $item->id) }}">{{ $item->blog_title }}</a>
                                    <p class="post-date">{{ $item->updated_at->format('F j, Y') }}
                                    </p>
                                </div>
                            </div>
                            </a>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>





    @include('user.partials.register-for-corporate-tax-section')

@endsection
