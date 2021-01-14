<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Comment extends Model implements  HasMedia
{
    use HasMediaTrait;

    protected $table = 'comments';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'user_id',
        'user_guard',
    	'parent_comment',
        'ticket_id',
    	'comment',
        'type'
    ];

    public function commentLike(){
       return $this->hasMany(CommentLike::class,'comment_id','id');
    }

    public function user(){
       return $this->belongsTo(User::class,'user_id','id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'user_id','id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class,'user_id','id');
    }

    public function ticket(){
       return $this->belongsTo(Ticket::class,'ticket_id','id');
    }

    public function commentLikeByMe(){
       return $this->hasOne(CommentLike::class,'comment_id','id')->where('user_id',\Auth::id());
    }

}
