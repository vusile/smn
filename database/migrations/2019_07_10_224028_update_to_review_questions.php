<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateToReviewQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('review_questions', function (Blueprint $table) {
            $table->text('question_no_permission')->after('question')->nullable();
        });
        
        DB::table('review_questions')
                ->where('id', 9)
                ->update([
                    'question' => 'Je, wimbo <strong>HAUNA</strong> changamoto ya mwafaka?',
                    'question_no_permission' => 'Je, wimbo <strong>HAUNA</strong> changamoto ya mwafaka isiyovumilika?'
                ]);
        
        
        DB::table('review_questions')
                ->where('id', 12)
                ->update([
                    'question' => 'Wimbo huu unafaa kutumika kwenye ibada ya misa?',
                ]);
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_questions', function (Blueprint $table) {
            $table->dropColumn('question_no_permission');
        });
    }
}
