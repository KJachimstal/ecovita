<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentsNotification;

class AppointmentNotificationsController extends Controller
{
    public function appointmentEnroll (Request $request) {
        Mail::to($request->appointment->user->email)
                ->send(new AppointmentNotifiacation());

        return back();
    }
}
 