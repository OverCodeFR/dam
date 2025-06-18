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

Route::middleware(['auth:sanctum'])->get('/patients/{id_patient}/treatments', function (Request $request, $id_patient) {
    $bearerToken = $request->bearerToken();
    $hashedToken = hash('sha256', $bearerToken);

    $token = PersonalAccessToken::where('tokenable_type', 'App\Models\Patient')
        ->where('tokenable_id', $id_patient)
        ->where('token', $hashedToken)
        ->first();

    if (!$token) {
        return response()->json(['message' => 'Token not affected of this patient'], 404);
    }

    $patient = Patient::with([
        'treatments.treatment_type',
        'treatments.treatment_frequencies.frequency',
        'treatments.stocks'
    ])->find($id_patient);

    if (!$patient) {
        return response()->json(['message' => 'Patient not found'], 404);
    }

    $treatment = $patient->treatments->all();

    if (!$treatment) {
        return response()->json(['message' => 'Treatment not found for this patient'], 404);
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

Route::middleware(['auth:sanctum'])->get('/patients/{id_patient}/treatments/{id_treatment}', function (Request $request, $id_patient, $id_treatment) {
    $bearerToken = $request->bearerToken();
    $hashedToken = hash('sha256', $bearerToken);

    $token = PersonalAccessToken::where('tokenable_type', 'App\Models\Patient')
        ->where('tokenable_id', $id_patient)
        ->where('token', $hashedToken)
        ->first();

    if (!$token) {
        return response()->json(['message' => 'Token not affected of this patient'], 404);
    }

    $patient = Patient::with([
        'treatments' => function ($query) use ($id_treatment) {
            $query->where('id', $id_treatment);
        },
        'treatments.treatment_type',
        'treatments.treatment_frequencies.frequency',
        'treatments.stocks'
    ])->find($id_patient);

    if (!$patient) {
        return response()->json(['message' => 'Patient not found'], 404);
    }

    $treatment = $patient->treatments->first();

    if (!$treatment) {
        return response()->json(['message' => 'Treatment not found for this patient'], 404);
    }

    $treatment->makeHidden(['patient_id', 'treatment_type_id']);

    $treatment->treatment_frequencies->each(function ($frequency) {
        $frequency->makeHidden(['frequency_id', 'treatment_id']);
    });

    $treatment->stocks->each(function ($stock) {
        $stock->makeHidden(['treatment_id']);
    });

    return response()->json([
        'treatment' => $treatment,
    ]);
});





