<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWhatsappTracker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whatsapp_tracker', function (Blueprint $table) {
            $table->id();
            $table->string("phone");
            $table->text("message")->nullable();
            $table->string("message_id");
            $table->string("delivery_status")->nullable();
            $table->string("conversation_id")->nullable();
            $table->enum('type', ['status', 'message']);
            $table->index('message_id');
            $table->index('conversation_id');
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
        Schema::dropIfExists('whatsapp_tracker');
    }
}
