<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use \App\Http\Controllers\PatientController;

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
    Route::get('/patients/{id}/treatments', [\App\Http\Controllers\TreatmentController::class, 'index'])->name('patients.treatments');

    //Settings
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
