<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->bigInteger('song_id');
            $table->unsignedInteger('review_question_id');
            $table->unsignedInteger('review_answer_id');
            $table->foreign('song_id')->references('id')->on('songs');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('review_question_id')->references('id')->on('review_questions');
            $table->foreign('review_answer_id')->references('id')->on('review_answers');
            $table->text('suggestion')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
