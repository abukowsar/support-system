<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMailMailablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('mail_mailables', function (Blueprint $table) {
            $table->longText('to')->nullable()->after('status');
             $table->longText('bcc')->nullable()->after('to');
             $table->longText('cc')->nullable()->after('bcc');
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
