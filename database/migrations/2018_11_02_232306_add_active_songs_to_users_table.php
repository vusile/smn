<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveSongsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->Integer('active_songs')->default(0)->after('remember_token');
        });
        
        $query = "SELECT user_id, COUNT( songs.id ) counts FROM songs WHERE status in (1,2) GROUP BY user_id";  
        $activeSongs = DB::select($query);
        
        foreach($activeSongs as $activeSong) {
            User::where('id', $activeSong->user_id)
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
