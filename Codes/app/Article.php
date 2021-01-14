<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class Article extends Model implements  HasMedia
{
	use HasSlug, HasMediaTrait;
	
   protected $table = 'articles';

    protected $fillable = [
    	'title',
    	'slug',
        'category_id',
        'type',
        'user_id',
        'user_guard',
    	'article_image',
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
        return $query->whereStatus(1)->orderBy('updated_at', 'DESC');
    }


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id','id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id','id');
    }

    public function staticData()
    {
        return $this->belongsTo(StaticData::class, 'type','value');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id','id');
    }

    public function category()
    {
        return $this->belongsTo('App\Categories', 'category_id','id');
    }
    
}
