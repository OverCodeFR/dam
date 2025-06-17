<?php

namespace Database\Seeders;

use App\FrequencyMomentDayEnum;
use App\Models\Frequency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $frequencies = [
            ['moment_day' => FrequencyMomentDayEnum::MATIN, 'hour' => '06:00'],
            ['moment_day' => FrequencyMomentDayEnum::MATIN, 'hour' => '06:30'],
            ['moment_day' => FrequencyMomentDayEnum::MATIN, 'hour' => '07:00'],
            ['moment_day' => FrequencyMomentDayEnum::MATIN, 'hour' => '07:30'],
            ['moment_day' => FrequencyMomentDayEnum::MATIN, 'hour' => '08:00'],
            ['moment_day' => FrequencyMomentDayEnum::MATIN, 'hour' => '08:30'],
            ['moment_day' => FrequencyMomentDayEnum::MATIN, 'hour' => '09:00'],
            ['moment_day' => FrequencyMomentDayEnum::MATIN, 'hour' => '09:30'],
            ['moment_day' => FrequencyMomentDayEnum::MATIN, 'hour' => '10:00'],
            ['moment_day' => FrequencyMomentDayEnum::MATIN, 'hour' => '10:30'],
            ['moment_day' => FrequencyMomentDayEnum::MATIN, 'hour' => '11:00'],
            ['moment_day' => FrequencyMomentDayEnum::MATIN, 'hour' => '11:30'],

            ['moment_day' => FrequencyMomentDayEnum::MIDI, 'hour' => '12:00'],
            ['moment_day' => FrequencyMomentDayEnum::MIDI, 'hour' => '12:30'],
            ['moment_day' => FrequencyMomentDayEnum::MIDI, 'hour' => '13:00'],
            ['moment_day' => FrequencyMomentDayEnum::MIDI, 'hour' => '13:30'],

            ['moment_day' => FrequencyMomentDayEnum::APRES_MIDI, 'hour' => '14:00'],
            ['moment_day' => FrequencyMomentDayEnum::APRES_MIDI, 'hour' => '14:30'],
            ['moment_day' => FrequencyMomentDayEnum::APRES_MIDI, 'hour' => '15:00'],
            ['moment_day' => FrequencyMomentDayEnum::APRES_MIDI, 'hour' => '15:30'],
            ['moment_day' => FrequencyMomentDayEnum::APRES_MIDI, 'hour' => '16:00'],
            ['moment_day' => FrequencyMomentDayEnum::APRES_MIDI, 'hour' => '16:30'],
            ['moment_day' => FrequencyMomentDayEnum::APRES_MIDI, 'hour' => '17:00'],

            ['moment_day' => FrequencyMomentDayEnum::SOIR, 'hour' => '17:30'],
            ['moment_day' => FrequencyMomentDayEnum::SOIR, 'hour' => '18:00'],
            ['moment_day' => FrequencyMomentDayEnum::SOIR, 'hour' => '18:30'],
            ['moment_day' => FrequencyMomentDayEnum::SOIR, 'hour' => '19:00'],
            ['moment_day' => FrequencyMomentDayEnum::SOIR, 'hour' => '19:30'],
            ['moment_day' => FrequencyMomentDayEnum::SOIR, 'hour' => '20:00'],
            ['moment_day' => FrequencyMomentDayEnum::SOIR, 'hour' => '20:30'],
            ['moment_day' => FrequencyMomentDayEnum::SOIR, 'hour' => '21:00'],
            ['moment_day' => FrequencyMomentDayEnum::SOIR, 'hour' => '21:30'],
            ['moment_day' => FrequencyMomentDayEnum::SOIR, 'hour' => '22:00'],

            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '22:30'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '23:00'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '23:30'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '00:00'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '00:30'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '01:00'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '01:30'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '02:00'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '02:30'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '03:00'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '03:30'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '04:00'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '04:30'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '05:00'],
            ['moment_day' => FrequencyMomentDayEnum::NUIT, 'hour' => '05:30'],
        ];

        foreach ($frequencies as $data) {

            Frequency::factory()->create([
                'moment_day' => $data['moment_day'],
                'hour' => $data['hour'],
            ]);
        }
    }
}
