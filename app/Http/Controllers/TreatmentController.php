<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\StoreTreatmentRequest;
use App\Models\Treatment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function index(Request $request, Patient $patient = null)
//    {
//        $search = $request->query('search');
//        $user = auth()->user();
//
//        $treatments = \App\Models\Treatment::query();
//
//        if ($user->role === 'e5d2e8b5-7a40-3ed6-a7e9-00d3f87c385d') {
//                $treatments->where('user_id', $user->id);
//
//        } elseif ($user->role === 'autre-role-id') {
//            if ($patient) {
//                $treatments->where('assigned_doctor_id', $user->id);
//            }
//
//        } else {
//            if ($patient) {
//                $treatments->where('patient_id', $patient->id);
//            }
//        }
//
//        // Requête de recherche
//        if ($search) {
//            $treatments->where(function ($q) use ($search) {
//                $q->where('name', 'like', '%' . $search . '%')
//                    ->orWhere('dosage', 'like', '%' . $search . '%')
//                    ->orWhere('start_at', 'like', '%' . $search . '%')
//                    ->orWhere('end_at', 'like', '%' . $search . '%');
//            });
//        }
//
//        $treatments = $treatments->paginate(10);
//
//        return view('treatments.index', compact('treatments', 'patient'));
//    }


    public function index(Request $request, Patient $patient = null)
    {
        $search = $request->query('search');
        $user = auth()->user();

        if ($user->role === 'e5d2e8b5-7a40-3ed6-a7e9-00d3f87c385d') {
            if ($patient && $patient->user_id !== $user->id) {
                abort(403);
            }

            $treatments = Treatment::whereHas('patient', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        } else {
            $treatments = Treatment::query();
        }

        $treatments = $treatments
            ->when($patient, function ($query) use ($patient) {
                return $query->where('patient_id', $patient->id);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('dosage', 'like', '%' . $search . '%')
                        ->orWhere('start_at', 'like', '%' . $search . '%')
                        ->orWhere('end_at', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10);

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

        if(auth()->user()->role !== 'e5d2e8b5-7a40-3ed6-a7e9-00d3f87c385d'){
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
//
//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(Item $item)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(UpdateItemRequest $request, Item $item)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy($id)
//    {
//        //
//    }
}

