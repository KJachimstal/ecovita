@extends('layouts.default')
@section('title', 'Wizyty')
@section('content')

<div class="bg-white rounded p-4 mt-2 shadow-sm">
<form action="" class="form-inline">
  {{Form::select('speciality_id', $specialities, app('request')->speciality_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolna specjalizacja'])}}
  {{Form::select('doctor_id', $doctors, app('request')->doctor_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolny lekarz'])}}
  {{Form::date('begin_date', \Carbon\Carbon::now(), ['class' => 'form-control mr-sm-2'])}}
  <button type="submit" class="btn btn-primary">Filtruj</button>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Termin</th>
            <th scope="col">Specjalizacja</th>   
            <th scope="col">Lekarz</th>
            <th scope="col">Opcje</th>
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
              <a href="{{ url("appointments/{$appointment->id}/enroll") }}" class="btn btn-sm border btn-light">
                <i class="fas fa-eye"></i>
              </a>
            </td>
          </tr>
      @empty
        <tr>
          <td colspan="4">Brak terminów</td>
        </tr>
      @endforelse
    </tbody>
</table>
{{ $appointments->links() }}
</div>
@endsection