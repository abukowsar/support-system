<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('site_footer_logo')->nullable();
            $table->string('site_favicon')->nullable();
            $table->longText('site_description')->nullable();
            $table->longText('google_map_api')->nullable();
            $table->string('site_copyright')->nullable();
            $table->tinyInteger('theme_setting')->default(1);
            $table->string('home_slide_title')->nullable();
            $table->text('home_slide_text')->nullable();
            $table->string('page_bg_image')->nullable();
            $table->string('about_title')->nullable();
            $table->longText('about_description')->nullable();
            $table->string('contact_title')->nullable();
            $table->longText('contact_address')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_lat')->nullable();
            $table->string('contact_long')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('gplus_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_settings');
    }
}
