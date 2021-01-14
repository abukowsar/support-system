<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use DB;

class AppSetting extends Model implements HasMedia
{
	use HasMediaTrait;
    protected $table = 'app_settings';

    protected $fillable = ['site_name', 'site_email','site_description','site_copyright','home_slide_title','home_slide_text','page_bg_image','about_title','about_description','contact_title','contact_address','contact_email','contact_number','contact_lat','contact_long','notification_settings','facebook_url','twitter_url','gplus_url','linkedin_url','google_map_api','site_header_code','site_footer_code'];

	public $timestamps = false;


	protected function getData(){

		$data=	self::get()->first();

		if($data==null){
			$data=new self;
		}

		return $data;

	}

    public function getNotificationSettingsAttribute($value)
    {
        return isset($value) ? json_decode($value, TRUE) : [];
    }
}
