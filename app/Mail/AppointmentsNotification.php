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
use App\Enums\AppointmentStatus;

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
        $mail; 

        $mail = $this->from('kontaktecovita@gmail.com');

        if($this->appointment->status == AppointmentStatus::Booked) {
            
            $mail = $mail->markdown('appointments.notifications.enroll',[
                'appointment' => $this->appointment
                ]);

        }elseif ($this->appointment->status == AppointmentStatus::Available) {

            $mail = $mail->markdown('appointments.notifications.cancel',[
                'appointment' => $this->appointment
                ]);
        }
                

        return $mail;
    }
}