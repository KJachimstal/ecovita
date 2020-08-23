<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index() {
        return view('users.index', ['users' => User::all()]);
    }

    public function show($id) {
        return view('users.show', ['user' => User::find($id)]);
    }

    public function edit($id) {
        return view('users.edit', ['user' => User::find($id)]);
    }
}
