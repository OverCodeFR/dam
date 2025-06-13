<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientUserRequest;
use App\Models\Patient;
use App\Models\PatientUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

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
        Gate::authorize('create', PatientUser::class);

        $user = auth()->user();

        if ($user->role->key === 'admin') {
            $patients = Patient::whereNull('user_id')->get();
            $healthcare = User::where('role_id', 2)->get();
            $helper = User::where('role_id', 3)->get();
        } elseif ($user->role->key === 'healthcare') {
            $patients = PatientUser::with('patient')
                ->where('user_id', $user->id)
                ->get();
            $healthcare = null;
            $helper = User::where('role_id', 3)->get();
        } else {
            abort(403);
        }


        return view('patient_user.index', compact('patients', 'healthcare', 'helper'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientUserRequest $request)
    {
        Gate::authorize('create', PatientUser::class);

        $patient_id = $request->get('patient_id');
        $healthcare_id = $request->get('healthcare_id');
        $helper_id = $request->get('helper_id');

        $existing = PatientUser::where('patient_id', $patient_id)
            ->where(function ($query) use ($healthcare_id, $helper_id) {
                $query->where('user_id', $healthcare_id)
                    ->orWhere('user_id', $helper_id);
            })
            ->exists();

        if ($existing) {
            return redirect()->back()->with('error', 'Patient already assigned to one of the selected users');
        }

        if ($healthcare_id) {
            PatientUser::create([
                'patient_id' => $patient_id,
                'user_id' => $healthcare_id,
            ]);
        }

        if ($helper_id) {
            PatientUser::create([
                'patient_id' => $patient_id,
                'user_id' => $helper_id,
            ]);
        }

        return redirect()->back()->with('success', 'Patient assigned successfully.');
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
