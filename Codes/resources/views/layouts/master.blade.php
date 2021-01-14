<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- VAPID PUBLIC KEY -->
    <meta name="VAPID_PUBLIC_KEY" content="{{ env('VAPID_PUBLIC_KEY') }}">

    <link rel="shortcut icon" href="{{ getSingleMedia(request()->appData,'site_favicon') }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Icons -->
    <link href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


    {{-- Datatable css --}}
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}">

    @include('partials._dynamic_css')

    <!-- Optional header section  -->
    @yield('head_extra')
</head>

@include('partials._body')

</html>
