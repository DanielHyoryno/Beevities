<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Regular User
        User::create([
            'name'     => 'User Example',
            'email'    => 'user@gmail.com',
            'password' => Hash::make('password'),
            'number'   => '081234567890',
            'role'     => 0,
        ]);

        // Admin User
        User::create([
            'name'     => 'Admin Example',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'number'   => '081234567891',
            'role'     => 1,
        ]);

        // BNCC Organization Admin
        User::create([
            'name'     => 'BNCC Admin',
            'email'    => 'bnccadmin@gmail.com',
            'password' => Hash::make('password'),
            'number'   => '081234567892',
            'role'     => 2,  // 2 for Organization Admin
            'organization_id' => 1, // BNCC ID
        ]);

        // BDM Organization Admin
        User::create([
            'name'     => 'BDM Admin',
            'email'    => 'bdmadmin@gmail.com',
            'password' => Hash::make('password'),
            'number'   => '081234567893',
            'role'     => 2,  // 2 for Organization Admin
            'organization_id' => 2, // BDM ID
        ]);
    }
}
