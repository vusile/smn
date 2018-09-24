<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveAntifonaShangilioToDominikasSongsTable extends Migration
{
    public function up()
    {        
        $records = DB::table('antifona_jumapili_na_sikukuu')
            ->get();
        
        $insert = [];
        
        foreach($records as $record)
        {
            $insert[] = [
                'song_id' => $record->SongID,
                'dominika_id' => $record->JumapiliSikukuuID,
                'parts_of_mass_id' => 4
            ];
        }
        
        DB::table('dominikas_songs')->insert($insert);
        
        $records = DB::table('shangilio_jumapili_na_sikukuu')
            ->get();
        
        $insert = [];
        
        foreach($records as $record)
        {
            $insert[] = [
                'song_id' => $record->SongID,
                'dominika_id' => $record->JumapiliSikukuuID,
                'parts_of_mass_id' => 3
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
        DB::table('dominikas_songs')->where('parts_of_mass_id', 3)->delete();
        DB::table('dominikas_songs')->where('parts_of_mass_id', 4)->delete();
    }
}
