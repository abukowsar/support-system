<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Pages extends Model
{
	use HasSlug;

	protected $primaryKey = 'id';
	protected $table = 'pages';

	protected $fillable = ['slug','page_title','page_content'];

	public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                ->generateSlugsFrom('page_title')
                ->saveSlugsTo('slug');
    }

	public function scopeActive($query)
    {
        return $query->whereStatus(1);
    }

	protected  function getPageData($slug)
	{
		$query = self::Active()->where('slug',$slug)->first();

		if($query==null)
			$query=new self;

		return $query;
	}

	protected  function getAllPageData()
	{
		$query= self::Active()->get();

		return $query;
	}
}
