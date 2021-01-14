<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Vote extends Model 
{
    
   protected $table = 'votes';

    protected $fillable = [
        'item_id',
        'user_id',
        'type',
        'vote',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id')->where('id',\Auth::id());
    }
}
