<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use \App\Http\Controllers\PatientController;
use \App\Http\Controllers\TreatmentController;
use App\Http\Controllers\TreatmentTypeController;
use App\Http\Controllers\StockController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::view('dashboard', 'dashboard.index')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    //Patients
    Route::resource('patients', PatientController::class);

    //Treatments Types
    Route::resource('treatments_types', TreatmentTypeController::class);

    //Treatments
    Route::resource('treatments', TreatmentController::class)->except('index', 'show');
    Route::get('/treatments/{patient?}', [TreatmentController::class, 'index'])->name('treatments.index');

    //Stocks
    Route::resource('dashboard', \App\Http\Controllers\DashboardController::class);

    //Settings
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
