<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Speciality;
use App\Doctor;
use App\Appointment;
use App\User;
use App\Enums\AppointmentStatus;
use App\Helpers\AppointmentHelper;
use App\Queries\Appointments;
use App\Queries\Doctors;

class DoctorsAppointmentsController extends Controller
{
    public function __construct(Request $request) 
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $id = $request->route('doctor');
            $currentUser = Auth::user();

            if (!$currentUser->isDoctor) {
                // LogHelper::log(__('logs.unauthorized_user_appointments'));
                return $this->redirectToUnauthorized();
            }

            $this->doctor = Doctor::find($id);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $id = $request->route('doctor');
        $specialities = Speciality::pluck('name', 'id');
        $doctors = (new Doctors\GetAllWithUsersQuery())->call();
        $appointments = (new Appointments\GetAllByDoctorQuery($request, Auth::user(), true))->call();
        $statuses = AppointmentHelper::getStatusesForSelect();

        return view('appointments.doctor.index', [
            'appointments' => $appointments->paginate(8),
            'specialities' => $specialities,
            'doctors' => $doctors,
            'statuses' => $statuses
        ]);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($doctor_id, $appointment_id)
    {
        $appointment = Appointment::find($appointment_id);
        return view('appointments.doctor.show', ['appointment' => $appointment]);
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }

    public function start($doctor_id, $appointment_id)
    {
        $appointment = Appointment::find($appointment_id);
        if (!$this->isDoctorVisit($appointment)) return $this->redirectToUnauthorized();
        $appointment->status = AppointmentStatus::Pending;
        $appointment->save();

        return redirect()->route('doctor.appointments.show', ['doctor' => $doctor_id, 'appointment' => $appointment_id])->with('success', __('doctor.appointments_succed_start'));
    }

    public function cancel($doctor_id, $appointment_id) 
    {
        $appointment = Appointment::find($appointment_id);
        $appointment->status = AppointmentStatus::Booked;
        $appointment->save();

        return redirect()->route('doctor.appointments', ['doctor' => $doctor_id])->with('success', __('doctor.appointments_succed_cancel'));
    }

    private function redirectToUnauthorized() {
        return redirect("/")->with('error', __('messages.unauthorized'));
    }
    
    private function isDoctorVisit($appointment)
    {
        return $appointment->doctorSpeciality->doctor->id == $this->doctor->id;
    }
}