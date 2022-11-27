<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'admin']);
        Permission::create(['name' => 'editor']);

        Role::create(['name' => 'editor']);
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('admin');
    }
}
