<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TreatmentResource;
use App\Models\Patient;
use App\Models\TreatmentIntake;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function getTreatments(Request $request) {
        $patient = Patient::findOrFail($request->user()->id);

        if ($patient->treatments->isEmpty()) {
            return response()->json(['message' => 'No treatment found for this patient']);
        }

        return TreatmentResource::collection($patient->treatments);
    }

    public function getTreatment(Request $request, $id) {
        $patient = Patient::findOrFail($request->user()->id);

        $treatment = $patient->treatments()->findOrFail($id);

        return new TreatmentResource($treatment);
    }

    public function postValidTreatment(Request $request, $id, $amount) {
        $patient = Patient::findOrFail($request->user()->id);

        $patient->treatments()->findOrFail($id);

        $data = ['taken_at' => \Symfony\Component\Clock\now(), 'amount' => $amount,
            'patient_id' => $patient->id, 'treatment_id' => $id];

        $treatment_intake = new TreatmentIntake();
        $treatment_intake->fill($data);
        $treatment_intake->save();
    }
}
