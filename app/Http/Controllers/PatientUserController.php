<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientUserRequest;
use App\Models\Patient;
use App\Models\PatientUser;
use App\Models\User;
use Illuminate\Http\Request;

class PatientUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = auth()->user();

        if ($user->role->key === 'admin') {
            $patients = PatientUser::with('patient')
                ->whereNull('user_id')
                ->get();
            $health_users = User::where('role_id', 2)->get();
        } elseif ($user->role->key === 'healthcare') {
            $patients = PatientUser::with('patient')
                ->where('user_id', $user->id)
                ->get();
            $health_users = User::where('role_id', 3)->get();
        } else {
            abort(403);
        }


        return view('patients.assignate', compact('patients', 'health_users'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientUserRequest $request)
    {
        if (
            PatientUser::where('patient_id', $request->get('patient_id')) ||
            PatientUser::where('user_id', $request->get('user_id'))
        ) {
            return redirect()->back()->with('error', 'Patient already assigned');
        }

       $patient_user = new PatientUser();
       $patient_user->fill($request->validated());
       $patient_user->save();


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(PatientUser $patientUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientUser $patientUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatientUser $patientUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatientUser $patientUser)
    {
        //
    }
}
