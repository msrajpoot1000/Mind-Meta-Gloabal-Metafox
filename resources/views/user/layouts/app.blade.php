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

    <style>
        .skiptranslate span,
        .skiptranslate a,
        .skiptranslate img,
        .skiptranslate::before,
        .skiptranslate::after {
            display: none !important;
        }

        .skiptranslate {
            font-size: 0px !important;
        }
    </style>


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
                <link rel="icon" href="{{ asset($faviconPath) }}" type="image/svg+xml">
            @break

            @case('png')
                <link rel="icon" href="{{ asset($faviconPath) }}" type="image/png">
            @break

            @default
                <link rel="icon" href="{{ asset($faviconPath) }}" type="image/x-icon">
        @endswitch
    @else
        <link rel="icon" href="{{ asset($faviconPath) }}" type="image/x-icon">
    @endif

    @yield('style')


</head>

<body>


    <!-- End Main -->

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>


    <div style="position: fixed; top: 10px; right: 10px; z-index: 9999;">
        <div id="google_translate_element"></div>
    </div>

    @include('user.partials.header')
    {{-- Optional custom styles/scripts before content --}}
    @yield('body')

    {{-- Main content section --}}
    @yield('content')

    {{-- Footer --}}
    @include('user.partials.footer')

    {{-- JS Files --}}
    @include('user.partials.vendor-scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const skipTranslate = document.querySelector('.skiptranslate');
            if (skipTranslate) {
                const originalText = skipTranslate.innerText;
                // Check if it contains "Powered by" and only keep the word "One"
                skipTranslate.innerText = 'One';
            }
        });
    </script>


    @yield('script')

</body>

</html>
