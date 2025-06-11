<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = [
            ['name' => 'Janne', 'phone' => '0751963580', 'address' => '13 rue des Lilas', 'email' => 'janne@example.com', 'user_id' => 2,],
            ['name' => 'Jamie', 'phone' => '0654597016', 'address' => '79 rue des Pépinières', 'email' => 'jamie@example.com', 'user_id' => 2,],
            ['name' => 'Sam', 'phone' => '0696831895', 'address' => '1 rue des Roseaux', 'email' => 'sam@example.com', 'user_id' => 3,],
            ['name' => 'Natacha', 'phone' => '0698476521', 'address' => '56 Boulevard des Primevères', 'email' => 'natacha@example.com', 'user_id' => 4,],
            ['name' => 'Jerry', 'phone' => '0759874250', 'address' => '39 rue des Bavières', 'email' => 'jerry@example.com', 'user_id' => null,],
        ];

        foreach ($patients as $data) {

            Patient::factory()->create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'email' => $data['email'],
                'user_id' => $data['user_id'],
            ]);
        }
    }
}
