<?php

use App\Models\Song;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
           $table->dropForeign('reviews_user_id_foreign');
        });
        
        Schema::table('songs', function (Blueprint $table) {
           $table->dropForeign('songs_user_id_foreign');
        });
        
        
        Schema::table('users', function (Blueprint $table) {
           $table->increments('id')->change();
        });
        
        $song = Song::find(DB::table('songs')->max('id'));
        
        $maxId = $song->id + 1;
        
        DB::statement("ALTER TABLE songs AUTO_INCREMENT = $maxId;");
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
