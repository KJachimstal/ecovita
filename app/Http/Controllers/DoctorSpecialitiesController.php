<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Log;
use App\DoctorSpeciality;
use App\Doctor;
use App\Queries\DoctorSpecialities;
use App\Queries\Doctors;
use Illuminate\Support\Facades\Auth;

class DoctorSpecialitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $doctorSpecialities = (new DoctorSpecialities\GetAllWithFiltersQuery($request))->call();
        $doctors = (new Doctors\GetAllWithUsersQuery($request->get('speciality_id')))->call();

        return view('doctor_specialities.index', [
            'doctorSpecialities' => $doctorSpecialities->paginate(8),
            'doctors' => $doctors->pluck('full_name', 'id')
        ]);
    }

    public function edit($id) {
        $doctorSpeciality = DoctorSpeciality::find($id);
        $doctor = [ $doctorSpeciality->doctor_id => $doctorSpeciality->doctor->user->fullName ];

        return view('doctor_specialities.edit', [
            'doctorSpeciality' => $doctorSpeciality,
            'doctor' => $doctor
        ]);
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