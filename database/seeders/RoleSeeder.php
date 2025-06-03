<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create([
            'name' => 'Admin',
            ]);

        Role::factory()->create([
            'name' => 'User - Patient',
            ]);

        Role::factory()->create([
            'name' => 'Personnel soignant',
            ]);

        Role::factory()->create([
            'name' => 'Aidant',
            ]);
    }
}
