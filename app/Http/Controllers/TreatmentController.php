<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use App\Models\Treatment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
            $treatments->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('dosage', 'like', '%' . $search . '%')
                    ->orWhere('start_at', 'like', '%' . $search . '%')
                    ->orWhere('end_at', 'like', '%' . $search . '%');
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
        return view('treatments.create',['treatmentTypes' => $treatmentTypes],compact('patient'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTreatmentRequest $request)
    {
//        $treatmentData = Arr::only($request->validated(), [
//            'name', 'dosage', 'start_at', 'end_at', 'patient_id']);
//        $treatment = Treatment::create($treatmentData);

        $moment_day_keys = ['MATIN', 'MIDI', 'APRES_MIDI', 'SOIR', 'NUIT'];

        $moment_day_result = [];

        foreach ($moment_day_keys as $moment_day_key) {
            if ($request->has($moment_day_key)) {
                $moment_day_result[] = $moment_day_key;
            }
        }

        $result = implode('_', $moment_day_result);
        return $result;


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

