<?php

namespace Database\Seeders;

use App\Models\User;
use App\RoleKeyEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Sophie',
            'email' => 'sophie@example.com',
            'password' => Hash::make('password'),
            'role' => RoleKeyEnum::Admin,
        ]);

        User::factory()->create([
            'name' => 'Natacha',
            'email' => 'natacha@example.com',
            'password' => Hash::make('password'),
            'role' => RoleKeyEnum::patient,
        ]);

        User::factory()->create([
            'name' => 'Didier',
            'email' => 'didier@example.com',
            'password' => Hash::make('password'),
            'role' => RoleKeyEnum::patient,
        ]);

        User::factory()->create([
            'name' => 'Marcel',
            'email' => 'marcel@example.com',
            'password' => Hash::make('password'),
            'role' => RoleKeyEnum::Helper,
        ]);
    }
}
