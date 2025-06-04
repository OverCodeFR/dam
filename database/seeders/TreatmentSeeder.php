<?php

namespace Database\Seeders;

use App\Models\Treatment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Treatment::factory()->create([
            'name ' => 'Sabril comprimé',
            'dosage' => '500',
            'start_at' => '2025-06-03',
            'end_at' => '2025-06-13',
            'patient_id' => 1,
        ]);

        Treatment::factory()->create([
            'name ' => 'Palafar caspusle',
            'dosage' => '300',
            'start_at' => '2025-06-04',
            'end_at' => '2025-06-22',
            'patient_id' => 1,
        ]);

        Treatment::factory()->create([
            'name ' => 'Calcium comprimé',
            'dosage' => '500',
            'start_at' => '2025-06-05',
            'end_at' => '2025-07-03',
            'patient_id' => 2,
        ]);

        Treatment::factory()->create([
            'name ' => 'Nalcrom caspusle',
            'dosage' => '100',
            'start_at' => '2025-06-01',
            'end_at' => '2025-08-03',
            'patient_id' => 2,
        ]);

        Treatment::factory()->create([
            'name ' => 'Gabapentin caspusle',
            'dosage' => '100',
            'start_at' => '2025-05-26',
            'end_at' => '2025-06-07',
            'patient_id' => 3,
        ]);

        Treatment::factory()->create([
            'name ' => 'Qinlock comprimé',
            'dosage' => '50',
            'start_at' => '2025-06-02',
            'end_at' => '2025-09-03',
            'patient_id' => 3,
        ]);
    }
}
