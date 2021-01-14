<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon;
use Laravel\Socialite\Facades\Socialite;


Class SocialLoginController extends Controller
{

    public function providerRedirect($provider = '')
    {

        if (!in_array($provider, config('config.social_login_provider')))
            return redirect('/login')->withErrors([trans('messages.invalid_link')]);

        if (!config('config.enable_social_login') || !config('config.enable_' . $provider . '_login'))
            return redirect('/login')->withErrors([('messages.invalid_link')]);

        return Socialite::driver($provider)->redirect();
    }

    public function providerRedirectCallback($provider = '')
    {
        if (!config('config.enable_social_login') || !config('config.enable_' . $provider . '_login'))
            return redirect('/login')->withErrors([trans('messages.invalid_link')]);

        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors([trans('messages.error_message')]);
        }

        $user_exists = \App\User::whereEmail($user->email)->first();

        if ($user_exists)
            \Auth::login($user_exists, true);
        else {

            $new_user = new \App\User;
            $new_user->name = $user->getName();
            $new_user->username = stristr($user->getEmail(), "@", true);
            $new_user->email = $user->getEmail();
            $new_user->provider = $provider;
            $new_user->provider_unique_id = $user->getId();
            $new_user->status = 'active';
            $new_user->email_verified_at  = date('Y-m-d H:i:s');
            $new_user->save();

            $new_user->addMediaFromUrl($user->getAvatar())
                ->toMediaCollection('image_icon');

            $new_user->userProfile()->create();
            \Auth::login($new_user, true);

            $new_user->assignRole('user');
        
        }
        return redirect()->route('home')->withSucces(__('message.login_success'));
    }
}