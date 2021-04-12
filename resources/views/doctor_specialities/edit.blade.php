@extends('layouts.default')
@section('title', 'Edytuj gabinet')
@section('content')
<div class="container">
  <h3 class="font-weight-bold mb-4">Edytuj gabinet</h3>
  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')
    {{ Form::model($doctorSpeciality, ['route' => ['doctor_specialities.update', $doctorSpeciality->id], 'method' => 'PUT']) }}
    @include('doctor_specialities.shared.form', [
      'doctorSpeciality' => $doctorSpeciality,
      'doctor' => $doctor,
      'specialities' => $specialities,
      'days' => $days,
      'schedule' => $schedule
    ])
    {{ Form::close() }}
  </div>
</div>
@endsection