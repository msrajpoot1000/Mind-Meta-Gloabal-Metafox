@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp
@extends('user.layouts.app')

@section('title', 'Home | Terms And Condition')

@section('content')


    <!-- Start Breadcrumb
                                                    ============================================= -->
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url(assets/img/2440x1578.png);">
        <div class="breadcrum-shape">
            <img src="assets/img/shape/50.png" alt="Image Not Found">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Terms And Condition</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('user.pages.index') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li>Terms And Condition</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="mt-4 mb-4">
        <h1 style="text-align: center">{{ $item->heading }}
        </h1>
        <div class="container">
            {!! $item->description !!}
        </div>

    </div>


    @include('user.partials.register-for-corporate-tax-section')

@endsection
