<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
class Settings extends Model implements  HasMedia
{
    use HasMediaTrait;
    protected $table = 'app_settings';

    protected $fillable = ['type','key','value'];
	
	public $timestamps = false;
    
}
