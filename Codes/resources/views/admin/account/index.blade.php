@extends("layouts.master")

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h2>{{ $pageTitle ?? ''}}</h2>
                        </div>
                    </div>
                </div>
                {{ Form::model(auth()->user(),['route' => 'admin.profile.store', 'method' => 'post', 'data-toggle' => 'validator', 'autocomplete' => 'off','enctype'=>'multipart/form-data']) }}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('admin.account.form')
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-center text-md-right">
                            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> {{ _t(__('message.save')) }}</button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
