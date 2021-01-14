@extends('layouts.master')

@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9">
                        <h2>{{ $pageTitle ?? ''}}</h2>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ $button }}" class="float-right btn btn-sm btn-primary"><i class="fas fa-angle-double-left"></i> {{_t(__('message.back'))}}</a>
                    </div>
                </div>
            </div>
            <div class="row p-4">
                <div class="col-md-12">
                   
                    {{ Form::model($video , ['method' => 'POST','route' => ['videos.store'],'enctype'=>'multipart/form-data','data-toggle'=>'validator']) }}

                    {{ Form::hidden('id', null, array('class' => 'form-control')) }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="category_name">{{_t(__('message.title'))}} <span class="text-red">*</span></label>
                                {{ Form::text('title', null, array('class' => 'form-control','required')) }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="category_id">{{  _t(__('message.category'))}} <span class="text-red">*</span></label>
                                <select class="form-control select2js category" name="category_id"
                                        data-ajax--url="{{ route('ajax-list', ['type' => 'category']) }}"
                                        data-ajax--cache="true">
                                        @if(isset($video->category))
                                            <option value="{{ $video->category_id}}" selected="">{{ $video->category->category_name ?? ''}}</option>
                                        @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="input-username" class="form-control-label">
                                    {{_t(__('message.status'))}}  <span class="text-danger">*</span>
                                </label>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="custom-control custom-radio">
                                            {{ Form::radio('status', "1", true, ['class' => 'custom-control-input ', 'id'=> 'GM-R-1']) }} 
                                            <label class="custom-control-label" for="GM-R-1">
                                                <span class="text-muted">{{_t(__('message.active'))}} </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="custom-control custom-radio">
                                            {{ Form::radio('status', "0", null, ['class' => 'custom-control-input ', 'id'=> 'GM-R-0']) }}
                                            <label class="custom-control-label" for="GM-R-0">
                                                <span class="text-muted">{{_t(__('message.deactive'))}} </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="priority">{{_t(__('message.video'))}} </label>
                                <div class="media">
                                    @if(isset($video))
                                    <div class="media-left mr-3">
                                        <video width="100" height="100" controls>
                                            <source src="{{getSingleMedia($video,'videos')}}" type="video/mp4">
                                            <source src="{{getSingleMedia($video,'videos')}}" type="video/ogg">
                                        </video>
                                    </div>

                                    @endif
                                    <div class="media-body">
                                        <input type="file" name="videos" class="filestyle" accept="video/*"> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="form-control-label" for="username"> {{_t(__('message.content'))}}</label>
                                {{ Form::textarea('content',htmlspecialchars($video->content), array('class' => 'form-control summernote')) }}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ $video->id != null ? _t(__('message.update',['name' => __('message.video')])) : _t(__('message.add',['name' => __('message.video')])) }}</button>
                               
                            </div>
                        </div>
                    </div>    
                    {{ Form::close() }} 
                </div>
            </div>
        </div>
    </div>
</div>
     
@endsection