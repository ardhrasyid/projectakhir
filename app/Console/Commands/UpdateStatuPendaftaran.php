<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ekstrakurikuler; // Model Ekstrakurikuler
use Carbon\Carbon;

class UpdateStatuPendaftaran extends Command
{

    // Menentukan nama signature command
    protected $signature = 'app:update-statu-pendaftaran';

    // Deskripsi command
    protected $description = 'Update registration status if the current date is past the registration close date';

    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    // Fungsi handle yang berisi logika bisnis
    public function handle()
    {
        $now = Carbon::now();
        $ekstrakurikulers = Ekstrakurikuler::where('tgl_ditutup', '<', $now)
            ->where('status_pendaftaran', '=', 1)
            ->get();

        foreach ($ekstrakurikulers as $ekstrakurikuler) {
            $ekstrakurikuler->status_pendaftaran = 0;
            $ekstrakurikuler->save();
        }

        $this->info('Registration statuses updated successfully.');
    }
}

