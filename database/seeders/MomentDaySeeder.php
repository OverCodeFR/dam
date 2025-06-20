<?php

namespace Database\Seeders;

use App\Models\MomentDay;
use App\MomentDayEnum;
use Illuminate\Database\Seeder;

class MomentDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moments = [
            ['moment_day' => MomentDayEnum::MATIN],

            ['moment_day' => MomentDayEnum::MIDI],

            ['moment_day' => MomentDayEnum::APRES_MIDI],

            ['moment_day' => MomentDayEnum::SOIR],

            ['moment_day' => MomentDayEnum::NUIT],
        ];

        foreach ($moments as $data) {

            MomentDay::factory()->create([
                'moment' => $data['moment_day'],
            ]);
        }
    }
}
