<?php

namespace App\Http\Controllers;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index',compact(['patients']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $item = new Item();
        $item->text = $request->validated('text');
        $item->save();
        return redirect()->route('dashboard');
    }

    /**
     *
     */
    public function check(UpdatePatientRequest $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->done = $request->has('done');
        $item->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Patient::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
