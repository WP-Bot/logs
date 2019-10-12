<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userhost', 255);
            $table->string('nickname', 255);
            $table->text('message');
            $table->string('event', 255)->default('message');
            $table->string('channel', 255)->default('#wordpress');
            $table->tinyInteger('is_question')->default(0);
            $table->text('is_appreciation')->nullable();
            $table->text('is_docbot')->nullable();
            $table->dateTime('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
