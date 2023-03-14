<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\AuthQuestion;

class CreateAuthQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_questions', function (Blueprint $table) {
            $table->id();
            $table->text("swahili");
            $table->text("english");
            $table->timestamps();
        });

        $data = [
            [
                'swahili' => 'Ulizaliwa mwaka gani?',
                'english' => 'What year were you born?',
            ],
            [
                'swahili' => 'Nani mtunzi unayempenda zaidi?',
                'english' => 'Who is your favorite composer?',
            ],
            [
                'swahili' => 'Jina la shule uliyosoma elimu ya msingi?',
                'english' => 'What is the name of the school you went to for primary education?',
            ],
            [
                'swahili' => 'Nani alikufundisha muziki?',
                'english' => 'Who taught you music?',
            ],
            [
                'swahili' => 'Unasali Parokia gani?',
                'english' => 'What is the name of your parish?',
            ],
        ];

        AuthQuestion::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_questions');
    }
}
