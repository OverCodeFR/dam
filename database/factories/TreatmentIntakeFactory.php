<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TreatmentIntake>
 */
class TreatmentIntakeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'taken_at' => fake()->dateTime(),
            'amount' => fake()->randomFloat(0, 1, 5),
            'patient_id' => Patient::factory(),
            'treatment_id' => Treatment::factory(),
        ];
    }
}

