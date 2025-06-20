<?php

namespace Database\Seeders;

use App\MomentDayEnum;
use App\Models\Frequency;
use App\Models\TreatmentFrequency;
use Illuminate\Database\Seeder;

class TreatmentFrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $treatmentFrequencies = [
            ['amount' => '1', 'preferred_hour' => '08:00:00', 'moment_day' => 1, 'frequency' => 1, 'treatment' => 1],
            ['amount' => '2', 'preferred_hour' => '10:00:00', 'moment_day' => 2, 'frequency' => 2, 'treatment' => 2],
            ['amount' => '3', 'preferred_hour' => '12:00:00', 'moment_day' => 3, 'frequency' => 3, 'treatment' => 3],
            ['amount' => '4', 'preferred_hour' => '14:00:00', 'moment_day' => 4, 'frequency' => 4, 'treatment' => 4],
            ['amount' => '5', 'preferred_hour' => '16:00:00', 'moment_day' => 5, 'frequency' => 5, 'treatment' => 5],
        ];

        foreach ($treatmentFrequencies as $data) {
            TreatmentFrequency::factory()->create([
                'amount' => $data['amount'],
                'preferred_hour' => $data['preferred_hour'],
                'moment_day_id' => $data['moment_day'],
                'frequency_id' => $data['frequency'],
                'treatment_id' => $data['treatment'],
            ]);
        }
    }
}
