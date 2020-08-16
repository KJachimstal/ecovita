@extends('layouts.default')
@section('title', 'Wizyty')


@section('content')
    @forelse ($appointments as $appointment)
        <li>
            <a href="{{ url('appointments', [$appointment->id]) }}">
                {{ $appointment->doctorSpeciality->doctor->user->name}}
                {{ $appointment->doctorSpeciality->doctor->user->surname}}
                <p>Godzina przyjęcia: {{ $appointment->begin_date}} </p>
                @if ($appointment->is_available == 1)
                    <p>Ten termin jest dostępny.</p>
                @else
                    <p>Ten termin jest niedostępny.</p>
                @endif
            </a>
        </li>
    @empty
        <p>Brak terminów</p>
    @endforelse
@endsection