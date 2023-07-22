<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_contributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donor_contribution_id');
            $table->integer("amount");
            $table->unsignedBigInteger('month_year_id');
            $table->foreign('donor_contribution_id')->references('id')->on('donor_contributions');
            $table->foreign('month_year_id')->references('id')->on('month_years');
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
        Schema::dropIfExists('monthly_contributions');
    }
}
