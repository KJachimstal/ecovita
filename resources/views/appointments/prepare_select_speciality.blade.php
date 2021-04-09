@extends('layouts.default')
@section('title', 'Wizyty')
@section('content')
<div class="bg-white rounded p-4 mt-2 shadow-sm form-inline justify-content-center">
    {{ Form::open(array('url' => 'select_speciality')) }}
        {{ Form::select('speciality_id', $specialities, app('request')->speciality_id, ['class' => 'form-control mr-sm-2']) }}
        {{ Form::submit('Wybierz specjalizację', ['class' => 'btn btn-success'])}}
    {{ Form::close() }}
</div>
@endsection