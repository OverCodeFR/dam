<?php

namespace Database\Factories;

use App\Models\Frequency;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TreatmentFrequency>
 */
class TreatmentFrequencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(0,1,5),
            'frequency_id' => Frequency::factory(),
            'treatment_id' => Treatment::factory(),
        ];
    }
}
