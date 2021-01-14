@extends('layouts.frontend')


@section('banner')
    <section class="green-bg iq-breadcrumb2 text-center iq-font-white">
        <div class="container">
            <div class="row">
                <div class="col-lg justify-content-center">
                    <div class="heading-title iq-mb-0">
                        <h2 class="title iq-tw-6"> {{ _t(__('message.submit_ticket'))}}</h2>
                        <nav aria-label="breadcrumb" class="iq-mt-30">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home')}}"><i
                                            class="ion-android-home"></i> {{ _t(__('message.home'))}}</a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{ _t(__('message.submit_ticket'))}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <article class="card-body ">
                            <h6 class="card-title fs-16">{{ _t(__('message.submit_a_ticket'))}}</h6>
                            <hr>
                            {{ Form::model($ticket,['route'=>'support.store','method' => 'POST','data-toggle'=>'validator','files'=>true ,'enctype'=>'multipart/form-data','class'=>'submit-ticket iq-mt-20', 'button-loader'=> 'true']) }}
                            {{ Form::hidden('id',null,['class'=>'form-control']) }}
                            
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            class="form-control-label"> {{ _t(__('message.select_department'))}}</label>
                                        <span class="text-danger">*</span>
                                        <select class="form-control select2js category" name="department_id"
                                                data-ajax--url="{{ route('ajax-list', ['type' => 'department']) }}"
                                                data-ajax--cache="true" required="">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _t(__('message.subject'))}}</label>
                                        <span class="text-danger">*</span>
                                        {{ Form::text('subject',null,['class'=>'form-control search-by-name','required'=>'required']) }}
                                    </div>
                                </div>

                                <div class="col-md-12 event d-none">
                                    <div id="accordion1" class="iq-accordion">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h6 class="mb-0">
                                                    <a class="btn btn-link collapsed tabslink" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Similar questions
                                                    </a>
                                                </h6>
                                            </div>
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion1">
                                                <div class="row">
                                                    <div class="col-md-12 suggestion-container">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _t(__('message.url'))}} <small>(optional)</small></label>
                                        {{ Form::url('url',null,['class'=>'form-control','placeholder'=>'https://']) }}
                                    </div>
                                </div>
                               
                                <input type="hidden" name="priority" value="normal">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label"> {{ _t(__('message.description'))}}</label>
                                        {{ Form::textarea('description',null,['class'=>'form-control','id'=>'editor']) }}
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label"> {{ _t(__('message.add_attachments'))}}</label>
                                        <input type="file" name="comment_attachment[]" class="form-control" accept="image/*" data-max-size="100MB" multiple>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _t(__('message.category'))}}</label>
                                        <select class="form-control select2js category" name="category[]"
                                                data-ajax--url="{{ route('ajax-list', ['type' => 'category']) }}" data-ajax--cache="true" multiple="">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="input-username"
                                               class="form-control-label"> {{ _t(__('message.ticket_visibility'))}}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="custom-control custom-radio">
                                                    {{ Form::radio('ticket_show_by', "public", true, ['class' => 'custom-control-input ', 'id'=> 'GM-R-1']) }}
                                                    <label class="custom-control-label" for="GM-R-1">
                                                        <span class="text-muted">{{ _t(__('message.public'))}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-radio">
                                                    {{ Form::radio('ticket_show_by', "private", null, ['class' => 'custom-control-input ', 'id'=> 'GM-R-0']) }}
                                                    <label class="custom-control-label" for="GM-R-0">
                                                        <span class="text-muted"> {{ _t(__('message.private'))}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="button float-md-right">{{ _t(__('message.submit_ticket'))}}</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('body_bottom')
    <script>
        (function ($) {
            "use strict";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('keyup', '.search-by-name', function () {
                var string=$(this).val();
                if(string !='' && string.length > 2){
                    $.ajax({
                        type: 'Post',
                        url: '{{route('ticket.suggestion')}}',
                        data: {'string': string },
                        success: function (res) {
                            if (res.status == true && res.html != '') {

                                $('.event').removeClass('d-none');
                                $(document).find('.suggestion-container').empty();
                                $(document).find('.suggestion-container').append(res.html);

                                if($('.tabslink').hasClass('collapsed')){
                                    $('.tabslink').trigger('click');
                                }
                            }else{
                                $('.event').addClass('d-none');
                                $(document).find('.suggestion-container').empty();
                            }
                        }
                    });
                }else{
                    $('.event').addClass('d-none');
                    $(document).find('.suggestion-container').empty();
                }
            });

        })(jQuery);
    </script>
@endsection
