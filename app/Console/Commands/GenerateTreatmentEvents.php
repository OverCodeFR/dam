<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\TreatmentFrequency;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class GenerateTreatmentEvents extends Command
{
    protected $signature = 'events:generate-future {days=7}';
    protected $description = 'Génère les événements à venir à partir des fréquences';

    public function handle()
    {
        $days = (int) $this->argument('days');
        $startDate = now()->startOfDay();
        $endDate = now()->addDays($days)->endOfDay();

        $frequencies = TreatmentFrequency::with(['treatment.patient', 'moment_day', 'frequency'])->get();
        $created = 0;

        foreach ($frequencies as $freq) {
            if (!$freq->preferred_hour) {
                $this->warn("⏰ Heure préférée manquante pour la fréquence ID {$freq->id}");
                continue;
            }

            $treatment = $freq->treatment;
            $patient = $treatment?->patient;
            $frequencyName = $freq->frequency->name ?? null;

            if (!$freq->frequency) {
                $this->warn("❌ Fréquence introuvable pour fréquence ID {$freq->id} (frequency_id = {$freq->frequency_id})");
                continue;
            }

            if (!$patient || !$treatment || !$frequencyName || !$treatment->end_at) {
                $this->warn("⛔ Données manquantes pour le traitement ID {$freq->treatment_id}");
                continue;
            }

            if (in_array($frequencyName, ['à la demande', 'ponctuel'])) {
                $this->info("ℹ️ Fréquence spéciale ignorée (\"$frequencyName\") pour traitement ID {$treatment->id}");
                continue;
            }

            // Extractions depuis le nom de la fréquence
            if (preg_match('/^(\d+)\/(\d+)?(jour|jours|semaine|mois|h)$/', $frequencyName, $matches)) {
                $count = (int) $matches[1];
                $interval = isset($matches[2]) ? (int) $matches[2] : 1;
                $unit = $matches[3];

                $timeObj = Carbon::parse($freq->preferred_hour);
                $treatmentEnd = Carbon::parse($treatment->end_at);

                for ($day = $startDate->copy(); $day->lte($endDate); $day->addDay()) {
                    if ($day->gt($treatmentEnd)) {
                        break;
                    }

                    // 💊 Cas : x/jour
                    if ($unit === 'jour' || $unit === 'jours') {
                        // Ex: 1/2jours → tous les 2 jours
                        if ($interval > 1 && $day->diffInDays($startDate) % $interval !== 0) {
                            continue;
                        }

                        for ($i = 0; $i < $count; $i++) {
                            $start = $day->copy()->setTime($timeObj->hour + $i, $timeObj->minute);
                            $end = $start->copy()->addMinutes(10);

                            $exists = Event::where('treatment_id', $treatment->id)
                                ->where('patient_id', $patient->id)
                                ->where('start_time', $start)
                                ->exists();

                            if (!$exists) {
                                Event::create([
                                    'title' => $treatment->name,
                                    'start_time' => $start,
                                    'end_time' => $end,
                                    'description' => "Fréquence : $frequencyName",
                                    'treatment_id' => $treatment->id,
                                    'patient_id' => $patient->id,
                                ]);
                                $created++;
                            }
                        }
                    }

                    // 💊 Cas : semaine
                    elseif ($unit === 'semaine') {
                        // Répartir les prises sur les 7 jours
                        $dayOfWeek = $day->dayOfWeekIso; // 1 à 7
                        if ($dayOfWeek <= $count) {
                            $start = $day->copy()->setTime($timeObj->hour, $timeObj->minute);
                            $end = $start->copy()->addMinutes(10);

                            $exists = Event::where('treatment_id', $treatment->id)
                                ->where('patient_id', $patient->id)
                                ->where('start_time', $start)
                                ->exists();

                            if (!$exists) {
                                Event::create([
                                    'title' => $treatment->name,
                                    'start_time' => $start,
                                    'end_time' => $end,
                                    'description' => "Fréquence : $frequencyName",
                                    'treatment_id' => $treatment->id,
                                    'patient_id' => $patient->id,
                                ]);
                                $created++;
                            }
                        }
                    }

                    // 💊 Cas : mois
                    elseif ($unit === 'mois') {
                        if ($day->day <= $count) {
                            $start = $day->copy()->setTime($timeObj->hour, $timeObj->minute);
                            $end = $start->copy()->addMinutes(10);

                            $exists = Event::where('treatment_id', $treatment->id)
                                ->where('patient_id', $patient->id)
                                ->where('start_time', $start)
                                ->exists();

                            if (!$exists) {
                                Event::create([
                                    'title' => $treatment->name,
                                    'start_time' => $start,
                                    'end_time' => $end,
                                    'description' => "Fréquence : $frequencyName",
                                    'treatment_id' => $treatment->id,
                                    'patient_id' => $patient->id,
                                ]);
                                $created++;
                            }
                        }
                    }

                    // 💊 Cas : toutes les X heures
                    elseif ($unit === 'h') {
                        for ($hour = 0; $hour < 24; $hour += $interval) {
                            $start = $day->copy()->setTime($hour, 0);
                            $end = $start->copy()->addMinutes(10);

                            $exists = Event::where('treatment_id', $treatment->id)
                                ->where('patient_id', $patient->id)
                                ->where('start_time', $start)
                                ->exists();

                            if (!$exists) {
                                Event::create([
                                    'title' => $treatment->name,
                                    'start_time' => $start,
                                    'end_time' => $end,
                                    'description' => "Fréquence : $frequencyName",
                                    'treatment_id' => $treatment->id,
                                    'patient_id' => $patient->id,
                                ]);
                                $created++;
                            }
                        }
                    }
                }
            } else {
                $this->warn("❗ Fréquence non reconnue : $frequencyName");
            }
        }

        $this->info("✅ $created événements créés avec succès.");
    }
}
