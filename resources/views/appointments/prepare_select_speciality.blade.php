@extends('layouts.default')
@section('title', 'Wizyty')
@section('content')
<div class="bg-white rounded p-4 mt-2 shadow-sm form-inline justify-content-center">
    {{-- {{ Form::open(array('url' => 'select_speciality')) }}
        {{ Form::select('speciality_id', $specialities, app('request')->speciality_id, ['class' => 'form-control mr-sm-2']) }}
        {{ Form::submit('Wybierz specjalizację', ['class' => 'btn btn-success'])}}
    {{ Form::close() }} --}}

    <div class="p-4 mt-2">
        <h3 class="font-weight-bold mb-4 justify-content-center">Wybierz specjalizację: </h3>
        <div class="row">
            @forelse ($specialities as $speciality)
              <div class="col-3">
                <div class="card mb-4 bg-white rounded shadow-sm">
                  <div class="card-body">
                    <h5 class="card-title font-weight-bold text-capitalize">{{ $speciality->name }}</h5>
                    <a href="{{ url('specialities', [$speciality->id]) }}" class="btn btn-light">
                      Zapisz się
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
@endsectiona