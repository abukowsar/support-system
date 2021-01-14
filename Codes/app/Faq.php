<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';

    protected $fillable = [
    	'question',
    	'answer',
    	'type',
    	'status'
    ];

    protected function getFaq(){
    	return self::where('status',1)
                    ->get();
    }
}
