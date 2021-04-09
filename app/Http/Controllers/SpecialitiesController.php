<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Speciality;
use App\Log;
use DB;
use App\Http\Helpers\LogHelper;

class SpecialitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $specialities = DB::table('specialities');
        $allSpecialities = Speciality::all();
        
        if ($request->filled('name')) {
            $specialities->where('name', 'like', "%{$request->name}%");
        }
        if (Auth::guest()){
            $viewName = 'specialities.index';
        }else {
            $viewName = Auth::user()->isActiveEmployee ? 'specialities.admin.index' : 'specialities.index';
        }
        return view($viewName, ['specialities' => $specialities->paginate(5), 'allSpecialities' => $allSpecialities]);
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

        $specialities = Speciality::all();
        foreach ($specialities as $speciality) {
            if ($speciality->name == $request->get('name')) {
                return redirect('specialities')->with('error', __('messages.speciality_error_exists'));
            }
        }

        $new_speciality = new Speciality;
        $new_speciality->name = $request->get('name');
        $new_speciality->save();

        LogHelper::log(__('logs.speciality_succed_create'));
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
        
        LogHelper::log(__('logs.speciality_succed_change'));
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

        LogHelper::log(__('logs.speciality_succed_delete'));
        return redirect('specialities')->with('success', __('messages.speciality_succed_delete'));
    }
}
