<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::factory()->create([
            'name' => 'Janne',
            'phone' => '0751963580',
            'address' => '13 rue des Lilas',
            'email' => 'janne@example.com',
            'user_id' => 2,
        ]);

        Patient::factory()->create([
            'name' => 'Jamie',
            'phone' => '0654597016',
            'address' => '79 rue des Pépinières',
            'email' => 'jamie@example.com',
            'user_id' => 3,
        ]);

        Patient::factory()->create([
            'name' => 'Sam',
            'phone' => '0696831895',
            'address' => '1 rue des Roseaux',
            'email' => 'sam@example.com',
            'user_id' => 4,
        ]);
    }
}
