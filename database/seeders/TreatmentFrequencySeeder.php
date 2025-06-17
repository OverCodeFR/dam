<?php

namespace Database\Seeders;

use App\FrequencyMomentDayEnum;
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
            ['amount' => '1', 'frequency' => '08:00:00', 'treatment' => 1],
            ['amount' => '2', 'frequency' => '12:00:00', 'treatment' => 2],
            ['amount' => '3', 'frequency' => '16:00:00', 'treatment' => 3],
            ['amount' => '4', 'frequency' => '20:00:00', 'treatment' => 4],
            ['amount' => '5', 'frequency' => '23:00:00', 'treatment' => 5],
        ];

        foreach ($treatmentFrequencies as $data) {
            $frequency = Frequency::where('hour', $data['frequency'])->first();

            TreatmentFrequency::factory()->create([
                'amount' => $data['amount'],
                'frequency_id' => $frequency->id,
                'treatment_id' => $data['treatment'],
            ]);
        }
    }
}
