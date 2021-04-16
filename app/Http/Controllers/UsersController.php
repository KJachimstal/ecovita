<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Doctor;
use App\Speciality;
use App\Appointment;
use App\DoctorSpeciality;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\ActiveAppointmentException;
use DB;
use App\Helpers\LogHelper;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {

            if (!Auth::user()->IsActiveEmployee) {
                return redirect('home')->with('error', __('messages.unauthorized'));
            }
            
            return $next($request);
        });
    }

    public function index(Request $request) 
    {
        $users = User::query()->orderBy('first_name')->orderBy('last_name');
        
        if ($request->filled('search')){
            $users->whereRaw("CONCAT(`first_name`, ' ', `last_name`) LIKE '%{$request->search}%'");
        }

        if ($request->get('is_unverified')) {
            $users->where('is_verified', false);
        }

        $viewName = Auth::user()->isActiveEmployee ? 'users.admin.index' : 'users.index';
        return view($viewName, ['users' => $users->paginate(8)]);
    }

    public function create() 
    {
        return view('users/admin/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'pesel' => ['required', 'digits:11'],
            'phone_number' => ['required', 'digits:9'],
            'city' => ['required'],
            'post_code' => ['required'],
            'street' => ['required'],
            'street_number' => ['required', 'between:1,7']
        ]);

        $user = new User;
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));

        if ($request->get('userable_type') == 'App\Doctor') {
            $user->userable_type = $request->get('userable_type');
            $doctor = new Doctor;
            $doctor->licensure = $request->get('licensure');
            $doctor->academic_degree = $request->get('academic_degree');
            $doctor->save();
            $user->userable_id = $doctor->id;
        }
        $user->pesel = $request->get('pesel');
        $user->phone_number = $request->get('phone_number');
        $user->city = $request->get('city');
        $user->post_code = $request->get('post_code');
        $user->street = $request->get('street');
        $user->street_number = $request->get('street_number');
        $user->is_verified = 0;
        $user->save();
        
        LogHelper::log(__('logs.user_succed_create'));
        return redirect('users')->with('success', __('messages.user_succed_create'));
    }

    public function show($id) 
    {
        return view('users.show', ['user' => User::find($id)]);
    }

    public function edit($id) 
    {
        return view('users/admin/edit', ['user' => User::find($id)]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'pesel' => ['required', 'digits:11'],
            'phone_number' => ['required', 'digits:9'],
            'city' => ['required'],
            'post_code' => ['required'],
            'street' => ['required'],
            'street_number' => ['required', 'between:1,7']
        ]);

        $user = User::find($id);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));

        if ($user->userable_type != null && $request->get('userable_type') == null || $request->get('userable_type') == 'App\Employee') {
            if ($user->isDoctor) {
                $appointments = $user->userable->appointments->toArray();

                if (!empty($appointments)) {
                    LogHelper::log(__('logs.appointment_active_error'));
                    return redirect('users')->with('error', __('messages.active_appointment_error'));  
                }
            }
            if($user->userable != null) {
                $user->userable->delete();
                $user->userable_id = null;
            }
        }
        if ($user->userable_type == null) { 
            if ($request->get('userable_type') == 'App\Doctor') {
                $doctor = new Doctor;
                $doctor->licensure = 0;
                $doctor->academic_degree = '';
                $doctor->save();
                $user->userable_id = $doctor->id;
            }
        }else {
            if ($request->get('userable_type') == 'App\Doctor') {
            $doctor = Doctor::find($user->userable_id);
            $doctor->licensure = $request->get('licensure');
            $doctor->academic_degree = $request->get('academic_degree');
            $doctor->save();
            }
        }

        // if ($request->get('userable_type') == 'App\Employee') {
        //     $employee = new Employee;
        //     $employee->save();
        // }

        $user->userable_type = $request->get('userable_type');
        $user->pesel = $request->get('pesel');
        $user->phone_number = $request->get('phone_number');
        $user->city = $request->get('city');
        $user->post_code = $request->get('post_code');
        $user->street = $request->get('street');
        $user->street_number = $request->get('street_number');
        if ($request->get('is_verified') == null) {
            $user->is_verified = 0;
        }else {
            $user->is_verified = $request->get('is_verified');
        }
        $user->save();
        
        LogHelper::log(__('logs.user_succed_change'));
        return redirect('users')->with('success', __('messages.user_succed_change'));
    }

    // public function destroy($id)
    // {
    //     $user = User::find($id);
    //     $user->delete();

    //     return redirect('users')->with('success', __('messages.user_succed_delete'));
    // }

    public function edit_doctor($id)
    {
        $specialities = Speciality::pluck('name', 'id');
        return view('users.admin.edit_doctor', ['user' => User::find($id), 'specialities' => $specialities]);
    }

    public function update_doctor(Request $request, $id)
    {
        $user = User::find($id);
        $doctor = $user->userable;
        $currentSpecialities = $doctor->specialities->pluck('id')->toArray();
        $formSpecialities = $request->get('specialities') ?? [];
        $removedSpecialities = array_diff($currentSpecialities, $formSpecialities);
        $addedSpecialities = array_diff($formSpecialities, $currentSpecialities);

        DB::beginTransaction();
        try {
            
            foreach ($removedSpecialities as $speciality_id) {
                $doctorSpeciality = $doctor->doctorSpecialities->where('speciality_id', $speciality_id)->first();
                
                if ($doctorSpeciality->appointments->isNotEmpty()) {
                    throw new ActiveAppointmentException();
                }
                
                $doctorSpeciality->delete();
            }

            foreach ($addedSpecialities as $speciality_id) {
                $doctorSpeciality = new DoctorSpeciality;
                $doctorSpeciality->doctor_id = $doctor->id;
                $doctorSpeciality->speciality_id = $speciality_id;
                $doctorSpeciality->save();
                
            }

            DB::commit();
            LogHelper::log(__('logs.doctor_succed_change_specjalization'));
            return redirect('users')->with('success', __('messages.doctor_succed_change_specjalization'));

        } catch (ActiveAppointmentException $e) {
            DB::rollback();
            LogHelper::log(__('logs.appointment_active_error'));
            return redirect('users')->with('error', __('messages.active_appointment_error'));
        }

        $doctor = Doctor::find($user->userable->id);
        $doctor->licensure = $request->get('licensure');
        $doctor->academic_degree = $request->get('academic_degree');
        $doctor->save();

        LogHelper::log(__('logs.doctor_succed_change'));
        return redirect('users')->with('success', __('messages.doctor_succed_change'));
    }

    public function search(Request $request)
    {
        $users = User::select('id', 'first_name', 'last_name')
        ->limit(20);

        if ($request->has('q')) {
            $search = $request->q;
            
            $users->whereRaw("CONCAT(`first_name`, ' ', `last_name`) LIKE '%$search%'");
        }

        return response()->json($users->get());
    }
}
