
@extends("layouts.master")

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
                            <a href="{{route('mail.template.index')}}" class="float-right btn btn-sm btn-primary"><i class="fas fa-angle-double-left"></i> {{_t(__('message.back'))}}</a>
                        </div>
                    </div>
                </div>
                <div class="row p-4">
                    <div class="col-md-12">
                       	{{ Form::open(['route' => ['mail.template.store']]) }}
				            @include('admin.mail.template.form')
				        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
 
@endsection