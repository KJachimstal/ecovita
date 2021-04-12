<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DoctorsController extends Controller
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
        //
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
        //
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

    public function search(Request $request)
    {
        $doctors = DB::table('doctors')
        ->leftJoin('users', function($join) {
            $join->on('users.userable_id', '=', 'doctors.id');
            $join->where('users.userable_type', '=', 'App\Doctor');
        })
        ->select('doctors.id', 'users.first_name', 'users.last_name')
        ->limit(20);

        if ($request->has('q')) {
            $search = $request->q;

            $doctors->whereRaw("CONCAT(`first_name`, ' ', `last_name`) LIKE '%$search%'");
        }

        return response()->json($doctors->get());
    }
}
