<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RestructureComposerEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('composer_emails', function (Blueprint $table) {
            $table->renameColumn('ComposerEmailID', 'id');
            $table->renameColumn('ComposerID', 'composer_id');
            $table->renameColumn('SenderName', 'sender_name');
            $table->renameColumn('SenderEmail', 'sender_email');
            $table->renameColumn('SenderPhone', 'sender_phone');
            $table->renameColumn('Message', 'message');
            $table->renameColumn('MessageDate', 'message_date');
            $table->renameColumn('MessageRead', 'message_read');
            $table->index('composer_id');
            $table->foreign('composer_id')
                    ->references('id')
                    ->on('composers')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('composer_emails', function (Blueprint $table) {
            $table->renameColumn('id', 'ComposerEmailID');
            $table->renameColumn('composer_id', 'ComposerID');
            $table->renameColumn('sender_name', 'SenderName');
            $table->renameColumn('sender_email', 'SenderEmail');
            $table->renameColumn('sender_phone', 'SenderPhone');
            $table->renameColumn('message', 'Message');
            $table->renameColumn('message_date', 'MessageDate');
            $table->renameColumn('message_read', 'MessageRead');
            $table->dropForeign('composer_emails_composer_id_foreign');
            $table->dropIndex('composer_emails_composer_id_index');
        });
    }
}
