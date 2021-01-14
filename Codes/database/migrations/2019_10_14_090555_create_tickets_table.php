<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('priority')->default('normal');
            $table->string('subject')->nullable();
            $table->longText('description')->nullable();
            $table->string('status')->nullable()->default('open');
            $table->enum('ticket_show_by', ['public', 'private'])->default('public');
            $table->string('url')->nullable();
            $table->bigInteger('solved_by')->nullable();
            $table->unsignedBigInteger('assigned_id')->nullable();
            $table->date('date')->nullable();
            $table->date('reopen_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('assigned_id')->references('id')->on('employees')->onDelete('cascade');
            $table->bigInteger('views')->default(1);
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
        Schema::dropIfExists('tickets');
    }
}
