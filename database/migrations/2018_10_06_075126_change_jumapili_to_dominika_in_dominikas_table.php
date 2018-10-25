<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Dominika;

class ChangeJumapiliToDominikaInDominikasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $dominikas = Dominika::all();
        foreach($dominikas as $dominika){
            $dominika->title = str_replace('Jumapili','Dominika', $dominika->title);
            $dominika->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $dominikas = Dominika::all();
        foreach($dominikas as $dominika){
            $dominika->title = str_replace('Jumapili','Dominika', $dominika->title);
            $dominika->save();
        }
    }
}
