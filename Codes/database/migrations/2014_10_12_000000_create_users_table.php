<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 20)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('email')->unique();
            $table->string('contact_number', 30)->nullable();
            $table->string('password', 255)->nullable();;
            $table->string('profile_image', 255)->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('activation_token', 255)->nullable();
            $table->string('user_type', 255)->nullable();            
            $table->string('api_token', 255)->nullable();
            $table->string('provider', 255)->nullable();            
            $table->string('provider_unique_id', 255)->nullable();
	        $table->timestamp('email_verified_at')->nullable();
            $table->string('status', 20)->default('active');
            $table->tinyInteger('banned')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
