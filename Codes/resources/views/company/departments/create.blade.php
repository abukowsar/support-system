@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h2>{{_t(__('message.add',['name' => __('message.department')]))}}</h2>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('departments.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i>{{_t(__('message.back'))}}</a>
                        </div>
                    </div>
                </div>
                {{ Form::open(['method' => 'post', 'route' => 'departments.store', 'data-toggle' => 'validator', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
                <div class="card-body">
                    @include('company.departments._form')
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary"> {{_t(__('message.save'))}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
