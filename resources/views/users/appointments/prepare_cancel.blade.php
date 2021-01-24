@extends('layouts.default')
@section('title', 'Odwołanie wizyty')
@section('content')

<div class="bg-white rounded p-4 mt-2 shadow-sm">
  <h3 class="font-weight-bold mb-4">Potwierdzenie odwołania wizyty</h3>

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
      </tbody>
    </table>
    <div class="mt-4 d-flex justify-content-center">
      <button type="submit" class="btn btn-success">Odwołaj wizytę </button>
      <a href="{{ url("users/{$appointment->user_id}/appointments") }}" class="btn btn-light ml-2">Rezygnuję</a>
    </div>
  {{ Form::close() }}


</div>
@endsection