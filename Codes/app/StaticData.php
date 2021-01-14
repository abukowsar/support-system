<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class StaticData extends Model
{

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    protected $table = 'static_data';

    protected function getData($type){
    	return self::where('type',$type)->orderBy('sequence')->get();
    }

    public function notificationTemplate() {
        return $this->belongsTo(MailMailable::class, 'value', 'type');
    }


    public function mailMailable(){
        return $this->belongsTo(MailMailable::class,'value','type');
    }
}
