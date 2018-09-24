<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dominika extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jumapili_na_sikukuu', function (Blueprint $table) {
            $table->renameColumn('JumapiliNaSikukuuID', 'id');
            $table->renameColumn('JumapiliSikukuuTitle', 'title');
            $table->renameColumn('MwakaID', 'mwaka_id');
        });
        
        Schema::rename('jumapili_na_sikukuu', 'dominika');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dominika', function (Blueprint $table) {
            $table->renameColumn('id', 'JumapiliNaSikukuuID');
            $table->renameColumn('title', 'JumapiliSikukuuTitle');
            $table->renameColumn('mwaka_id', 'MwakaID');
        });
        
        Schema::rename('dominika', 'jumapili_na_sikukuu');
    }
}
