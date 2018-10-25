<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MwakaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mwaka', function (Blueprint $table) {
            $table->renameColumn('MwakaID', 'id');
            $table->renameColumn('Title', 'title');
        });
        
        Schema::rename('mwaka', 'years');
        
        Schema::table('dominikas', function (Blueprint $table) {
            $table->renameColumn('mwaka_id', 'year_id');
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
