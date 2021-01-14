@extends('layouts.master')

@section("content")
<?php
    $fa_icons = \Config('fa-icon.FAICON');
?>
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
                   
                    {{ Form::model($category , ['method' => 'POST','route' => ['categories.store'],'enctype'=>'multipart/form-data','data-toggle'=>'validator']) }}

                    {{ Form::hidden('id', null, array('class' => 'form-control')) }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="category_name"> {{ _t(__('message.category_name'))}}<span class="text-red">*</span></label>
                                {{ Form::text('category_name', null, array('class' => 'form-control','required')) }}
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="input-username" class="form-control-label">
                                    {{ _t(__('message.status'))}} <span class="text-danger">*</span>
                                </label>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="custom-control custom-radio">
                                            {{ Form::radio('status', "1", true, ['class' => 'custom-control-input ', 'id'=> 'GM-R-1']) }} 
                                            <label class="custom-control-label" for="GM-R-1">
                                                <span class="text-muted"> {{ _t(__('message.active'))}}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="custom-control custom-radio">
                                            {{ Form::radio('status', "0", null, ['class' => 'custom-control-input ', 'id'=> 'GM-R-0']) }}
                                            <label class="custom-control-label" for="GM-R-0">
                                                <span class="text-muted">{{ _t(__('message.deactive'))}}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="priority">{{ _t(__('message.category_image')) }}</label>
                                <div class="media">
                                    @if(isset($category->category_image))
                                    <div class="media-left mr-3">
                                            <span class="avatar avatar-base rounded-circle ">
                                                <img src="{{getSingleMedia($category,'category_image')}}" >
                                            </span>
                                    </div>
                                    @endif
                                    <div class="media-body">
                                        <input type="file" name="category_image" class="filestyle"> <br>
                                        <small class="text-muted bold">Size 1300x200px</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ $category->category_id != null ? _t(__('message.update',['name' => __('message.category')])) : _t(__('message.add',['name' => __('message.category')])) }}</button>
                               
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