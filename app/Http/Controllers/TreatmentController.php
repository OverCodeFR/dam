<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreTreatmentRequest;
use App\Models\Treatment;
use App\Models\Patient;
use Illuminate\Http\Request;


class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Patient $patient = null)
    {
        $search = $request->query('search');

        $treatments = Treatment::when($patient, function ($query) use ($patient) {
            return $query->where('patient_id', $patient->id);
        })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('dosage', 'like', '%' . $search . '%')
                        ->orWhere('start_at', 'like', '%' . $search . '%')
                        ->orWhere('end_at', 'like', '%' . $search . '%');
                });
            })->paginate(10);

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

        return redirect()->route('patients.index');
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

