<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CleanupSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dateTime('approved_date')->nullable()->change();
        });
        
        DB::update("UPDATE songs SET `approved_date` = NULL WHERE CAST(approved_date AS CHAR(20)) = '0000-00-00 00:00:00'");
        DB::update("UPDATE songs SET `date_of_composition` = NULL WHERE CAST(date_of_composition AS CHAR(11)) = '0000-00-00'");
        DB::update("UPDATE songs SET `uploaded_date` = NULL WHERE CAST(uploaded_date AS CHAR(11)) = '0000-00-00'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
