@extends('layouts.default')
@section('title', 'Wizyta')
@section('content')

<ul>
    <h3 class="font-weight-bold mb-4">Szczegóły wizyty:</h3>
    <h4 class="font-weight-light">Specjalizacja: {{$appointment->doctorSpeciality->speciality->name}}</h4>
    <h4 class="font-weight-light">Pacjent: @if (!empty($appointment->user->fullName)) {{ $appointment->user->fullName}} @else {{"Wizyta niezarezerwowana"}}@endif</h4>
    <h4 class="font-weight-light">Doktor: {{ $appointment->doctorSpeciality->doctor->user->fullName}}</h4>
    <h4 class="font-weight-light">Data i godzina przyjęcia: {{ $appointment->begin_date}} </h4>

    @if (Auth::user()->is_panel_active && Auth::user()->isDoctor)
    <div class="mt-4 d-flex justify-content-center">
        <a class="nav-link" href="{{ route('doctor.appointments.start', ['doctor' => Auth::user()->userable_id, 'appointment' => $appointment->id]) }}"><button type="submit" class="btn btn-primary">Rozpocznij wizytę</button></a>
        <a class="nav-link" href="{{ route('doctor.appointments', ['doctor' => Auth::user()->userable_id]) }}"><button class="btn btn-secondary">Powrót</button></a>
      </div>
    @endif
</ul>
@endsection
