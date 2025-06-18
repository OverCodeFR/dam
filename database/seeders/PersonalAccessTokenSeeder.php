<?php

namespace Database\Seeders;

use App\Models\PersonalAccessToken;
use Illuminate\Database\Seeder;

class PersonalAccessTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tokens = [
            ['tokenable_type' => 'App\Models\Patient', 'tokenable_id' => 1, 'name' => 'api_token',
                'token' => '56b7630733e04d3b057ec12e23d34f3c82740d7ebb0639c41873462625205dd7',
                'abilities' => '["*"]', 'last_used_at' => now(), 'expires_at' => null,
                'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($tokens as $data) {
            PersonalAccessToken::factory()->create([
                'tokenable_type' => $data['tokenable_type'],
                'tokenable_id' => $data['tokenable_id'],
                'name' => $data['name'],
                'token' => $data['token'],
                'abilities' => $data['abilities'],
                'last_used_at' => $data['last_used_at'],
                'expires_at' => $data['expires_at'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
            ]);
        }
    }
}
