<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Speciality;
use App\Doctor;
use App\Appointment;
use App\User;
use App\Detail;
use App\DoctorSpeciality;
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
        $user = User::find($appointment->user_id);
        $prevAppointments = (new Appointments\GetAllByUserQuery($user, $appointment->doctor_speciality_id))->call();
        $detail = $appointment->detail;
        return view('appointments.doctor.show', [
            'appointment' => $appointment, 
            'detail' => $detail,
            'prevAppointments' => $prevAppointments
        ]);
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $doctor_id, $appointment_id)
    {
        $request->validate([
            'description' => ['required']
        ]);

        $appointment = Appointment::find($appointment_id);

        $detail = new Detail;
        $detail->appointment_id = $appointment_id;
        $detail->doctor_speciality_id = $appointment->doctor_speciality_id;
        $detail->description = $request->get('description');
        $detail->save();

        $appointment->status = AppointmentStatus::Finished;
        $appointment->save();

        return redirect()->route('doctor.appointments', ['doctor' => $doctor_id])->with('success', __('messages.appointments_succed_ended'));
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

        return redirect()->route('doctor.appointments.show', [
            'doctor' => $doctor_id, 
            'appointment' => $appointment_id
        ])->with('success', __('messages.appointments_succed_start'));
    }

    public function cancel($doctor_id, $appointment_id) 
    {
        $appointment = Appointment::find($appointment_id);
        $appointment->status = AppointmentStatus::Booked;
        $appointment->save();

        return redirect()->route('doctor.appointments', ['doctor' => $doctor_id])->with('success', __('messages.appointments_succed_cancel'));
    }

    private function redirectToUnauthorized() {
        return redirect("/")->with('error', __('messages.unauthorized'));
    }
    
    private function isDoctorVisit($appointment)
    {
        return $appointment->doctorSpeciality->doctor->id == $this->doctor->id;
    }
}