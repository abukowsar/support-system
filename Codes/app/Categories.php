<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Categories extends Model
{
    use HasSlug;

    protected $table = 'categories';

    protected $fillable = ['category_name', 'slug', 'category_image','category_type','category_desc','status'];

    protected $primaryKey = 'id';

	public $timestamps = false;


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                ->generateSlugsFrom('category_name')
                ->saveSlugsTo('slug');
    }

    public function scopeList($query, $order='category_name')
    {
        return $query->whereStatus(1)
            ->orderBy('category_name', 'ASC');
    }

    public function article()
    {
        return $this->hasMany('App\Article', 'category_id','id');
    }

    public function ticketCategory(){
       return $this->hasMany(TicketTags::class,'category_id','id');
    }


    public function knowledge()
    {
        return $this->hasMany(Knowledge::class, 'category_id','id');
    }

    public function videos()
    {
        return $this->hasMany(Videos::class, 'category_id','id');
    }

    protected function getCategory($slug){
        $result=  self::where('slug',$slug)->first();
        return $result;
    }
}
