<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->text("reference_number");
            $table->integer("amount");
            $table->boolean("divide_monthly");
            $table->dateTime("contribution_date");
            $table->unsignedInteger('donor_id');
            $table->foreign('donor_id')->references('id')->on('donors');
            $table->unique("reference_number");
            $table->index("reference_number");
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
        Schema::dropIfExists('contributions');
    }
}
