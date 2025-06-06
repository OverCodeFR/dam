<?php

namespace Database\Factories;

use App\FrequencyMomentDayEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Frequency>
 */
class FrequencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $moment_day = fake()->randomElement(FrequencyMomentDayEnum::cases());

        return [
            'moment_day' => $moment_day->value,
        ];
    }
}
