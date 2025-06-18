<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PersonalAccessTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tokenable_type' => 'App\Models\Patient',
            'tokenable_id' => Patient::factory(),
            'name' => fake()->name(),
            'token' => fake()->sha256(),
            'abilities' => '["*"]',
            'last_used_at' => fake()->dateTime(),
            'expires_at' => fake()->dateTime(),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
