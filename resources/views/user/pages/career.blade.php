@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', 'Career Page | Meta Mind Global')
@section('style')
    <style>
        .country-code {
            border: 1px solid rgb(214, 214, 214);
            padding: 0.5rem;
            border-radius: 10px;
        }

        .country-code option {
            padding: 0.5rem;
        }
    </style>
@endsection

@section('content')


    {{-- <!-- banner --}}

    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url(assets/img/shape/contact.jpg);">
        <div class="breadcrum-shape">
            {{-- <img src="assets/img/shape/cont.jpg" alt="Image Not Found" style="width: 100%;opacity:0.5"> --}}
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Career</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('user.pages.index') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li>Career</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    @if ($jobs->count())
        <div class="home-blog-area default-padding bottom-less bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="site-heading text-center">
                            <h4 class="sub-heading">Let's Grow With Us</h4>
                            <h2 class="title">Listed Jobs</h2>
                            <div class="devider"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <!-- Single Item -->
                    @foreach ($jobs as $job)
                        <div class="col-xl-4 col-md-6 mb-30 wow  d-flex" data-wow-delay="300ms">
                            <div class="blog-style-one flex-column">
                                <div class="info p-5 ">
                                    <h4 class="text-center">
                                        <a>{{ $job->job_name }}</a>
                                    </h4>
                                    <h5>Job Type : {{ $job->career->job_type }}</h5>
                                    <p class="para para{{ $job->id }}" data-lines="3">
                                        {{ strip_tags($job->job_description) }}</p>
                                    <div class="button mt-2">
                                        <a class="toggle-btn-read-more" data-target="para{{ $job->id }}"
                                            role="button">Read More</a>
                                        <div class="devider"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach






                    <!-- End Single Item -->
                </div>
            </div>

        </div>

    @endif





    {{-- <!-- Start Contact Us --}}

    <div class="contact-style-one-area overflow-hidden default-padding">

        <div class="contact-shape">
            <img src="assets/img/shape/37.png" alt="Image Not Found">
        </div>

        <div class="container">
            <div class="row align-center">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <div class="contact-stye-one col-lg-9 pl-60 pl-md-15 pl-xs-15">
                    <div class="contact-form-style-one">
                        {{-- <h5 class="sub-title">Have Questions?</h5> --}}
                        <h2 class="heading">Fill Form</h2>



                        <form action="{{ route('user.pages.career-record') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" id="name" name="name" placeholder="Name"
                                            type="text" required value="{{ old('name', $email ?? '') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" id="email" name="email" placeholder="Email *"
                                            type="email" required value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row country-code-head-head d-flex align-items-center">

                                <div class="col-lg-6">
                                    <select class="country-code country-code1" name="country_code"
                                        style="width:100%"></select>
                                    @error('country_code2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 ">
                                    <div class="form-group country-code-head">
                                        <input type="text" id="countrySearch1" placeholder="serach country"
                                            style="width:100%" />

                                    </div>
                                </div>

                            </div>
                            {{-- phone  --}}
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <input class="form-control" id="phone" name="phone" placeholder="Phone"
                                            type="text" required value="{{ old('phone') }}"
                                            oninput="this.value = this.value.replace(/[^0-9 ]/g, '')">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- resume  --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Attach Your Resume/CV
                                            <input class="form-control" id="resume" name="resume"
                                                placeholder="resume" type="file" required
                                                value="{{ old('resume') }}">
                                            @error('resume')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row ">

                                <div class="col-lg-12" class="form-group">
                                    <select class="form-control" name="job_type" style="width:100%" required>
                                        <option value="" disabled selected>Select Job Type</option>
                                        @foreach ($jobType as $item)
                                            <option value="{{ $item->job_type }}">{{ $item->job_type }}</option>
                                        @endforeach
                                    </select>

                                    @error('country_code2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group comments">
                                        <textarea class="form-control" id="comments" name="message" placeholder="Brief Yourself" required>{{ old('comments') }}</textarea>
                                        @error('comments')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit">
                                        <i class="fa fa-paper-plane"></i> Get in Touch
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-12 alert-notification">
                                <div id="message" class="alert-msg"></div>
                            </div>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- End Contact -->




@endsection
