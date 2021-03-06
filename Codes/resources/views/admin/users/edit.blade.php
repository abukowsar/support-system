@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            @if(auth()->guard('admin')->check())
                                <h2>{{ _t(__('message.edit',['name' =>_t(__('message.user')) ])) }}</h2>
                            @else
                                <h2>{{ _t(__('message.profile')) }}</h2>
                            @endif
                        </div>
                        <div class="col-md-3">
                            @if(auth()->guard('admin')->check())
                                <a href="{{ route('users.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ _t(__('message.back')) }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                @if(auth()->guard('admin')->check())
                    {{ Form::model($user,['method' => 'patch', 'route' => ['users.update', $user->id], 'data-toggle' => 'validator', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
                @else
                    {{ Form::model($user,['method' => 'patch', 'route' => ['user.profile.update', $user->id], 'data-toggle' => 'validator', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
                @endif
                <div class="card-body">
                    @include('admin.users._form')
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ _t(__('message.save')) }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
