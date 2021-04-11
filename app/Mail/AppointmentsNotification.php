<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Speciality;
use App\Doctor;
use App\User;

class AppointmentsNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $appointment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('kontaktecovita@gmail.com')
                    ->markdown('appointments.notifications.enroll',[
                    'appointment' => $this->appointment
                    ]);
    }
}