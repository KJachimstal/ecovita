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
use App\Helpers\LogHelper;
use App\Queries\Logs;


class LogController extends Controller
{
   public function index(Request $request) 
   {
      $logs = (new Logs\GetAllWithFiltersQuery($request))->call();
      $actions = LogHelper::getStatusesForSelect();

      return view('logs.index', [
         'logs' => $logs->paginate(8),
         'actions' => $actions,

      ]);
   }

   public function show($id)
    {
      // echo json_encode(Log::find($id)->details, JSON_PRETTY_PRINT);
      // return;
        return view('logs.show', ['log' => Log::find($id)]);
    }
}
