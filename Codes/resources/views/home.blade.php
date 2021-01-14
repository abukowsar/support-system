@extends('layouts.frontend')

<!-- Banner -->
@section('banner')
    @include('home.banner')
@endsection
<!-- Banner -->


@section('content')

    @include('home.knowledge')

    <!-- Public Tickets -->
    @include('home.tickets', ['categories' => $categories])
    <!-- Public Tickets -->

    <!-- Recent Articles -->
    @include('home.articles',['articles'=>$articles])
    <!-- Recent Articles -->

    <!-- Videos Tutorials -->
    @include('home.videos')
    <!-- Videos Tutorials -->
    @if(ENV('PERCHASE_CODE')) 
    <div class="iq-action-blog green-bg particles-bg iq-ptb-40">
        <canvas id="canvas"></canvas>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-10 col-md-9 col-sm-8  iq-font-white">
                    <h2 class="iq-font-white iq-fw-4 iq-pb-10">{{ _t(__('message.sofDesk_creative'))}}</h2>
                    <div>{{ _t(__('message.sofDesk_creative_desc'))}}</div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 text-right">
                    <a href="https://codecanyon.net/item/sofdesk-support-ticket-and-knowledge-base-script/24884109" target="_blank" class="button white grey iq-re-4-mt30 iq-mr-0">
                        {{ _t(__('message.purchase_now'))}}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section('body_bottom')
    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                $('.tabslink').find('a.active').trigger('click');
            });

            $(document).on('keyup', '.search-by-name', function () {
                $.ajax({
                    type: 'Post',
                    url: '{{route('search.list')}}',
                    data: $('#universal-form').serialize(),
                    success: function (res) {
                        if (res.status == true) {
                            $('.theme-suggestion').css('display', 'block');
                            $(document).find('.theme-suggestion-item').empty();
                            $(document).find('.theme-suggestion-item').append(res.html);
                        }
                    }
                });
            });

            $(document).on('click', '.theme-suggestion-item li', function () {
                $('.search-by-name').val($(this).text());
                $('.theme-suggestion').css('display', 'none');
            });
        })(jQuery);
    </script>
@endsection





