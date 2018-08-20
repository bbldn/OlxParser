<?php

namespace App\Console;

use App\Console\Commands\ParseCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * @var string[] $commands
     */
    protected $commands = [
        //
    ];

    /**
     * @param  Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
    }

    /**
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        /** @noinspection PhpIncludeInspection */
        require base_path('routes/console.php');
    }
}
