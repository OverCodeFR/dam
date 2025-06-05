<?php

namespace Database\Seeders;

use App\Models\Treatment;
use App\Models\TreatmentType;
use App\TreatmentTypeModuleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $treatments = [
            ['name' => 'Sabril', 'dosage' => '500', 'start_at' => '2025-06-03', 'end_at' => '2025-06-13', 'patient_id' => 1, 'treatment_type_id' => '1'],
            ['name' => 'Palafar', 'dosage' => '300', 'start_at' => '2025-06-04', 'end_at' => '2025-06-22', 'patient_id' => 1, 'treatment_type_id' => '2'],
            ['name' => 'Calcium', 'dosage' => '500', 'start_at' => '2025-06-05', 'end_at' => '2025-07-03', 'patient_id' => 2, 'treatment_type_id' => '3'],
            ['name' => 'Nalcrom ', 'dosage' => '100', 'start_at' => '2025-06-01', 'end_at' => '2025-08-03', 'patient_id' => 2, 'treatment_type_id' => '4'],
        ];

        foreach ($treatments as $data) {
//            $treatment_type = TreatmentType::where('module', $data['treatment_type_id']->value)->first();

            Treatment::factory()->create([
                'name' => $data['name'],
                'dosage' => $data['dosage'],
                'start_at' => $data['start_at'],
                'end_at' => $data['end_at'],
                'patient_id' => $data['patient_id'],
                'treatment_type_id' => $data['treatment_type_id'],
            ]);
        }
    }
}
