<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSoftwareFieldInSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->renameColumn('software', 'software_id');
        });
        
        Schema::table('softwares', function (Blueprint $table) {
            $table->renameColumn('software_id', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->renameColumn('software_id', 'software');
        });
        
        Schema::table('softwares', function (Blueprint $table) {
            $table->renameColumn('id', 'software_id');
        });
    }
}
