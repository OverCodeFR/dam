<?php

use App\Http\Controllers\Api\TreatmentController;
use App\Http\Controllers\EventController;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});

Route::get('/patients', function () {return Patient::all();});

Route::get('/token/generate', function () {$token = User::find(4)->createToken('api_token')->plainTextToken;
    Log::info($token);});

Route::middleware('auth:patient')->group(function () {
    Route::get('/patients/treatments', [TreatmentController::class, 'getTreatments']);

    Route::get('/patients/treatments/{id}', [TreatmentController::class, 'getTreatment']);

    Route::post('/patients/treatments/{id}/taken/{amount}', [TreatmentController::class, 'postValidTreatment']);
});
