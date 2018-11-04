<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_answers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('value');
        });
        
        DB::table('review_answers')
            ->insert(
                [
                    ['value' => 'Ndio (Ni sahihi)'],
                    ['value' => 'Hapana (Si sahihi)'],
                    ['value' => 'Sina Hakika'],
                ]
            );
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_answers');
    }
}
