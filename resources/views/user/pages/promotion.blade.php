@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', 'Promotion And Offer Page | Meta Mind Global')

@section('style')
    <style>
        .offer_price h4 {
            color: black !important;
        }

        .offer-des-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .app-btn {
            display: inline-block;
            color: #fff;
            background: linear-gradient(135deg, #28a745, #218838);
            /* Gradient Green */
            padding: 0.6rem 1.5rem;
            margin-top: 1.2rem;
            margin-bottom: 0.5rem !important;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .app-btn:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }

        .app-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
@section('content')


    <!-- banner
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ============================================= -->
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url('{{ asset('assets/img/shape/promotion-banner.webp') }}');">
        <div class="breadcrum-shape">
            {{-- <img src="assets/img/shape/cont.jpg" alt="Image Not Found" style="width: 100%;opacity:0.5"> --}}
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Promotion And Offer Page</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('user.pages.index') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <!-- Start Services
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ============================================= -->
    <div class="services-style-two-area default-padding bottom-less bg-cover bg-gray"
        style="background-image: url(assets/img/shape/27.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <!--<h4 class="sub-heading">What we do</h4>-->
                        <h2 class="title">Our Best Offer</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                @foreach ($promotionPage->promotionOffers as $offer)
                    <div class="col-xl-4 col-md-6 mb-30">
                        <div class="offer-card">
                            <div class="services-style-two active h-100">

                                {{-- Clickable area: image + title triggers modal --}}
                                <div class="thumb" data-bs-toggle="modal" data-bs-target="#offerModal{{ $offer->id }}"
                                    style="cursor: pointer;">
                                    <img src="{{ asset($offer->offer_image) }}" alt="Thumb">
                                    <div>
                                        <div>
                                            <i class="flaticon-budget"></i>
                                        </div>
                                        <div class="title py-2">
                                            <h4>{{ $offer->offer_title }}<br><span>{{ $offer->offer_price }}</span></h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- Info section --}}
                                <div class="info" style="margin:0px; padding:1rem;">
                                    <a href="{{ route('user.pages.book-appointment') }}" class="app-btn">Make
                                        Appointment</a>

                                    <p class="offer-des-2">
                                        {{ strip_tags($offer->offer_description) }}
                                    </p>

                                    {{-- Read More triggers modal --}}
                                    <div class="button">
                                        <a class="toggle-btn-read-more" role="button" data-bs-toggle="modal"
                                            data-bs-target="#offerModal{{ $offer->id }}">
                                            Read More
                                        </a>
                                        <div class="devider"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach







                <!-- End Single Item -->
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
    <!-- End Services -->

    @foreach ($promotionPage->promotionOffers as $offer)
        <div class="modal fade" id="offerModal{{ $offer->id }}" tabindex="-1"
            aria-labelledby="offerModalLabel{{ $offer->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="" style="background-color:white">
                    <div class="modal-header">
                        <h5 class="modal-title" id="offerModalLabel{{ $offer->id }}">
                            {{ $offer->offer_title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset($offer->offer_image) }}" class="img-fluid mb-3" alt="Offer Image">
                        <h3>Price: <strong>{{ $offer->offer_price }}</strong></h3>
                        <p>{!! $offer->offer_description !!}</p>
                        <a href="{{ route('user.pages.book-appointment') }}" class="app-btn">Make
                            Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach



    @include('user.partials.register-for-corporate-tax-section')

@endsection
