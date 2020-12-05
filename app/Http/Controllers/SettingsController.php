<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit_profile()
    {
        return view('settings.edit_profile', ['user' => Auth::user()]);
    }

    public function update_profile(Request $request)
    {
        
    }

    public function edit_password()
    {
        return view('settings.edit_password');
    }

    public function update_password(Request $request)
    {
        
    }
}
