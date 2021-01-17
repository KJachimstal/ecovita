@extends('layouts.default')
@section('title', 'Zarządzaj wizytami')
@section('content')
<h3 class="font-weight-bold mb-4">Zarządzanie wizytami</h3>
  <div class="bg-white rounded p-4 mt-2 shadow-sm">
    <div class="row">
      <div class="col-8">
        <form action="" class="form-inline">
          {{Form::select('speciality_id', $specialities, app('request')->speciality_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Wybierz specjalizację...'])}}
          {{Form::select('doctor_id', $doctors, app('request')->doctor_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Wybierz lekarza...'])}}
          {{Form::date('begin_date', null, ['class' => 'form-control mr-sm-2'])}}
          {{-- {{Form::date('begin_date', \Carbon\Carbon::now(), ['class' => 'form-control mr-sm-2'])}} --}}
          <button type="submit" class="btn btn-primary">Filtruj</button>
        </form>
      </div>
      <div class="col-4 text-right">
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
              <th scope='col'>Dostępna</th>
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
                @if ($appointment->is_available)
                  <i class="fas fa-check text-success"></i>
                @else
                  <i class="fas fa-times text-muted"></i>
                @endif
              </td>
              <td>
                {{ Form::open(['method' => 'DELETE', 'route' => ['appointments.destroy', $appointment->id]]) }}
                  <a href="{{ url("appointments/{$appointment->id}/edit") }}" class="btn btn-sm border btn-light">
                    <i class="fas fa-user-edit"></i>
                  </a>
                  <button class="btn btn-sm btn-danger" onclick="return confirm('Czy chcesz usunąć wizytę?')">
                    <i class="fas fa-trash"></i>
                  </button>
                {{ Form::close() }}
              </td>
            </tr>
            {{-- <tr>
              <td colspan="6">
                {{ print_r($appointment) }}
              </td>
            </tr> --}}
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