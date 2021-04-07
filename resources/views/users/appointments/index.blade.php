@extends('layouts.default')
@section('title', 'Moje wizyty')
@section('content')

<div class="bg-white rounded p-4 mt-2 shadow-sm">
  <form action="" class="form-inline">
    {{Form::select('speciality_id', $specialities, app('request')->speciality_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolna specjalizacja'])}}
    {{Form::select('doctor_id', $doctors, app('request')->doctor_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolny lekarz'])}}
    {{Form::select('status', $statuses, app('request')->status, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolny status'])}}
    <button type="submit" class="btn btn-primary">Filtruj</button>
  </form>

  <table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Termin</th>
            <th scope="col">Specjalizacja</th>   
            <th scope="col">Lekarz</th>
            <th scope="col">Status</th>
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
              @lang("models/appointment.status.{$appointment->statusKey}")
            </td>
            <td>
              <a href="{{ url("users/{$appointment->user_id}/appointments/{$appointment->id}/cancel") }}" class="btn btn-sm border btn-light">
                <i class="fas fa-eye mr-2"></i>
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