<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use \App\Http\Controllers\PatientController;
use \App\Http\Controllers\TreatmentController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    //Patients
    Route::resource('patients', PatientController::class);
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');

    //Treatments
    Route::get('/treatments', [TreatmentController::class, 'index'])->name('treatments.index');
    Route::get('/patients/{id}/treatments', [TreatmentController::class, 'treatment'])->name('patients.treatments');
    Route::get('/patients/{id}/treatments/create', [TreatmentController::class, 'create'])->name('patients.treatments.create');
    Route::post('/patients/treatments/store', [TreatmentController::class, 'store'])->name('patients.treatments.store');

    //Settings
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
