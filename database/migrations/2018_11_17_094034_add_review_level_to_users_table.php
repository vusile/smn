<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReviewLevelToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->Integer('review_level')->default(1)->after('remember_token');
        });
        
        Schema::table('review_questions', function (Blueprint $table) {
            $table->renameColumn('user_level','review_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('review_level');
        });
        
        Schema::table('review_questions', function (Blueprint $table) {
            $table->renameColumn('review_level', 'user_level');
        });
    }
}
