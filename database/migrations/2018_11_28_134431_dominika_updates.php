<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Dominika;

class DominikaUpdates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $missingDominikas = [
            [
                'title' => 'Dominika ya 1 ya Majilio Mwaka A',
                'year_id' => 1,
                'dominika_date' => null
            ],
            [
                'title' => 'Dominika ya 1 ya Majilio Mwaka B',
                'year_id' => 2,
                'dominika_date' => null
            ],
            [
                'title' => 'Dominika ya 1 ya Majilio Mwaka C',
                'year_id' => 3,
                'dominika_date' => '2018-12-02'
            ],
        ];
        
        foreach($missingDominikas as $missingDominika) {
            $dominika = new Dominika;
            $dominika->title = $missingDominika['title'];
            $dominika->year_id = $missingDominika['year_id'];
            $dominika->dominika_date = $missingDominika['dominika_date'];
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
        //
    }
}
