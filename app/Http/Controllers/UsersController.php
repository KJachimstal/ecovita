<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index() 
    {
        return view('users.index', ['users' => User::all()]);
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
            'pesel' => ['required'],
            'phone_number' => ['required'],
            'city' => ['required'],
            'post_code' => ['required'],
            'street' => ['required'],
            'street_number' => ['required'],
        ]);

        $user = new User;
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->userable_type = $request->get('userable_type');
        $user->pesel = $request->get('pesel');
        $user->phone_number = $request->get('phone_number');
        $user->city = $request->get('city');
        $user->post_code = $request->get('post_code');
        $user->street = $request->get('street');
        $user->street_number = $request->get('street_number');
        $user->is_verified = 0;
        $user->save();
        
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
            'pesel' => ['required'],
            'phone_number' => ['required'],
            'city' => ['required'],
            'post_code' => ['required'],
            'street' => ['required'],
            'street_number' => ['required'],
        ]);

        $user = User::find($id);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->userable_type = $request->get('userable_type');
        $user->pesel = $request->get('pesel');
        $user->phone_number = $request->get('phone_number');
        $user->city = $request->get('city');
        $user->post_code = $request->get('post_code');
        $user->street = $request->get('street');
        $user->street_number = $request->get('street_number');
        $user->is_verified = 0;
        $user->save();
        
        return redirect('users')->with('success', __('messages.user_succed_change'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('users')->with('success', __('messages.user_succed_delete'));
    }
}
