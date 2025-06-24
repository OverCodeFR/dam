<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Enregistrement des commandes artisan personnalisées.
     */
    protected $commands = [
        \App\Console\Commands\GenerateTreatmentEvents::class,
    ];

    /**
     * Planification des tâches automatiques.
     */
    protected function schedule(Schedule $schedule)
    {
        // Exécuter la commande tous les jours à 00h05
        $schedule->command('events:generate-future 1')->dailyAt('00:05');
    }

    /**
     * Enregistrement des fichiers de commandes artisan.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
