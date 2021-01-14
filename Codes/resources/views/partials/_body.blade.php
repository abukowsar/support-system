<body>
<div id="app">
    @include('partials._body_sidebar')

    <!-- Main content -->
    <div class="main-content">
        @include('partials._body_header')
        @include('partials._body_content')

        <!-- Dynamic Modal Load [START] -->
        <div class="modal fade" id="formModal" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="formTitle"></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="main_form">
                    </div>
                </div>
            </div>
        </div>
        <!-- Dynamic Modal Load [END] -->

        <!-- Hidden Form Submit [START] -->
        {{ Form::open(['data--submit'=>'confirm_form', 'id' => 'confirm_form']) }}
        {{ Form::close() }}
        <!-- Hidden Form Submit [END] -->
        </div>
    </div>

    @include('partials._body_js')

    <!-- Optional bottom section -->
    @yield('body_bottom')

   
</body>
