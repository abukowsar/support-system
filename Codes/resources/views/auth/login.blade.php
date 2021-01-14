@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0">

                @if(setActive('login'))
                <!-- Social Login [START] -->
                @include('auth.social_login')
                <!-- Social Login [END] -->
                @endif

                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        <small>
                            @if(setActive('login'))
                            {{ _t(__('message.or_sign_credentials')) }}
                            @else
                            {{ _t(__('message.sign_credentials',['name'=>'in'])) }}
                            @endif
                        </small>
                    </div>

                    <?php
                        $username='';

                        if(setActive('company')){
                            $username='';
                        }elseif (setActive('admin')) {
                            $username='';
                            
                        }

                    ?>

                    <form method="POST" data-toggle="validator" action="{{ isset($url)? $url : route('login')}}">
                        @csrf
                        <div class="form-group mb-3 has-error has-danger">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ _t(__('message.email')) }}" name="email" value="{{ old('email') ?? $username  }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input id="password" type="password" placeholder="{{ _t(__('message.password')) }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" value="">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="custom-control custom-control-alternative custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">
                                <span class="text-muted">{{ _t(__('message.remember_me')) }}</span>
                            </label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-block btn-primary my-4"><i class="fas fa-sign-in-alt"></i>{{ _t(__('message.sign_in')) }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    @if (Route::has('password.request'))
                        <a class="text-primary" href="{{ route('password.request') }}">
                            {{ _t(__('message.forgot_password')) }}
                        </a>
                    @endif
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('register') }}" class="text-primary">{{ _t(__('message.create_new_account')) }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
