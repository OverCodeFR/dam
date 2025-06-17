<?php

use App\Models\Patient;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
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

Route::middleware(['auth:sanctum'])->get('/patients/{id}/treatments', function (Request $request, $id) {
    $bearerToken = $request->bearerToken();
    $hashedToken = hash('sha256', $bearerToken);

    $token = PersonalAccessToken::where('tokenable_type', 'App\Models\Patient')
        ->where('tokenable_id', $id)
        ->where('token', $hashedToken)
        ->first();

    if (!$token) {
        return response()->json(['message' => 'Token not affected of this patient'], 404);
    }

    $patient = Patient::with([
        'treatments.treatment_type',
        'treatments.treatment_frequencies.frequency',
        'treatments.stocks'
    ])->find($id);

    if (!$patient) {
        return response()->json(['message' => 'Patient not found'], 404);
    }

    $treatments = $patient->treatments->map(function ($treatment) {
        $treatment->makeHidden(['patient_id','treatment_type_id']);

        $treatment->treatment_frequencies->each(function ($frequency) {
            $frequency->makeHidden(['frequency_id', 'treatment_id']);
        });

        $treatment->stocks->each(function ($stock) {
            $stock->makeHidden(['treatment_id']);
        });

        return $treatment;
    });

    return response()->json([
        'treatments' => $treatments,
    ]);
});







//
//Route::middleware('auth:sanctum')->get('/me', function () {
//    return Auth::guard('patient')->user();
//});

//Route::apiResource('users', UserController::class);


