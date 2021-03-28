@extends('layouts.default')
@section('title', 'Edytuj wizytę')
@section('content')
<div class="container">
  <h3 class="font-weight-bold mb-4">Edytuj wizytę</h3>
  <div class="p-4 bg-white shadow-sm">
    @include('shared.errors')
    <h3 class="font-weight-bold mb-4">Szczegóły wizyty:</h3>
    <h4 class="font-weight-light">Specjalizacja: {{$appointment->doctorSpeciality->speciality->name}}</h4>
    <h4 class="font-weight-light">Pacjent: @if (!empty($appointment->user->fullName)) {{ $appointment->user->fullName}} @else {{"Wizyta niezarezerwowana"}}@endif</h4>
    <h4 class="font-weight-light">Doktor: {{ $appointment->doctorSpeciality->doctor->user->fullName}}</h4>
    <h4 class="font-weight-light">Data i godzina przyjęcia: {{ $appointment->begin_date}} </h4>

    <h3 class="font-weight-bold mu-4">Rozpoznanie:</h3>
    {{-- {{ Form::open(['method' => 'PUT', 'route' => ['doctor.appointments.update', ['doctor' => Auth::user()->userable_id, 'appointment' => $appointment->id]]]) }}
      <button class="btn btn-sm btn-danger">
        <i class="fas fa-save mr-2"></i></i>Zakończ wizytę
      </button>
    {{ Form::close() }} --}}
    {{ Form::open(['method' => 'PUT', 'route' => ['doctor.appointments.cancel', ['doctor' => Auth::user()->userable_id, 'appointment' => $appointment->id]]]) }}
    <button class="btn btn-secondary">Powrót</button>
    {{ Form::close() }}
</div>
</div>
@endsection