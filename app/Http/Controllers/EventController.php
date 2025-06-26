<?php

namespace App\Http\Controllers;

use App\Models\Frequency;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\TreatmentFrequency;
use App\Models\TreatmentIntake;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('event.index', compact('patients'));
    }

    public function fetch(Request $request)
    {
        $patient = Patient::findOrFail($request->input('patient'));
        $now = now();

        $treatments = Treatment::where('patient_id', $patient->id)
            ->whereDate('start_at', '<=', $now)
            ->whereDate('end_at', '>=', $now)
            ->get();

        $events = collect();

        $intakes = TreatmentIntake::where('patient_id', $patient->id)->get();

        foreach ($treatments as $treatment) {
            $frequencies = TreatmentFrequency::where('treatment_id', $treatment->id)->get();

            foreach ($frequencies as $frequency) {
                $frequencyModel = Frequency::find($frequency->frequency_id);

                if (!$frequencyModel) continue;

                $dates = $this->generateDates(
                    $treatment->start_at,
                    $treatment->end_at,
                    $frequencyModel->name
                );

                foreach ($dates as $date) {
                    $hour = trim($frequency->preferred_hour);
                    if (preg_match('/\d{2}:\d{2}(:\d{2})?/', $hour, $matches)) {
                        $hour = $matches[0];
                    } else {
                        $hour = '08:00:00';
                    }

                    $start = Carbon::parse($date . ' ' . $hour);
                    $end = $start->copy()->addMinutes(90);

                    $matchingIntake = $intakes->first(function ($intake) use ($start, $end, $treatment) {
                        return
                            $intake->treatment_id === $treatment->id &&
                            Carbon::parse($intake->taken_at)->between($start, $end);
                    });

                    if ($start->isPast()) {
                        if ($matchingIntake) {
                            continue;
                        } else {
                            $events->push([
                                'title' => 'Oublié : ' . $treatment->name,
                                'start' => $start->toIso8601String(),
                                'end' => $end->toIso8601String(),
                                'description' => 'Dosage : ' . $treatment->dosage . ' ' . $treatment->unit,
                                'color' => '#dc3545',
                            ]);
                        }
                    } else {
                        $events->push([
                            'title' => 'À prendre : ' . $treatment->name,
                            'start' => $start->toIso8601String(),
                            'end' => $end->toIso8601String(),
                            'description' => 'Dosage : ' . $treatment->dosage . ' ' . $treatment->unit,
                            'color' => '#00cdff',
                        ]);
                    }
                }
            }
        }

        $takenEvents = $intakes->map(function ($intake) {
            $takenAt = Carbon::parse($intake->taken_at);
            return [
                'title' => 'Pris : ' . $intake->treatment->name,
                'start' => $takenAt->toIso8601String(),
                'end' => $takenAt->copy()->addMinutes(75)->toIso8601String(),
                'description' => 'Quantité : ' . $intake->amount,
                'color' => '#28a745',
            ];
        });

        return response()->json($events->merge($takenEvents));
    }

    private function generateDates($startDate, $endDate, $frequency)
    {
        $start = Carbon::parse($startDate)->startOfDay();
        $end = $endDate ? Carbon::parse($endDate)->endOfDay() : now()->addMonths(1)->endOfDay();

        $dates = [];

        while ($start <= $end) {
            $dates[] = $start->toDateString();

            switch (strtolower(trim($frequency))) {
                case 'quotidien':
                case 'daily':
                    $start->addDay();
                    break;
                case 'hebdomadaire':
                case 'weekly':
                    $start->addWeek();
                    break;
                case 'mensuel':
                case 'monthly':
                    $start->addMonth();
                    break;
                default:
                    $start->addDay();
                    break;
            }
        }

        return $dates;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'start' => 'required|date',
            'end' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        return Event::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
