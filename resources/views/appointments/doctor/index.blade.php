@extends('layouts.default')
@section('title', 'Umówione wizyty')
@section('content')
<h3 class="font-weight-bold mb-4">Umówione wizyty</h3>
  <div class="bg-white rounded p-4 mt-2 shadow-sm">
    <div class="row">
      <div class="col-10">
        <form action="" class="form-inline mb-2">
          {{ Form::select('speciality_id', $specialities, app('request')->speciality_id, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolna specjalizacja']) }}
          {{ Form::date('begin_date', null, ['class' => 'form-control mr-sm-2']) }}
          {{ Form::select('status', $statuses, app('request')->status, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Dowolny status']) }}
          {{ Form::select('user_id', $user ?? [], null, ['class' => 'form-control mr-sm-2 patient_search', 'placeholder' => 'Wyszukaj pacjenta..']) }}
          <button type="submit" class="btn btn-primary ml-2">Filtruj</button>
        </form>
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
                @if ( $appointment->status == 3 )
                <a href="{{ route('doctor.appointments.show', ['doctor' => Auth::user()->userable_id, 'appointment' => $appointment->id]) }}">
                  <button class="btn btn-sm btn-info">
                    <i class="fas fa-info mr-2"></i>Informacje
                  </button>
                </a>
                @else
                {{ Form::open(['method' => 'PUT', 'route' => ['doctor.appointments.start', ['doctor' => Auth::user()->userable_id, 'appointment' => $appointment->id]]]) }}
                  <button class="btn btn-sm btn-secondary">
                    <i class="fas fa-play mr-2"></i>Rozpocznij
                  </button>
                {{ Form::close() }}
                @endif
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
  <script src="{{ URL::asset('js/search/patient.js') }}"></script>
@endsection