<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class Videos extends Model implements  HasMedia
{
    use HasSlug, HasMediaTrait;
    
   protected $table = 'video_tutorials';

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'user_id',
        'content',
        'status',
        'views'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                    ->generateSlugsFrom('title')
                    ->saveSlugsTo('slug');
    }

    public function scopeList($query)
    {
        return $query->whereStatus(1)->orderBy('views', 'ASC');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id','id');
    }

    public function category()
    {
        return $this->belongsTo('App\Categories', 'category_id','id');
    }
    
}
