<?php

namespace App\Http\Controllers;
use App\Models\Treatment;
use App\Models\Patient;

class TreatmentController extends Controller
{
    public function index($id)
    {
        $patient = Patient::findOrFail($id);
        $treatments = Treatment::where('patient_id', $patient->id)->get();
        return view('treatments.index',compact('patient','treatments'));
    }
}
