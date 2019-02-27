<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRolesAndPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $ithibatiRole = Role::create(['name' => 'ithibati']);
        $uhakikiRole = Role::create(['name' => 'uhakiki']);
        $adminRole = Role::create(['name' => 'admin']);
        $superAdminRole = Role::create(['name' => 'super admin']);
        
        $ithibati = Permission::create(['name' => 'kutoa ithibati']);
        $uhakiki = Permission::create(['name' => 'kuhakiki']);
        
        $ithibatiRole->givePermissionTo($ithibati);
        $uhakikiRole->givePermissionTo($uhakiki);
        $adminRole->syncPermissions([$ithibati, $uhakiki]);
        $superAdminRole->syncPermissions([$ithibati, $uhakiki]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
