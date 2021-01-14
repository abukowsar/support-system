<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_data', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('type')->nullable();
            $table->string('value')->nullable();
            $table->string('label')->nullable();
            $table->integer('sequence')->nullable();
            $table->string('sub_type')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('static_data');
    }
}
