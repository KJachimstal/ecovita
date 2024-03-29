<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Speciality;
use App\Log;
use DB;
use App\Helpers\LogHelper;
use App\Enums\ActionType;

class SpecialitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $specialities = DB::table('specialities')->orderBy('name');
        $allSpecialities = Speciality::all()->sortBy('name');
        
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
                LogHelper::log(ActionType::Create, __('messages.speciality_error_exists'), $speciality);
                return redirect('specialities')->with('error', __('messages.speciality_error_exists'));
            }
        }

        $new_speciality = new Speciality;
        $new_speciality->name = $request->get('name');
        $new_speciality->save();

        LogHelper::log(ActionType::Update, __('messages.speciality_succed_add'), $speciality);
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
        $original_record = json_encode($speciality);
        $speciality->name = $request->get('name');
        $speciality->save();
        
        LogHelper::log(ActionType::Update, __('messages.speciality_succed_change'), $speciality, $original_record);
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
        $original_record = json_encode($speciality);
        $speciality->delete();

        LogHelper::log(ActionType::Delete, __('messages.speciality_succed_delete'), $speciality, $original_record);
        return redirect('specialities')->with('success', __('messages.speciality_succed_delete'));
    }
}
