<?php

namespace Database\Seeders;

use App\FrequencyEnum;
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
        foreach (FrequencyEnum::cases() as $frequence) {
            Frequency::create([
                'name' => $frequence,
            ]);
        }
    }
}
