@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PK Managing Solutions" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- @yield('favicon') --}}
    @php
        $extension = '';

        if (!empty($company->favicon)) {
            $extension = pathinfo($company->favicon, PATHINFO_EXTENSION);
        }

        $faviconPath = $company->favicon ?? 'default/image/favicon/default_favicon.ico';
    @endphp


    @if (!empty($company->favicon))
        @switch($extension)
            @case('svg')
                <link rel="icon" href="{{ $faviconPath }}" type="image/svg+xml">
            @break

            @case('png')
                <link rel="icon" href="{{ $faviconPath }}" type="image/png">
            @break

            @default
                <link rel="icon" href="{{ $faviconPath }}" type="image/x-icon">
        @endswitch
    @else
        <link rel="icon" href="{{ $faviconPath }}" type="image/x-icon">
    @endif


    <!-- include head css -->
    @include('admin.partials.head-css')


</head>


<body>

    <div id="layout-wrapper">

        @include('admin.partials.header')


        @include('admin.partials.sidebar')

        <!-- Start right Content here -->

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('admin.partials.footer')

        </div>
        <!-- end main content-->
    </div>

    <!-- vendor-scripts -->
    @include('admin.partials.vendor-scripts')
    @yield('script')

</body>

</html>
