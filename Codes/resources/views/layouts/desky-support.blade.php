<!--
 * SofDesk - Laravel Kit
 * @version v1.0.0
 * @link http://goldenmace.com
-->
<?php  $rtl=config('app.locale')=='ar'?'-rtl':''; ?>

<!DOCTYPE html>
<html lang="{{ session()->get('locale') }}" dir="{{ str_replace('-','',$rtl) }}">
<head>
    <title>{{ _t($pageTitle ?? request()->appData->site_name) }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <?php echo SEO::generate(true); ?>
    <style type="text/css">
        :root {
            --main-color: #{{ENV("MAIN_COLOR") ?? "#4ec4f3"}};
        }
    </style>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ getSingleMedia(request()->appData,'site_favicon') }}">

    <!-- plyr css -->
    <link href="{{ asset('assets/vendor/plyr/plyr.css') }}" rel="stylesheet">

    <!-- bootstrap -->
    <link href="{{ asset('/frontend/css/bootstrap'.$rtl.'.min.css') }}" rel="stylesheet">
    <!-- font awesome -->
    <link href='{{asset("frontend/css/font-awesome.min.css")}}' rel="stylesheet" type="text/css"/>
    <!-- ionicons icon -->
    <link href='{{asset("frontend/css/ionicons.min.css") }}' rel="stylesheet" type="text/css"/>
    <!-- mega menu -->
    <link href="{{asset('frontend/css/mega-menu/mega_menu'.$rtl.'.css') }}" rel="stylesheet" type="text/css"/>
    <!-- animate -->
    <link href='{{asset("frontend/css/animate.css") }}' rel="stylesheet" type="text/css"/>
    <!-- shortcodes -->
    <link href="{{asset('frontend/css/shortcodes'.$rtl.'.css') }}" rel="stylesheet" type="text/css"/>
    <!-- main style -->
    <link href="{{asset('frontend/css/style'.$rtl.'.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('frontend/css/shop'.$rtl.'.css') }}" rel="stylesheet" type="text/css"/>

    <link href='{{asset("frontend/css/responsive.css") }}' rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/vendor/polyglotLanguage/css/polyglot-language-switcher-2.min.css') }}" rel="stylesheet"/>

    <!-- custom -->
    <link href="{{asset('frontend/css/custom'.$rtl.'.css') }}" rel="stylesheet" type="text/css"/>

    @include('partials.frontend._dynamic_styles')

    <?php echo request()->appData->site_header_code; ?>

</head>

@include('partials.support._body')

</html>
