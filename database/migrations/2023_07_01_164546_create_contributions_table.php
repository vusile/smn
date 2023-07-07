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
        Schema::create('donor_contributions', function (Blueprint $table) {
            $table->id();
//            $table->string("reference_number", 50)->nullable();
            $table->integer("amount");
//            $table->boolean("divide_monthly")->default(true);
            $table->boolean("processed")->default(false);
            $table->dateTime("contribution_date");
            $table->unsignedBigInteger('donor_id');
            $table->foreign('donor_id')->references('id')->on('donors');
            $table->unique(['amount', 'contribution_date', 'donor_id']);
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
        Schema::dropIfExists('donor_contributions');
    }
}
