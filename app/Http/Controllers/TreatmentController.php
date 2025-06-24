<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use App\Models\Frequency;
use App\Models\MomentDay;
use App\Models\PatientUser;
use App\Models\Stock;
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

        $treatments = Treatment::with(['stock', 'patient', 'treatment_type'])
            ->withSum('stock', 'amount');

        if ($user->role->key === 'patient') {
            $patientModel = Patient::where('user_id', $user->id)->first();
            if ($patientModel) {
                $treatments->where('patient_id', $patientModel->id);
            } else {
                $treatments->whereRaw('1 = 0');
            }

        } elseif ($user->role->key === 'admin') {
            if (!is_null($patient)) {
                $treatments->where('patient_id', $patient->id);
            }
        } else {
            if (!\Illuminate\Support\Facades\Request::is('treatments/*')) {
                $patients_id = PatientUser::where('user_id', $user->id)
                    ->pluck('patient_id');
                Patient::whereIn('id', $patients_id);

            } else {
                if ($patient) {
                    $treatments->where('patient_id', $patient->id);
                }
            }
        }

        if ($search) {

            $patients = Patient::where('name', 'like', '%' . $search . '%')->pluck('id');
            $treatment_types = TreatmentType::where('name', 'like', '%' . $search . '%')->pluck('id');

            $treatments->where(function ($q) use ($search, $patients, $treatment_types) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('dosage', 'like', '%' . $search . '%')
                    ->orWhere('unit', 'like', '%' . $search . '%')
                    ->orWhere('start_at', 'like', '%' . $search . '%')
                    ->orWhere('end_at', 'like', '%' . $search . '%');

                if ($patients->isNotEmpty()) {
                    $q->orWhereIn('patient_id', $patients);
                }
                if ($treatment_types->isNotEmpty()) {
                    $q->orWhereIn('treatment_type_id', $treatment_types);
                }
            });
        }

        $treatments = $treatments->orderBy('stock_sum_amount', 'asc')->paginate(10);

        return view('treatments.index', compact('treatments', 'patient'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Patient $patient)
    {
        $treatmentTypes = TreatmentType::all();
        $frequencies = Frequency::all();

        return view('treatments.create', compact('treatmentTypes', 'frequencies', 'patient'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTreatmentRequest $request)
    {
        $treatmentData = Arr::only($request->validated(), [
            'name','dosage','unit', 'start_at', 'end_at', 'patient_id', 'treatment_type_id'
        ]);
        $treatment = Treatment::create($treatmentData);
        Stock::create(['amount' => 0, 'treatment_id' => $treatment->id]);

        $moment_day_keys = ['MATIN' => 'Matin',
            'MIDI' => 'Midi', 'APRES_MIDI' => 'Après-midi',
            'SOIR' => 'Soir', 'NUIT' => 'Nuit'];

        foreach ($moment_day_keys as $key => $value) {
            if ($request->has($key)) {
                $amount = "amount_" . $key;
                $preferred_hour = "preferredHour_" . $key;

                $amount = $request->input($amount);
                $preferred_hour = $request->input($preferred_hour);
                $moment_day = MomentDay::where('moment', $key)->first();
                $frequency_id = $request->input('frequency_id');

                TreatmentFrequency::create([
                    'amount' => $amount,
                    'preferred_hour' => $preferred_hour,
                    'moment_day_id' => $moment_day->id,
                    'frequency_id' => $frequency_id,
                    'treatment_id' => $treatment->id,
                ]);
            }
        }

        return auth()->user()->role->key !== 'patient'
            ? redirect()->route('patients.index')
            : redirect()->route('treatments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
        $treatmentTypes = TreatmentType::all();
        $frequencies = Frequency::all();

        return view('treatments.edit', compact('treatment', 'treatmentTypes', 'frequencies'));
    }


    public function update(UpdateTreatmentRequest $request, Treatment $treatment)
    {
        // 1. Mise à jour du traitement
        $treatment->update(Arr::only($request->validated(), [
            'name', 'dosage','unit', 'start_at', 'end_at', 'patient_id', 'treatment_type_id'
        ]));

        // 2. Suppression des fréquences actuelles (pour repartir de zéro)
        $treatment->treatment_frequencies()->delete();

        // 3. Ajout des nouvelles fréquences
        $moment_day_keys = ['MATIN', 'MIDI', 'APRES_MIDI', 'SOIR', 'NUIT'];

        foreach ($moment_day_keys as $moment_day_key) {
            if ($request->has($moment_day_key)) {
                $frequency = "listbox_" . $moment_day_key;
                $amount = "inputbox_" . $moment_day_key;

                if ($request->filled($frequency) and $request->filled($amount) ) {
                    $frequencyId = $request->input($frequency);
                    $amount = $request->input($amount);

                    TreatmentFrequency::create([
                        'treatment_id' => $treatment->id,
                        'frequency_id' => $frequencyId,
                        'amount' => $amount,
                    ]);
                }
            }
        }

        return redirect()->route('treatments.index');
    }

}

