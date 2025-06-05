<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use App\Models\Treatment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            $treatments = Treatment::query();
        } else {
            $patients_id = Patient::where('user_id', $user->id)->pluck('id');
            $treatments->whereIn('patient_id', $patients_id);

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
        return view('treatments.create', compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTreatmentRequest $request)
    {

        $treatment = new Treatment();
        $treatment->fill($request->validated());
        $treatment->save();

        if(auth()->user()->role->key !== 'patient'){
            return redirect()->route('patients.index');
        } else {
            return redirect()->route('treatments.index');
        }
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
        return view('treatments.edit', compact('treatment'));
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

