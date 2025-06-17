<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\TreatmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'dosage' => fake()->randomFloat(2,1,250),
            'start_at' => fake()->dateTime(),
            'end_at' => fake()->dateTime(),
            'patient_id' => Patient::factory(),
            'treatment_type_id' => TreatmentType::factory(),
        ];
    }
}
