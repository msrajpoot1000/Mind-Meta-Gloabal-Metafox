<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Anterra Commodities | Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}



    <!-- Plugin CSS -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Bootstrap CSS -->
    <link href="{{ URL::asset('build/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />

    <!-- Icons CSS -->
    <link href="{{ URL::asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App CSS -->
    <link href="{{ URL::asset('build/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    {{-- Custom Css  --}}
    <link href="{{ URL::asset('build/css/style.css') }}" rel="stylesheet" type="text/css" />


</head>

<body class="font-sans text-gray-900 antialiased">
    {{-- guest file  --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>


    {{-- Custom Script  --}}
    <script src="{{ URL::asset('build/js/custom-script.js') }}"></script>


    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/eva-icons/eva.min.js"></script>



    <script src="assets/js/pages/pass-addon.init.js"></script>
</body>

</html>
