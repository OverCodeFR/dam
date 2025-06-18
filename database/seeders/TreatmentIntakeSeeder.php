<?php

namespace Database\Seeders;

use App\Models\TreatmentIntake;
use Illuminate\Database\Seeder;

class TreatmentIntakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $treatment_intakes = [
            ['taken_at' => now(), 'amount' => '1', 'patient_id' => 1, 'treatment_id' => 1],
            ['taken_at' => now(), 'amount' => '2', 'patient_id' => 2, 'treatment_id' => 2],
            ['taken_at' => now(), 'amount' => '3', 'patient_id' => 3, 'treatment_id' => 3],
            ['taken_at' => now(), 'amount' => '4', 'patient_id' => 4, 'treatment_id' => 4],
        ];

        foreach ($treatment_intakes as $data) {
            TreatmentIntake::factory()->create([
                'taken_at' => $data['taken_at'],
                'amount' => $data['amount'],
                'patient_id' => $data['patient_id'],
                'treatment_id' => $data['treatment_id'],
            ]);
        }
    }
}
