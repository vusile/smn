<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\RoleAlreadyExists;

class CreateRolesAndPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            $ithibatiRole = Role::create(['name' => 'ithibati']);
            $uhakikiRole = Role::create(['name' => 'uhakiki']);
            $adminRole = Role::findOrCreate('admin');
            $superAdminRole = Role::findOrCreate('super admin');
    
            $ithibati = Permission::create(['name' => 'kutoa ithibati']);
            $uhakiki = Permission::create(['name' => 'kuhakiki']);
    
            $ithibatiRole->givePermissionTo($ithibati);
            $uhakikiRole->givePermissionTo($uhakiki);
            $adminRole->syncPermissions([$ithibati, $uhakiki]);
            $superAdminRole->syncPermissions([$ithibati, $uhakiki]);
        } catch(RoleAlreadyExists $error ) {
            //do nothing
        }

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
