<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangesInComposersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('composers', function (Blueprint $table) {
            $table->unsignedInteger('user')->change();
            $table->unsignedInteger('added_by')->change();
//            $table->foreign('user')->references('id')->on('users')->change();
//            $table->foreign('added_by')->references('id')->on('users')->change();
            $table->renameColumn('user', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('composers', function (Blueprint $table) {
            //
        });
    }
}
