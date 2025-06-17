<?php

namespace Database\Factories;

use App\RoleKeyEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $key = fake()->randomElement(RoleKeyEnum::cases());

        return [
            'name' => ucfirst($key->name),
            'key' => $key->value,
        ];
    }
}
