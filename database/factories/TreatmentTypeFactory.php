<?php

namespace Database\Factories;


use App\TreatmentTypeModuleEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class TreatmentTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $module = fake()->randomElement(TreatmentTypeModuleEnum::cases());

        return [
            'name' => ucfirst($module->name),
            'module' => $module->value,
        ];
    }
}
