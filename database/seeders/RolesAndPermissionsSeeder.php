<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        Permission::create(['name' => 'view currency rates']);
        Permission::create(['name' => 'view currency rate']);
        Permission::create(['name' => 'create currency rate']);
        Permission::create(['name' => 'update currency rate']);
        Permission::create(['name' => 'delete currency rate']);

        $admin->givePermissionTo('view currency rates');
        $admin->givePermissionTo('view currency rate');
        $admin->givePermissionTo('create currency rate');
        $admin->givePermissionTo('update currency rate');
        $admin->givePermissionTo('delete currency rate');

        $user->givePermissionTo('view currency rates');
        $user->givePermissionTo('view currency rate');
    }
}
