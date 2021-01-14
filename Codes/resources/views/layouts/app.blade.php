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

    <title>{{ _t(config('app.name')) }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/snackbar/css/snackbar.css') }}" rel="stylesheet"/>

</head>
<body>
<div id="app" class="bg-default">
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
            <div class="container px-4">
                <a class="navbar-brand" href="{{ route('home')}}">
                    <img src="{{getSingleMedia(request()->appData,'site_footer_logo')}}" style="height:50px" alt="#">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-collapse-main">
                    <!-- Collapse header -->
                    <div class="navbar-collapse-header d-md-none">
                        <div class="row">

                            <div class="col-6 collapse-close">
                                <button type="button" class="navbar-toggler" data-toggle="collapse"
                                        data-target="#navbar-collapse-main" aria-controls="sidenav-main"
                                        aria-expanded="false" aria-label="Toggle sidenav">
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Navbar items -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link nav-link-icon" href="{{ route('home') }}">
                                <i class="ni ni-planet"></i>
                                <span class="nav-link-inner--text">{{_t(__('message.home'))}}</span>
                            </a>
                        </li>
                        @if(\Request::route()->getName() == 'login')
                            <li class="nav-item">
                                <a class="nav-link nav-link-icon" href="{{ route('register') }}">
                                    <i class="ni ni-circle-08"></i>
                                    <span class="nav-link-inner--text">{{_t(__('message.register'))}}</span>
                                </a>
                            </li>
                        @endif
                        @if(\Request::route()->getName() == 'register')
                            <li class="nav-item">
                                <a class="nav-link nav-link-icon" href="{{ route('login') }}">
                                    <i class="ni ni-circle-08"></i>
                                    <span class="nav-link-inner--text">{{_t(__('message.login'))}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <h1 class="text-white">{{_t(__('message.welcome'))}}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                     xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>

        <!-- Page content -->
        <div class="container mt--8 pb-5">
            @yield('content')
        </div>
    </div>
    @include('partials._body_footer')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('assets/vendor/snackbar/js/snackbar.js') }}"></script>
<!-- Global Message -->
@include('helper.app_mesage')

@auth
    <script src="{{ asset('js/enable-push.js') }}" defer></script>
@endauth

</body>
</html>
