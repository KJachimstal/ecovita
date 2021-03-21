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
    
    public function index(Request $request)
    {
        $id = $request->route('doctor');
        $specialities = Speciality::pluck('name', 'id');
        $doctors = (new Doctors\GetAllWithUsersQuery())->call();
        $appointments = (new Appointments\GetAllWithFiltersQuery($request, Auth::user()))->call();
        $statuses = AppointmentHelper::getStatusesForSelect();

        return view('appointments.doctor.index', [
            'appointments' => $appointments->paginate(8),
            'specialities' => $specialities,
            'doctors' => $doctors->pluck('full_name', 'id'),
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

    
    public function show($id)
    {
        //
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
        return view('appointments.doctor.start', ['appointment' => Appointment::find($appointment_id)]);
    }
}
