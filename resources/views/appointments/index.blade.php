@extends('layouts.default')
@section('title', 'Wizyty')


@section('content')

<form action="" class="form-inline">
  {{Form::select('speciality_id', $specialities, app('request')->speciality_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Wybierz specjalizację...'])}}
  {{Form::select('doctor_id', $doctors, app('request')->doctor_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Wybierz lekarza...'])}}
  {{Form::date('begin_date', \Carbon\Carbon::now(), ['class' => 'form-control mr-sm-2'])}}
  <button type="submit" class="btn btn-primary">Filtruj</button>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Termin</th>
            <th scope="col">Specjalizacja</th>   
            <th scope="col">Lekarz</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
      @forelse ($appointments as $appointment)
          <tr>
            <td>
              {{ $appointment->begin_date }}
            </td>
            <td>
              {{ $appointment->doctorSpeciality->speciality->name }}
            </td>
            <td>
              {{ $appointment->doctorSpeciality->doctor->user->fullName }}
            </td>
            <td>
              <a href="{{ url('appointments', [$appointment->id]) }}">Podgląd</a>
            </td>
          </tr>
      @empty
        <tr>
          <td colspan="4">Brak terminów</td>
        </tr>
      @endforelse
    </tbody>
</table>
@endsection