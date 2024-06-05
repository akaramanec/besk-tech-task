<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@us.er',
            'password' => Hash::make('user@us.er'),
        ]);
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@ad.min',
            'password' => Hash::make('admin@ad.min'),
        ]);
        $user->assignRole(Role::roleUserApi());
        $admin->assignRole(Role::roleAdminApi());
    }
}
