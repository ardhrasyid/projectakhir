<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();




Artisan::command('schedule:run', function () {
    $schedule = app(Schedule::class);
    $schedule->command('app:update-statu-pendaftaran')->daily();
})->describe('Run the command scheduler');