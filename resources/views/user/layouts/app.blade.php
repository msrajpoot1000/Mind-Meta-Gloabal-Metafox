<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico">

    <!-- Site Title -->
    <title>@yield('title', '')</title>

    <!-- CSS Files -->
    @include('user.partials.head-css')
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

</body>
</html>
