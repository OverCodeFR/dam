<?php

namespace Database\Seeders;

use App\Models\Role;
use App\RoleKeyEnum;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoleKeyEnum::cases() as $case) {
            Role::firstOrCreate(
                ['key' => $case->value],
                ['name' => ucfirst($case->name)]
            );
        }
    }
}
