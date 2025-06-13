<?php

namespace Database\Seeders;

use App\Models\PatientUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patientUser = [
            ['patient_id' => '1', 'user_id' => '2'],
            ['patient_id' => '2', 'user_id' => '2'],
            ['patient_id' => '3', 'user_id' => '3'],
            ['patient_id' => '5', 'user_id' => '2'],
        ];

        foreach ($patientUser as $data) {

            PatientUser::factory()->create([
                'patient_id' => $data['patient_id'],
                'user_id' => $data['user_id'],
            ]);
        }
    }
}
