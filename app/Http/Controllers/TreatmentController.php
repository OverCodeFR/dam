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
    public function index(Request $request)
    {
        $search = $request->query('search');

        $treatments = Treatment::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('dosage', 'like', '%' . $search . '%')
                    ->orWhere('start_at', 'like', '%' . $search . '%')
                    ->orWhere('end_at', 'like', '%' . $search . '%');
            });
        })->paginate(10);

        return view('treatments.index', compact('treatments'));
    }

    public function treatment(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $search = $request->query('search');

        $searchConverted = $this->convertDateFrToEn($search);

        $treatments = Treatment::where('patient_id', $patient->id)
            ->when($search, function ($query, $search) use ($searchConverted) {
                $query->where(function ($q) use ($search, $searchConverted) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('dosage', 'like', '%' . $search . '%')
                        ->orWhere('start_at', 'like', '%' . $searchConverted . '%')
                        ->orWhere('end_at', 'like', '%' . $searchConverted . '%');
                });
            })
            ->paginate(10);

        return view('treatments.index', compact('patient', 'treatments'));
    }

    private function convertDateFrToEn($input) //IA
    {
        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $input, $matches)) {
            return $matches[3] . '-' . $matches[2] . '-' . $matches[1]; // yyyy-mm-dd
        }

        return $input;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $patient = Patient::findOrFail($id);

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

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}

