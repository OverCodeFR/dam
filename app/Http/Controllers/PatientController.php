<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Patient::class);

        $user = auth()->user();
        $search = $request->query('search');

        $patients = Patient::when($user->role->key !== 'admin', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })->paginate(10);

        return view('patients.index', compact('patients'));
    }

    public function assignate(Request $request)
    {
        Gate::authorize('viewAny_patients', Patient::class);

        $user = auth()->user();
        $search = $request->query('search');

        $patients =Patient::all();

//        $patients = Patient::when($user->role->key !== 'admin', function ($query) use ($user) {
//            $query->where('user_id', $user->id);
//        })
//            ->when($search, function ($query, $search) {
//                $query->where(function ($q) use ($search) {
//                    $q->where('name', 'like', '%' . $search . '%')
//                        ->orWhere('phone', 'like', '%' . $search . '%')
//                        ->orWhere('address', 'like', '%' . $search . '%')
//                        ->orWhere('email', 'like', '%' . $search . '%');
//                });
//            })->paginate(10);

        return view('patients.assignate', compact('patients'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Patient::class);

        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        Gate::authorize('create', Patient::class);

        $patient = new Patient();
        $patient->fill($request->validated());
        $patient->save();

        return redirect()->route('patients.index');
    }

    /**
     *
     */
    public function check(UpdatePatientRequest $request, $id)
    {
       //
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
    public function edit(Patient $patient)
    {
        Gate::authorize('update', $patient);

        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        Gate::authorize('update', $patient);

        $patient->update($request->validated());
        return redirect()->route('patients.index');
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
