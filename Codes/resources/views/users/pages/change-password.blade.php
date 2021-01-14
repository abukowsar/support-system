@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h2>{{ _t(__('message.change_password')) }}</h2>
                        </div>
                    </div>
                </div>
                {{ Form::model($user,['method' => 'POST','route' => ['users.update.password'],'enctype'=>'multipart/form-data','data-toggle'=>'validator','data-ajax'=>'true']) }}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::hidden('id', $user->id, array('class' => 'form-control')) }}
                            {{ Form::hidden('reload_page', true, array('class' => 'form-control')) }}
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="username">
                                                    {{ _t(__('message.new_password'))}}
                                                    <span class="text-red"> *</span>
                                                </label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="password" name="password" class="form-control w-100" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="first_name">
                                                    {{ _t(__('message.confirm_password'))}}
                                                    <span class="text-red"> *</span>
                                                </label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="password" name="password_confirmation" class="form-control w-100" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ _t(__('message.update',['name' => __('message.password')]))  }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
