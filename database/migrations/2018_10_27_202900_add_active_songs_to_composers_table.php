<?php

use App\Models\Composer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveSongsToComposersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('composers', function (Blueprint $table) {
            $table->Integer('active_songs')->default(0);
        });
        
        $query = "SELECT composers.*, composers.name name, composers.url url, COUNT( songs.id ) counts FROM songs, composers WHERE songs.composer_id = composers.id AND songs.status in (1,2) GROUP BY songs.composer_id ORDER BY composers.name";
        
        $activeSongs = DB::select($query);
        
        foreach($activeSongs as $activeSong) {
            Composer::where('id', $activeSong->id)
                ->update(
                    [
                        'active_songs' => $activeSong->counts
                    ]
                );
        }
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
