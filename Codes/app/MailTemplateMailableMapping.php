<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailTemplateMailableMapping extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'mailable_id',
        'template_id',
        'template_detail',
        'notification_message',
        'notification_link',
        'language',
        'subject',
        'status'
    ];

    public function template(){
        return $this->belongsTo(MailTemplate::class,'template_id','id');
    }
}
