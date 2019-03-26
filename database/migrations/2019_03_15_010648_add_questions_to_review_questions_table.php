<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuestionsToReviewQuestionsTable extends Migration
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
                        'question' => 'Je, wimbo huu unafaa kuimbwa kwenye ibada ya misa?',
                        'has_comment' => false,
                        'has_suggestion' => true,
                        'reviewer_help_video_link' => '',
                        'uploader_help_video_link' => '',
                        'field' => 'fit_for_liturgy',
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
    }
}
