<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailMailable extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'label',
        'description',
        'type',
        'status',
        'to',
        'bcc',
        'cc',
    ];

    public function staticData(){
        return $this->belongsTo(StaticData::class,'type','value')->where('type','mailable');
    }

    public function mailTemplateMap(){
        return $this->hasMany(MailTemplateMailableMapping::class,'mailable_id','id')->where('status',1)->with('template');
    }


    public function defaultMailTemplateMap(){
        return $this->hasOne(MailTemplateMailableMapping::class,'mailable_id','id')->where('language','en');
    }
}
