@extends('layouts.default')
@section('title', 'Wizyty')
@section('content')
<div class="bg-white rounded p-4 mt-2 shadow-sm form-inline justify-content-center">
    <div class="p-4 mt-2">
        <h3 class="font-weight-bold mb-4 justify-content-center">Wybierz specjalizację: </h3>
        <div class="row">
            @forelse ($specialities as $speciality)
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card mb-4 bg-white rounded shadow-sm">
                  <div class="card-body">
                    <h4 class="card-title font-weight-bold text-capitalize" style="height: 80px">{{ $speciality->name }}</h4>
                    <a href="{{ route('appointments.index', ['speciality_id' => $speciality->id]) }}" class="btn btn-outline-success">
                      Wybierz
                    </a>
                  </div>
                </div>
              </div>
            @empty
                <p>No specialities</p>
            @endforelse
        </div>
      </div>
    
</div>
@endsection