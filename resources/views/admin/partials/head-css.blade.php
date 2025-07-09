@yield('css')

<!-- Plugin CSS -->
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Bootstrap CSS -->
<link href="{{ URL::asset('build/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

<!-- Icons CSS -->
<link href="{{ URL::asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

<!-- App CSS -->
<link href="{{ URL::asset('build/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

{{-- Custom Css  --}}
<link href="{{ URL::asset('build/css/style.css') }}" rel="stylesheet" type="text/css" />


<meta name="csrf-token" content="{{ csrf_token() }}">
