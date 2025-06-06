<?php

namespace Database\Seeders;

use App\Models\Frequency;
use App\FrequencyMomentDayEnum;
use Illuminate\Database\Seeder;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (FrequencyMomentDayEnum::cases() as $case) {
            Frequency::firstOrCreate(
                ['moment_day' => $case->value],
            );
        }
    }
}
