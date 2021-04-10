<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Appointment;
use App\Speciality;
use App\Doctor;
use DB;
use App\Log;
use DateTime;
use App\Http\Helpers\LogHelper;
use App\Enums\AppointmentStatus;
use App\Queries\Appointments;
use App\Queries\Doctors;
use App\Helpers\AppointmentHelper;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $specialities = Speciality::pluck('name', 'id');
        $doctors = (new Doctors\GetAllWithUsersQuery())->call();
        $appointments = (new Appointments\GetAllWithFiltersQuery($request, Auth::user()))->call();
        $statuses = AppointmentHelper::getStatusesForSelect();
        $dailyAppointments = AppointmentHelper::getAppointmentsByDays($appointments->get());

        $viewName = Auth::user()->isActiveEmployee ? 'appointments.admin.index' : 'appointments.index';
        return view($viewName, [
            'appointments' => $appointments->paginate(8),
            'specialities' => $specialities,
            'doctors' => $doctors->pluck('full_name', 'id'),
            'statuses' => $statuses,
            'dailyAppointments' => $dailyAppointments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appointments.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_speciality_id' => ['required'],
            'begin_date' => ['required']
        ]);

        $appointment = new Appointment;
        $appointment->user_id = $request->get('user_id');
        $appointment->doctor_speciality_id = $request->get('doctor_speciality_id');
        $appointment->begin_date = $request->get('begin_date');
        $appointment->status = empty($request->get('user_id')) ? AppointmentStatus::Available : AppointmentStatus::Booked;
        $appointment->save();

        LogHelper::log(__('logs.appointments_succed_create'));
        return redirect('appointments')->with('success', __('messages.appointments_succed_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('appointments.show', ['appointment' => Appointment::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::find($id);
        $doctor_speciality = [ $appointment->doctor_speciality_id => $appointment->doctorSpeciality->name ];
        $user = !empty($appointment->user_id) ? [$appointment->user_id => $appointment->user->fullName] : [];
        $date = date('Y-m-d\Th:m:s',  strtotime($appointment->begin_date));
        
        return view('appointments.admin.edit', [
            'appointment' => $appointment, 
            'doctor_speciality' => $doctor_speciality, 
            'user' => $user,
            'date' => $date
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        $appointment->user_id = $request->get('user_id');
        $appointment->doctor_speciality_id = $request->get('doctor_speciality_id');
        $appointment->begin_date = $request->get('begin_date');
        $appointment->status = empty($appointment->user_id) ? AppointmentStatus::Available : AppointmentStatus::Booked;
        $appointment->save();

        LogHelper::log(__('logs.appointment_succed_change'));
        return redirect('appointments')->with('success', __('messages.appointment_succed_change'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        
        LogHelper::log(__('logs.appointments_succed_delete'));
        return redirect('appointments')->with('success', __('messages.appointments_succed_delete'));
    }

    public function prepare_enroll($id)
    {
        $appointment = Appointment::find($id);
    
        return view('appointments.prepare_enroll', ['appointment' => $appointment]);
    }

    public function enroll($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment->status == AppointmentStatus::Available) {
            $appointment->user_id = Auth::user()->id;
            $appointment->status = AppointmentStatus::Booked;
            $appointment->save();

            LogHelper::log(__('logs.appointment_succed_enroll'));
            return redirect('/appointments')->with('success', __('messages.appointment_succed'));
        } else {
            LogHelper::log(__('logs.appointment_unavailable_enroll'));
            return redirect('/appointments')->with('error', __('messages.appointment_unavailable'));
        }
    }

    public function prepareSelectSpeciality() {
        $specialities = Speciality::all();

        return view('appointments.prepare_select_speciality', 
        [
            'specialities' => $specialities
        ]);
    }

    public function selectSpeciality(Request $request) {
        $speciality_id = $request->get('speciality_id');

        return view('appointments.select_speciality', 
        [
            'speciality_id' => $speciality_id
        ]);
    }
}