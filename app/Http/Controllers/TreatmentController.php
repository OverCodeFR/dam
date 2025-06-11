<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use App\Models\Frequency;
use App\Models\Treatment;
use App\Models\Patient;
use App\Models\TreatmentFrequency;
use App\Models\TreatmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Patient $patient = null)
    {
        $search = $request->query('search');
        $user = auth()->user();

        $treatments = \App\Models\Treatment::query();

        if ($user->role->key === 'patient') {
            $patient_id = Patient::where('user_id', $user->id)->first();
            $treatments->where('patient_id', $patient_id->id);

        } elseif ($user->role->key === 'admin') {
            if(is_null($patient)) {
                $treatments = Treatment::query();
            } else {
                $treatments->where('patient_id', $patient->id);
            }
        } else {
            if(!\Illuminate\Support\Facades\Request::is('treatments/*')) {
                $patients_id = Patient::where('user_id', $user->id)->pluck('id');
                $treatments->whereIn('patient_id', $patients_id);
            } else {
                $treatments->where('patient_id', $patient->id);
            }
        }

        if ($search) {

            $patients = Patient::where('name', 'like', '%' . $search . '%')->pluck('id');
            $treatment_types = TreatmentType::where('name', 'like', '%' . $search . '%')->pluck('id');

            $treatments->where(function ($q) use ($search, $patients, $treatment_types) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('dosage', 'like', '%' . $search . '%')
                    ->orWhere('start_at', 'like', '%' . $search . '%')
                    ->orWhere('end_at', 'like', '%' . $search . '%');

                if ($patients->isNotEmpty()) {
                    $q->orWhereIn('patient_id', $patients);}
                if ($treatment_types->isNotEmpty()) {
                    $q->orWhereIn('treatment_type_id', $treatment_types);}
            });
        }

        $treatments = $treatments->paginate(10);

        return view('treatments.index', compact('treatments', 'patient'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Patient $patient)
    {
        $treatmentTypes = \App\Models\TreatmentType::all();

        $frequency_getMatin = \App\Models\Frequency::where('moment_day', 'Matin')->get();
        $frequency_getMidi = \App\Models\Frequency::where('moment_day', 'Midi')->get();
        $frequency_getApres_midi = \App\Models\Frequency::where('moment_day', 'Après-midi')->get();
        $frequency_getSoir = \App\Models\Frequency::where('moment_day', 'Soir')->get();
        $frequency_getNuit = \App\Models\Frequency::where('moment_day', 'Nuit')->get();

        return view('treatments.create',['treatmentTypes' => $treatmentTypes, 'frequency_getMatin' => $frequency_getMatin,
            'frequency_getMidi' => $frequency_getMidi, 'frequency_getApres_midi' => $frequency_getApres_midi,
                'frequency_getSoir' => $frequency_getSoir, 'frequency_getNuit' => $frequency_getNuit]
            ,compact('patient'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTreatmentRequest $request)
    {
        $treatmentData = Arr::only($request->validated(), [
            'name', 'dosage', 'start_at', 'end_at', 'patient_id', 'treatment_type_id']);
        $treatment = Treatment::create($treatmentData);

        $moment_day_keys = ['matin', 'midi', 'après_midi', 'soir', 'nuit'];

        $moment_day_result = [];
        $amount = 0;

        foreach ($moment_day_keys as $moment_day_key) {
            if ($request->has($moment_day_key)) {
                $moment_day_result[] = $moment_day_key;
                $amount++;
            }
        }

        $result_moment_day = implode('/', $moment_day_result);
        $frequency = Frequency::where('moment_day', $result_moment_day)->first();

        $treatmentFrequencyData = ['amount' => $amount, 'frequency_id' => $frequency->id, 'treatment_id' => $treatment->id];
        $treatmentFrequency = TreatmentFrequency::create($treatmentFrequencyData);

        return auth()->user()->role->key !== 'patient'
            ? redirect()->route('patients.index')
            : redirect()->route('treatments.index');
    }

//    /**
//     *
//     */
//    public function check(UpdateItemRequest $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
        $treatmentTypes = \App\Models\TreatmentType::all();
        return view('treatments.edit', ['treatmentTypes' => $treatmentTypes] ,compact('treatment'));
    }


    public function update(UpdateTreatmentRequest $request, Treatment $treatment)
    {
        $treatment->update($request->validated());
        return redirect()->route('treatments.index');
    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy($id)
//    {
//        //
//    }
}

