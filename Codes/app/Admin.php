<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use NotificationChannels\WebPush\HasPushSubscriptions;
    use Spatie\Permission\Traits\HasRoles;
    use Spatie\MediaLibrary\HasMedia\HasMedia;
    use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

    class Admin extends Authenticatable implements HasMedia
    {
        use Notifiable, HasMediaTrait, HasRoles, HasPushSubscriptions;

        protected $guard = 'admin';

        protected $fillable = [
            'name', 'email', 'password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
    }
