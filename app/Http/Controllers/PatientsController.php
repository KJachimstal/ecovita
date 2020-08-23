<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('patients.edit', ['patient' => Patient::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pesel' => 'digits:11',
            'phone_number' => 'digits_between:7,9',
            'city' => ['min:3', 'max:15'],
            'post_code' => 'regex:/^[0-9]{2}\-[0-9]{3}$/',
            'street' => '',
            'street_number' => '',
        ]);

        $patient = Patient::find($id);
        $patient->pesel = $request->get('pesel');
        $patient->phone_number = $request->get('phone_number');
        $patient->city = $request->get('city');
        $patient->post_code = $request->get('post_code');
        $patient->street = $request->get('street');
        $patient->street_number = $request->get('street_number');
        $patient->is_verified = 0;
        $patient->save();
        
        return redirect('/')->with('success', __('messages.succed_change'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}