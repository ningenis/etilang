<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'add violations']);
        Permission::create(['name' => 'edit violations']);
        Permission::create(['name' => 'delete violations']);
        Permission::create(['name' => 'verify violations']);
        Permission::create(['name' => 'view violations']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'officer']);
        $role->givePermissionTo(['add violations', 'edit violations', 'delete violations', 'view violations']);

        $role = Role::create(['name' => 'verifier']);
        $role->givePermissionTo('verify violations');

        $role = Role::create(['name' => 'violator']);
        $role->givePermissionTo('view violations');

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
