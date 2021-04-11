<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Appointment;
use App\Speciality;
use App\Doctor;
use App\Log;
use App\Enums\AppointmentStatus;
use DB;
use DateTime;
use App\Http\Helpers\LogHelper;
use App\Queries\Appointments;
use App\Queries\Doctors;
use App\Helpers\AppointmentHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentsNotification;

class UserAppointmentsController extends Controller
{
    private $user;

    public function __construct(Request $request) 
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $id = $request->route('user');
            $currentUser = Auth::user();

            if ($id != $currentUser->id && !$currentUser->isEmployee) {
                LogHelper::log(__('logs.unauthorized_user_appointments'));
                return redirect("/users/{$currentUser->id}/appointments")->with('error', __('messages.unauthorized'));
            }

            $this->user = User::find($id);
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $specialities = Speciality::pluck('name', 'id');
        $doctors = (new Doctors\GetAllWithUsersQuery())->call();
        $appointments = (new Appointments\GetAllWithFiltersQuery($request, Auth::user(), true))->call();
        $statuses = AppointmentHelper::getStatusesForSelect();

        return view('users.appointments.index', [
            'appointments' => $appointments->paginate(8),
            'specialities' => $specialities,
            'doctors' => $doctors->pluck('full_name', 'id'),
            'statuses' => $statuses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function prepare_cancel($user_id, $appointment_id)
    {
        $appointment = $this->user->appointments->find($appointment_id);
        if ($appointment) {
            $user_id = User::find($user_id)->id;
            return view('users.appointments.prepare_cancel', ['appointment' => $appointment, 'user_id' => $user_id]);
        } else {
            return redirect("users/{$user_id}/appointments")->with('error', __('messages.appointment_not_found'));
        }
    }

    public function cancel($user_id, $appointment_id)
    {
        $appointment = $this->user->appointments->find($appointment_id);
        $patient_email = $appointment->user->email;
        
        if ($appointment->status == AppointmentStatus::Booked) {
            $appointment->user_id = null;
            $appointment->status = AppointmentStatus::Available;
            $appointment->save();
            
            Mail::to($patient_email)
                    ->send(new AppointmentsNotification($appointment));

            LogHelper::log(__('logs.appointment_succed_cancel'));
            return redirect("users/{$user_id}/appointments")->with('success', __('messages.cancel_appointment_succed'));
        } else {
            LogHelper::log(__('logs.appointment_error_cancel'));
            return redirect("users/{$user_id}/appointments")->with('error', __('messages.cancel_appointment_unavailable'));
        }
    }

    public function show_history($user_id, Request $request) {
        return view('home', ['user_id' => $user_id]);
    }
}
