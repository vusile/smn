<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDominikaQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('review_questions')
            ->insert(
                [
                    [
                        'question' => 'Je, wimbo unatumika kwenye dominika hizi/zozote?',
                        'has_comment' => false,
                        'has_suggestion' => true,
                        'reviewer_help_video_link' => '',
                        'uploader_help_video_link' => '',
                        'field' => 'dominika',
                        'review_level' => 1,
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
        //
    }
}
