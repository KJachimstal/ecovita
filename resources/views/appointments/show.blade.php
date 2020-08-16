@extends('layouts.default')
@section('title', 'Specjalność')
@section('content')

<ul>
    {{ $appointment->doctorSpeciality->doctor->user->name}}
    {{ $appointment->doctorSpeciality->doctor->user->surname}}
    <p>Godzina przyjęcia: {{ $appointment->begin_date}} </p>
</ul>
@endsection
