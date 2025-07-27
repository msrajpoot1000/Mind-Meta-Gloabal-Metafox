@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', 'Contact Page | Meta Mind Global')

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


    <!-- banner
                                                                                                                                                                                                                                                                                                            ============================================= -->
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url(assets/img/shape/contact.jpg);">
        <div class="breadcrum-shape">
            {{-- <img src="assets/img/shape/cont.jpg" alt="Image Not Found" style="width: 100%;opacity:0.5"> --}}
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Contact Us</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('user.pages.index') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



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

                <div class="contact-stye-one col-lg-5 mb-md-50 mb-xs-20">

                    <div class="contact-style-one-info">
                        <h2>Contact Information</h2>
                        <p>
                            Plan upon yet way get cold spot its week. Almost do am or limits hearts. Resolve parties but why
                            she shewing.
                        </p>
                        <ul>
                            <li class="wow fadeInUp">
                                <div class="icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="content">
                                    <h5 class="title">Phone</h5>
                                    <a href="">{{ $company->phone }}</a>
                                </div>
                            </li>
                            <li class="wow fadeInUp" data-wow-delay="300ms">
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Our Location</h5>
                                    <p>
                                        {{ $company->address }}
                                    </p>
                                </div>
                            </li>
                            <li class="wow fadeInUp" data-wow-delay="500ms">
                                <div class="icon">
                                    <i class="fas fa-envelope-open-text"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Official Email</h5>
                                    <a href="mailto:info@agrul.com.com"> {{ $company->email }}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>




                <div class="contact-stye-one col-lg-7 pl-60 pl-md-15 pl-xs-15">
                    <div class="contact-form-style-one">
                        <h5 class="sub-title">Have Questions?</h5>
                        <h2 class="heading">Send us a Massage</h2>



                        <form action="{{ route('contact.store') }}" method="POST">
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

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group comments">
                                        <textarea class="form-control" id="comments" name="message" placeholder="Tell Us About Project *" required>{{ old('comments') }}</textarea>
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


    @include('user.partials.register-for-corporate-tax-section')

@endsection
