<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveDominikaStuffToDominikasSongs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('dominikas_songs')
            ->update(['parts_of_mass_id' => 1]);
        
        $records = DB::table('katikati_jumapili_na_sikukuu')
            ->get();
        
        $insert = [];
        
        foreach($records as $record)
        {
            $insert[] = [
                'song_id' => $record->SongID,
                'dominika_id' => $record->JumapiliSikukuuID,
                'parts_of_mass_id' => 2
            ];
        }
        
        DB::table('dominikas_songs')->insert($insert);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('dominikas_songs')->where('parts_of_mass_id', 2)->delete();
    }
}
