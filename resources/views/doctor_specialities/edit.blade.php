@extends('layouts.default')
@section('title', 'Edytuj gabinet')
@section('content')
<div class="container">
  <h3 class="font-weight-bold mb-4">Edytuj gabinet</h3>
  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')
    {{ Form::model($doctorSpeciality, ['route' => ['doctor_specialities.update', $doctorSpeciality->id], 'method' => 'PUT']) }}
      <div class="form-group row">
        {{ Form::label('doctor_id', 'Doktor', ['class' => 'col-sm-3 col-form-label']) }}
        <div class="col-sm-9">
          {{ Form::select('doctor_id', $doctor ?? [], null, ['class' => 'form-control doctor_search']) }}
        </div>
      </div>
      <div class="form-group row">
        {{ Form::label('speciality_id', 'Specjalizacja', ['class' => 'col-sm-3 col-form-label']) }}
        <div class="col-sm-9">
          {{ Form::input('speciality_id', 'begin_date', $date ?? null, array('class' => 'form-control')) }}
        </div>
      </div>
      <div class="mt-4 d-flex justify-content-center">
        {{ Form::submit('Wyślij', ['class' => 'btn btn-success'])}}
        <a href="{{ url("doctor_specialities") }}" class="btn border btn-light ml-2">Powrót</a>
      </div>
      @include('appointments.shared.search')
    {{ Form::close() }}
  </div>
</div>
@endsection