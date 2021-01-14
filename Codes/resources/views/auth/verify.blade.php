@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Verify Your Email Address') }}</h2></div>

                <div class="card-body text-center">
                    <div class="col-8 offset-2">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ _t(__('message.verification_link')) }}
                            </div>
                        @endif

                        {{ _t(__('message.before_proceeding')) }}
                        {{ _t(__('message.email_not_receive')) }}
                        <br>
                        <div class="mall-20 text-center">

                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">{{ _t(__('message.send_another_req')) }}</button>.
                            </form>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
