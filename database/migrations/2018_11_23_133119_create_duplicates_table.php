<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDuplicatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duplicates', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('entity_id');
            $table->String('entity_type');
            $table->String('duplicates');
            $table->index(['entity_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duplicates');
    }
}
