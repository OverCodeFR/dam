<?php

use App\Http\Resources\TreatmentResource;
use App\Models\Patient;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
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
        return response()->json(['message' => 'Token not affected to this patient'], 404);
    }

    $patient = Patient::with([
        'treatments.treatment_type',
        'treatments.treatment_frequencies.frequencies',
        'treatments.stock'
    ])->find($id_patient);

    if (!$patient) {
        return response()->json(['message' => 'Patient not found'], 404);
    }

    if ($patient->treatments->isEmpty()) {
        return response()->json(['message' => 'No treatment found for this patient'], 404);
    }

    return response()->json([
        'treatments' => TreatmentResource::collection($patient->treatments),
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
        return response()->json(['message' => 'Token not affected to this patient'], 403);
    }

    $patient = Patient::find($id_patient);
    if (!$patient) {
        return response()->json(['message' => 'Patient not found'], 404);
    }

    $treatment = $patient->treatments()
        ->where('id', $id_treatment)
        ->with([
            'treatment_type',
            'treatment_frequencies.frequencies',
            'stock',
        ])
        ->first();


    if (!$treatment) {
        return response()->json(['message' => 'Treatment not found for this patient'], 404);
    }

    return response()->json([
        'treatments' => [new TreatmentResource($treatment)],
    ]);
});






