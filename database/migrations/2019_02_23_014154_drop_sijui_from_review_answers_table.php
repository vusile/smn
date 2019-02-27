<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropSijuiFromReviewAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('review_answers')
                ->where('id',3)
                ->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('review_answers')
            ->insert(
                [
                    'id' => 3,
                    'value' => 'Sina Hakika'
                ]
            );
    }
}
