@extends('layouts.default')
@section('title', 'Tworzenie gabinetu')
@section('content')
<div class="container">
  <h3 class="font-weight-bold mb-4">Tworzenie gabinetu</h3>
  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')
    {{ Form::model(null, ['route' => ['doctor_specialities.store'], 'method' => 'POST']) }}
    @include('doctor_specialities.shared.form', [
      'doctor' => $doctor,
      'specialities' => $specialities,
      'days' => $days
    ])
    {{ Form::close() }}
  </div>
</div>
@endsection