@extends('layouts.default')
@section('title', 'Wizyta')
@section('content')

<ul>
    {{ $appointment->doctorSpeciality->doctor->user->first_name}}
    {{ $appointment->doctorSpeciality->doctor->user->last_name}}
    <p>Godzina przyjęcia: {{ $appointment->begin_date}} </p>
</ul>
@endsection
