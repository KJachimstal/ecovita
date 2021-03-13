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
        $doctors = Doctor::leftJoin('users', function($join) {
            $join->on('users.userable_id', '=', 'doctors.id');
            $join->where('users.userable_type', '=', 'App\Doctor');
        })->select(DB::raw('CONCAT(users.first_name, " ", users.last_name) AS full_name'), 'doctors.id')->pluck('full_name', 'id');

        $appointments = Auth::user()->isActiveEmployee ? Appointment::query() : Appointment::where('status', AppointmentStatus::Available);
        
        if ($request->filled('speciality_id') || $request->filled('doctor_id')) {
            $appointments->leftJoin('doctor_speciality as doctor_speciality', 'doctor_speciality.id', '=', 'doctor_speciality_id')
            ->select('appointments.*');

            if ($request->filled('speciality_id')) {
                $appointments->where('doctor_speciality.speciality_id', $request->speciality_id);
            }

            if ($request->filled('doctor_id')) {
                $appointments->where('doctor_speciality.doctor_id', $request->doctor_id);
            }
        }

        if ($request->filled('begin_date')) {
            $appointments->whereBetween('begin_date', ["{$request->begin_date} 00:00:00", "{$request->begin_date} 23:59:59"]);
        }

        $appointments->orderBy('begin_date');

        $viewName = Auth::user()->isActiveEmployee ? 'appointments.admin.index' : 'appointments.index';
        return view($viewName, 
            ['appointments' => $appointments->paginate(8),
            'specialities' => $specialities,
            'doctors' => $doctors]
        );
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
        print_r($appointment);
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
        if ($appointment->status == 'Available') {
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
}