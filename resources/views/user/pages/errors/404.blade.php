{{-- resources/views/errors/404.blade.php --}}
@extends('user.layouts.app')

@section('title', '404 – Page Not Found')

@section('style')
    <style>
        .navbar.validnavs.navbar-default .navbar-nav li a {
            color: black !important;
        }

        .mainDiv {
            margin-top: 150px;
            margin-bottom: 100px
        }
    </style>
@endsection

@section('content')
    <div class=" flex items-center justify-center bg-gray-50 mainDiv" >
        <div class="text-center px-6">
            <h1 class="text-7xl font-bold text-indigo-600 mb-4">404</h1>
            <h2 class="text-2xl font-semibold mb-2">Page Not Found</h2>
            <p class="mb-6 text-gray-600">
                Oops! The page you were looking for doesn’t exist or has been moved.
            </p>
            <a href="{{ url('/') }}"
                class="inline-block px-6 py-3 text-sm font-medium rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                Go Home
            </a>
        </div>
    </div>
@endsection
