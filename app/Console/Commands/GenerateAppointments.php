<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\DoctorSpeciality;
use App\Queries\DoctorSpecialities;
use Carbon\Carbon;
use App\Enums\AppointmentStatus;
use App\Appointment;

class GenerateAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:generate {--days=14}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates appointments based on office hours';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $numberOfDays = $this->option('days');
        echo $numberOfDays;
    
        $today = Carbon::today();
        $doctorSpecialities = DoctorSpeciality::all();
        foreach ($doctorSpecialities as $doctorSpeciality) {
          $schedule = json_decode($doctorSpeciality->schedule, true);
          for ($i = 0; $i < $numberOfDays; $i++) {
            $day = $today->copy()->add('day', $i);
            $weekDay = $day->weekday();

            if (!is_array($schedule) || !array_key_exists('start', $schedule[$weekDay]) || !array_key_exists('stop', $schedule[$weekDay])) {
              continue;
            }

            $appointmentDuration = 10; //$doctorSpeciality->visit_length
            // 1975-12-25 22:43
            $start = Carbon::parse($day->toDateString() . " " . $schedule[$weekDay]['start']);
            $stop = Carbon::parse($day->toDateString() . " " . $schedule[$weekDay]['stop']);

            while ($start->lessThan($stop->copy()->add('minute', $appointmentDuration))) {
              // Create appointment
              $appointment = new Appointment;
              $appointment->doctor_speciality_id = $doctorSpeciality->id;
              $appointment->begin_date = $start;
              $appointment->status = AppointmentStatus::Available;
              $appointment->save();
              $start->add('minute', $appointmentDuration);
            }
            echo "\n";
          }
        }
        
        return 0;
    }
}