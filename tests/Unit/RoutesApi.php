<?php

use App\Models\Patient;
use App\Models\Treatment;
use App\Models\User;
use App\Models\TreatmentType;
use Illuminate\Testing\Fluent\AssertableJson;




it('get treatments with token', function () {
    $patient = Patient::factory()->create();

    $token = $patient->createToken('api_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer ' . $token)
        ->getJson('/api/patients/treatments');

    $response->assertStatus(200);
});


it('no access without token', function () {
    $this->getJson('/api/patients/treatments')
        ->assertStatus(401);
});


it('list of treatments', function () {
    $patient = \App\Models\Patient::factory()->create();
    $token = $patient->createToken('api_token')->plainTextToken;
    $type = \App\Models\TreatmentType::factory()->create();

    $patient->treatments()->createMany([
        [
            'name' => 'Traitement 1',
            'dosage' => 100,
            'unit' => 'mg',
            'start_at' => now(),
            'end_at' => now()->addDays(5),
            'treatment_type_id' => $type->id,
            'is_done' => false,
        ],
        [
            'name' => 'Traitement 2',
            'dosage' => 250,
            'unit' => 'ml',
            'start_at' => now(),
            'end_at' => now()->addDays(10),
            'treatment_type_id' => $type->id,
            'is_done' => false,
        ]
    ]);

//    $response = $this->withToken($token)
//        ->getJson('/api/patients/treatments');
//
//    dd($response->json());

    $this->withToken($token)
        ->getJson('/api/patients/treatments')
        ->assertStatus(200)
        ->assertJsonCount(2, 'data');
});


it('validate treatment taken', function () {
    $patient = \App\Models\Patient::factory()->create();
    $token = $patient->createToken('api_token')->plainTextToken;
    $type = \App\Models\TreatmentType::factory()->create();

    $treatment = $patient->treatments()->create([
        'name' => 'Vitamine C',
        'dosage' => 200,
        'unit' => 'mg',
        'start_at' => now(),
        'end_at' => now()->addDays(7),
        'treatment_type_id' => $type->id,
        'is_done' => false,
    ]);

    $amount = 1;
    $this->withToken($token)
        ->postJson("/api/patients/treatments/{$treatment->id}/taken/{$amount}")
        ->assertStatus(200);
});














