@extends('layouts.default')
@section('title', 'Specjalność')
@section('content')
    
<div class="p-4 mt-2">
    <h3 class="font-weight-bold mb-4 text-capitalize">{{ $speciality->name }}</h3>

    <div class="p-4 mt-2 bg-white rounded shadow-sm">
        <h4 class="mb-4">Specjaliści</h4>

        <ul class="list-group">
            @forelse ($speciality->doctors as $doctor)
                    @include('specialities.shared.doctor', ['doctor' => $doctor])
            @empty
                <li class="list-group-item">No doctors</li>
            @endforelse
        </ul>
    </div>
</div>
@if ((Auth::user()->is_panel_active) && (Auth::user()->is_employee))
  <div class="mt-4 d-flex justify-content-center">
    <a href="{{ url("specialities/{$speciality->id}/edit") }}" class="btn btn-success ml-2">Edytuj specjalność</a>
  </div>
@endif
@endsection
