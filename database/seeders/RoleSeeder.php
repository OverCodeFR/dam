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
            'key' => 'd8bad2f9-2d24-3861-9f7a-d4a5dccfe79d',
            ]);

        Role::factory()->create([
            'name' => 'User - Patient',
            'key' => 'e5d2e8b5-7a40-3ed6-a7e9-00d3f87c385d',
            ]);

        Role::factory()->create([
            'name' => 'Personnel soignant',
            'key' => '9a72061a-2116-3f33-aae6-6c992e3238e3',
            ]);

        Role::factory()->create([
            'name' => 'Aidant',
            'key' => 'fbaf263c-fd8b-3d08-931c-740fa0a1f743',
            ]);
    }
}
