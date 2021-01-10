<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DoctorsSpecialitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $doctorSpecialities = DB::table('doctor_speciality')
        ->join('doctors', 'doctor_speciality.doctor_id', '=', 'doctors.id')
        ->join('users', 'users.userable_id', '=', 'doctors.id')
        ->where('users.userable_type', '=', 'App\Doctor')
        ->join('specialities', 'doctor_speciality.speciality_id', '=', 'specialities.id')
        ->select('doctor_speciality.id', 'users.first_name', 'users.last_name', 'specialities.name')
        ->limit(20);

        if ($request->has('q')) {
            $search = $request->q;

            $doctorSpecialities->whereRaw("CONCAT(`first_name`, ' ', `last_name`) LIKE '%$search%'")->orWhere('name', 'like', "%$search%");
        }

        return response()->json($doctorSpecialities->get());
    }
}