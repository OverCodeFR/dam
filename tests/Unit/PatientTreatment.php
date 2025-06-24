<?php

use App\Models\Patient;
use App\Models\Treatment;

it('patient has treatments', function () {
    $patient = Patient::factory()
        ->has(Treatment::factory()->count(1))
        ->create();

    $patient->load('treatments'); // Charge explicitement la relation

    expect($patient->treatments)->toHaveCount(1);
});


it('treatment belongs to a patient', function () {
    $treatment = Treatment::factory()->create();

    expect($treatment->patient)->toBeInstanceOf(Patient::class);
});

it('patient can have zero treatments', function () {
    $patient = Patient::factory()->create();

    expect($patient->treatments)->toBeEmpty();
});

it('can update treatment for patient', function () {
    $patient = Patient::factory()
        ->has(Treatment::factory()->count(1))
        ->create();

    $treatment = $patient->treatments()->first();
    $treatment->update(['is_done' => true]);

    expect($treatment->is_done)->toBeTrue();
});

it('deletes treatments when patient deleted', function () {
    $patient = Patient::factory()
        ->has(Treatment::factory()->count(2))
        ->create();

    $patientId = $patient->id;
    $patient->delete();

    expect(Treatment::where('patient_id', $patientId)->count())->toBe(0);
});









