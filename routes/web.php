<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    //Patients
    Route::resource('patients', \App\Http\Controllers\PatientController::class);
    Route::resource('patients/add', [\App\Http\Controllers\TreatmentController::class, 'add'])->name('patients.add');

    //Treatments
    Route::get('/patients/{id}/treatments', [\App\Http\Controllers\TreatmentController::class, 'index'])->name('patients.treatments');

    //Settings
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
