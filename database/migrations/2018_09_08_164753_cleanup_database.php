<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanupDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('piano_data_types');
        Schema::dropIfExists('piano_primary_keys');
        Schema::dropIfExists('piano_references');
        Schema::dropIfExists('piano_validation_parameters');
        Schema::dropIfExists('piano_not_reviewed_reasons');
        Schema::rename('non_review_reasons', 'song_rejected_reasons');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('song_rejected_reasons', 'non_review_reasons');
    }
}
