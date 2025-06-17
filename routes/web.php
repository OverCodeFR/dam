<?php

use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use \App\Http\Controllers\PatientController;
use \App\Http\Controllers\TreatmentController;
use App\Http\Controllers\TreatmentTypeController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    //Patients
    Route::resource('patients', PatientController::class)->except('show');

    //PatientUser
    Route::resource('patients_users', \App\Http\Controllers\PatientUserController::class);

    //Treatments Types
    Route::resource('treatments_types', TreatmentTypeController::class);

    //Treatments
    Route::resource('treatments', TreatmentController::class)->except('index', 'show');
    Route::get('/treatments/{patient?}', [TreatmentController::class, 'index'])->name('treatments.index');

    //Stocks
    Route::resource('stocks', StockController::class);

    //Settings
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
