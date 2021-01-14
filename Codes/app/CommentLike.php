<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $table = 'comment_likes';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'user_id',
    	'comment_id',
    	'ip_address',
        'vote',
    	'comment',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected function commentLoved($itemId)
    {
        $like =self::where('comment_id',$itemId);
                if(auth()->user()->id){
                   	$like->where('user_id', \Auth::id());
                }else{
                    $like->where('ip_address', \Request::ip());
                }
        $like=$like->first();

        return $like;
    }
}
