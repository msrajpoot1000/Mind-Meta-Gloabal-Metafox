<html class="no-js" lang="en">
  <head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ThemeServices">
    <!-- Favicon Icon -->
    <link rel="icon" href="assets/img/favicon.png">
    <!-- Site Title -->
    <title>@yield('title')</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  </head>
  
  
<body>

        @include('layouts.frontend.header')
        @yield('write')
        @include('layouts.frontend.footer')




<!-- JS here -->
 <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slick.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>