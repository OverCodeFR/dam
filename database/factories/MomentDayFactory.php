<?php

namespace Database\Factories;

use App\MomentDayEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MomentDay>
 */
class MomentDayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $moment_day = fake()->randomElement(MomentDayEnum::cases());

        return [
            'moment' => $moment_day->value,
        ];
    }
}
