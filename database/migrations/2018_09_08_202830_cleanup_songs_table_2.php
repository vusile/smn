<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CleanupSongsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->renameColumn('jina_la_wimbo', 'name');
            $table->renameColumn('mtunzi', 'composer_id');
            $table->renameColumn('image_au_PDF', 'pdf');
            $table->dropColumn(['mtunzi_mpya', 'category', 'redraw_reason']);
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
            $table->renameColumn('name', 'jina_la_wimbo');
            $table->renameColumn('composer_id', 'mtunzi');
            $table->renameColumn('pdf', 'image_au_PDF');
        });
    }
}
