<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Appointment;
use App\Speciality;
use App\Doctor;
use App\DoctorSpeciality;
use DB;
use App\Log;
use DateTime;
use App\Helpers\LogHelper;
use App\Enums\AppointmentStatus;
use App\Enums\ActionType;
use App\Queries\Appointments;
use App\Queries\Doctors;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentsNotification;
use App\Helpers\AppointmentHelper;
use Carbon\Carbon;

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
        if (!$request->filled('speciality_id') && !Auth::user()->isActiveEmployee) {
            return redirect()->route('appointments.prepare_select_speciality');
        }

        if (!Auth::user()->isActiveEmployee) {
            $speciality = Speciality::find($request->get('speciality_id'));
            $doctors = (new Doctors\GetAllWithUsersQuery($speciality->id))->call();
        } else {
            $speciality = Speciality::all()->pluck('name','id');
            $doctors = Doctor::all();
        }
        
        $appointments = (new Appointments\GetAllWithFiltersQuery($request, Auth::user(), false, true))->call();
        $statuses = AppointmentHelper::getStatusesForSelect();
        $dailyAppointments = AppointmentHelper::getAppointmentsByDays($appointments->get());

        

        $viewName = Auth::user()->isActiveEmployee ? 'appointments.admin.index' : 'appointments.index';
        return view($viewName, [
            'appointments' => $appointments->paginate(8),
            'speciality' => $speciality,
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

        LogHelper::log(ActionType::Create, __('messages.appointments_succed_create'), $appointment);

        Mail::to($appointment->user->email)
                    ->send(new AppointmentsNotification($appointment));

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
        $original_record = json_encode($appointment);
        $appointment->user_id = $request->get('user_id');
        $appointment->doctor_speciality_id = $request->get('doctor_speciality_id');
        $appointment->begin_date = $request->get('begin_date');
        $appointment->status = empty($appointment->user_id) ? AppointmentStatus::Available : AppointmentStatus::Booked;
        $appointment->save();

        LogHelper::log(ActionType::Update, __('messages.appointment_succed_change'), $appointment, $original_record);

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
        $appointment->status = AppointmentStatus::Available;
        $appointment->save();

        Mail::to($appointment->user->email)
        ->send(new AppointmentsNotification($appointment));

        $original_record = json_encode($appointment);
        $appointment->delete();
        
        LogHelper::log(ActionType::Delete, __('messages.appointments_succed_delete'), $appointment, $original_record);
        
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
        $original_record = json_encode($appointment);
        $currentUser = Auth::user();
        $limitTime = Carbon::now()->add('minute', 15);
        $appointmentTime = Carbon::parse($appointment->begin_date);

        if ($appointmentTime->lessThan($limitTime)) {
            return redirect("/users/{$currentUser->id}/appointments")->with('error', __('messages.appointment_enroll_to_late'));
        }

        if ($appointment->doctorSpeciality->doctor->user->id == $currentUser->id) {
            return redirect("/users/{$currentUser->id}/appointments")->with('error', __('messages.doctor_self_appointment'));
        }

        if ($appointment->status == AppointmentStatus::Available) {
            $appointment->user_id = Auth::user()->id;
            $appointment->status = AppointmentStatus::Booked;
            $appointment->save();

            Mail::to($appointment->user->email)
                    ->send(new AppointmentsNotification($appointment));

            LogHelper::log(ActionType::Update, __('messages.appointment_succed'), $appointment, $original_record);
            return redirect("/users/{$currentUser->id}/appointments")->with('success', __('messages.appointment_succed'));
        } else {
            LogHelper::log(ActionType::Update, __('messages.appointment_unavailable'), $appointment, $original_record);
            return redirect("/users/{$currentUser->id}/appointments")->with('error', __('messages.appointment_unavailable'));
        }
    }

    public function prepareSelectSpeciality() {
        $specialities = Speciality::all()->sortBy('name');

        return view('appointments.prepare_select_speciality', 
        [
            'specialities' => $specialities
        ]);
    }
}