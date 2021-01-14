@extends('layouts.frontend')

@section('banner')
    <section class="green-bg iq-breadcrumb2 text-center iq-font-white">
        <div class="container">
            <div class="row">
                <div class="col-lg justify-content-center">
                    <div class="heading-title iq-mb-0">
                        <h2 class="title white iq-font-white iq-tw-6">
                            {{ _t(__('message.knowledge_base'))}}
                        </h2>
                        <nav aria-label="breadcrumb" class="iq-mt-30">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home')}}">
                                        <i class="ion-android-home"></i>
                                        {{ _t(__('message.home'))}}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ _t(__('message.knowledge_base'))}}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="iq-blog overview-block-ptb bg-w1">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 iq-mtb-20">
                    <div class="row" id="scroll-content"
                         data-url="{{route('get.category.knowledge')}}" data-index=1
                         data-processing=0 data-content=1>
                    </div>
                </div>

                @include('knowledge.side-bar',['category_id'=>null])

            </div>
        </div>
    </section>
@endsection

@section('body_bottom')
    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                $(document).on('keyup', '.filter-change', function (e) {
                    $(document).find('.scroll-load').trigger('click');
                });
            })
        })(jQuery);
    </script>
@endsection

