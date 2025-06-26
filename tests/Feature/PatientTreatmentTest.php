<?php

use App\Models\Patient;
use App\Models\Stock;
use App\Models\Treatment;
use App\Models\TreatmentType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $rolePatient = \App\Models\Role::factory()->create(['key' => 'patient']);
    $roleOther   = \App\Models\Role::factory()->create(['key' => 'patient']);
    test()->user = \App\Models\User::factory()->create([
        'role_id' => $rolePatient->id,]);
    test()->otherUser = \App\Models\User::factory()->create([
        'role_id' => $roleOther->id,]);
    test()->patient = \App\Models\Patient::factory()->create([
        'user_id' => test()->user->id,]);
    test()->treatmentType = \App\Models\TreatmentType::factory()->create();
    test()->treatment = \App\Models\Treatment::factory()->create([
        'patient_id' => test()->patient->id,
        'treatment_type_id' => test()->treatmentType->id,
        'name' => 'Traitement A',]);
    test()->stock = \App\Models\Stock::factory()->create([
        'treatment_id' => test()->treatment->id,
        'amount' => 10,]);
});


test('user not authenticated cannot access treatment index', function () {
    $this->get(route('treatments.index'))->assertRedirect(route('login'));
});

test('user not authenticated cannot access treatment creation page', function () {
    $this->get(route('treatments.create'))->assertRedirect(route('login'));
});

test('user not authenticated cannot access treatment edit page', function () {
    $this->get(route('treatments.edit', test()->treatment->id))->assertRedirect(route('login'));
});


test('user can access treatments index', function () {
    $this->actingAs(test()->user)
        ->get(route('treatments.index'))
        ->assertOk()
        ->assertSee('Traitement');
});

test('user can access create treatment view', function () {
    $this->actingAs(test()->user)
        ->get(route('treatments.create'))
        ->assertOk()
        ->assertSee('Entrez les données du traitement.');
});

test('user can access edit view for their own treatment', function () {
    $this->actingAs(test()->user)
        ->get(route('treatments.edit', test()->treatment->id))
        ->assertOk()
        ->assertSee(test()->treatment->name);
});

test('accessing edit page invalid treatment id returns', function () {
    $this->actingAs(test()->user)
        ->get(route('treatments.edit', 1234))
        ->assertNotFound(404);
});


test('accessing index invalid patient id', function () {
    $this->actingAs(test()->user)
        ->get(route('treatments.index', ['patient' => 1234]))
        ->assertStatus(404);
});

test('user cannot edit stock from a treatment they do not own', function () {
    $otherPatient = Patient::factory()->create(['user_id' => test()->otherUser->id]);
    $otherTreatment = Treatment::factory()->create([
        'patient_id' => $otherPatient->id,
        'treatment_type_id' => test()->treatmentType->id,
    ]);
    $otherStock = Stock::factory()->create([
        'treatment_id' => $otherTreatment->id,
        'amount' => 20,
    ]);

    $this->actingAs(test()->user)
        ->get(route('stocks.edit', $otherStock->id))
        ->assertStatus(403);
});

test('non authenticated cannot access stock index', function () {
    $this->get(route('stocks.index'))->assertRedirect(route('login'));
});

test('non authenticated cannot access stock creation page', function () {
    $this->get(route('stocks.create'))->assertRedirect(route('login'));
});

test('non authenticated cannot access stock edit page', function () {
    $this->get(route('stocks.edit', test()->stock->id))->assertRedirect(route('login'));
});


test('authenticated user can access stock edit page for their own treatment', function () {
    $this->actingAs(test()->user)
        ->get(route('stocks.edit', test()->stock->id))
        ->assertOk()
        ->assertSee((string) test()->stock->amount);
});

test('user cannot access stock edit page from another users treatment', function () {
    $otherPatient = Patient::factory()->create();
    $otherTreatment = Treatment::factory()->create([
        'patient_id' => $otherPatient->id,
        'treatment_type_id' => test()->treatmentType->id,
    ]);
    $otherStock = Stock::factory()->create([
        'treatment_id' => $otherTreatment->id,
        'amount' => 99,
    ]);

    $this->actingAs(test()->user)
        ->get(route('stocks.edit', $otherStock->id))
        ->assertStatus(403);
});

test('edit page invalid stock id', function () {
    $this->actingAs(test()->user)
        ->get(route('stocks.edit', 1234))
        ->assertNotFound(404);
});


