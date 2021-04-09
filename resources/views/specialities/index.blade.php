@extends('layouts.default')
@section('title', 'Specjalności')
@section('content')
  <div class="p-4 mt-2">
    <h3 class="font-weight-bold mb-4">Specjalności</h3>
    <div class="row">
        @forelse ($allSpecialities as $speciality)
            @include('specialities.shared.speciality', ['speciality' => $speciality])
        @empty
            <p>No specialities</p>
        @endforelse
    </div>
  </div>
@endsection