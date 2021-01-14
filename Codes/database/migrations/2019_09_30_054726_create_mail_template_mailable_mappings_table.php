<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTemplateMailableMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_template_mailable_mappings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mailable_id');
            $table->unsignedInteger('template_id');
            $table->string('language')->nullable();;
            $table->longText('template_detail')->nullable();
            $table->tinyInteger('status')->default(0);

            $table->foreign('mailable_id')->references('id')->on('mail_mailables')->onDelete('cascade');
            $table->foreign('template_id')->references('id')->on('mail_templates')->onDelete('cascade');

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
        Schema::dropIfExists('mail_template_mailable_mappings');
    }
}
