<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Log;
use App\DoctorSpeciality;
use App\Doctor;
use App\Speciality;
use App\Queries\DoctorSpecialities;
use App\Queries\Doctors;
use Illuminate\Support\Facades\Auth;
use App\Helpers\LogHelper;
use App\Enums\ActionType;

class DoctorSpecialitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
         
        $this->middleware(function ($request, $next) {

            if(Auth::guest() || !Auth::user()->isEmployee) {
                return $this->redirectToUnauthorized();
            }
            
            return $next($request);
        });
    }

    public function index(Request $request) {
        $doctorSpecialities = (new DoctorSpecialities\GetAllWithFiltersQuery($request))->call();
        $doctors = (new Doctors\GetAllWithUsersQuery($request->get('speciality_id')))->call();
        $specialities = Speciality::all()->sortBy('name')->pluck('name', 'id');

        return view('doctor_specialities.index', [
            'doctorSpecialities' => $doctorSpecialities->paginate(8),
            'doctors' => $doctors->pluck('full_name', 'id'),
            'specialities' => $specialities
        ]);
    }

    public function edit($id) {
        $doctorSpeciality = DoctorSpeciality::find($id);
        $doctor = [ $doctorSpeciality->doctor_id => $doctorSpeciality->doctor->user->fullName ];
        $specialities = Speciality::all()->pluck('name', 'id');
        $days = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela'];
        $schedule = json_decode($doctorSpeciality->schedule, true);

        return view('doctor_specialities.edit', [
            'doctorSpeciality' => $doctorSpeciality,
            'doctor' => $doctor,
            'specialities' => $specialities,
            'days' => $days,
            'schedule' => $schedule
        ]);
    }

    public function update(Request $request, $id) {

        $request->validate ([
            'doctor_id' => ['required'],
            'speciality_id' => ['required'],
            'visit_length' => ['numeric']
        ]);

        $schedule = [];

        $start = $request->get('start');
        $stop = $request->get('stop');

        foreach ($start as $index => $element) {
            $schedule[$index] = [
                "start" => $element,
                "stop" => $stop[$index]
            ];
        }

        $doctorSpeciality = DoctorSpeciality::find($id);
        $original_record = json_encode($doctorSpeciality);
        $doctorSpeciality->doctor_id = $request->get('doctor_id');
        $doctorSpeciality->speciality_id = $request->get('speciality_id');
        $doctorSpeciality->schedule = $schedule;
        $doctorSpeciality->visit_length = intval($request->get('visit_lenght'));

        $doctorSpeciality->save();

        LogHelper::log(ActionType::Update, __('messages.doctor_speciality_success_edit'), $doctorSpeciality, $original_record);
        return redirect('doctor_specialities')->with('success', __('messages.doctor_speciality_success_edit'));
    }

    public function create() 
    {
        $doctor = (new Doctors\GetAllWithUsersQuery())->call();
        $specialities = Speciality::all()->sortBy('name')->pluck('name', 'id');
        $days = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela'];

        return view('doctor_specialities.create', [
            'doctor' => $doctor,
            'specialities' => $specialities,
            'days' => $days
        ]);
    }

    public function store(Request $request)
    {
        $request->validate ([
            'doctor_id' => ['required'],
            'speciality_id' => ['required'],
            'visit_length' => ['numeric']
        ]);

        $schedule = [];

        $start = $request->get('start');
        $stop = $request->get('stop');

        foreach ($start as $index => $element) {
            $schedule[$index] = [
                "start" => $element,
                "stop" => $stop[$index]
            ];
        }

        $doctorSpeciality = new DoctorSpeciality;
        $doctorSpeciality->doctor_id = $request->get('doctor_id');
        $doctorSpeciality->speciality_id = $request->get('speciality_id');
        $doctorSpeciality->schedule = json_encode($schedule);
        $doctorSpeciality->visit_lenght = $request->get('visit_lenght');
        $doctorSpeciality->save();
        
        LogHelper::log(ActionType::Create, __('messages.doctor_speciality_success_create'), $doctorSpeciality);
        return redirect('doctor_specialities')->with('success', __('messages.doctor_speciality_success_create'));
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

    public function destroy($id)
    {
        // $doctorSpecialities = DoctorSpeciality::find($id);
        // $original_record = json_encode($appointment);
        
        // LogHelper::log(ActionType::Delete, __('messages.appointments_succed_delete'), $doctorSpecialities, $original_record);
        // return redirect('doctor_specialities')->with('success', __('messages.doctor_speciality_success_delete'));
    }

    private function redirectToUnauthorized() {
        LogHelper::log(ActionType::View, __('messages.unauthorized'), Auth::user());
        return redirect('/')->with('error', __('messages.unauthorized'));
    }
}