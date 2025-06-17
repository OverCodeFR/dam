<?php

namespace Database\Seeders;

use App\Models\TreatmentType;
use App\TreatmentTypeModuleEnum;
use Database\Factories\TreatmentTypeFactory;
use Illuminate\Database\Seeder;

class TreatmentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $treatmentTypes = [
            ['name' => 'Comprimé', 'module' => TreatmentTypeModuleEnum::Module1],
            ['name' => 'Gelule', 'module' => TreatmentTypeModuleEnum::Module2 ],
            ['name' => 'Sachet', 'module' => TreatmentTypeModuleEnum::Module3],
            ['name' => 'Ampoule', 'module' => TreatmentTypeModuleEnum::Module4],
        ];

        foreach ($treatmentTypes as $type) {
            TreatmentType::firstOrCreate([
                'name' => $type['name'],
                'module' => $type['module'],
            ]);
        }
    }
}


