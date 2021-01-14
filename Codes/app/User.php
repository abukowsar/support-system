<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use Notifiable, HasMediaTrait, HasRoles, HasPushSubscriptions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_verified_at','contact_number','gender','country','status','banned','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userProfile() {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function scopeList($query, $order='name')
    {
        return $query->whereStatus('active')
            ->orderBy('name', 'ASC');
    }

    public function themes(){
        return $this->hasMany(UserThemeMapping::class,'user_id','id')->where('user_type','web');
    }

    /**
     * Route notifications for the Mattermost channel.
     *
     * @return int
     */
    public function routeNotificationForMattermost()
    {
        return env('MATTERMOST_WEBHOOK_URL'); //$this->mattermost_webhook_url;
    }


    public function routeNotificationForSlack() {
        return env('SLACK_WEBHOOK_URL');
    }
}
