<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointments;
use Carbon\Carbon;

class UpdateMissedAppointments extends Command
{
    protected $signature = 'appointments:update-missed';
    protected $description = 'Update pending appointments to missed if startDate is in the past';

    public function handle()
    {
        //current date in current time zone GMT +5:30
        $now = Carbon::now('Asia/Colombo');

        $appointments = Appointments::where('status', 'pending')->get();
        foreach ($appointments as $appointment) {
            if ($appointment->date < $now) {
                $appointment->status = 'missed';
                $appointment->save();
            }
        }

    }
}
