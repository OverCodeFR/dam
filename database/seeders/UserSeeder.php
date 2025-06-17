<?php

namespace Database\Seeders;

use App\Models\User;
use App\RoleKeyEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Sophie', 'email' => 'sophie@example.com', 'role' => RoleKeyEnum::Admin],
            ['name' => 'Didier', 'email' => 'didier@example.com', 'role' => RoleKeyEnum::Healthcare],
            ['name' => 'Marcel', 'email' => 'marcel@example.com', 'role' => RoleKeyEnum::Helper],
            ['name' => 'Natacha', 'email' => 'natacha@example.com', 'role' => RoleKeyEnum::patient],
        ];

        foreach ($users as $data) {
            $role = Role::where('key', $data['role']->value)->first();

            User::factory()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role_id' => $role->id,
            ]);
        }
    }
}
