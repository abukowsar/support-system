<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
    protected $fillable = [
        'name',
        'label',
        'description',
        'template_detail',
        'notification_message',
        'notification_link',
        'status',
    ];
}
