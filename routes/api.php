<?php

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});

Route::get('/patients', function () {return Patient::all();});



//Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
////    return \App\Models\Patient::();
//    return Auth::guard('patient');
//});

Route::middleware(['auth:sanctum'])->get('/patients/{id}/token', function ($id) {
    $patient = Patient::find($id);

    if (!$patient) {
        return response()->json(['message' => 'Patient not found'], 404);
    }

    $patient->tokens()->where('name', 'access_token')->delete();
    $token = $patient->createToken('access_token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'patient' => $patient,
    ]);
});


//
//Route::middleware('auth:sanctum')->get('/me', function () {
//    return Auth::guard('patient')->user();
//});

//Route::apiResource('users', UserController::class);


