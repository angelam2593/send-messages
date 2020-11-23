<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_messages', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->string('subject');
            $table->string('recipient_email');
            $table->string('recipient_cc')->nullable();
            $table->string('recipient_bcc')->nullable();
            $table->text('error')->nullable();
            $table->timestamp('sent_at');
            $table->integer('message_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        //Schema::table('email_messages', function($table) {
        //   $table->foreign('message_id')->references('id')->on('messages');
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_messages');
    }
}