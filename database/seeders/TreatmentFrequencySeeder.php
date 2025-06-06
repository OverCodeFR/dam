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
            ['amount' => '1', 'frequency' => FrequencyMomentDayEnum::MATIN, 'treatment' => 1],
            ['amount' => '2', 'frequency' => FrequencyMomentDayEnum::MATIN_MIDI, 'treatment' => 2],
            ['amount' => '3', 'frequency' => FrequencyMomentDayEnum::MATIN_MIDI_APRES_MIDI, 'treatment' => 3],
            ['amount' => '4', 'frequency' => FrequencyMomentDayEnum::MATIN_MIDI_APRES_MIDI_SOIR, 'treatment' => 4],
            ['amount' => '5', 'frequency' => FrequencyMomentDayEnum::MATIN_MIDI_APRES_MIDI_SOIR_NUIT, 'treatment' => 5],
        ];

        foreach ($treatmentFrequencies as $data) {
            $frequency = Frequency::where('moment_day', $data['frequency']->value)->first();

            TreatmentFrequency::factory()->create([
                'amount' => $data['amount'],
                'frequency_id' => $frequency->id,
                'treatment_id' => $data['treatment'],
            ]);
        }
    }
}
