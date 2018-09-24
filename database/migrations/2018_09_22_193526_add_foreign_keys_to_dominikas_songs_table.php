<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToDominikasSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('dominikas_songs')
           ->whereNotIn('song_id',
                DB::table('songs')
                ->get()      
                ->pluck('id')
                ->all()
            )
            ->delete();
        
        Schema::table('dominikas_songs', function (Blueprint $table) {
            $table->bigInteger('song_id')->change();
            $table->foreign('song_id')->references('id')->on('songs');
            $table->foreign('dominika_id')->references('id')->on('dominika');
            $table->foreign('parts_of_mass_id')->references('id')->on('parts_of_mass');
        });
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
