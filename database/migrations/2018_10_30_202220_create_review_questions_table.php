<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_questions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('question');
            $table->boolean('has_comment');
            $table->boolean('has_suggestion');
            $table->string('reviewer_help_video_link');
            $table->string('uploader_help_video_link');
            $table->string('field');
            $table->integer('user_level');
            $table->timestamps();
        });
        
        DB::table('review_questions')
            ->insert(
                [
                    [
                        'question' => 'Je, jina la wimbo limeandikwa kwa usahihi?',
                        'has_comment' => false,
                        'has_suggestion' => true,
                        'reviewer_help_video_link' => '',
                        'uploader_help_video_link' => '',
                        'field' => 'name',
                        'user_level' => 1,
                    ],
                    [
                        'question' => 'Je, wimbo ni wa Kiswahili?',
                        'has_comment' => false,
                        'has_suggestion' => false,
                        'reviewer_help_video_link' => '',
                        'uploader_help_video_link' => '',
                        'field' => 'name',
                        'user_level' => 1,
                    ],
                    [
                        'question' => 'Je, jina la wimbo linafanana na jina au maneno yanayooonekana kwenye PDF?',
                        'has_comment' => false,
                        'has_suggestion' => false,
                        'reviewer_help_video_link' => '',
                        'uploader_help_video_link' => '',
                        'field' => 'name',
                        'user_level' => 1,
                    ],
                    [
                        'question' => 'Je, jina la mtunzi kwenye PDF, linafanana na jina la mtunzi lililochaguliwa?',
                        'has_comment' => false,
                        'has_suggestion' => false,
                        'reviewer_help_video_link' => '',
                        'uploader_help_video_link' => '',
                        'field' => 'composer_id',
                        'user_level' => 1,
                    ],
                    [
                        'question' => 'Je, midi iliyowekwa ni sahihi kulingana na PDF?',
                        'has_comment' => false,
                        'has_suggestion' => false,
                        'reviewer_help_video_link' => '',
                        'uploader_help_video_link' => '',
                        'field' => 'midi',
                        'user_level' => 1,
                    ],
                    [
                        'question' => 'Je, uploader ametenganisha staff lines za kiitikio na mashairi?',
                        'has_comment' => false,
                        'has_suggestion' => false,
                        'reviewer_help_video_link' => '',
                        'uploader_help_video_link' => '',
                        'field' => 'pdf',
                        'user_level' => 1,
                    ],
                    [
                        'question' => 'Je, PDF imeandaliwa kwa usafi? Mfano: maneno hayaingiliana na nota?',
                        'has_comment' => false,
                        'has_suggestion' => false,
                        'reviewer_help_video_link' => '',
                        'uploader_help_video_link' => '',
                        'field' => 'pdf',
                        'user_level' => 1,
                    ],
                    [
                        'question' => 'Je, kuna alama za pumziko sehemu sahihi na hazipo sehemu zisizostahili?',
                        'has_comment' => false,
                        'has_suggestion' => false,
                        'reviewer_help_video_link' => '',
                        'uploader_help_video_link' => '',
                        'field' => 'pdf',
                        'user_level' => 1,
                    ],
                    [
                        'question' => 'Je, wimbo <strong>HAUNA</strong> shida ya harmony?',
                        'has_comment' => true,
                        'has_suggestion' => false,
                        'reviewer_help_video_link' => '',
                        'uploader_help_video_link' => '',
                        'field' => 'pdf',
                        'user_level' => 2,
                    ],
                    [
                        'question' => 'Je, wimbo upo kwenye makundi nyimbo sahihi? ',
                        'has_comment' => false,
                        'has_suggestion' => true,
                        'reviewer_help_video_link' => '',
                        'uploader_help_video_link' => '',
                        'field' => 'categories',
                        'user_level' => 1,
                    ],
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
        Schema::dropIfExists('review_questions');
    }
}
