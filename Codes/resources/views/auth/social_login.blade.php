<div class="card-header bg-transparent pb-5">
    <div class="text-muted text-center mt-2 mb-4"><small>{{ (\Request::route()->getName() == 'register') ? 'Sign up' : 'Sign in' }} with</small></div>
    <div class="text-center">
        @if(config('config.social_login_provider'))
            @foreach(config('config.social_login_provider') as $provider)
                @switch($provider)
                    {{--@case('facebook')
                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-neutral btn-icon mr-2">
                            <span class="btn-inner--icon"><img src="{{ asset('assets/img/icons/common/facebook.svg.png') }}" alt="facebook.svg.png"></span>
                            <span class="btn-inner--text"> {{ _t(__('message.facebook')) }}</span>
                        </a>
                    @break;--}}
                    @case('google')
                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-neutral btn-icon mr-2">
                            <span class="btn-inner--icon"><img src="{{ asset('assets/img/icons/common/google.svg') }}" alt="google.svg"></span>
                            <span class="btn-inner--text">{{ _t(__('message.google')) }}</span>
                        </a>
                    @break;
                @endswitch
            @endforeach
        @endif

    </div>
</div>
