<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Phase2RolesAndPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $kmtMuzikiRole = Role::create(['name' => 'viongozi kamati muziki']);
        $kmtUhakikiRole = Role::create(['name' => 'viongozi uhakiki']);

        $reassignMhakiki = Permission::create(['name' => 'reassign mhakiki']);
        $reassignMtoaIthibati = Permission::create(['name' => 'reassign mtoa ithibati']);
        $prioritizeSong = Permission::create(['name' => 'prioritize song']);

        $kmtMuzikiRole->givePermissionTo([$reassignMtoaIthibati]);
        $kmtUhakikiRole->givePermissionTo([$reassignMhakiki, $prioritizeSong]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
