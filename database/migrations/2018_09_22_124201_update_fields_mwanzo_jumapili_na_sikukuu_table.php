<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFieldsMwanzoJumapiliNaSikukuuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mwanzo_jumapili_na_sikukuu', function (Blueprint $table) {
            $table->renameColumn('SongID', 'song_id');
            $table->renameColumn('JumapiliSikukuuID', 'dominika_id');
            $table->renameColumn('priority', 'parts_of_mass_id');
        });
        
        Schema::rename('mwanzo_jumapili_na_sikukuu', 'dominikas_songs');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('dominikas_songs', 'mwanzo_jumapili_na_sikukuu');
        
        Schema::table('mwanzo_jumapili_na_sikukuu', function (Blueprint $table) {
            $table->renameColumn('song_id', 'SongID');
            $table->renameColumn('dominika_id', 'JumapiliSikukuuID');
            $table->renameColumn('parts_of_mass_id', 'priority');
        });
    }
}
