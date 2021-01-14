@extends('layouts.frontend')

@section('banner')
    <section class="green-bg iq-breadcrumb2 text-center iq-font-white">
        <div class="container">
            <div class="row">
                <div class="col-lg justify-content-center">
                    <div class="heading-title iq-mb-0">
                        <h2 class="title white iq-font-white iq-tw-6">{{ucfirst(str_replace('_',' ',$type))}} {{ _t(__('message.tickets'))}}</h2>
                        <nav aria-label="breadcrumb" class="iq-mt-30">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home')}}"><i
                                            class="ion-android-home"></i> {{ _t(__('message.home'))}}</a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{ _t(ucfirst(str_replace('_',' ',$type))) }} {{ _t(__('message.tickets'))}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="overview-block-ptb grey-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="iq-post-sideba white-bg">
                        {{ Form::open(['method' => 'POST', 'id'=>'search_form']) }}
                        <div class="iq-sidebar-widget">
                            <h5 class="iq-tw-6 small-title iq-font-dark">{{ _t(__('message.filters'))}}</h5>

                            {{ Form::hidden('filter_type', 'all', ['id'=> 'filter_type']) }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            class="form-control-label float-md-left">{{ _t(__('message.search_by_keywords')) }}</label>
                                        <input type="text" class="form-control" value="{{$keywords}}" name="keywords"
                                               placeholder="Search By Keyword">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            class="form-control-label float-md-left"> {{ _t(__('message.search_by_departments'))}} </label>
                                        <select class="form-control select2js category" name="department_id[]"
                                                data-ajax--url="{{ route('ajax-list', ['type' => 'department']) }}"
                                                data-ajax--cache="true" multiple>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            class="form-control-label float-md-left"> {{ _t(__('message.search_by_categories'))}} </label>
                                        <select class="form-control select2js category" name="category[]"
                                                data-ajax--url="{{ route('ajax-list', ['type' => 'category']) }}"
                                                data-ajax--cache="true" multiple="">
                                            @if($category!=null)
                                                <option value="{{$category->id}}"
                                                        selected="">{{ _t($category->category_name) }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <a href="javascript:void(0)"
                                       class="button w-100 text-center mt-4 scroll-load"> {{ _t(__('message.search'))}} </a>
                                </div>
                            </div>
                            <input type="hidden" name="type" value="{{$type}}">
                        </div>
                        {{ Form::close() }}

                    </div>
                </div>
                <?php $filters = \Config::get('constant.TICKETFILTER'); ?>
                <div class="col-lg-8 col-md-12 col-sm-12  content">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                @foreach($filters as $key => $filter)
                                    <li class="tabslink nav-item iq-pr-10">
                                        <a href="javascript:void(0)"
                                           class="nav-link filter-change {{ $key=='all'?'active':''}}"
                                           data-filter-type="{{$key}}"
                                           data-toggle="pill">
                                            {{ $filter}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12 faqs">
                            <div class="theiaStickySidebar" id="scroll-content"
                                 data-url="{{route('ticket.list')}}" data-index=1
                                 data-processing=0 data-content=1 data-form='#search_form'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="iq-action-blog iq-ptb-40">

    </div>

@endsection

@section('body_bottom')
    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                $(document).on('click', '.filter-change[data-toggle="pill"]', function (e) {
                    let type = $(this).data('filter-type') || null;

                    if (type != null) {
                        $('#filter_type').val(type);
                    }
                    $(document).find('.scroll-load').trigger('click');
                });
            })
        })(jQuery);
    </script>
@endsection
