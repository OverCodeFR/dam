<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Patient;
use App\Models\TreatmentFrequency;
use App\Models\TreatmentIntake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $patient = Patient::findOrFail ($request->input('patient'));

        $now = now();

        $events = Event::where('patient_id', $patient->id)
            ->where('isDone', false)
            ->get()
            ->map(function ($event) {
                return [
                    'title' => 'À prendre : ' . $event->title,
                    'start' => $event->start_time->toIso8601String(),
                    'end' => $event->end_time?->toIso8601String(),
                    'description' => $event->description,
                    'color' => '#28a745',
                ];
            });

        $intakes = TreatmentIntake::with('treatment')
            ->where('patient_id', $patient->id)
            ->where('taken_at', '<', $now)
            ->get()
            ->map(function ($intake) {
                $takenAt = \Carbon\Carbon::parse($intake->taken_at);
                return [
                    'title' => 'Pris : ' . $intake->treatment->name,
                    'start' => $takenAt->toIso8601String(),
                    'end' => $takenAt->copy()->addMinutes(10)->toIso8601String(),
                    'description' => 'Quantité : ' . $intake->amount,
                    'color' => '#dc3545',
                ];
            });

        return response()->json($events->merge($intakes));
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
