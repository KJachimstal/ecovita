<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorsSpecialitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $doctorSpecialities = [];

        if ($request->has('q')) {
            $search = $request->q;

            $doctorSpecialities = DB::table('doctor_speciality')
            ->join('doctors', 'doctor_specialities.doctor_id', '=', 'doctors.id')
            ->join('users', 'users.userable_id', '=', 'doctors.id')
            ->where('users.userable_type', '=', 'App\Doctor')
            ->join('specialities', 'doctor_specialities.speciality_id', '=', 'specialities.id')
            ->select(DB::raw('CONCAT(users.first_name, " ", users.last_name) AS full_name'), 'doctor_specialities.id')->pluck('full_name', 'id');

            // $doctorSpecialities = DoctorSpeciality::leftJoin('doctors', function($join) {
            //     $join->on('doctor_specialities.doctor_id', '=', 'doctors.id');
            // })::leftJoin('users', function($join) {
            //     $join->on('users.userable_id', '=', 'doctors.id');
            //     $join->where('users.userable_type', '=', 'App\Doctor');
            // })::leftJoin('specialities', function($join) {
            //     $join->on('doctor_specialities.speciality_id', '=', 'specialities.id');
            // })->select(DB::raw('CONCAT(users.first_name, " ", users.last_name) AS full_name'), 'doctor_specialities.id')->pluck('full_name', 'id');
        
        }

        return response()->json($doctorSpecialities);
    }
}