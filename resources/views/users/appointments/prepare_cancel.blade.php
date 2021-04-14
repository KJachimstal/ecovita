@extends('layouts.default')
@section('title', 'Szczegóły wizyty')
@section('content')

<div class="bg-white rounded p-4 mt-2 shadow-sm">
  <h3 class="font-weight-bold mb-4">Szczegóły wizyty</h3>

  {{ Form::open(['method' => 'post']) }}
    <table class="table table-borderless mt-2">
      <tbody>
        <tr>
          <th scope="row">Lekarz</th>
          <td>{{ $appointment->doctorSpeciality->doctor->user->fullName}}</td>
        </tr>
        <tr>
          <th scope="row">Specjalność</th>
          <td>{{ $appointment->doctorSpeciality->speciality->name }}</td>
        </tr>
        <tr>
          <th scope="row">Data</th>
          <td>{{ $appointment->begin_date }}</td>
        </tr>
        @if ( $appointment->status == 3)
        <tr>
          <th scope="row">Rozpoznanie</th>
          <td>{!! $appointment->detail->description !!}</td>
        </tr>
        @endif
      </tbody>
    </table>
    <div class="mt-4 d-flex justify-content-center">
      @if ( $appointment->status != 3) <button type="submit" class="btn btn-success">Odwołaj wizytę </button> @endif
      {{-- <a href="{{ url("users/{$appointment->user_id}/appointments") }}" class="btn btn-light ml-2 border border-secondary">Powrót</a> --}}
      <div onclick="window.history.back()" class="btn btn-light ml-2 border border-secondary"> Powrót</div>
  {{ Form::close() }}


</div>
@endsection