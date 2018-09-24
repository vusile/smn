<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsOfMassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wimbo_huu_ni', function (Blueprint $table) {
            $table->renameColumn('Wimbo_Huu_Ni_ID', 'id');
            $table->renameColumn('Title', 'name');
        });
        
        Schema::rename('wimbo_huu_ni', 'parts_of_mass');
     
        DB::table('parts_of_mass')
                ->where('id', 4)
                ->update(['name' => 'Antifona / Komunio']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('parts_of_mass')
                ->where('id', 4)
                ->update(['name' => 'Komunio']);
        
        Schema::rename('parts_of_mass', 'wimbo_huu_ni');
        
        Schema::table('wimbo_huu_ni', function (Blueprint $table) {
            $table->renameColumn('id', 'Wimbo_Huu_Ni_ID');
            $table->renameColumn('name', 'Title');
        });
    }
}
