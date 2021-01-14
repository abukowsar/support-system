<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMailTemplateMailableMappings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('mail_templates', function (Blueprint $table) {
            $table->string('notification_message')->nullable()->after('template_detail');
            $table->string('notification_link')->nullable()->after('notification_message');
        });

        Schema::table('mail_template_mailable_mappings', function (Blueprint $table) {
            $table->string('subject')->nullable()->after('language');
            $table->string('notification_message')->nullable()->after('template_detail');
            $table->string('notification_link')->nullable()->after('notification_message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
