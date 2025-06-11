<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stocks = [
            ['amount' => 20, 'treatment_id' => 1],
            ['amount' => 25, 'treatment_id' => 2],
            ['amount' => 17, 'treatment_id' => 3],
            ['amount' => 31, 'treatment_id' => 4],
            ['amount' => 9, 'treatment_id' => 5],
            ];

        foreach ($stocks as $data) {
            Stock::factory()->create([
                'amount' => $data['amount'],
                'treatment_id' => $data['treatment_id'],
            ]);
        }

    }
}
