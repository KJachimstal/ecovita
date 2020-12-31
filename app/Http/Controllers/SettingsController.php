<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

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
        $request->validate([
            'name' => ['min:3', 'max:15'],
            'surname' => ['min:3', 'max:25'],
            'pesel' => 'digits:11',
            'phone_number' => 'digits_between:7,9',
            'city' => ['min:3', 'max:15'],
            'post_code' => 'regex:/^[0-9]{2}\-[0-9]{3}$/',
            'street' => '',
            'street_number' => '',
        ]);

        $user = Auth::user();
        $user->pesel = $request->get('pesel');
        $user->phone_number = $request->get('phone_number');
        $user->city = $request->get('city');
        $user->post_code = $request->get('post_code');
        $user->street = $request->get('street');
        $user->street_number = $request->get('street_number');
        $user->is_verified = 0;
        $user->save();
        
        return redirect('/')->with('success', __('messages.succed_change'));
    }

    public function edit_password()
    {
        return view('settings.edit_password');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'password' => ['required'],
            'new_password' => ['required', 'confirmed', 'between:8,50']
        ]);
        
        $requestData = $request->all();
        $currentPassword = Auth::user()->password;
        if (Hash::check($requestData['password'], $currentPassword))
        {
            $user = Auth::user();
            $user->password = Hash::make($requestData['new_password']);
            $user->save();
            return back()->with('success', 'Hasło zostało pomyślnie zmienione.');
        }
        else
        {
            return back()->withErrors(['Przepraszamy twoje hasło nie zostało rozpoznane. Spróbuj ponownie.']);
        }
    }

    public function switch_panel()
    {
        $user = Auth::user();
        $user->is_panel_active = !$user->is_panel_active;
        $user->save();
        return redirect('/');
    }
}
