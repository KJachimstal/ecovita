<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Doctor;
use App\Speciality;
use App\Appointment;
use App\DoctorSpeciality;
use App\Log;
use DB;
use App\Http\Helpers\LogHelper;


class LogController extends Controller
{
   public function index() 
   {
      $logs = Log::query();

      return view('logs.index', ['logs' => $logs->paginate(8)]);
   }
}
