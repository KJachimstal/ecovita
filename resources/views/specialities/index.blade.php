@extends('layouts.default')
@section('title', 'Specjalności')
@section('content')

@if ((Auth::user()->is_panel_active) && (Auth::user()->is_employee))
    @include('specialities.admin.index');
{{--   
    <div class="mt-4 d-flex justify-content-center">
      <a href="{{ url("specialities/{$speciality->id}/edit") }}" class="btn btn-success ml-2">Edytuj specjalność</a>
    </div> --}}
@else
  <div class="p-4 mt-2">
    <h3 class="font-weight-bold mb-4">Specjalności</h3>
    <div class="row">
        @forelse ($specialities as $speciality)
            @include('specialities.shared.speciality', ['speciality' => $speciality])
        @empty
            <p>No specialities</p>
        @endforelse
    </div>
  </div>
@endif
@endsection