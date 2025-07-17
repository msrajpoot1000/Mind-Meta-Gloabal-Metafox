@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">




    <!-- Site Title -->
    <title>@yield('title', '')</title>

    <!-- CSS Files -->
    @include('user.partials.head-css')

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

    @yield('style')


</head>

<body>
    @include('user.partials.header')
    {{-- Optional custom styles/scripts before content --}}
    @yield('body')

    {{-- Main content section --}}
    @yield('content')

    {{-- Footer --}}
    @include('user.partials.footer')

    {{-- JS Files --}}
    @include('user.partials.vendor-scripts')

    @yield('script')

</body>

</html>
