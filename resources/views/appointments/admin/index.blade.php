@extends('layouts.default')
@section('title', 'Zarządzaj wizytami')
@section('content')
<h3 class="font-weight-bold mb-4">Zarządzanie wizytami</h3>
  <div class="bg-white rounded p-4 mt-2 shadow-sm">
    <div class="row">
      <div class="col-10">
        <form action="" class="form-inline">
          {{Form::select('speciality_id', $specialities, app('request')->speciality_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolna specjalizacja'])}}
          {{Form::select('doctor_id', $doctors, app('request')->doctor_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolny lekarz'])}}
          {{Form::date('begin_date', null, ['class' => 'form-control mr-sm-2'])}}
          {{Form::select('status', $statuses, app('request')->status, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolny status'])}}
          {{-- {{Form::date('begin_date', \Carbon\Carbon::now(), ['class' => 'form-control mr-sm-2'])}} --}}
          <button type="submit" class="btn btn-primary">Filtruj</button>
        </form>
      </div>
      <div class="col-2 text-right">
        <a href="{{ url("appointments/create") }}" class="btn btn-success ml-2">Dodaj wizytę</a>
      </div>
    </div>

  <table class="table table-striped">
      <thead>
          <tr>
              <th scope="col">Termin</th>
              <th scope="col">Specjalizacja</th>   
              <th scope="col">Lekarz</th>
              <th scope="col">Zapisany pacjent</th>
              <th scope='col'>Status</th>
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
                @if (!empty($appointment->user->fullName)) 
                  {{ $appointment->user->fullName }}
                @endif
              </td>
              <td>
                @lang("models/appointment.status.{$appointment->statusKey}")
              </td>
              <td>
                {{ Form::open(['method' => 'DELETE', 'route' => ['appointments.destroy', $appointment->id]]) }}
                  <a href="{{ url("appointments/{$appointment->id}/edit") }}" class="btn btn-sm border btn-light">
                    <i class="fas fa-edit"></i>
                  </a>
                  <button class="btn btn-sm btn-danger" onclick="return confirm('Czy chcesz usunąć wizytę?')">
                    <i class="fas fa-trash"></i>
                  </button>
                {{ Form::close() }}
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