@extends('layouts.default')
@section('title', 'Specjalności')


@section('content')
    @forelse ($specialities as $speciality)
        <li>
            <a href="{{ url('specialities', [$speciality->id]) }}">
                {{ $speciality->name }}
            </a>
        </li>
    @empty
        <p>No specialities</p>
    @endforelse
@endsection