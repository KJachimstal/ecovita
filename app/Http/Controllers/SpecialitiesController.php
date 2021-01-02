<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Speciality;

class SpecialitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('specialities.index', ['specialities' => Speciality::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specialities/admin/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3']
        ]);

        $speciality = new Speciality;
        $speciality->name = $request->get('name');
        $speciality->save();

        return redirect('specialities')->with('success', __('messages.speciality_succed_add'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('specialities.show', ['speciality' => Speciality::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("specialities/admin/edit", ['speciality' => Speciality::find($id)]);
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
            'name' => ['required', 'min:3']
        ]);

        $speciality = Speciality::find($id);
        $speciality->name = $request->get('name');
        $speciality->save();
        
        return redirect('specialities')->with('success', __('messages.speciality_succed_change'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $speciality = Speciality::find($id);
        $speciality->delete();

        return redirect('specialities')->with('success', __('messages.speciality_succed_delete'));
    }
}
