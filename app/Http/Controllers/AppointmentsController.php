<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Appointment;
use App\Speciality;
use App\Doctor;
use DB;
use DateTime;


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
        
        $appointsments = Appointment::where('is_available', true);

        if ($request->filled('speciality_id') || $request->filled('doctor_id')) {
            $appointsments->leftJoin('doctor_speciality', 'doctor_speciality.id', '=', 'doctor_speciality_id');

            if ($request->filled('speciality_id')) {
                $appointsments->where('doctor_speciality.speciality_id', $request->speciality_id);
            }

            if ($request->filled('doctor_id')) {
                $appointsments->where('doctor_speciality.doctor_id', $request->doctor_id);
            }
        }

        if ($request->filled('begin_date')) {
            $appointsments->whereBetween('begin_date', ["{$request->begin_date} 00:00:00", "{$request->begin_date} 23:59:59"]);
        }

        $appointsments->orderBy('begin_date');

        return view('appointments.index', 
            ['appointments' => $appointsments->get(), 
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

    public function prepare_enroll($id)
    {
        $appointment = Appointment::find($id);
    
        return view('appointments.prepare_enroll', ['appointment' => $appointment]);
    }

    public function enroll($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment->is_available) {
            $appointment->user_id = Auth::user()->id;
            $appointment->is_available = false;
            $appointment->save();

            return redirect('/appointments')->with('success', __('messages.appointment_succed'));
        } else {
            return redirect('/appointments')->with('error', __('messages.appointment_unavailable'));
        }
    }
}