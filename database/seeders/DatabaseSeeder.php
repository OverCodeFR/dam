<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Role
        Role::factory()->create(['name' => 'Admin',]);
        Role::factory()->create(['name' => 'User - Patient',]);
        Role::factory()->create(['name' => 'Personnel soignant',]);
        Role::factory()->create(['name' => 'Aidant',]);

        //User
        User::factory()->create([
            'name' => 'Sophie',
            'email' => 'sophie@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Natacha',
            'email' => 'natacha@example.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'Didier',
            'email' => 'didier@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3,
        ]);

        User::factory()->create([
            'name' => 'Marcel',
            'email' => 'marcel@example.com',
            'password' => Hash::make('password'),
            'role_id' => 4,
        ]);

    }
}
