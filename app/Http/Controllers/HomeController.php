<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LogHelper;
use App\Enums\ActionType;
use App\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        // LogHelper::log(ActionType::Update, __('logs.appointments_succed_create'), User::find(3));
        // return;

        return view('welcome');
    }
}
