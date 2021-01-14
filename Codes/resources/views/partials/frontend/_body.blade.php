<body>
    <div id="loading">
        <div id="loading-center">
            <img src="{{ getSingleMedia(request()->appData,'site_loader') }}" alt="#" class="w-200">
        </div>
    </div>

    <!-- Header -->
    @include('partials.frontend._app_header')

    <!-- Header -->
    @include('partials.frontend._app_body')

     <!-- Footer -->
    @include('partials.frontend._app_footer')

    @include('partials.frontend._body_js')

    <!-- Optional bottom section... -->
    @yield('body_bottom')

    @include('partials.frontend._dynamic_script')

</body>
